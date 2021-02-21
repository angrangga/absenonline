<!doctype html>
<html lang="en">
<?php error_reporting(0); ?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Koreksi Absen</title>
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
                <B style="font-size: 13pt"><span style="color:#000277">KOREKSI</span> <span style="color:#E8572A">ABSEN</span></B>
            </nav>
            <nav class="navbar navbar-dark navbar-expand fixed-bottom" style="background-color: #000277; border-top: 0.3em solid #E8572A">
                <ul class="navbar-nav nav-justified w-100">
                    <li class="nav-item">
                        <a href="k0r3k5i.php" class="nav-link active">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" class="bi bi-tools" viewBox="0 0 16 16">
                                <path d="M1 0L0 1l2.2 3.081a1 1 0 0 0 .815.419h.07a1 1 0 0 1 .708.293l2.675 2.675-2.617 2.654A3.003 3.003 0 0 0 0 13a3 3 0 1 0 5.878-.851l2.654-2.617.968.968-.305.914a1 1 0 0 0 .242 1.023l3.356 3.356a1 1 0 0 0 1.414 0l1.586-1.586a1 1 0 0 0 0-1.414l-3.356-3.356a1 1 0 0 0-1.023-.242L10.5 9.5l-.96-.96 2.68-2.643A3.005 3.005 0 0 0 16 3c0-.269-.035-.53-.102-.777l-2.14 2.141L12 4l-.364-1.757L13.777.102a3 3 0 0 0-3.675 3.68L7.462 6.46 4.793 3.793a1 1 0 0 1-.293-.707v-.071a1 1 0 0 0-.419-.814L1 0zm9.646 10.646a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708zM3 11l.471.242.529.026.287.445.445.287.026.529L5 13l-.242.471-.026.529-.445.287-.287.445-.529.026L3 15l-.471-.242L2 14.732l-.287-.445L1.268 14l-.026-.529L1 13l.242-.471.026-.529.445-.287.287-.445.529-.026L3 11z"/>
                            </svg>
                            <br><small>Koreksi</small>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="supercek.php" class="nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                            </svg>
                            <br><small>Delete</small>
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
                                    <label for="tanggal" style="font-size: 16pt">Tanggal</label>
                                    <input type='text' id='tanggal' class='form-control' readonly="readonly" style="background:white;" data-language='en' name="tanggal" autocomplete="off" class="form-control" required>
                                </div>
                                <div class="text-center mt-4">
                                    <input type="submit" id="submit" class="btn btn-block btn-lg btn-orange" value="Cek">
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

        $('#tanggal').datepicker({
            autoClose: true,
            dateFormat : "yyyy-mm-dd",
            todayButton: new Date(),
            maxDate : new Date(),
            minDate : mindate,
        }).data('datepicker').selectDate(new Date());

    </script>

    <script>
        $(document).ready(function () {
            // $( "#nip" ).val(localStorage.getItem("nip"));

            $('.nutupin').focus( function() {
                $('.navbar-expand').hide();
            });

            $('.nutupin').blur( function() {
                $('.navbar-expand').delay(250).fadeIn(50);
            });

            $( "#nip" ).autocomplete({
                serviceUrl: "autocomplete/pegawai.php",
                minChars: 4 ,
                dataType: "JSON",
                onSelect: function (suggestion) {
                    $( "#nip" ).val(suggestion.nip);
                }
            });

            $('#submit').click(function(e){
                e.preventDefault();

                var nip     = $("#nip").val();
                var tanggal = $("#tanggal").val();

                if (nip && tanggal) {
                    $.ajax({
                        type: "POST",
                        url: "action/nipada.php",
                        data: {nip:nip},
                        cache: false,
                        dataType: "html",
                        success : function(ada){
                            if(ada == 1){
                                $.ajax({
                                    type: "POST",
                                    url: "action/getkoreksi.php",
                                    data: {nip:nip, tanggal:tanggal},
                                    cache: false,
                                    beforeSend: function(){
                                        $(".spinner-border").removeClass('d-none');
                                    },
                                    success: function(data){
                                        $('#showresults').html(data).fadeIn();
                                    },
                                    complete:function(){
                                        $(".spinner-border").addClass('d-none');
                                    }
                                });
                            }
                            else{
                                Swal.fire("NIP Tidak Terdaftar","","error");
                            }
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