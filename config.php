<?php
session_start();
define('SECRET','stock-learning');
define('SITE_DOMAIN','http://localhost/stock-learning/');
$conn = new mysqli("localhost","root","","stock_learning");
$conn->set_charset("utf8");
$createdAt = date('Y-m-d H:i:s');
?>