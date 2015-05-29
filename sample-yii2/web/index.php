<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

// register Composer autoloader - autoload the libraries for us 
require(__DIR__ . '/../vendor/autoload.php');

// include Yii class file
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

//load application configuration 
$config = require(__DIR__ . '/../config/web.php');

//create(instantiate), configure and run the application 
(new yii\web\Application($config))->run();

