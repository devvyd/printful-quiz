<?php

use App\Core\Config;

require_once 'vendor/autoload.php';

$config = new Config();
var_dump($config->get('database')['driver']);