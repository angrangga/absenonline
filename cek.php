<!doctype html>
<html lang="en">
<?php error_reporting(0); ?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cek Absen</title>
    <link rel="icon" href="assets/img/favicon.png">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/datatables/datatables.min.css" rel="stylesheet">
    <link href="assets/vendor/airdatepicker/dist/css/datepicker.min.css" rel="stylesheet">
    <link href="assets/css/master.css" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <div id="body">
            <nav class="navbar navbar-dark fixed-top" style="background-color: white; border-bottom: 0.3em solid #ccc">
                <img src="assets/img/logo.png" height="25" class="d-inline-block align-top" alt="">
                <B style="font-size: 13pt"><span style="color:#000277">ABSEN</span> <span style="color:#E8572A">ONLINE</span></B>
            </nav>
            <nav class="navbar navbar-dark navbar-expand fixed-bottom" style="background-color: #000277; border-top: 0.3em solid #E8572A">
                <ul class="navbar-nav nav-justified w-100">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                            </svg>
                            <br><small>Absen</small>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="cek.php" class="nav-link active">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg>
                            <br><small>Cek</small>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="rekap.php" class="nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" class="bi bi-bar-chart-line" viewBox="0 0 16 16">
                                <path d="M11 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h1V7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7h1V2zm1 12h2V2h-2v12zm-3 0V7H7v7h2zm-5 0v-3H2v3h2z" />
                            </svg>
                            <br><small>Rekap</small>
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="content">
                <div class="container-fluid">
                    <br><br>
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <form action="#" method="POST" accept-charset="utf-8">
                                <div class="form-group">
                                    <label for="nip" style="font-size: 16pt">NIP (10 Digit)</label>
                                    <input type="tel" value="<?= $_POST['nip'] ?>" name="nip" id="nip" autocomplete="off" onkeypress="return isNumberKey(event)" class="form-control nutupin" maxlength="10" required>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="tgl_mulai" style="font-size: 16pt">Tgl Mulai</label>
                                            <input type='text' id='tgl_mulai' class='form-control' readonly="readonly" style="background:white;" data-language='en' name="tgl_mulai" autocomplete="off" class="form-control" required>
                                        </div>
                                        <div class="col-6">
                                            <label for="tgl_selesai" style="font-size: 16pt">Tgl Selesai</label>
                                            <input type='text' id='tgl_selesai' class='form-control' readonly="readonly" style="background:white;" data-language='en' name="tgl_selesai" autocomplete="off" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center mt-4">
                                    <input type="submit" id="submit" class="btn btn-block btn-lg btn-orange" value="Cari">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="showresults"></div>
                    <div class="d-flex justify-content-center mt-5">
                        <div class="spinner-border d-none" role="status" style="width: 3rem; height: 3rem;">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                    <br><br>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/autocomplete/jquery.autocomplete.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/datatables/datatables.min.js"></script>
    <script src="assets/vendor/airdatepicker/dist/js/datepicker.min.js"></script>
    <script src="assets/vendor/airdatepicker/dist/js/i18n/datepicker.en.js"></script>
    <script src="assets/js/sweetalert2@10.js"></script>
    <script>
        function isNumberKey(evt) {
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
            dateFormat: "yyyy-mm-dd",
            todayButton: new Date(),
            maxDate: new Date(),
            minDate: mindate,
        }).data('datepicker').selectDate(new Date());

        $('#tgl_selesai').datepicker({
            position: "bottom right",
            autoClose: true,
            dateFormat: "yyyy-mm-dd",
            todayButton: new Date(),
            maxDate: new Date(),
            minDate: mindate,
        }).data('datepicker').selectDate(new Date());
    </script>

    <script>
        $(document).ready(function() {
            // $( "#nip" ).val(localStorage.getItem("nip"));

            $('.nutupin').focus(function() {
                $('.navbar-expand').hide();
            });

            $('.nutupin').blur(function() {
                $('.navbar-expand').delay(250).fadeIn(50);
            });

            $("#nip").autocomplete({
                serviceUrl: "autocomplete/pegawai.php",
                minChars: 4,
                dataType: "JSON",
                onSelect: function(suggestion) {
                    $("#nip").val(suggestion.nip);
                }
            });

            $('#submit').click(function(e) {
                e.preventDefault();

                var nip = $("#nip").val();
                var tgl_mulai = $("#tgl_mulai").val();
                var tgl_selesai = $("#tgl_selesai").val();

                if (nip && tgl_mulai && tgl_selesai) {
                    $.ajax({
                        type: "POST",
                        url: "action/nipada.php",
                        data: {
                            nip: nip
                        },
                        cache: false,
                        dataType: "html",
                        success: function(ada) {
                            if (ada == 1) {
                                $.ajax({
                                    type: "POST",
                                    url: "action/cekabsen.php",
                                    data: {
                                        nip: nip,
                                        tgl_mulai: tgl_mulai,
                                        tgl_selesai: tgl_selesai
                                    },
                                    cache: false,
                                    beforeSend: function() {
                                        $(".spinner-border").removeClass('d-none');
                                    },
                                    success: function(data) {
                                        $('#showresults').html(data).fadeIn();
                                    },
                                    complete: function() {
                                        $(".spinner-border").addClass('d-none');
                                    }
                                });
                            } else {
                                Swal.fire("NIP Tidak Terdaftar", "", "error");
                            }
                        }
                    });
                } else {
                    Swal.fire("Form Tidak Lengkap", "", "warning");
                }
            });
        });
    </script>
</body>

</html>