<?php
error_reporting(E_ERROR | E_PARSE);
$offset_page = 25;

// konfiguracja baza danych MySQL
$user = 'root';
$password = 'root';
$host = 'localhost';
$database = 'calendar';
///////
$smtp_host = "smtp.gmail.com";
$smtp_port = 25;
$smtp_login = "email@gmail.com";
$smtp_password = "password";


function make_con() {
    global $user, $password, $database, $host;
    $con = new mysqli($host, $user, $password, $database);
    $con->set_charset("utf8");
    return $con;
}


