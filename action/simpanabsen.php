<?php

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
	$ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
	$ip = $_SERVER['REMOTE_ADDR'];
}

include_once '../config/connection.php';

$newTime = date('Y-m-d H:i:s', strtotime('-4 minutes -20 seconds'));

$query  = $conn->query("INSERT INTO absen_detail (ip,nip,tipe,bekerja,device,waktu) VALUES ('$ip',\"$_POST[nip]\",'$_POST[tipe]','$_POST[bekerja]','$_POST[deviceid]',\"$newTime\")");

if ($query) {

	// get tgl & jam post
	$qwe     = "SELECT DATE(waktu) AS tanggal, TIME(waktu) AS jam FROM absen_detail ORDER BY id DESC LIMIT 1";
	$doqwe   = mysqli_query($conn, $qwe);
	while ($data = mysqli_fetch_array($doqwe)) {
		$tglpost = $data['tanggal'];
		$jam     = $data['jam'];
	}

	// get absen terakhir
	$query   = $conn->query("SELECT * FROM absen WHERE nip=\"$_POST[nip]\" AND tanggal = '$tglpost' AND activerow ='1' ");
	while ($data = mysqli_fetch_array($query)) {
		$id      = $data['id'];
		$tap_in  = $data['tap_in'];
		$tap_out = $data['tap_out'];
	}

	// Jika Tipe IN
	if ($_POST['tipe'] == "IN") {
		// Jika sudah ada absen masuk
		if (isset($tap_in)){
			// do nothing (alert : Anda sudah absen masuk Post Date)
			echo "Anda Sudah Absen Masuk";
		}
		// Jika belum ada absen masuk
		else{
			// Insert absen isi kolom IN utk Post Date (alert : Berhasil)
			$conn->query("INSERT INTO absen (nip,tanggal,tap_in) VALUES (\"$_POST[nip]\",'$tglpost','$jam')");
			echo "Berhasil";
		}
	}
	// Jika Tipe OUT
	else {
		// Jika sudah ada absen OUT di Post Date
		if (isset($tap_out)) {
			// Update kolom OUT di Post Date (alert : Update absen pulang Post Date)
			$conn->query("UPDATE absen set tap_out = '$jam' where id = $id");
			echo "Update Absen Pulang Berhasil";
		}
		else{
			// Update kolom OUT di latest row (alert : Berhasil)
			// $conn->query("UPDATE absen SET tap_out='$jam' WHERE id=(SELECT MAX(id) FROM absen WHERE nip=\"$_POST[nip]\" AND activerow ='1')");
			$conn->query("UPDATE absen SET tap_out='$jam' WHERE id=(SELECT id FROM absen WHERE nip=\"$_POST[nip]\" AND activerow ='1' ORDER BY tanggal DESC LIMIT 1)");
			if(mysqli_affected_rows($conn)) {
				echo "Update Absen Pulang Berhasil";
			}
			else{
				$conn->query("INSERT INTO absen (nip,tanggal,tap_out) VALUES (\"$_POST[nip]\",'$tglpost','$jam')");
				echo "Berhasil";
			}
		}
	}

	// Update Status Absen
	// $query2 = $conn->query("SELECT id, tap_in, tap_out, bekerja FROM absen WHERE nip=\"$_POST[nip]\" AND activerow ='1' AND tanggal='$tglpost' order by id desc limit 1");
	$query2 = $conn->query("SELECT tanggal, id, tap_in, tap_out, bekerja FROM absen WHERE nip=\"$_POST[nip]\" AND activerow ='1' order by tanggal desc limit 1");
	while ($data = mysqli_fetch_array($query2)) {
		$id      = $data['id'];
		$tap_in  = new DateTime($data['tap_in']);
		$tap_out = new DateTime($data['tap_out']);
		$tanggal = $data['tanggal'];
		$bekerja = $data['bekerja'];

		if(date('w', strtotime($tglpost)) == 6 || date('w', strtotime($tglpost)) == 0) {
			// Weekend LIBUR SABTU MINGGU
			$status_in = "OVT";
			$status_out = "OVT";
		} else {
			// Weekday HARI SENIN - JUMAT 
			if ($data['tap_in'] === NULL) {
				$status_in = "NSI";
			}
			else{
				if($tap_in < new DateTime('08:00:00')){
					$status_in = "ONT";
				}
				else {
					$status_in = "LTI";
				}
			}

			if ($data['tap_out'] === NULL) {
				$status_out = "NSO";
			}
			else{
				if ($tglpost == $tanggal) {
					if ($tap_out < new DateTime('17:00:00')) {
						$status_out = "UNP";
					}
					else {
						if ($tap_out < new DateTime('19:00:00')) {
							$status_out = "ONT";
						}
						else{
							$status_out = "OVT";
						}
					}
				}
				else{
					$status_out = "OVT";
				}
			}
		}

		$conn->query("UPDATE absen SET bekerja='$_POST[bekerja]', status_in='$status_in', status_out='$status_out' WHERE id=$id");
	}

}
else{
	echo "Gagal";
}