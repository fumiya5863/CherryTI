<?php

/*
|--------------------------------------------------------------------------
| Request-related constant settings
|--------------------------------------------------------------------------
*/

define("REQUEST_METHOD", $_SERVER["REQUEST_METHOD"]);

define("IS_POST",REQUEST_METHOD === "POST");

define("IS_GET",REQUEST_METHOD === "GET");

define("HTTP_HOST", $_SERVER["HTTP_HOST"]);

define("REQUEST_URI", $_SERVER["REQUEST_URI"]);

define("SCRIPT_NAME", $_SERVER["SCRIPT_NAME"]);

define("ROOT_URI", pathinfo(SCRIPT_NAME)["dirname"] . "/");

define("ROUTE_URI", str_replace(ROOT_URI, "", REQUEST_URI));