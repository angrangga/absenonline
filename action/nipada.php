<?php 
include_once '../config/connection.php';

$query = $conn->query("SELECT EXISTS(SELECT nama FROM pegawai WHERE nip=\"$_POST[nip]\") AS ada");
$data  = mysqli_fetch_array($query);
echo $data['ada'];
