<hr>
<div class="row">
    <div class="col-lg-12">
        <?php 
        include_once '../config/connection.php';

        $qwe   = "SELECT nama FROM pegawai WHERE nip=$_POST[nip]";
        $doqwe = mysqli_query($conn, $qwe);
        $data  = mysqli_fetch_array($doqwe);
        $nama  = $data['nama'];
        ?>
        <div class="text-center">
            Hasil Pencarian : <br><h3><?= $nama ?></h3>
        </div>
        <table class="table table-striped table-bordered bg-white" id="dataTables1" width="100%">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>NIP</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php  
                $qwe   = "SELECT * FROM absen_detail WHERE activerow='1' AND nip=\"$_POST[nip]\" AND date(waktu) BETWEEN \"$_POST[tgl_mulai]\" AND \"$_POST[tgl_selesai]\"";
                $doqwe = mysqli_query($conn, $qwe);                                      

                while ($data = mysqli_fetch_array($doqwe)) {
                    echo "<tr>";
                    echo "<td>$data[waktu]</td>";
                    echo "<td>$data[nip]</td>";
                    // echo "<td><button type='button' class='delbtn btn btn-danger btn-sm' data-id='$data[id]'>Hapus</button></td>";
                    echo "<td><button type='button' class='delbtn btn btn-danger btn-sm' data-id='$data[id]'>Hapus</button></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<br>

<script>

    $(document).ready(function () {

        $('.delbtn').click(function(e){
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    var id = $(this).data("id");
                    $(this).removeClass("delbtn btn btn-danger").addClass('btn btn-success').text('Done');
                    $.ajax({
                        type: "POST",
                        url: "action/hapusabsen.php",
                        data: {id:id},
                        cache: false
                    });
                }
            });
        });
    });
</script>

<script>
    $('#dataTables1').dataTable( {
        paging:   false,
        responsive: true,
        lengthChange: false,
        searching: false,
        ordering: true
    });
</script>