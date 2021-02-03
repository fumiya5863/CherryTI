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
        "driver"    => _load_env("DB_CONNECTION"),
        "host"      => _load_env("DB_HOST"),
        "database"  => _load_env("DB_DATABASE"),
        "username"  => _load_env("DB_USERNAME"),
        "password"  => _load_env("DB_PASSWORD"),
        "charset"   => _load_env("DB_CHARSET"),
        "collation" => _load_env("DB_COLLATION"),
    ]
);