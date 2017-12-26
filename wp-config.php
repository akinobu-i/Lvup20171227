<?php
/**
 * WordPress の基本設定
 *
 * このファイルは、インストール時に wp-config.php 作成ウィザードが利用します。
 * ウィザードを介さずにこのファイルを "wp-config.php" という名前でコピーして
 * 直接編集して値を入力してもかまいません。
 *
 * このファイルは、以下の設定を含みます。
 *
 * * MySQL 設定
 * * 秘密鍵
 * * データベーステーブル接頭辞
 * * ABSPATH
 *
 * @link http://wpdocs.osdn.jp/wp-config.php_%E3%81%AE%E7%B7%A8%E9%9B%86
 *
 * @package WordPress
 */

// 注意:
// Windows の "メモ帳" でこのファイルを編集しないでください !
// 問題なく使えるテキストエディタ
// (http://wpdocs.osdn.jp/%E7%94%A8%E8%AA%9E%E9%9B%86#.E3.83.86.E3.82.AD.E3.82.B9.E3.83.88.E3.82.A8.E3.83.87.E3.82.A3.E3.82.BF 参照)
// を使用し、必ず UTF-8 の BOM なし (UTF-8N) で保存してください。

// ** MySQL 設定 - この情報はホスティング先から入手してください。 ** //
/** WordPress のためのデータベース名 */
define('DB_NAME', 'wp');

/** MySQL データベースのユーザー名 */
define('DB_USER', 'wp');

/** MySQL データベースのパスワード */
define('DB_PASSWORD', 'AckN0Bee');

/** MySQL のホスト名 */
define('DB_HOST', 'localhost');

/** データベースのテーブルを作成する際のデータベースの文字セット */
define('DB_CHARSET', 'utf8mb4');

/** データベースの照合順序 (ほとんどの場合変更する必要はありません) */
define('DB_COLLATE', '');

/**#@+
 * 認証用ユニークキー
 *
 * それぞれを異なるユニーク (一意) な文字列に変更してください。
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org の秘密鍵サービス} で自動生成することもできます。
 * 後でいつでも変更して、既存のすべての cookie を無効にできます。これにより、すべてのユーザーを強制的に再ログインさせることになります。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'U(5,<ObUWuWTc3b?Mk+&5c0mn%sGSA}z-h^05}f_CZ?M5 7v.g/x1:>Ob!z4 =,f');
define('SECURE_AUTH_KEY',  ' $nIQU5WRF[R80}~t6kaEXyan26N44C=3G:6p{qV;!cSis=RF5h1H0V(N:(k|{3`');
define('LOGGED_IN_KEY',    'Xkx!,9AU|Zjc*un22L6{CBUvjngO`99[FtdP1EkMks=I.Bo{/*4a|h P)-n]mtG3');
define('NONCE_KEY',        '<rhf~(_B 2*lPJ^5C[-sJ*}B9=]?T|GK}VfF{OE{+A1T.9}&?3%UT5g%brf`JU5w');
define('AUTH_SALT',        'A7~VwGvVa9CKrID$?B})!5(!wq02=Sz|20d7k=3LW ;a?OZZTJ.cF0 3G5Gh,5;+');
define('SECURE_AUTH_SALT', '#~1#wSBW$fe#oZ_Ew@R]g^pF}mnGmVzj.%[Bdto@f,f_cH|TR:%$qs~!dKxdl0zR');
define('LOGGED_IN_SALT',   '}2u#K/}{_8HsWZV 6HB$.`?WvzI@CO=(S(2H$`D4_u-9Z~+<T?blII{u)^J+(6iT');
define('NONCE_SALT',       '[&deCYvq##pm/5e.pL*.(vU3tF/!nf4e)2GMc;A^_DN,~cBS$$b;%E=a{j=CU7.|');

/**#@-*/

/**
 * WordPress データベーステーブルの接頭辞
 *
 * それぞれにユニーク (一意) な接頭辞を与えることで一つのデータベースに複数の WordPress を
 * インストールすることができます。半角英数字と下線のみを使用してください。
 */
$table_prefix  = 'wp_';

/**
 * 開発者へ: WordPress デバッグモード
 *
 * この値を true にすると、開発中に注意 (notice) を表示します。
 * テーマおよびプラグインの開発者には、その開発環境においてこの WP_DEBUG を使用することを強く推奨します。
 *
 * その他のデバッグに利用できる定数については Codex をご覧ください。
 *
 * @link http://wpdocs.osdn.jp/WordPress%E3%81%A7%E3%81%AE%E3%83%87%E3%83%90%E3%83%83%E3%82%B0
 */
define('WP_DEBUG', false);

/* 編集が必要なのはここまでです ! WordPress でブログをお楽しみください。 */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
