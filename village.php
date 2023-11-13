<?php
include 'db.php';
$commune_id = $_POST['commune_data'];

$village = "SELECT * FROM villages WHERE commune_id = $commune_id";

$village_qry = mysqli_query($conn, $village);
// $output="";
$output = '<option value="">Select Village</option>';
while ($village_row = mysqli_fetch_assoc($village_qry)) {
    $output .= '<option value="' . $village_row['id'] . '">' . $village_row['khmer_name'] . '</option>';
}
echo $output;
?>