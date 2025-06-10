<?php
$host = 'localhost';
$username = 'root';
$password = ''; // Sesuaikan jika ada password
$database = 'dbms_berita';
$mysqli = new mysqli($host, $username, $password, $database);
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>