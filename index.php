<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Absen Online WBP</title>
    <link rel="icon" href="assets/img/favicon.png">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
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
                        <a href="index.php" class="nav-link active">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                            </svg>
                            <br><small>Absen</small>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="cek.php" class="nav-link">
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
                    <div class="row mt-2">
                        <div class="col-lg-12">
                            <div class="page-title text-center">
                                <B id="clock" style="font-size: 2.5em; color:#000277;"><i>loading...</i></B>
                                <br>
                                <span class="badge-pill btn-orange p-1 px-3">
                                    <span id="tgl"><i>loading...</i></span>
                                </span>
                            </div>
                            <hr>
                            <form action="#" method="POST" accept-charset="utf-8" style="font-size: 16pt">
                                <div class="form-group">
                                    <label for="nip">NIP (10 Digit)</label>
                                    <input type="tel" name="nip" id="nip" autocomplete="off" onkeypress="return isNumberKey(event)" class="form-control nutupin" maxlength="10" required>
                                    <small id="nama" class="form-text text-muted float-right" style="font-size: 7pt"></small>
                                </div>
                                <div class="form-group">
                                    <label>Jenis Kehadiran</label>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="jenis_kehadiran1" value="IN" name="tipe" class="custom-control-input" checked="">
                                        <label class="custom-control-label small" for="jenis_kehadiran1">Absen Masuk</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="jenis_kehadiran2" value="OUT" name="tipe" class="custom-control-input">
                                        <label class="custom-control-label small" for="jenis_kehadiran2">Absen Pulang</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Bekerja Dari</label>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="bekerja1" value="WFH" name="bekerja" class="custom-control-input" checked="">
                                        <label class="custom-control-label small" for="bekerja1">Rumah (WFH)</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="bekerja2" value="WFO" name="bekerja" class="custom-control-input">
                                        <label class="custom-control-label small" for="bekerja2">Kantor (WFO)</label>
                                    </div>
                                </div>
                                <hr>
                                <div class="text-center">
                                    <input type="submit" id="submit" class="btn btn-block btn-lg btn-success mb-3">
                                    <i style="font-size: 10pt"> Metode Absen FILO (First In, Last Out) </i>
                                    <br>
                                    <a tabindex="0" class="btn btn-link myid" role="button" data-placement="top" data-toggle="popover" data-trigger="focus" data-content="Waiting...">Device ID</a>
                                    <!-- <i id='deviceid' style="font-size: 8pt"></i> -->
                                </div>
                            </form>
                        </div>
                    </div>
                    <br><br><br>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/autocomplete/jquery.autocomplete.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/fp.min.js"></script>
    <script src="assets/js/sweetalert2@10.js"></script>

    <script>
        function updateClock() {
            var currentTime = new Date();
            var currentHours = currentTime.getHours();
            var currentMinutes = currentTime.getMinutes();
            var currentSeconds = currentTime.getSeconds();
            var tahun = currentTime.getFullYear();
            var bulan = currentTime.getMonth();
            var tanggal = currentTime.getDate();
            var hari = currentTime.getDay();

            currentMinutes = (currentMinutes < 10 ? "0" : "") + currentMinutes;
            currentSeconds = (currentSeconds < 10 ? "0" : "") + currentSeconds;
            var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds;
            $("#clock").html(currentTimeString);

            switch (hari) {
                case 0:
                    hari = "Minggu";
                    break;
                case 1:
                    hari = "Senin";
                    break;
                case 2:
                    hari = "Selasa";
                    break;
                case 3:
                    hari = "Rabu";
                    break;
                case 4:
                    hari = "Kamis";
                    break;
                case 5:
                    hari = "Jum'at";
                    break;
                case 6:
                    hari = "Sabtu";
                    break;
            }
            switch (bulan) {
                case 0:
                    bulan = "Januari";
                    break;
                case 1:
                    bulan = "Februari";
                    break;
                case 2:
                    bulan = "Maret";
                    break;
                case 3:
                    bulan = "April";
                    break;
                case 4:
                    bulan = "Mei";
                    break;
                case 5:
                    bulan = "Juni";
                    break;
                case 6:
                    bulan = "Juli";
                    break;
                case 7:
                    bulan = "Agustus";
                    break;
                case 8:
                    bulan = "September";
                    break;
                case 9:
                    bulan = "Oktober";
                    break;
                case 10:
                    bulan = "November";
                    break;
                case 11:
                    bulan = "Desember";
                    break;
            }

            $("#tgl").html(hari + ", " + tanggal + " " + bulan + " " + tahun);

        }

        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            // $( "#nip" ).val(localStorage.getItem("nip"));

            $("#nip").autocomplete({
                serviceUrl: "autocomplete/pegawai.php",
                minChars: 4,
                dataType: "JSON",
                onSelect: function(suggestion) {
                    $("#nip").val(suggestion.nip);
                    $("#nama").html(suggestion.nama);

                    // localStorage.setItem("nip",suggestion.nip);
                }
            });

            $("#nip").keyup(function(event) {
                $("#nama").empty();
            });


            FingerprintJS.load().then(fp => {
                fp.get().then(result => {
                    const visitorId = result.visitorId;
                    $(".myid").attr("data-content", visitorId);
                });
            });

            setInterval(updateClock, 1000); // JAM

            $('[data-toggle="popover"]').popover()

            $('.nutupin').focus(function() {
                $('.navbar-expand').hide();
            });

            $('.nutupin').blur(function() {
                $('.navbar-expand').delay(250).fadeIn(50);
            });

            $('#submit').click(function(e) {
                e.preventDefault();

                var nip = $("#nip").val();
                var tipe = $("input[name=tipe]:checked").val();
                var bekerja = $("input[name=bekerja]:checked").val();
                var deviceid = $(".myid").attr("data-content");

                if (nip && tipe && bekerja && deviceid) {
                    $.ajax({
                        type: "POST",
                        url: "action/nipada.php",
                        data: {
                            nip: nip
                        },
                        cache: false,
                        success: function(ada) {
                            if (ada == 1) {
                                $.ajax({
                                    type: "POST",
                                    url: "action/simpanabsen.php",
                                    data: {
                                        nip: nip,
                                        tipe: tipe,
                                        bekerja: bekerja,
                                        deviceid: deviceid
                                    },
                                    cache: false,
                                    success: function(data) {
                                        if (data == "Berhasil") {
                                            Swal.fire(data, "", "success");
                                        } else if (data == "Anda Sudah Absen Masuk") {
                                            Swal.fire(data, "", "warning");
                                        } else if (data == "Update Absen Pulang Berhasil") {
                                            Swal.fire(data, "", "success");
                                        } else {
                                            Swal.fire(data, "", "error");
                                        }
                                    }
                                });
                            } else {
                                Swal.fire("NIP Tidak Terdaftar", "", "error");
                            }
                        }
                    });
                } else {
                    Swal.fire("NIP Kosong", "", "warning");
                }
            });

        });
    </script>

</body>

</html>