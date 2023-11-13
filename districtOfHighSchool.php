<?php
include 'db.php';
$provinceOfHighSchool_id = $_POST['provinceOfHighSchool_data'];

$districtOfHighSchool = "SELECT * FROM districts WHERE province_id = $provinceOfHighSchool_id";

$districtOfHighSchool_qry = mysqli_query($conn, $districtOfHighSchool);
// $output="";
$output = '<option value="">Select district</option>';
while ($districtOfHighSchool_row = mysqli_fetch_assoc($districtOfHighSchool_qry)) {
    $output .= '<option value="' . $districtOfHighSchool_row['id'] . '">' . $districtOfHighSchool_row['khmer_name'] . '</option>';
}
echo $output;
?>