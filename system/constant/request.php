<?php

/*
|--------------------------------------------------------------------------
| Request-related constant settings
|--------------------------------------------------------------------------
*/

define("REQUEST_METHOD", $_SERVER["REQUEST_METHOD"]);

define("IS_POST", REQUEST_METHOD === "POST");

define("IS_GET", REQUEST_METHOD === "GET");

define("HTTP_HOST", $_SERVER["HTTP_HOST"]);

define("HTTP_PARAM", "?" . @$_SERVER['QUERY_STRING'] ?: '');

define("REQUEST_URI", $_SERVER["REQUEST_URI"]);

define("SCRIPT_NAME", $_SERVER["SCRIPT_NAME"]);

define("ROOT_URI", pathinfo(SCRIPT_NAME)["dirname"] . "/");

define("ROUTE_URI", rtrim(str_replace(HTTP_PARAM, "", str_replace(ROOT_URI, "", REQUEST_URI)), "/"));

// HTTP status code
define("HTTP_STATUS_CODE_404", 404);