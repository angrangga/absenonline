<?php
include_once '../config/connection.php';

// Deklarasi variable keyword nip.
$nip = $_GET["query"];

// Query ke database.
$query  = $conn->query("SELECT nip,nama FROM pegawai WHERE nip LIKE '$nip%' ORDER BY nip ASC");
$result = $query->fetch_all(MYSQLI_ASSOC);

// Format bentuk data untuk autocomplete.
foreach($result as $data) {
    $output['suggestions'][] = [
        'value' => $data['nip']." - ".$data['nama'],
        'nip' => $data['nip'],
        'nama' => $data['nama'],
    ];
}

if (!empty($output)) {
    // Encode ke format JSON.
    echo json_encode($output);
}