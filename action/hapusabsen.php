<?php

include_once '../config/connection.php';

$query  = $conn->query("UPDATE absen_detail set activerow='0' where id='$_POST[id]'");

if ($query) {
	echo "Berhasil";
}
else{
	echo "Gagal";
}