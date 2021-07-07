<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'cryptotik_wp1' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'cryptotik_wp1' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', 'jaQ&I94Vt' );

/** Имя сервера MySQL */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '~sISTvz-yfFy3#M:gR{&FjrrK.k{g~,GVyeY^;C~)apj]iQHwe~ VdT|PUy+P.-2' );
define( 'SECURE_AUTH_KEY',  'CfPY3RQSt,.vZyrSZFISvsKpD/~W(6Sg,sQR87=.QO>j+U)r^l_ V[<w`P*5.I]c' );
define( 'LOGGED_IN_KEY',    '&/#b7vC[(vD>Vgu1,@{[$<hc#mNL6?!WX=U.i}3u9R=XL_Yd7h~}lb.ksK0JXImi' );
define( 'NONCE_KEY',        'Wp{|#ZMVSpVJ};Nl6`1|x!MaN,~o@8$F3Q-q,sC2g5626eVi*dB5W:SPRmz!^zD&' );
define( 'AUTH_SALT',        '70e8 BKfBJ3HTZ>x83+mXnY@-K[c%?r#pQTANHgD9Gy|gVb`T}t.1Wt^OvA1$!b+' );
define( 'SECURE_AUTH_SALT', 'TS}]NFt*FVL)`v2@y@1?$OnZu!|+RhGrJxe7?_0aUDVv?_6w.x4lvCN~UbFJ]tl/' );
define( 'LOGGED_IN_SALT',   'CstDo7vLofg2)o>t~,IO!aU>*>q6_A`TUBidOyOw8U!Oe)X].u|8[O|ymLj&4^m~' );
define( 'NONCE_SALT',       'HK[aVEAfvbd)PNQfp2}VYpgJ2zQ]P&&(P;(Mrvb)Va?j>l50J=~2I|AT.y1[EV=L' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
