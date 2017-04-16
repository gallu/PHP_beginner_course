<?php

/*
 * 認証関連の共通関数群
 */

function login($input_pass, $datum, $lock_table) {
    // 判定用フラグ
    $login_flg = false;
    // DBハンドルの取得
    $dbh = get_dbh();

    // emailが存在していたら、作業を続行する
    if (false === empty($datum)) {
        // ロックテーブルを読み込んで情報を把握する
        $sql = 'SELECT * FROM ' . $lock_table . ' WHERE user_id=:user_id;';
        $pre = $dbh->prepare($sql);
        // 値のバインド
        $pre->bindValue(':user_id', $datum['user_id'], PDO::PARAM_STR);
        // SQLの実行
        $r = $pre->execute(); // XXX
        // SELECTした内容の取得
        $lock_datum = $pre->fetch(PDO::FETCH_ASSOC);
        // とれてなければデフォルトの情報を入れる
        if (false === $lock_datum) {
            //
            $lock_datum['user_id'] = $datum['user_id'];
            $lock_datum['error_count'] = 0;
            $lock_datum['lock_time'] = '0000-00-00 00:00:00';
        }

        // 現在ロック中なら、時刻を確認
        if ('0000-00-00 00:00:00' !== $lock_datum['lock_time']) {
            // ロック時間が「現在以降」なら、ロックを一端外す
            if (time() > strtotime($lock_datum['lock_time'])) {
                $lock_datum['lock_time'] = '0000-00-00 00:00:00';
                $lock_datum['error_count'] = 0;
            }
        }

        // 最終的に「ロックされていなければ」以下の処理をする
        if ('0000-00-00 00:00:00' === $lock_datum['lock_time']) {
            // パスワードを比較して、その結果を代入する
            if (true === password_verify($input_pass, $datum['pass'])) {
                // countのリセット
                $lock_datum['error_count'] = 0;
                // ログインフラグを立てる
                $login_flg = true;
            } else {
                // countのいんくり
                ++ $lock_datum['error_count'];
                // 一定回数(一端、５回)連続でエラーなら、ロックを入れる(一端、１時間)
                if (5 <= $lock_datum['error_count']) {
                    $lock_datum['lock_time'] = date('Y-m-d H:i:s', time() + 3600);
                    // XXX ここで「ユーザメールに"ログインロックがされた。心当たりがなければ運用に連絡して欲しい"的なmailを投げる等の処理を入れるのも有効
                }
            }
        }

        // ロックテーブルに情報を入れる
        // XXX いわゆるupsertにはREPLACEとINSERT ON DUPLICATE KEY UPDATEがあるが、今回は「全てのカラムを入れる」ので、SQL文がシンプルなREPLACEで対応
        $sql = 'REPLACE INTO ' . $lock_table . '(user_id, error_count, lock_time) VALUES(:user_id, :error_count, :lock_time);';
        $pre = $dbh->prepare($sql);
        // 値のバインド
        $pre->bindValue(':user_id', $lock_datum['user_id'], PDO::PARAM_STR);
        $pre->bindValue(':error_count', $lock_datum['error_count'], PDO::PARAM_INT);
        $pre->bindValue(':lock_time', $lock_datum['lock_time'], PDO::PARAM_STR);
        // SQLの実行
        $r = $pre->execute(); // XXX
    }

    //
    return $login_flg;
}
