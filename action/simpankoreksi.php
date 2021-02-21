<?php 
// error_reporting(0);

include_once '../config/connection.php';

$qwe   = "UPDATE absen set activerow='0' WHERE nip=\"$_POST[nip]\" AND tanggal = \"$_POST[tanggal]\" and activerow='1'";
$doqwe = mysqli_query($conn, $qwe);

$qwe   = "INSERT INTO absen (nip, tanggal, tap_in, tap_out, status_in, status_out, bekerja) VALUES (\"$_POST[nip]\",\"$_POST[tanggal]\",\"$_POST[tap_in]\",\"$_POST[tap_out]\",\"$_POST[status_in]\",\"$_POST[status_out]\",\"$_POST[bekerja]\")";
$doqwe = mysqli_query($conn, $qwe);

$qwe   = "UPDATE absen_detail set activerow='0' WHERE nip=\"$_POST[nip]\" AND DATE(waktu) = \"$_POST[tanggal]\" and activerow='1'";
$doqwe = mysqli_query($conn, $qwe);

if (!empty($_POST['tap_in'])) {
	$waktu = $_POST['tanggal']." ".$_POST['tap_in'];
	$qwe   = "INSERT INTO absen_detail (nip, tipe, bekerja, waktu, device) VALUES (\"$_POST[nip]\",'IN',\"$_POST[bekerja]\",\"$waktu\",'koreksi')";
	$doqwe = mysqli_query($conn, $qwe);
}

if (!empty($_POST['tap_out'])) {
	$waktu = $_POST['tanggal']." ".$_POST['tap_out'];
	$qwe   = "INSERT INTO absen_detail (nip, tipe, bekerja, waktu, device) VALUES (\"$_POST[nip]\",'OUT',\"$_POST[bekerja]\",\"$waktu\",'koreksi')";
	$doqwe = mysqli_query($conn, $qwe);
}

echo "Berhasil";
