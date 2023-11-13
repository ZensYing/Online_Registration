<?php
include 'db.php';
$province_id = $_POST['province_data'];

$district = "SELECT * FROM districts WHERE province_id = $province_id";

$district_qry = mysqli_query($conn, $district);
// $output="";
$output = '<option value="">Select district</option>';
while ($district_row = mysqli_fetch_assoc($district_qry)) {
    $output .= '<option value="' . $district_row['id'] . '">' . $district_row['khmer_name'] . '</option>';
}
echo $output;
?>