<!-- <div style="overflow-y: auto;"> -->
    <table class="table table-striped table-bordered nowrap table-compact small" id="dataTables1" width="100%">
        <thead>
            <tr>
                <th>nip</th>
                <th>nama</th>
                <th>gender</th>
                <th>position</th>
                <th>orgunit</th>
                <th>employmentstatus</th>
                <th>jobstatus</th>
                <th>worklocation</th>
            </tr>
        </thead>
        <tbody>
            <?php  
            include_once 'config/connection.php';

            $query = "SELECT * FROM pegawai";
            $result = mysqli_query($conn, $query);                                  
            while ($data = mysqli_fetch_array($result)) {

                echo "<tr>";
                echo "<td>$data[nip]</td>";
                echo "<td>$data[nama]</td>";
                echo "<td>$data[gender]</td>";
                echo "<td>$data[position]</td>";
                echo "<td>$data[orgunit]</td>";
                echo "<td>$data[employmentstatus]</td>";
                echo "<td>$data[jobstatus]</td>";
                echo "<td>$data[worklocation]</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <!-- </div> -->

    <script>
        $('#dataTables1').dataTable({
            scrollX: true,
            paging: false,
            dom: 'Bfrtip',
            buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        } );
    </script>