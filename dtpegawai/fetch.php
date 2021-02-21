<?php
include_once '../config/connection.php';

$columns = array('nip', 'nama', 'gender', 'position', 'orgunit', 'employmentstatus', 'jobstatus', 'worklocation');

$query = "SELECT * FROM pegawai ";

if(isset($_POST["search"]["value"]))
{
	$query .= '
	WHERE nip LIKE "%'.$_POST["search"]["value"].'%" 
	OR nama LIKE "%'.$_POST["search"]["value"].'%" 
	OR gender LIKE "%'.$_POST["search"]["value"].'%" 
	OR position LIKE "%'.$_POST["search"]["value"].'%" 
	OR orgunit LIKE "%'.$_POST["search"]["value"].'%" 
	OR employmentstatus LIKE "%'.$_POST["search"]["value"].'%" 
	OR jobstatus LIKE "%'.$_POST["search"]["value"].'%" 
	OR worklocation LIKE "%'.$_POST["search"]["value"].'%" 
	';
}

if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
	';
}
else
{
	$query .= 'ORDER BY id DESC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
	$query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($conn, $query));

$result = mysqli_query($conn, $query . $query1);

$data = array();

while($row = mysqli_fetch_array($result))
{
	$sub_array = array();
	$sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="nip">' . $row["nip"] . '</div>';
	$sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="nama">' . $row["nama"] . '</div>';
	$sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="gender">' . $row["gender"] . '</div>';
	$sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="position">' . $row["position"] . '</div>';
	$sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="orgunit">' . $row["orgunit"] . '</div>';
	$sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="employmentstatus">' . $row["employmentstatus"] . '</div>';
	$sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="jobstatus">' . $row["jobstatus"] . '</div>';
	$sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="worklocation">' . $row["worklocation"] . '</div>';
	$sub_array[] = '<button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row["id"].'">Delete</button>';
	$data[] = $sub_array;
}

function get_all_data($conn)
{
	$query = "SELECT * FROM pegawai";
	$result = mysqli_query($conn, $query);
	return mysqli_num_rows($result);
}

$output = array(
	"draw" => intval($_POST["draw"]),
	"recordsTotal" =>  get_all_data($conn),
	"recordsFiltered" => $number_filter_row,
	"data" => $data
);

echo json_encode($output);

?>