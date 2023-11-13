<?php 
include_once("db.php");
if(isset($_POST["From"], $_POST["to"]))
{
    $result = '';
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
    INNER JOIN tblmajor ON tblregistration.MajorID = tblmajor.MajorID 
    WHERE RegisterDate BETWEEN '".$_POST["From"]."' AND '".$_POST["to"]."ORDER BY RegisterDate desc'";
    // $fromDate = $_POST["From"];
    // $toDate = $_POST["to"];
    // $fromHighSchool = $_POST["FromHighSchool"];
    // $facultyID = $_POST["FacultyID"];
    // $majorID = $_POST["MajorID"];

// $query = "SELECT * FROM tblregistration WHERE 
    // RegisterDate BETWEEN '$fromDate' AND '$toDate' AND 
    // FromHighSchool = '$fromHighSchool' AND 
    // FacultyID = '$facultyID' AND 
    // MajorID = '$majorID'";

    $sql = mysqli_query($conn, $query);
    $result .= '
    <table class="min-w-full text-center bg-dark text-sm font-light">
    <tr>
            <th scope="col" class=" px-6 py-4">Student ID</th>
            <th scope="col" class=" px-6 py-4">Student Name(KH)</th>
            <th scope="col" class=" px-6 py-4">Student Name(EN)</th>
            <th scope="col" class=" px-6 py-4">Sex</th>
            <th scope="col" class=" px-6 py-4">From HighSchool</th>
            <th scope="col" class=" px-6 py-4">From Faculty</th>
            <th scope="col" class=" px-6 py-4">From Major</th>
            <th scope="col" class=" px-6 py-4">Register Date</th>
            <!-- <th scope="col" class=" px-6 py-4">Handle</th> -->
    </tr>';
    if(mysqli_num_rows($sql) > 0)
    {
        while($row = mysqli_fetch_array($sql))
        {
            $result .= '
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
    }
    else{
        $result .= '
        <tr>
           <td colspan="7">No Data Found </td>
        </tr>';
    }
    $result .= '</table>';
    echo $result;
}
?>
