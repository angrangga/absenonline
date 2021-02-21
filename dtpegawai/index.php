<html>
<head>
    <title>Data Pegawai Absen Online</title>
    <link rel="icon" href="../assets/img/favicon.png">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="../assets/vendor/datatables/datatables.min.css" />
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/datatables/datatables.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <style>
        body
        {
            margin:0;
            padding:0;
            background-color:#f1f1f1;
        }
        .box
        {
            width:1270px;
            padding:20px;
            background-color:#fff;
            border:1px solid #ccc;
            border-radius:5px;
            margin-top:25px;
            box-sizing:border-box;
            margin-bottom: 30px;
        }
        #message {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
        }
        #inner-message {
            margin: 0 auto;
        }
        .dataTables_filter {
            float: right;
            text-align: right;
        }
        input[type="search"]::-webkit-search-cancel-button {
            -webkit-appearance: searchfield-cancel-button;
        }
    </style>
</head>
<body>
    <div class="container box">
        <center>
            <B style="font-size: 20pt; vertical-align: middle; margin-right: 10px">Data Pegawai Absen Online</B>
            <button type="button" name="add" id="add" class="btn btn-info">Add</button>
        </center>
        <div id="message">
            <div style="padding: 5px;">
                <div id="inner-message">
                    <div id="alert_message"></div>
                </div>
            </div>
        </div>
        <table id="user_data" class="table table-bordered table-striped small">
            <thead>
                <tr>
                    <th>NIP</th>
                    <th>NAMA</th>
                    <th>GENDER</th>
                    <th>POSITION</th>
                    <th>UNIT</th>
                    <th>STATUS</th>
                    <th>LEVEL</th>
                    <th>WORKLOCATION</th>
                    <th>AKSI</th>
                </tr>
            </thead>
        </table>
    </div>
</body>
</html>

<script type="text/javascript" language="javascript" >
    $(document).ready(function(){

        fetch_data();

        function fetch_data()
        {
            var dataTable = $('#user_data').DataTable({
                "stateSave": true,
                "processing" : true,
                "serverSide" : true,
                "order" : [],
                "ajax" : {
                    url:"fetch.php",
                    type:"POST"
                }
            });
        }

        function update_data(id, column_name, value)
        {
            $.ajax({
                url:"update.php",
                method:"POST",
                data:{id:id, column_name:column_name, value:value},
                success:function(data)
                {
                    $('#user_data').DataTable().destroy();
                    $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
                    fetch_data();
                    // $(".update[data-id="+id+"][data-column="+column_name+"]").focus();
                }
            });
            setInterval(function(){
                $('#alert_message').html('');
            }, 3000);
        }

        $(document).on("keypress", ".update", function(e){
            if(e.which == 13){
                e.preventDefault();
                var id = $(this).data("id");
                var column_name = $(this).data("column");
                var value = $(this).text();
                update_data(id, column_name, value);
            }
        });

        $('#add').click(function(){
            var html = '<tr>';
            html += '<td contenteditable id="data1" style="background-color:lightyellow"></td>';
            html += '<td contenteditable id="data2" style="background-color:lightyellow"></td>';
            html += '<td contenteditable id="data3" style="background-color:lightyellow"></td>';
            html += '<td contenteditable id="data4" style="background-color:lightyellow"></td>';
            html += '<td contenteditable id="data5" style="background-color:lightyellow"></td>';
            html += '<td contenteditable id="data6" style="background-color:lightyellow"></td>';
            html += '<td contenteditable id="data7" style="background-color:lightyellow"></td>';
            html += '<td contenteditable id="data8" style="background-color:lightyellow"></td>';
            html += '<td style="background-color:lightyellow"><button type="button" name="insert" id="insert" class="btn btn-success btn-xs">Insert</button></td>';
            html += '</tr>';
            // $('#user_data tbody').prepend(html);
            $("tbody:not(#user_data)").attr('id', 'user_data').prepend(html);
            $("#data1").focus();
        });

        $(document).on('click', '#insert', function(){
            var nip              = $('#data1').text();
            var nama             = $('#data2').text();
            var gender           = $('#data3').text();
            var position         = $('#data4').text();
            var orgunit          = $('#data5').text();
            var employmentstatus = $('#data6').text();
            var jobstatus        = $('#data7').text();
            var worklocation     = $('#data8').text();

            if(nip != '' && nama != '' && gender != '' && position != '' && orgunit != '' && employmentstatus != '' && jobstatus != '' && worklocation != '')
            {
                $.ajax({
                    url:"insert.php",
                    method:"POST",
                    data:{nip:nip, nama:nama, gender:gender, position:position, orgunit:orgunit, employmentstatus:employmentstatus, jobstatus:jobstatus, worklocation:worklocation},
                    success:function(data)
                    {
                        $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
                        $('#user_data').DataTable().destroy();
                        fetch_data();
                    }
                });
                setInterval(function(){
                    $('#alert_message').html('');
                }, 3000);
            }
            else
            {
                alert("Isi Semua");
            }
        });

        $(document).on('click', '.delete', function(){
            var id = $(this).attr("id");
            if(confirm("Are you sure you want to remove this?"))
            {
                $.ajax({
                    url:"delete.php",
                    method:"POST",
                    data:{id:id},
                    success:function(data){
                        $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
                        $('#user_data').DataTable().destroy();
                        fetch_data();
                    }
                });
                setInterval(function(){
                    $('#alert_message').html('');
                }, 3000);
            }
        });
    });
</script>