<?php

// error display for in browser testing
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$username = "root";
$hostname = "localhost";
$password = "";
$dbname = "sportradar";

$conn = mysqli_connect($hostname, $username, $password, $dbname);

if (!$conn) {
  die("Connection failed.");
}
