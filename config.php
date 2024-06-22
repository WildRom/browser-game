<?php
date_default_timezone_set('Europe/London');

require_once 'libs\rb.php';

R::setup('mysql:host=localhost;dbname=trading_game', 'root', '');

if (!R::testConnection()) {
    die('Error connecting to the database');
}

require_once 'vendor/autoload.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('templates');
// $loader = new Twig_Loader_Filesystem();
// $twig = new Twig_Environment($loader, array('cache' => 'cache'));

// $loader = new Twig_Loader_String();
// echo $twig->render('Hello {{ name }}!', array('name' => 'Fabien'));
// die;
$twig = new Twig_Environment($loader);

session_start();
?>