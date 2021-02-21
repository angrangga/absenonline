<hr>
<div class="row">
    <div class="col-lg-12">
        <?php 
        include_once '../config/connection.php';

        $qwe = "SELECT b.nama, a.* FROM absen a 
        LEFT JOIN pegawai b on a.nip = b.nip
        WHERE a.nip=\"$_POST[nip]\" AND a.tanggal = \"$_POST[tanggal]\" AND activerow='1'";
        $doqwe      = mysqli_query($conn, $qwe);
        $data       = mysqli_fetch_array($doqwe);
        $nama       = (isset($data['nama']) ? $data['nama'] : "");
        $tap_in     = (isset($data['tap_in']) ? $data['tap_in'] : "");
        $status_in  = (isset($data['status_in']) ? $data['status_in'] : "");
        $tap_out    = (isset($data['tap_out']) ? $data['tap_out'] : "");
        $status_out = (isset($data['status_out']) ? $data['status_out'] : "");
        $bekerja    = (isset($data['bekerja']) ? $data['bekerja'] : "");
        $tanggal    = (isset($data['tanggal']) ? $data['tanggal'] : "");

        ?>
        <div class="text-center">
            Hasil Pencarian : <br>
            <?php 
            if (isset($data['nama']) && isset($data['tanggal'])) {
                echo "<h3>$nama</h3><h5>$tanggal</h5>";
            }
            else{
                echo "<h3>Tidak Ada Data</h3>";
                $status_in = "NSI";
                $status_out = "NSO";
            }
            ?>
            
        </div>

        <form action="#" method="POST" accept-charset="utf-8">
            <input type='hidden' id='nip2' value="<?= $_POST['nip'] ?>">
            <input type='hidden' id='tanggal2' value="<?= $_POST['tanggal'] ?>">
            <input type='hidden' id='bekerja2' value="<?= $_POST['bekerja'] ?>">
            <div class="form-group">
                <label for="tap_in" style="font-size: 16pt">IN</label>
                <input type='text' id='tap_in' class='form-control' autocomplete="off" value="<?= $tap_in ?>">
            </div>
            <div class="form-group">
                <label for="status_in" style="font-size: 16pt">STATUS IN</label>
                <select name="status_in" id="status_in" class="form-control">
                    <option value="ONT" <?= ($status_in == "ONT" ? "Selected" : "") ?>>ONT</option>
                    <option value="OVT" <?= ($status_in == "OVT" ? "Selected" : "") ?>>OVT</option>
                    <option value="NSI" <?= ($status_in == "NSI" ? "Selected" : "") ?>>NSI</option>
                    <option value="NSO" <?= ($status_in == "NSO" ? "Selected" : "") ?>>NSO</option>
                    <option value="LTI" <?= ($status_in == "LTI" ? "Selected" : "") ?>>LTI</option>
                    <option value="UNP" <?= ($status_in == "UNP" ? "Selected" : "") ?>>UNP</option>
                </select>
                <!-- <input type='text' id='status_in' class='form-control' autocomplete="off" value="<?= $status_in ?>"> -->
            </div>
            <div class="form-group">
                <label for="tap_out" style="font-size: 16pt">OUT</label>
                <input type='text' id='tap_out' class='form-control' autocomplete="off" value="<?= $tap_out ?>">
            </div>
             <div class="form-group">
                <label for="status_out" style="font-size: 16pt">STATUS OUT</label>
                <select name="status_out" id="status_out" class="form-control">
                    <option value="ONT" <?= ($status_out == "ONT" ? "Selected" : "") ?>>ONT</option>
                    <option value="OVT" <?= ($status_out == "OVT" ? "Selected" : "") ?>>OVT</option>
                    <option value="NSI" <?= ($status_out == "NSI" ? "Selected" : "") ?>>NSI</option>
                    <option value="NSO" <?= ($status_out == "NSO" ? "Selected" : "") ?>>NSO</option>
                    <option value="LTI" <?= ($status_out == "LTI" ? "Selected" : "") ?>>LTI</option>
                    <option value="UNP" <?= ($status_out == "UNP" ? "Selected" : "") ?>>UNP</option>
                </select>
                <!-- <input type='text' id='status_out' class='form-control' autocomplete="off" value="<?= $status_out ?>"> -->
            </div>
            <div class="form-group">
                <label style="font-size: 16pt">Bekerja Dari</label>
                <select name="bekerja" id="bekerja" class="form-control">
                    <option value="WFH" <?= ($bekerja == "WFH" ? "Selected" : "") ?>>Rumah (WFH)</option>
                    <option value="WFO" <?= ($bekerja == "WFO" ? "Selected" : "") ?>>Kantor (WFO)</option>
                </select>
            </div>
            <div class="text-center mt-4">
                <input type="submit" id="submit2" class="btn btn-block btn-lg btn-primary" value="Koreksi">
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function () {

        $('#submit2').click(function(e){
            e.preventDefault();

            var nip        = $("#nip2").val();
            var tanggal    = $("#tanggal2").val();
            var bekerja    = $("#bekerja").val();
            var tap_in     = $("#tap_in").val();
            var tap_out    = $("#tap_out").val();
            var status_in  = $("#status_in").val();
            var status_out = $("#status_out").val();

            $.ajax({
                type: "POST",
                url: "action/simpankoreksi.php",
                data: {nip:nip, tanggal:tanggal, bekerja:bekerja, tap_in:tap_in, tap_out:tap_out, status_in:status_in, status_out:status_out},
                cache: false,
                success: function(data){
                    Swal.fire(data,"","success");
                }
            });
            
        });
    });
</script>
