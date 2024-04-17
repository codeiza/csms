<?php

$localhost = '127.0.0.1';
$port = 3306;
$db = 'u423960254_dbcsms';
$user = 'root';
$pass = '';

//define( 'DSN', 'mysql:host='.$localhost.';dbname='.$dbname );
define('DSN', "mysql:host=$localhost;dbname=$db");
define('DB_USR', $user);
define('DB_PWD', $pass);