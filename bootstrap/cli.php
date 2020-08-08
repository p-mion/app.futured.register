<?php

if (PHP_SAPI !== 'cli') {

    exit('bad channel');
}

define('APP_ROOT', realpath(__DIR__ . '/../'));

require __DIR__ . '/../vendor/autoload.php';

env_ini(APP_ROOT . '/.env');

