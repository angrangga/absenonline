<?php
include_once '../config/connection.php';

if(isset($_POST["nip"], $_POST["nama"], $_POST["gender"], $_POST["position"], $_POST["orgunit"], $_POST["employmentstatus"], $_POST["jobstatus"], $_POST["worklocation"]))
{
 $nip              = mysqli_real_escape_string($conn, $_POST["nip"]);
 $nama             = mysqli_real_escape_string($conn, $_POST["nama"]);
 $gender           = mysqli_real_escape_string($conn, $_POST["gender"]);
 $position         = mysqli_real_escape_string($conn, $_POST["position"]);
 $orgunit          = mysqli_real_escape_string($conn, $_POST["orgunit"]);
 $employmentstatus = mysqli_real_escape_string($conn, $_POST["employmentstatus"]);
 $jobstatus        = mysqli_real_escape_string($conn, $_POST["jobstatus"]);
 $worklocation     = mysqli_real_escape_string($conn, $_POST["worklocation"]);

 $query = "INSERT INTO pegawai(nip, nama, gender, position, orgunit, employmentstatus, jobstatus, worklocation) 
 VALUES('$nip', '$nama', '$gender', '$position', '$orgunit', '$employmentstatus', '$jobstatus', '$worklocation')";
 if(mysqli_query($conn, $query))
 {
  echo 'Data Inserted : <B>'.$nama." (".$nip.")</B>";
 }
}
?>