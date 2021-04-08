<?php

/*
|--------------------------------------------------------------------------
| system path initialization constant
|--------------------------------------------------------------------------
*/

// Path setting
define("ENV_PATH", ROOT_PATH . "env/");

define("CLASS_PATH", SYSTEM_PATH . "class/");

define("CONSTANT_PATH", SYSTEM_PATH . "constant/");

define("HELPER_PATH", SYSTEM_PATH . "helper/");

define("EXTERNAL_PATH", SYSTEM_PATH . "external/");

// Files in the system folder
define(
    "SYSTEM_LOAD_PATH",
    [
        CONSTANT_PATH => [
            "init_setting.php",
            "file.php",
            "path.php",
            "request.php",
            "db.php",
            "error.php"
        ],
        HELPER_PATH => [
            "Session.php"
        ],
        CLASS_PATH => [
            "Error.php",
            "Model.php",
            "Router.php",
            "Controller.php"
        ]
    ]
);

// Separator related
define(
    "SEPARATORS",
    [
        'underbar' => '_'
    ]
);