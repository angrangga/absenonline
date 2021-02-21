<?php
include_once '../config/connection.php';

if(isset($_POST["id"]))
{
	$query = "DELETE FROM pegawai WHERE id = '".$_POST["id"]."'";
	if(mysqli_query($conn, $query))
	{
		echo 'Data Deleted';
	}
}
?>