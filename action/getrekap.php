<hr>
<div class="row">
    <div class="col-lg-12">
        <div class="text-center">
            Rekap Absen : <br><h3><?= date("d M Y", strtotime($_POST['tgl_mulai']))?></h3>
        </div>
        <div>
            <table class="table table-striped bg-white table-bordered" id="dataTables1" width="100%" style="margin: 0; padding: 0;">
                <thead>
                    <tr>
                        <th>Lokasi</th>
                        <th>ONT</th>
                        <th>LTI</th>
                        <th>WFH</th>
                        <th>WFO</th>
                        <th>Jml Peg</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  
                    include_once '../config/connection.php';
                    $qwe   = "SELECT worklocation AS lokasi, COUNT(id) AS jml_pegawai FROM pegawai GROUP BY worklocation ORDER BY worklocation ASC";
                    $doqwe = mysqli_query($conn, $qwe);                                      
                    $i = 1;
                    while ($data = mysqli_fetch_array($doqwe)) {

                        // GET TOTAL WFH
                        $query = "SELECT COUNT(a.nip) AS total FROM absen a
                        LEFT JOIN pegawai b ON a.nip = b.nip 
                        WHERE worklocation=\"$data[lokasi]\"
                        AND activerow = '1'
                        AND tanggal = '$_POST[tgl_mulai]'
                        AND bekerja = 'WFH'";
                        $result    = mysqli_query($conn, $query);
                        $tbl       = mysqli_fetch_array($result);
                        $total_wfh = $tbl['total'];

                        // GET TOTAL WFO
                        $query = "SELECT COUNT(a.nip) AS total FROM absen a
                        LEFT JOIN pegawai b ON a.nip = b.nip 
                        WHERE worklocation=\"$data[lokasi]\"
                        AND activerow = '1'
                        AND tanggal = '$_POST[tgl_mulai]'
                        AND bekerja = 'WFO'";
                        $result    = mysqli_query($conn, $query);
                        $tbl       = mysqli_fetch_array($result);
                        $total_wfo = $tbl['total'];

                        // GET TOTAL ONT
                        $query = "SELECT COUNT(a.nip) AS total FROM absen a
                        LEFT JOIN pegawai b ON a.nip = b.nip 
                        WHERE worklocation=\"$data[lokasi]\"
                        AND activerow = '1'
                        AND tanggal = '$_POST[tgl_mulai]'
                        AND status_in = 'ONT'";
                        $result    = mysqli_query($conn, $query);
                        $tbl       = mysqli_fetch_array($result);
                        $total_ont = $tbl['total'];

                        // GET TOTAL LTI
                        $query = "SELECT COUNT(a.nip) AS total FROM absen a
                        LEFT JOIN pegawai b ON a.nip = b.nip 
                        WHERE worklocation=\"$data[lokasi]\"
                        AND activerow = '1'
                        AND tanggal = '$_POST[tgl_mulai]'
                        AND status_in = 'LTI'";
                        $result    = mysqli_query($conn, $query);
                        $tbl       = mysqli_fetch_array($result);
                        $total_lti = $tbl['total'];

                        // NAMA ALIAS SINGKATAN
                        $lokasi = str_replace("BATCHING PLANT","BP","$data[lokasi]");
                        $lokasi = str_replace("PROYEK PEMBANGUNAN","PROPEM","$lokasi");
                        $lokasi = str_replace("DIVISI","DIV","$lokasi");

                        $humandate = date("d M Y", strtotime($_POST['tgl_mulai']));

                        echo "<tr>";
                        echo "<td class='lockscroll'><a class='btn-link' data-toggle='modal' data-target='#myModal' data-tgl='$_POST[tgl_mulai]' data-humandate='$humandate' data-lokasi='$data[lokasi]'>$lokasi</a></td>";
                        // echo "<td class='lockscroll'><a class='btn-link' href='rekap_detail.php?tgl=$_POST[tgl_mulai]&lokasi=$data[lokasi]'>$lokasi</a></td>";
                        echo "<td>$total_ont</td>";
                        echo "<td>$total_lti</td>";
                        echo "<td>$total_wfh</td>";
                        echo "<td>$total_wfo</td>";
                        echo "<td>$data[jml_pegawai]</td>";
                        echo "</tr>";
                        $i++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>  
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-scrollable">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header m-0 pb-0">
                <p class="text-center btn-block">
                    <B class="modal-title" style="font-size: 16pt">Modal title</B>
                    <br><i class="text-center" id="tgl">Tanggal</i>
                </p>
            </div>
            <div class="modal-body m-0 p-0">
                <div class="detailrekap"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-orange btn-block" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<script>
    $('.btn-link').click(function(){
        var lokasi    = $(this).data("lokasi");
        var tgl       = $(this).data("tgl");
        var humandate = $(this).data("humandate");
        $('.modal-title').html(lokasi);
        $('#tgl').html(humandate);
        $.ajax({
            type: "POST",
            url: "action/getdetailrekap.php",
            data: {lokasi:lokasi,tgl:tgl},
            cache: false,
            success: function(data){
                $('.detailrekap').html(data).fadeIn();
            }
        });
    });

    $('.lockscroll').bind('touchmove', function(e){e.preventDefault()});
    $('.lockscroll').css("overflow", "hidden");

    $('#dataTables1').dataTable({
        paging: false,
        lengthChange: false,
        searching: false,
        ordering: true,
        order: [],
        scrollX: true,
        scrollCollapse: true,
        fixedColumns:   true,
        fixedColumns: {
            leftColumns: 1
        }
    });
</script>
