<?php
include 'db.php';
$faculty_id = $_POST['faculty_data'];

$district = "SELECT MajorID,MajorName FROM tblMajor WHERE FacultyID = $faculty_id";

$district_qry = mysqli_query($conn, $district);
// $output="";
$output = '<option value="">Select Major</option>';
while ($district_row = mysqli_fetch_assoc($district_qry)) {
    $output .= '<option value="' . $district_row['MajorID'] . '">' . $district_row['MajorName'] . '</option>';
}
echo $output;
?>