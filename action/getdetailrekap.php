<style>
    .modal-header {
        border-bottom: 0 none;
    }
</style>

<table class="table table-striped table-bordered table-compact small" id="dataTables2" width="100%">
    <thead>
        <tr>
            <!-- <th></th> -->
            <th>Nama</th>
            <th>In</th>
            <th>Out</th>
            <th>Bekerja</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php  
        include_once '../config/connection.php';
        $query = "SELECT b.nip, b.nama, a.tap_in,a.tap_out,a.status_in,a.status_out, a.bekerja FROM pegawai b
        LEFT JOIN absen a ON a.nip = b.nip AND activerow='1' AND tanggal = \"$_POST[tgl]\" 
        WHERE worklocation=\"$_POST[lokasi]\"
        ORDER BY FIELD(jobstatus,'Staf','Ahli Muda','Pelaksana','Kepala Lapangan','Kepala Bagian','Ahli Madya','Manager Proyek','Manager Batching Plant','Manager Plant','Manager','Ahli Utama','General Manager') DESC, nama ASC";
        $result = mysqli_query($conn, $query);                                  
        // $i = 1;
        while ($data = mysqli_fetch_array($result)) {
            $status  = (isset($data['status_in']) ? "$data[status_in] , $data[status_out]" : "-");
            $tap_in  = (isset($data['tap_in']) ? $data['tap_in'] : "-");
            $tap_out = (isset($data['tap_out']) ? $data['tap_out'] : "-");
            $bekerja = (isset($data['bekerja']) ? $data['bekerja'] : "-");
            echo "<tr>";
            // echo "<td>$i</td>";
            echo "<td>$data[nama]</td>";
            echo "<td>$tap_in</td>";
            echo "<td>$tap_out</td>";
            echo "<td>$bekerja</td>";
            echo "<td>$status</td>";
            echo "</tr>";
            // $i++;
        }
        ?>
    </tbody>
</table>

<script>
    $('#dataTables2').dataTable({
        paging: false,
        lengthChange: false,
        searching: false,
        ordering: true,
        order: []
    });
</script>