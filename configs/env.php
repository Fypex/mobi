<?php

use Symfony\Component\Dotenv\Dotenv;

$env = new Dotenv();
$env->overload('../.env');
