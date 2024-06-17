<?php
require_once 'rb.php';

R::setup('mysql:host=localhost;dbname=trading_game', 'root', '');

if (!R::testConnection()) {
    die('Error connecting to the database');
}

session_start();
?>