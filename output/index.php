<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Laporan Absen</title>
    <link rel="icon" href="../assets/img/favicon.png">
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/datatables/datatables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/fixedheader/3.1.7/css/fixedHeader.dataTables.min.css" rel="stylesheet">
    <link href="../assets/vendor/datatables/buttons.dataTables.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap/css/bootstrap-select.css" rel="stylesheet">
    <link href="../assets/vendor/airdatepicker/dist/css/datepicker.min.css" rel="stylesheet">
    <link href="../assets/css/master.css" rel="stylesheet">
    <style>
        .bootstrap-select .dropdown-toggle .filter-option{
            background-color: white;
            border: 1px solid #CED4DA;
            border-radius: 4px;
        }        
    </style>
</head>

<body>
    <div class="wrapper">
        <div id="body">
            <nav class="navbar navbar-dark fixed-top" style="background-color: white; border-bottom: 0.3em solid #ccc">
                <img src="../assets/img/logo.png" height="25" class="d-inline-block align-top" alt="">
                <div class="btn-group">
                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    MENU
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item active" href="/absenonline/output">LAPORAN ABSEN</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/absenonline/output/export.php">EXPORT FOR SUNFISH</a>
                </div>
            </div>
        </nav>
        <div class="content">
            <div class="container-fluid">
                <br><br>
                <div class="row mt-3">
                    <div class="col-lg-3 mb-4">
                        <form action="#" method="POST" accept-charset="utf-8">
                            <div class="form-group">
                                <label for="nip" style="font-size: 16pt">Lokasi</label>
                                <select class="selectpicker form-control" name="lokasi[]" id="lokasi" multiple data-live-search="true">
                                    <?php 
                                    include_once '../config/connection.php';
                                    $qwe   = "SELECT DISTINCT(worklocation) AS lokasi FROM pegawai ORDER BY worklocation ASC";
                                    $doqwe = mysqli_query($conn, $qwe);
                                    while ($data  = mysqli_fetch_array($doqwe)) {
                                        echo "<option>$data[lokasi]</option>";
                                    };
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tgl_mulai" style="font-size: 16pt">Tanggal Mulai</label>
                                <input type='text' id='tgl_mulai' class='form-control datepicker-here' data-language='en' name="tgl_mulai" readonly="readonly" style="background:white;" autocomplete="off" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="tgl_selesai" style="font-size: 16pt">Tanggal Selesai</label>
                                <input type='text' id='tgl_selesai' class='form-control datepicker-here' data-language='en' name="tgl_selesai" readonly="readonly" style="background:white;" autocomplete="off" class="form-control" required>
                            </div>
                            <hr>
                            <div class="text-center mt-4">
                                <input type="submit" id="submit" class="btn btn-block btn-lg btn-orange" value="Generate">
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-9 card p-3">
                        <h3>LAPORAN ABSEN</h3>
                        <p id="tgl"></p>
                        <hr>
                        <div id="showresults"></div>
                        <div class="d-flex justify-content-center mt-5">
                            <div class="spinner-border d-none" role="status" style="width: 3rem; height: 3rem;">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>   
            </div>                
        </div>
    </div>
</div>
<script src="../assets/vendor/jquery/jquery.min.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap-select.min.js"></script>
<script src="../assets/vendor/datatables/datatables.min.js"></script>
<script src="../assets/vendor/datatables/export/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.1.7/js/dataTables.fixedHeader.min.js"></script>
<script src="../assets/vendor/datatables/export/buttons.flash.min.js"></script>
<script src="../assets/vendor/datatables/export/jszip.min.js"></script>
<script src="../assets/vendor/datatables/export/pdfmake.min.js"></script>
<script src="../assets/vendor/datatables/export/buttons.html5.min.js"></script>
<script src="../assets/vendor/datatables/export/buttons.print.min.js"></script>
<script src="../assets/vendor/datatables/export/vfs_fonts.js"></script>
<script src="../assets/vendor/airdatepicker/dist/js/datepicker.min.js"></script>
<script src="../assets/vendor/airdatepicker/dist/js/i18n/datepicker.en.js"></script>
<script src="../assets/js/sweetalert2@10.js"></script>
<script>
    $('#dataTables1').dataTable({
        paging: false,
        searching: false,
    } );
</script>
<script>
    function isNumberKey(evt){
        var charCode = (evt.which) ? evt.which : evt.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
</script>
<script>
    var mindate = new Date();
    mindate.setDate(mindate.getDate() - 60);

    $('#tgl_mulai').datepicker({
        autoClose: true,
        dateFormat : "yyyy-mm-dd",
        todayButton: new Date(),
            maxDate : new Date(),
            minDate : mindate,
        }).data('datepicker').selectDate(new Date());

    $('#tgl_selesai').datepicker({
        position: "bottom right",
        autoClose: true,
        dateFormat : "yyyy-mm-dd",
        todayButton: new Date(),
            maxDate : new Date(),
            minDate : mindate,
        }).data('datepicker').selectDate(new Date());
    </script>
    <script>
        $(document).ready(function () {
            $('select').selectpicker({
                noneSelectedText : 'ALL'
            });

            $('#submit').click(function(e){
                e.preventDefault();

                var lokasi      = $("#lokasi").val();
                var tgl_mulai   = $("#tgl_mulai").val();
                var tgl_selesai = $("#tgl_selesai").val();

                if (lokasi && tgl_mulai && tgl_selesai) {
                    $.ajax({
                        type: "POST",
                        url: "../action/getreport.php",
                        data: {lokasi:lokasi, tgl_mulai:tgl_mulai, tgl_selesai:tgl_selesai},
                        cache: false,
                        beforeSend: function(){
                            $(".spinner-border").removeClass('d-none');
                        },
                        success: function(data){
                            if (tgl_mulai == tgl_selesai) {
                                $("#tgl").html(tgl_mulai);
                            }
                            else{
                                $("#tgl").html(tgl_mulai+" s/d "+tgl_selesai);
                            }
                            $('#showresults').html(data).fadeIn();
                        },
                        complete:function(){
                            $(".spinner-border").addClass('d-none');
                        }
                    });
                }
                else{
                    Swal.fire("Form Tidak Lengkap","","warning");
                }
            });
        });
    </script>
    
</body>

</html>