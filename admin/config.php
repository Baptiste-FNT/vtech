<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

$user = 'nom';
$password = 'mot_de_passe'; //To be completed if you have set a password to root
$database = 'vtech'; //To be completed to connect to a database. The database must exist.
$port = NULL; //Default must be NULL to use default port
$conn = new mysqli('127.0.0.1', $user, $password, $database, $port);
$conn->set_charset("utf8mb4");
if ($conn->connect_error) {
    die('Connect Error (' . $conn->connect_errno . ') '
            . $conn->connect_error);
}
