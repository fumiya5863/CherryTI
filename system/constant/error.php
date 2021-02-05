<?php

/*
|--------------------------------------------------------------------------
| Error-related constants
|--------------------------------------------------------------------------
*/

// Error output file
define("ERROR_LOG",  "error.log");
define("ERROR_LOG_PATH", LOG_PATH . ERROR_LOG);

// Error class
define("ERROR_CLASS", 'Error');
define("ERROR_CLASS_NAME", SEPARATORS['underbar'] . ERROR_CLASS);

//Error method
define("ERROR_HANDLER_METHOD", '_error_handler');
define("ERROR_SHUTDOWN_HANDLER_METHOD", '_error_shutdown_handler');

// Error display file
define("ERROR_TEMPLATE_FILE", TEMPLATE_PATH . "error.php");
define("ERROR_TEMPLATE_404_FILE", TEMPLATE_PATH . "404_error.php");

// Error set
define("LEVEL", "_level");
define("MESSAGE", "_message");
define("FILE", "_file");
define("LINE", "_line");

// Error level
define(
    "ERROR_LEVELS",
    [
        1    => "ERROR",
        2    => "WARNING",
        4    => "PARSE",
        8    => "NOTICE",
        16   => "CORE_ERROR",
        32   => "CORE_WARNING",
        64   => "COMPILE_ERROR",
        128  => "COMPILE_WARNING",
        256  => "COMPILE_WARNING",
        521  => "USER_WARNING",
        1024 => "USER_NOTICE",
        2048 => "E_STRICT",
    ]
);