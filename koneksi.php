<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$conn = new mysqli("localhost", "root", "", "galery_foto");

//check koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// error_reporting(E_ALL);
// ini_set("display_errors", 1);
