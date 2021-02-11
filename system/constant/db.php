<?php

/*
|--------------------------------------------------------------------------
| DB related constant setting
|--------------------------------------------------------------------------
*/

define("DB_DRIVER", $_ENV["DB_CONNECTION"]);

define("DB_HOST", $_ENV["DB_HOST"]);

define("DB_DATABASE", $_ENV["DB_DATABASE"]);

define("DB_USERNAME", $_ENV["DB_PASSWORD"]);

define("DB_PASSWORD", $_ENV["DB_PASSWORD"]);

define("DB_CHARSET", $_ENV["DB_CHARSET"]);

define("DB_COLLATION", $_ENV["DB_COLLATION"]);

// DB connection settings
define(
    "DB_CONFIG",
    [
        "driver"    => DB_DRIVER,
        "host"      => DB_HOST,
        "database"  => DB_DATABASE,
        "username"  => DB_USERNAME,
        "password"  => DB_PASSWORD,
        "charset"   => DB_CHARSET,
        "collation" => DB_COLLATION,
    ]
);