<?php

use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * Configure the database and boot Eloquent
 */
$capsule = new Capsule;

$local = array(
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'mybanjir',
    'username'  => 'homestead',
    'password'  => 'secret',
    'charset'   => 'utf8',
    'collation' => 'utf8_general_ci',
    'prefix'    => ''
);

$capsule->addConnection($local);

$capsule->setAsGlobal();

$capsule->bootEloquent();

// set timezone for timestamps etc
date_default_timezone_set('UTC');
