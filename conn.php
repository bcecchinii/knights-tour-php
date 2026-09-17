<?php

$config = require 'config.php';

$servername = $config['servername'];
$username = $config['username'];
$password = $config['password'];
$databasename = $config['databasename'];

$conn = new mysqli(
    $servername,
    $username,
    $password,
    $databasename
);