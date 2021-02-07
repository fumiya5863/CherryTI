<?php

/*
|--------------------------------------------------------------------------
| DB related constant setting
|--------------------------------------------------------------------------
*/

// DB connection settings
define(
    "DB_CONFIG",
    [
        "driver"    => $_ENV["DB_CONNECTION"],
        "host"      => $_ENV["DB_HOST"],
        "database"  => $_ENV["DB_DATABASE"],
        "username"  => $_ENV["DB_USERNAME"],
        "password"  => $_ENV["DB_PASSWORD"],
        "charset"   => $_ENV["DB_CHARSET"],
        "collation" => $_ENV["DB_COLLATION"],
    ]
);