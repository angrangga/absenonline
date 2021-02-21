<hr>
<div class="row">
    <div class="col-lg-12">
        <?php 
        include_once '../config/connection.php';

        $qwe   = "SELECT id FROM absen WHERE activerow='1' AND activerow='1' AND nip=\"$_POST[nip]\" AND tanggal BETWEEN \"$_POST[tgl_mulai]\" AND \"$_POST[tgl_selesai]\" AND (status_in != 'NSI' AND status_out != 'NSO')";
        $doqwe = mysqli_query($conn, $qwe);                                      
        $total_kehadiran = mysqli_num_rows($doqwe);

        $qwe   = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(tap_in, '08:00:00')))) AS total_telat FROM absen WHERE activerow='1' AND nip=\"$_POST[nip]\" AND tanggal BETWEEN \"$_POST[tgl_mulai]\" AND \"$_POST[tgl_selesai]\" and tap_in > '08:00:00' and status_in ='LTI'";
        $doqwe = mysqli_query($conn, $qwe);
        $data  = mysqli_fetch_array($doqwe);
        $total_telat = ($data['total_telat'] ? $data['total_telat'] : 0);

        $qwe   = "SELECT nama FROM pegawai WHERE nip=$_POST[nip]";
        $doqwe = mysqli_query($conn, $qwe);
        $data  = mysqli_fetch_array($doqwe);
        $nama  = $data['nama'];
        ?>
        <div class="text-center">
            Hasil Pencarian : <br><h3><?= $nama ?></h3>
        </div>
        <div class="row mt-3">
            <div class="col-sm-6">
                <div class="card">
                    <div class="content">
                        <span> Total Kehadiran </span>
                        <h1><?= $total_kehadiran ?> hari</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="content">
                        <span> Total Terlambat </span>
                        <h1><?= $total_telat ?></h1>
                    </div>
                </div>
            </div>
        </div>

        <table class="table table-striped table-bordered bg-white" id="dataTables1" width="100%">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>In</th>
                    <th>Out</th>
                    <th>Bekerja</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php  
                $qwe   = "SELECT * FROM absen WHERE activerow='1' AND nip=\"$_POST[nip]\" AND tanggal BETWEEN \"$_POST[tgl_mulai]\" AND \"$_POST[tgl_selesai]\"";
                $doqwe = mysqli_query($conn, $qwe);                                      

                while ($data = mysqli_fetch_array($doqwe)) {
                    if(date('w', strtotime($data['tanggal'])) == 6 || date('w', strtotime($data['tanggal'])) == 0) {
                        $weekend = "style='background-color:#FBCFD0'";
                    }
                    else{
                        $weekend = "";
                    }

                    if ($data['status_in'] != 'NSI' && $data['status_out'] != 'NSO') {
                        $red = "";
                    }
                    else{
                        $red = "class='text-danger'";
                    }
                    echo "<tr $weekend $red>";
                    echo "<td nowrap>$data[tanggal]</td>";
                    echo "<td>$data[tap_in]</td>";
                    echo "<td>$data[tap_out]</td>";
                    echo "<td>$data[bekerja]</td>";
                    echo "<td>$data[status_in] , $data[status_out]</td>";
                    echo "</tr>";
                }

                ?>
            </tbody>
        </table>
    </div>
</div>
<br>

<script>
    $('#dataTables1').dataTable( {
        paging:   false,
        responsive: true,
        lengthChange: false,
        searching: false,
        ordering: true
    });
</script>