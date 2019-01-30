<?php

use App\Core\Config;
use App\Seeder;
use Illuminate\Database\Capsule\Manager as Capsule;

require_once 'vendor/autoload.php';

$config = new Config;
$capsule = new Capsule;

// Establish connection to database.
$capsule->addConnection(
    $config->get('database')
);

$capsule->setAsGlobal();
$capsule->bootEloquent();

// Creating & seeding database
(new Seeder)->seed();

