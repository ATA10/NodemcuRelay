<?php
/*
*
* Veritabanı bağlantısı için
* gerekli bağlantı bilgilerinin
* bulunduğu ayar dosyası.
*
*
*/

header('Content-Type: text/html; Charset=UTF-8');
date_default_timezone_set('Europe/Istanbul');
setlocale(LC_TIME, 'tr_TR');

define('MYSQL_HOST',	'localhost');
define('MYSQL_DB',		'espdemo');
define('MYSQL_USER',	'root');
define('MYSQL_PASS',	'');

include 'db.php';
