<?php
date_default_timezone_set("Asia/Jakarta");

// Deklarasi variable untuk koneksi ke database.
$host     = "localhost";
$username = "root";
$password = "root";
$database = "dbabsenwbp";

// Koneksi ke database.
$conn = new mysqli($host, $username, $password, $database);
