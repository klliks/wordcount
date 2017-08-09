<?php
require_once 'autoload.php';
use app\Autoloader as Autoload ;
use app\controllers\Controller;
$wordcount = new Controller($argv[1]);
$wordcount->run();
