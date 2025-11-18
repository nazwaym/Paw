<?php
$hostname = '127.0.0.1';
$username = 'root';
$password = '';  
$database = 'latihanPhpDasar';
$port     = 3307;    

$db = mysqli_connect($hostname, $username, $password, $database, $port);

if (!$db) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

echo "Koneksi sukses!";
?>
