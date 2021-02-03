<?php

// Path setting
define("ROOT_PATH", __DIR__ . "/");

define("SYSTEM_PATH", ROOT_PATH . "system/");

define("BOOTSTRAP_PATH", SYSTEM_PATH . "bootstrap/");

// Launch boot
require_once(BOOTSTRAP_PATH . "init.php");

exit;