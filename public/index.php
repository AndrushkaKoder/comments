<?php
include_once dirname(__DIR__) . '/config/constants.php';
include_once PATH . '/config/helpers.php';
include_once '../vendor/autoload.php';

use Kernel\App;

session_start();

($app = new App())->run();

