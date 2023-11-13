<?php
session_start();
include('db.php');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_POST['save_excel_data'])) {
    $fileName = $_FILES['import_file']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

    $allowed_ext = ['xls', 'csv', 'xlsx'];

    if (in_array($file_ext, $allowed_ext)) {
        $inputFileNamePath = $_FILES['import_file']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
        $data = $spreadsheet->getActiveSheet()->toArray();

        $count = "0";
        foreach ($data as $row) {
            if ($count > 0) {
                $StudentID = $row['0'];
                $NameInKhmer = $row['1'];
                $NameInLatin = $row['2'];
                $SexID = $row['3'];
                $Nationality = $row['4'];
                $DOB = $row['5'];
                $ProvinceOfBirthID = $row['6'];
                $DistrictOfBirthID = $row['7'];
                $CommuneOfBirthID = $row['8'];
                $VillageOfBirthID = $row['9'];
                $PhoneNumber1 = $row['10'];
                $PhoneNumber2 = $row['11'];
                $TelegramNumber = $row['12'];
                $Email = $row['13'];
                $FromHighSchool = $row['14'];
                $NationalExamYear = $row['15'];
                $TransferedFromUniversity = $row['16'];
                $TransferYearID = $row['17'];
                $CampusID = $row['18'];
                $ProgramID = $row['19'];
                $BatchID = $row['20'];
                $DegreeID = $row['21'];
                $FacultyID = $row['22'];
                $MajorID = $row['23'];
                $ShiftID = $row['24'];
                $YearID = $row['25'];
                $EnrollmentTestID = $row['26'];
                $EnrollmentTestDescription = $row['27'];
                $TuitionFeePaymentID = $row['28'];
                $ScholarshipID = $row['29'];
                $BacIIDiploma = $row['30'];
                $Photo = $row['31'];
                $FoundationYearCertificateOrTranscript = $row['32'];
                $TestResults = $row['33'];
                $CommentsOfVPUC = $row['34'];
                $RegisterDate = $row['35'];


                // $phone = $row['2'];
                // $course = $row['3'];

                // $studentQuery = "INSERT INTO tblregistration (HighSchoolName,ProvinceID) VALUES ('$HighSchoolName','$ProvinceID')";
                $studentQuery = "INSERT INTO tblregistration (
                    StudentID, NameInKhmer, NameInLatin, SexID, Nationality, DOB,
                    ProvinceOfBirthID, DistrictOfBirthID, CommuneOfBirthID, VillageOfBirthID,
                    PhoneNumber1, PhoneNumber2, TelegramNumber, Email, FromHighSchool,
                    NationalExamYear, TransferedFromUniversity, TransferYearID, CampusID,
                    ProgramID, BatchID, DegreeID, FacultyID, MajorID, ShiftID, YearID,
                    EnrollmentTestID, EnrollmentTestDescription, TuitionFeePaymentID,
                    ScholarshipID, BacIIDiploma, Photo, FoundationYearCertificateOrTranscript,
                    TestResults, CommentsOfVPUC, RegisterDate
                ) VALUES (
                    '$StudentID', '$NameInKhmer', '$NameInLatin', '$SexID', '$Nationality', '$DOB',
                    '$ProvinceOfBirthID', '$DistrictOfBirthID', '$CommuneOfBirthID', '$VillageOfBirthID',
                    '$PhoneNumber1', '$PhoneNumber2', '$TelegramNumber', '$Email', '$FromHighSchool',
                    '$NationalExamYear', '$TransferedFromUniversity', '$TransferYearID', '$CampusID',
                    '$ProgramID', '$BatchID', '$DegreeID', '$FacultyID', '$MajorID', '$ShiftID', '$YearID',
                    '$EnrollmentTestID', '$EnrollmentTestDescription', '$TuitionFeePaymentID',
                    '$ScholarshipID', '$BacIIDiploma', '$Photo', '$FoundationYearCertificateOrTranscript',
                    '$TestResults', '$CommentsOfVPUC', '$RegisterDate'
                )";
                $result = mysqli_query($conn, $studentQuery);
                $msg = true;
            } else {
                $count = "1";
            }
        }
       
        
        if (isset($msg)) {
            $_SESSION['import_success'] = true;
            header('Location: tblregistration.php');
            exit(0);
        }
        else {
            $_SESSION['message'] = "Not Imported";
            header('Location: tblregistration.php');
            exit(0);
        }
    } else {
        $_SESSION['message'] = "Invalid File";
        header('Location: tblregistration.php');
        exit(0);
    }
}
?>
