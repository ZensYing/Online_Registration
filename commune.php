<?php
include 'db.php';
$district_id = $_POST['district_data'];

$commune = "SELECT * FROM communes WHERE district_id = $district_id";

$commune_qry = mysqli_query($conn, $commune);
// $output="";
$output = '<option value="">Select commune</option>';
while ($commune_row = mysqli_fetch_assoc($commune_qry)) {
    $output .= '<option value="' . $commune_row['id'] . '">' . $commune_row['khmer_name'] . '</option>';
}
echo $output;
?>