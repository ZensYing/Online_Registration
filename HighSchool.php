<?php
include 'db.php';
$districtOfHighSchool_id = $_POST['districtOfHighSchool_data'];

$HighSchool = "SELECT * FROM tblhighschool WHERE districts_id = $districtOfHighSchool_id";

$HighSchool_qry = mysqli_query($conn, $HighSchool);
// $output="";
$output = '<option value="">Select HighSchool</option>';
while ($HighSchool_row = mysqli_fetch_assoc($HighSchool_qry)) {
    $output .= '<option value="' . $HighSchool_row['HighSchoolID'] . '">' . $HighSchool_row['HighSchoolName'] . '</option>';
}
echo $output;
?>