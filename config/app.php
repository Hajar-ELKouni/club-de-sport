<?php

session_start();

const APP_NAME = 'Sport Tetouan';
const APP_URL = '/VSPORT';
const contactEmail = 'contact@vsport.com';
const contactPhone = '+212602-918501';

// Usage
$mysqlHost = "localhost";
$mysqlDBname = "club";
$mysqlUsername = "root";
$mysqlPassword = "";

require_once __DIR__ . '/../database/connect.php';

$database = new DatabaseConnection($mysqlHost, $mysqlDBname, $mysqlUsername, $mysqlPassword);
$conn = $database->getConnection();

/*
* Time Zone Setting
*/
date_default_timezone_set('Africa/Casablanca');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
