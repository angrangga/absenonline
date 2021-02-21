<!-- <div style="overflow-y: auto;"> -->
    <table class="table table-striped table-bordered nowrap table-compact small" id="dataTables1" width="100%">
        <thead>
            <tr>
                <th>NIP</th>
                <th>Tanggal</th>
                <th>Jam</th>
            </tr>
        </thead>
        <tbody>
            <?php  
            include_once '../config/connection.php';

            $query = "SELECT nip, DATE(waktu) AS tanggal, TIME(waktu) AS jam FROM absen_detail WHERE activerow='1' AND DATE(waktu) BETWEEN \"$_POST[tgl_mulai]\" AND \"$_POST[tgl_selesai]\"";
            $result = mysqli_query($conn, $query);                                  
            while ($data = mysqli_fetch_array($result)) {
                $jam = substr($data['jam'], 0, -3);
                // $tanggal = $data[tanggal];
                echo "<tr>";
                echo "<td>$data[nip]</td>";
                echo "<td>$data[tanggal]</td>";
                echo "<td>$jam</td>";
                echo "</tr>";

                $tgl_mulai   = date("d M Y", strtotime($_POST['tgl_mulai']));
                $tgl_selesai = date("d M Y", strtotime($_POST['tgl_selesai']));
                if ($tgl_mulai == $tgl_selesai) {
                    $tglfile = $tgl_mulai;
                }
                else{
                    $tglfile = $tgl_mulai." - ".$tgl_selesai;
                }
                // $namafile = "Export Absen (".$tglfile.")";
                $namafile = "ExportAbsen";
            }
            ?>
        </tbody>
    </table>
    <!-- </div> -->

    <script>
        $('#dataTables1').dataTable({
            ordering: false,
            scrollX: true,
            paging: false,
            dom: 'Bfrtip',
            buttons: [
            {
                extend: 'excelHtml5',
                title: '',
                // header : false,
                filename : '<?= $namafile ?>',
            }
            ]
        } );
    </script>