<?php

$conn = mysqli_connect("localhost", "root", "Soratha@2003", "online_registration_db");
$output = '';
if (isset($_POST["export"])) {
    $query = "SELECT 
    tblregistration.StudentID, 
    tblregistration.NameInKhmer, 
    tblregistration.NameInLatin, 
    tblsex.SexName, 
    tblhighschool.HighSchoolName, 
    tblfaculty.FacultyName, 
    tblmajor.MajorName, 
    tblregistration.RegisterDate 
    FROM tblregistration 
    INNER JOIN TblSex ON tblregistration.SexID = TblSex.SexID 
    INNER JOIN tblhighschool ON tblregistration.FromHighSchool = tblhighschool.HighSchoolID 
    INNER JOIN tblfaculty ON tblregistration.FacultyID = tblfaculty.FacultyID 
    INNER JOIN tblmajor ON tblregistration.MajorID = tblmajor.MajorID";
    // $query = "SELECT * FROM tblregistration WHERE RegisterDate BETWEEN '".$_POST["From"]."' AND '".$_POST["to"]."'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $output .= '
        <table class="min-w-full text-center text-sm font-light">  
            <thead class="border-b bg-neutral-800 font-medium text-white dark:border-neutral-500 dark:bg-neutral-900">
                <tr>
                    <th scope="col" class=" px-6 py-4">Student ID</th>
                    <th scope="col" class=" px-6 py-4">Student Name(KH)</th>
                    <th scope="col" class=" px-6 py-4">Student Name(EN)</th>
                    <th scope="col" class=" px-6 py-4">Sex</th>
                    <th scope="col" class=" px-6 py-4">From HighSchool</th>
                    <th scope="col" class=" px-6 py-4">Faculty</th>
                    <th scope="col" class=" px-6 py-4">Major</th>
                    <th scope="col" class=" px-6 py-4">Register Date</th>
                </tr>
            </thead>
        ';
        while ($row = mysqli_fetch_array($result)) {
            $output .= '
            <tr class="border-b dark:border-neutral-500">
                <td class="whitespace-nowrap  px-6 py-4">'.$row['StudentID'].' </td>
                <td class="whitespace-nowrap  px-6 py-4">'.$row['NameInKhmer'].' </td>
                <td class="whitespace-nowrap  px-6 py-4">'.$row['NameInLatin'].' </td>
                <td class="whitespace-nowrap  px-6 py-4">'.$row['SexName'].' </td>
                <td class="whitespace-nowrap  px-6 py-4">'.$row['HighSchoolName'].' </td>
                <td class="whitespace-nowrap  px-6 py-4">'.$row['FacultyName'].' </td>
                <td class="whitespace-nowrap  px-6 py-4">'.$row['MajorName'].' </td>
                <td class="whitespace-nowrap  px-6 py-4">'.$row['RegisterDate'].' </td>
            </tr>';
        }
        $output .= '</table>';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename=student_report.xls');
        echo $output;
    }
}
?>
