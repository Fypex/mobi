<?php

use \RedBeanPHP\R as R;

R::setup( 'mysql:host='.$_ENV['DB_HOST'].';dbname='.$_ENV['DB_NAME'].'', $_ENV['DB_USER'], $_ENV['DB_PASS']);

if (!R::testConnection()){
    exit('Нет подключения к бд');
}