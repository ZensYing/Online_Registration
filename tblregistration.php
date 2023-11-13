<?php
session_start();
if (isset($_SESSION['import_success']) && $_SESSION['import_success']) { 
    echo '<script>alert("Data has been successfully imported.");</script>';
    unset($_SESSION['import_success']); // Clear the session variable
}
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
include_once 'db.php';

$province = "SELECT * FROM provinces";
$province_qry = mysqli_query($conn, $province);

$provinceOfHighSchool = "SELECT * FROM provinces";
$provinceOfHighSchool_qry = mysqli_query($conn, $provinceOfHighSchool);

if (isset($_POST['insert'])) {
    $NameInLatin = $_POST['NameInLatin'];
    $NameInKhmer = $_POST['NameInKhmer'];
    $SexID = $_POST['SexID'];
    $Nationality = $_POST['Nationality'];
    $DOB = $_POST['DOB'];
    $ProvinceOfBirthID = $_POST['ProvinceOfBirthID'];
    $DistrictOfBirthID = $_POST['DistrictOfBirthID'];
    $CommuneOfBirthID = $_POST['CommuneOfBirthID'];
    $VillageOfBirthID = $_POST['VillageOfBirthID'];
    $PhoneNumber1 = $_POST['PhoneNumber1'];
    $PhoneNumber2 = $_POST['PhoneNumber2'];
    $TelegramNumber = $_POST['TelegramNumber'];
    $Email = $_POST['Email'];
    $FromHighSchool = $_POST['FromHighSchool'];
    $NationalExamYear = $_POST['NationalExamYear'];
    $TransferedFromUniversity = $_POST['TransferedFromUniversity'];
    $TransferYearID = $_POST['TransferYearID'];
    $CampusID = $_POST['CampusID'];
    $ProgramID = $_POST['ProgramID'];
    $BatchID = $_POST['BatchID'];
    $DegreeID = $_POST['DegreeID'];
    $FacultyID = $_POST['FacultyID'];
    $MajorID = $_POST['MajorID'];
    $ShiftID = $_POST['ShiftID'];
    $YearID = $_POST['YearID'];
    $EnrollmentTestID = $_POST['EnrollmentTestID'];
    $EnrollmentTestDescription = $_POST['EnrollmentTestDescription'];
    $TuitionFeePaymentID = $_POST['TuitionFeePaymentID'];
    $ScholarshipID = $_POST['ScholarshipID'];
    $BacIIDiploma = "";
    $Photo = "";
    $FoundationYearCertificateOrTranscript = "";
    $TestResults = $_POST['TestResults'];
    $CommentsOfVPUC = $_POST['CommentsOfVPUC'];
    $RegisterDate = $_POST['RegisterDate'];


    if (move_uploaded_file($_FILES["BacIIDiploma"]["tmp_name"], "images/BacIIDiploma/" . date("Ymdhis") . $_FILES["BacIIDiploma"]["name"])) {
        $BacIIDiploma = date("Ymdhis") . $_FILES["BacIIDiploma"]["name"];
    }
    if (move_uploaded_file($_FILES["Photo"]["tmp_name"], "images/Photo/" . date("Ymdhis") . $_FILES["Photo"]["name"])) {
        $Photo = date("Ymdhis") . $_FILES["Photo"]["name"];
    }
    if (move_uploaded_file($_FILES["FoundationYearCertificateOrTranscript"]["tmp_name"], "images/FoundationYearCertificateOrTranscript/" . date("Ymdhis") . $_FILES["FoundationYearCertificateOrTranscript"]["name"])) {
        $FoundationYearCertificateOrTranscript = date("Ymdhis") . $_FILES["FoundationYearCertificateOrTranscript"]["name"];
    }

    $sql = "INSERT INTO tblregistration(NameInKhmer, NameInLatin, SexID, Nationality, DOB, ProvinceOfBirthID, DistrictOfBirthID, CommuneOfBirthID, VillageOfBirthID, PhoneNumber1, PhoneNumber2, TelegramNumber, Email, FromHighSchool, NationalExamYear, TransferedFromUniversity, TransferYearID, CampusID, ProgramID, BatchID, DegreeID, FacultyID, MajorID, ShiftID, YearID, EnrollmentTestID, EnrollmentTestDescription, TuitionFeePaymentID, ScholarshipID, BacIIDiploma, Photo, FoundationYearCertificateOrTranscript, TestResults, CommentsOfVPUC, RegisterDate) VALUES ('$NameInKhmer', '$NameInLatin', '$SexID', '$Nationality', '$DOB', '$ProvinceOfBirthID', '$DistrictOfBirthID', '$CommuneOfBirthID', '$VillageOfBirthID', '$PhoneNumber1', '$PhoneNumber2', '$TelegramNumber', '$Email', '$FromHighSchool', '$NationalExamYear', '$TransferedFromUniversity', '$TransferYearID', '$CampusID', '$ProgramID', '$BatchID', '$DegreeID', '$FacultyID', '$MajorID', '$ShiftID', '$YearID', '$EnrollmentTestID', '$EnrollmentTestDescription', '$TuitionFeePaymentID', '$ScholarshipID', '$BacIIDiploma', '$Photo', '$FoundationYearCertificateOrTranscript', '$TestResults', '$CommentsOfVPUC', '$RegisterDate')";
    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("New record has been added successfully !")</script>';
        // header("location: Faculty.php");
    } else {
        echo "Error: " . $sql . ":-" . mysqli_error($conn);
    }
    mysqli_close($conn);
}
if (isset($_POST['search'])) {
    $StudentID = $_POST['StudentID'];

    $sql = "SELECT * FROM tblregistration WHERE StudentID = $StudentID";

    $query = mysqli_query($conn, $sql);
    while ($data = mysqli_fetch_array($query)) {
        // Here you can do whatever you want with the data
        // For example, you can redirect to a new page with some parameters
        header("location:tblregistration.php?StudentID=" . $data['StudentID']
            . "&NameInLatin=" . $data['NameInLatin']  . "&NameInKhmer=" . $data['NameInKhmer']
            . "&SexID=" . $data['SexID'] . "&Nationality=" . $data['Nationality'] . "&DOB=" . $data['DOB']
            . "&ProvinceOfBirthID=" . $data['ProvinceOfBirthID'] . "&DistrictOfBirthID=" . $data['DistrictOfBirthID']
            . "&CommuneOfBirthID=" . $data['CommuneOfBirthID'] . "&VillageOfBirthID=" . $data['VillageOfBirthID']
            . "&PhoneNumber1=" . $data['PhoneNumber1'] . "&PhoneNumber2=" . $data['PhoneNumber2']
            . "&TelegramNumber=" . $data['TelegramNumber'] . "&Email=" . $data['Email']
            . "&FromHighSchool=" . $data['FromHighSchool'] . "&NationalExamYear=" . $data['NationalExamYear']
            . "&TransferedFromUniversity=" . $data['TransferedFromUniversity'] . "&TransferYearID=" . $data['TransferYearID']
            . "&CampusID=" . $data['CampusID'] . "&ProgramID=" . $data['ProgramID']
            . "&BatchID=" . $data['BatchID'] . "&DegreeID=" . $data['DegreeID']
            . "&FacultyID=" . $data['FacultyID'] . "&MajorID=" . $data['MajorID']
            . "&ShiftID=" . $data['ShiftID'] . "&YearID=" . $data['YearID']
            . "&EnrollmentTestID=" . $data['EnrollmentTestID'] . "&EnrollmentTestDescription=" . $data['EnrollmentTestDescription']
            . "&TuitionFeePaymentID=" . $data['TuitionFeePaymentID'] . "&ScholarshipID=" . $data['ScholarshipID']
            . "&BacIIDiploma=" . $data['BacIIDiploma']
            . "&Photo=" . $data['Photo'] . "&FoundationYearCertificateOrTranscript=" . $data['FoundationYearCertificateOrTranscript']
            . "&TestResults=" . $data['TestResults']  . "&CommentsOfVPUC=" . $data['CommentsOfVPUC']  . "&RegisterDate=" . $data['RegisterDate']);
    }
}
if (isset($_POST['update'])) {

    $StudentID = $_POST['StudentID'];
    $NameInLatin = $_POST['NameInLatin'];
    $NameInKhmer = $_POST['NameInKhmer'];
    $SexID = $_POST['SexID'];
    $Nationality = $_POST['Nationality'];
    $DOB = $_POST['DOB'];
    $ProvinceOfBirthID = $_POST['ProvinceOfBirthID'];
    $DistrictOfBirthID = $_POST['DistrictOfBirthID'];
    $CommuneOfBirthID = $_POST['CommuneOfBirthID'];
    $VillageOfBirthID = $_POST['VillageOfBirthID'];
    $PhoneNumber1 = $_POST['PhoneNumber1'];
    $PhoneNumber2 = $_POST['PhoneNumber2'];
    $TelegramNumber = $_POST['TelegramNumber'];
    $Email = $_POST['Email'];
    $FromHighSchool = $_POST['FromHighSchool'];
    $NationalExamYear = $_POST['NationalExamYear'];
    $TransferedFromUniversity = $_POST['TransferedFromUniversity'];
    $TransferYearID = $_POST['TransferYearID'];
    $CampusID = $_POST['CampusID'];
    $ProgramID = $_POST['ProgramID'];
    $BatchID = $_POST['BatchID'];
    $DegreeID = $_POST['DegreeID'];
    $FacultyID = $_POST['FacultyID'];
    $MajorID = $_POST['MajorID'];
    $ShiftID = $_POST['ShiftID'];
    $YearID = $_POST['YearID'];
    $EnrollmentTestID = $_POST['EnrollmentTestID'];
    $EnrollmentTestDescription = $_POST['EnrollmentTestDescription'];
    $TuitionFeePaymentID = $_POST['TuitionFeePaymentID'];
    $ScholarshipID = $_POST['ScholarshipID'];
    $BacIIDiploma = "";
    $Photo = "";
    $FoundationYearCertificateOrTranscript = "";
    $TestResults = $_POST['TestResults'];
    $CommentsOfVPUC = $_POST['CommentsOfVPUC'];
    $RegisterDate = $_POST['RegisterDate'];


    if (move_uploaded_file($_FILES["BacIIDiploma"]["tmp_name"], "images/BacIIDiploma/" . date("Ymdhis") . $_FILES["BacIIDiploma"]["name"])) {
        $BacIIDiploma = date("Ymdhis") . $_FILES["BacIIDiploma"]["name"];
    }
    if (move_uploaded_file($_FILES["Photo"]["tmp_name"], "images/Photo/" . date("Ymdhis") . $_FILES["Photo"]["name"])) {
        $Photo = date("Ymdhis") . $_FILES["Photo"]["name"];
    }
    if (move_uploaded_file($_FILES["FoundationYearCertificateOrTranscript"]["tmp_name"], "images/FoundationYearCertificateOrTranscript/" . date("Ymdhis") . $_FILES["FoundationYearCertificateOrTranscript"]["name"])) {
        $FoundationYearCertificateOrTranscript = date("Ymdhis") . $_FILES["FoundationYearCertificateOrTranscript"]["name"];
    }

    $sql = "UPDATE tblregistration SET NameInLatin = '$NameInLatin', NameInKhmer = '$NameInKhmer', SexID = '$SexID', Nationality = '$Nationality', DOB = '$DOB', ProvinceOfBirthID = '$ProvinceOfBirthID', DistrictOfBirthID = '$DistrictOfBirthID', CommuneOfBirthID = '$CommuneOfBirthID', VillageOfBirthID = '$VillageOfBirthID', PhoneNumber1 = '$PhoneNumber1', PhoneNumber2 = '$PhoneNumber2', TelegramNumber = '$TelegramNumber', Email = '$Email', FromHighSchool = '$FromHighSchool', NationalExamYear = '$NationalExamYear', TransferedFromUniversity = '$TransferedFromUniversity', TransferYearID = '$TransferYearID', CampusID = '$CampusID', ProgramID = '$ProgramID', BatchID = '$BatchID', DegreeID = '$DegreeID', FacultyID = '$FacultyID', MajorID = '$MajorID', ShiftID = '$ShiftID', YearID = '$YearID', EnrollmentTestID = '$EnrollmentTestID', EnrollmentTestDescription = '$EnrollmentTestDescription', TuitionFeePaymentID = '$TuitionFeePaymentID', ScholarshipID = '$ScholarshipID', BacIIDiploma = '$BacIIDiploma', Photo = '$Photo', FoundationYearCertificateOrTranscript = '$FoundationYearCertificateOrTranscript', TestResults = '$TestResults', CommentsOfVPUC = '$CommentsOfVPUC', RegisterDate = '$RegisterDate' WHERE StudentID = $StudentID";

    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("Record has been successfully !")</script>';
        // header("location: Faculty.php");
    } else {
        echo "Error updating record: " . $sql . ":-" . mysqli_error($conn);
    }
}
if (isset($_POST['delete'])) {

    $StudentID = $_POST['StudentID'];
    $stmt = $conn->prepare("DELETE FROM tblregistration WHERE StudentID = ?");
    $stmt->bind_param("s", $StudentID); // "s" means the database expects a string

    if ($stmt->execute()) {
        echo '<script>alert("Delete Student successfully!!!")</script>';
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Admin Dashboard | Korsat X Parmaga</title>
    <!-- ======= Styles ====== -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet"> -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .style-form input {
            border: 1px solid purple;

        }

        .style-form select {
            border: 1px solid purple;

        }
    </style>
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="big-container-fluid">
        <div class="navigation">
        <ul>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="logo-school"></ion-icon>
                        </span>
                        <span class="title">BELTEI IU SYSTEM</span>
                    </a>
                </li>

                <li>
                    <a href="index.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                <!-- <li>
                    <a href="PersonalInformation.php">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Insert Personal Information</span>
                    </a>
                </li> -->
                <li>
                    <a href="tblregistration.php">
                        <span class="icon">
                        <ion-icon name="person-add-outline"></ion-icon>
                        </span>
                        <span class="title">From Registration</span>
                    </a>
                </li>

                <!-- <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="chatbubble-outline"></ion-icon>
                        </span>
                        <span class="title">Messages</span>
                    </a>
                </li> -->
                <li>
                    <a href="options.php">
                        <span class="icon">
                            <ion-icon name="options-outline"></ion-icon>
                        </span>
                        <span class="title">More Options</span>
                    </a>
                </li>
                <li>
                    <a href="faculties.php">
                        <span class="icon">
                            <ion-icon name="school"></ion-icon>
                        </span>
                        <span class="title">Faculties</span>
                    </a>
                </li>

                <li>
                    <a href="campus.php">
                        <span class="icon">
                            <ion-icon name="business-outline"></ion-icon>
                        </span>
                        <span class="title">Campus</span>
                    </a>
                </li>
                <li>
                    <a href="about_us.php">
                        <span class="icon">
                        <i class="fa-regular fa-address-card text-2xl"></i>
                        </span>
                        <span class="title">About Team</span>
                    </a>
                </li>
                <li>
                    <a href="about_professor.php">
                        <span class="icon">
                        <i class="fa-solid fa-chalkboard-user"></i>
                        </span>
                        <span class="title">About Prefessor</span>
                    </a>
                </li>

                <!-- <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="lock-closed-outline"></ion-icon>
                        </span>
                        <span class="title">Password</span>
                    </a>
                </li> -->

                <li>
                    <a href="logout.php">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="search">
                    <label>
                        <input type="text" placeholder="Search here">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>

                <div class="user">

                </div>
            </div>

            <!-- ======================= Cards ================== -->
            <!-- <div class="cardBox">
                <div class="card">
                    <div>
                        <div class="numbers">1,504</div>
                        <div class="cardName">Daily Views</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="eye-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">80</div>
                        <div class="cardName">...</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="cart-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">284</div>
                        <div class="cardName">Comments</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="chatbubbles-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">$7,842</div>
                        <div class="cardName">....</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="cash-outline"></ion-icon>
                    </div>
                </div>
            </div> -->
  
            <!-- ================ Order Details List ================= -->
            <!-- <div id="dropdown" class="relative inline-block " style="margin-left:1.4rem;">
                <button class="bg-blue-500 text-white font-semibold py-2 px-5 rounded" onclick="toggleDropdown()">
                    Sex,Nationality, AcademicInformation
                </button>
                <div id="dropdown-menu" class="hidden absolute mt-2 w-48 bg-white text-gray-700 rounded shadow-lg">
                    <a href="#" class="block px-4 py-2 hover:bg-blue-500 hover:text-white">Item 1</a>
                    <a href="#" class="block px-4 py-2 hover:bg-blue-500 hover:text-white">Item 2</a>
                    <a href="#" class="block px-4 py-2 hover:bg-blue-500 hover:text-white">Item 3</a>
                </div>
            </div> -->



            <!-- Button to trigger SweetAlert -->
            <!-- <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="showForm()">
            Show Form
        </button> -->
            <!--  -->


            <script>
                function toggleDropdown() {
                    const dropdownMenu = document.getElementById('dropdown-menu');
                    dropdownMenu.classList.toggle('hidden');
                }
            </script>
            <div class="bg-white-200 p-4 sm:p-6 md:p-8 rounded-lg text-center">
                <p class="text-lg sm:text-xl md:text-2xl font-bold ">
                    Registration Form
                </p>
                <div class="w-full mx-auto">
                    <div class="float-right">
                        <button id="importBtn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Import <i class="fa-solid fa-upload"></i>
                        </button>
                    </div>
                </div>
            </div>
            <?php
                if(isset($_SESSION['message']))
                {
                    echo "<h4>".$_SESSION['message']."</h4>";
                    unset($_SESSION['message']);
                }
                ?>
            <!-- Modal -->
            <!-- Modal -->
            <div id="modal" class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="bg-black bg-opacity-50 flex items-center justify-center min-h-screen">
                    <div class="bg-white rounded-lg w-full transition-all transform ease-in-out duration-300 ease-in-out ">
                        <div class="px-4 py-5 sm:p-6 sm:pb-4">
                            <button id="closeModal" class="float-right ml-4 mt-5 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:mt-0 sm:w-auto sm:text-sm">
                                Close
                            </button>
                            <form action="code.php" method="POST" enctype="multipart/form-data">
                                <button type="submit" id="closeModal" name="save_excel_data" class="float-right mt-5 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-purple-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:mt-0 sm:w-auto sm:text-sm">
                                    Submit
                                </button>
                            
                                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                        Import Excel File
                                    </h3>
                                    <div class="mt-2">
                                        <label for="excelFile" class="custom-file-upload">
                                            <span>Select File <i class="fa-solid fa-file-import"></i></span> <br>
                                            <input type="file" id="excelFile" name="import_file" style="cursor: pointer;" accept=".xlsx, .xls" onchange="handleFile()">
                                        </label>
                                    </div>
                            </form>
                            <div id="excelData" class="mt-4">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                const importBtn = document.getElementById('importBtn');
                const modal = document.getElementById('modal');
                const closeModal = document.getElementById('closeModal');

                importBtn.addEventListener('click', function() {
                    modal.classList.remove('hidden', 'scale-0');
                    modal.classList.add('scale-100');
                });

                closeModal.addEventListener('click', function() {
                    modal.classList.add('hidden', 'scale-0');
                    modal.classList.remove('scale-100');
                });

                function handleFile() {
                    const selectedFile = document.getElementById('excelFile').files[0];
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const data = new Uint8Array(e.target.result);
                        const workbook = XLSX.read(data, {
                            type: 'array'
                        });

                        // Get the first worksheet
                        const worksheetName = workbook.SheetNames[0];
                        const worksheet = workbook.Sheets[worksheetName];

                        // Convert the worksheet to JSON
                        const jsonData = XLSX.utils.sheet_to_json(worksheet);

                        // ...

                        // Generate an HTML table
                        const table = document.createElement('table');
                        table.classList.add('min-w-full', 'divide-y', 'divide-gray-200'); // Add Tailwind classes for styling
                        // table.style.width = '50px';
                        // Create a div with overflow-x-auto class
                        const responsiveDiv = document.createElement('div');
                        responsiveDiv.classList.add('overflow-scroll');

                        // Append the table to the div
                        responsiveDiv.appendChild(table);

                        // Generate the table header
                        const thead = document.createElement('thead');
                        const headerRow = document.createElement('tr');

                        // Define the headers
                        const headers = [
                            "Student ID", "Name KH", "Name En", "Sex", "Nationality", "Date of Birth",
                            "Province", "District", "Commune", "Village", "Phone 1", "Phone 2", "Telegram",
                            "Email", "HighSchool", "National Exam Year", "transfered University",
                            "Transfer Year", "Campus", "Program", "Batch", "Degree", "Faculty",
                            "Major", "Shift", "Year", "Enrollment Test", "Enrollment Test Des",
                            "Tuition Fee payment", "Scholarship", "Bacll Diploma", "Photo",
                            "Foundation Year Certificate", "Test Results", "Comments of VPUC", "Register Date"
                        ];

                        // Generate the header cells
                        // Generate the header cells
                        headers.forEach(header => {
                            const th = document.createElement('th');
                            th.textContent = header;
                            th.classList.add('px-5', 'py-4', 'text-center', 'text-white', 'bg-cyan-600'); // Add Tailwind classes for styling
                            // th.classList.add('w-100px'); // Add the custom width class

                            // Set the width to 50 pixels

                            // Add width style here
                            headerRow.appendChild(th);
                        });

                        // ...
                        thead.appendChild(headerRow);
                        table.appendChild(thead);

                        // Generate the table body
                        const tbody = document.createElement('tbody');

                        jsonData.forEach(obj => {
                            const row = document.createElement('tr');

                            headers.forEach(header => {
                                const td = document.createElement('td');
                                td.textContent = obj[header] || '';
                                td.classList.add('text-center','bg-white')
                                 // Return an empty string if the key does not exist in the object
                                row.appendChild(td);
                            });

                            tbody.appendChild(row);
                        });

                        table.appendChild(tbody);

                        // Display the table
                        const excelData = document.getElementById('excelData');
                        excelData.innerHTML = '';
                        excelData.appendChild(responsiveDiv);
                        // ...
                    };

                    reader.readAsArrayBuffer(selectedFile);
                }
            </script>
           
            <form action="tblregistration.php" method="POST" enctype="multipart/form-data" class="max-w-full  mx-auto bg-white p-8 rounded-lg shadow-md style-form">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="bg-white p-4 rounded shadow  border-2 ">
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="sex_id">
                                Sutdent ID
                            </label>
                            <input class=" border-2 border-purple-600 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="StudentID" type="text" placeholder="Enter Shift ID" value="<?php if (!empty($_GET))                                                                                                                                                                                                           echo $_GET['StudentID'] ?>">
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded shadow  border-2 ">
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="NameInKhmer">
                                Student Name(Khmer)
                            </label>
                            <input class="border-2 border-purple-600 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="NameInKhmer" type="text" placeholder="Enter Student ID" value="<?php if (!empty($_GET))
                                                                                                                                                                                                                                                                    echo $_GET['NameInKhmer'] ?>">
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded shadow  border-2 ">
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="NameInLatin">
                                Student Name(Latin)
                            </label>
                            <input class="border-2 border-purple-600 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="NameInLatin" type="text" placeholder="Enter Student ID" value="<?php if (!empty($_GET))
                                                                                                                                                                                                                                                                    echo $_GET['NameInLatin'] ?>">
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded shadow  border-2 ">
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="SexID">Select Sex</label>
                            <select name="SexID" class="bg-white border border-gray-100 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option>
                                    <?php
                                    if (!empty($_GET)) {
                                        $sql = "SELECT SexName FROM tblsex where SexID = $_GET[SexID]";
                                        $query = mysqli_query($conn, $sql);
                                        $data = mysqli_fetch_array($query);
                                        echo $data['SexName'];
                                    }
                                    if (empty($_GET))
                                        echo "Select Sex"
                                    ?>
                                </option>
                                <?php
                                $query = "SELECT SexID,SexName FROM tblsex";
                                $result = $conn->query($query);
                                if ($result->num_rows > 0) {
                                    $options = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                }
                                foreach ($options as $option) {
                                ?>
                                    <option value="<?php echo $option['SexID']; ?>"><?php echo $option['SexName']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>



                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4" style="margin-top: 10px;">
                    <div class="bg-white p-4 rounded shadow border-2 ">
                        <div class="mb-4 ">
                            <label class="block text-gray-700 font-bold mb-2" for="Nationality">
                                Nationality
                            </label>
                            <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="Nationality" type="text" placeholder="Enter Nationality" value="<?php if (!empty($_GET))
                                                                                                                                                                                                                                            echo $_GET['Nationality'] ?>">
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded shadow border-2 ">
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="DOB">
                                Date Of Birth
                            </label>
                            <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="DOB" type="Date" placeholder="Enter Date Of Birth" value="<?php if (!empty($_GET))
                                                                                                                                                                                                                                    echo $_GET['DOB'] ?>" min="1900-01-01" max="2100-12-31" class="w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded shadow border-2 ">
                        <div class="mb-4">
                            <label for="" class="block text-gray-700 font-bold mb-2">Select Province</label>
                            <select id="province" name="ProvinceOfBirthID" class="block w-full py-2 pl-3 pr-10 text-gray-700 bg-white border border-gray-300 rounded-lg appearance-none focus:outline-none focus:border-indigo-500">
                                <option selected disabled>Select Province</option>
                                <?php while ($row = mysqli_fetch_assoc($province_qry)) : ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['khmer_name']; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded shadow border-2 ">
                        <div class="mb-4">
                            <label for="" class="block text-gray-700 font-bold mb-2">Select District</label>
                            <select id="district" name="DistrictOfBirthID" class="block w-full py-2 pl-3 pr-10 text-gray-700 bg-white border border-gray-300 rounded-lg appearance-none focus:outline-none focus:border-indigo-500">
                                <option value="">Select District</option>
                            </select>
                        </div>
                    </div>
                </div>




                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4" style="margin-top:10px;">
                    <div class="bg-white p-4 rounded shadow border-2 ">
                        <div class="mb-4">
                            <label for="" class="block text-gray-700 font-bold mb-2">Select Sommune</label>
                            <select id="commune" name="CommuneOfBirthID" class="block w-full py-2 pl-3 pr-10 text-gray-700 bg-white border border-gray-300 rounded-lg appearance-none focus:outline-none focus:border-indigo-500">
                                <option value="">Select Commune</option>
                            </select>
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded shadow border-2 ">
                        <div class="mb-4">
                            <label for="" class="block text-gray-700 font-bold mb-2">Select Village</label>
                            <select id="village" name="VillageOfBirthID" class="block w-full py-2 pl-3 pr-10 text-gray-700 bg-white border border-gray-300 rounded-lg appearance-none focus:outline-none focus:border-indigo-500">
                                <option value="">Select Village</option>
                            </select>
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded shadow border-2 ">
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="PhoneNumber1">
                                PhoneNumber1
                            </label>
                            <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="PhoneNumber1" type="text" placeholder="Enter PhoneNumber1" value="<?php if (!empty($_GET['PhoneNumber1']))
                                                                                                                                                                                                                                            echo htmlspecialchars($_GET['PhoneNumber1'], ENT_QUOTES, 'UTF-8'); ?>">
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded shadow border-2 ">
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="PhoneNumber2">
                                PhoneNumber2
                            </label>
                            <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="PhoneNumber2" type="text" placeholder="Enter PhoneNumber2" value="<?php if (!empty($_GET['PhoneNumber2']))
                                                                                                                                                                                                                                            echo htmlspecialchars($_GET['PhoneNumber2'], ENT_QUOTES, 'UTF-8'); ?>">
                        </div>
                    </div>
                </div>



                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4" style="margin-top:10px;">
                    <div class="bg-white p-4 rounded shadow border-2 ">
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="TelegramNumber">
                                TelegramNumber
                            </label>
                            <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="TelegramNumber" type="text" placeholder="Enter TelegramNumber" value="<?php if (!empty($_GET)) echo $_GET['TelegramNumber'] ?>">
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded shadow border-2 ">
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="Email">
                                Email
                            </label>
                            <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="Email" type="text" placeholder="Enter Email" value="<?php if (!empty($_GET)) echo $_GET['Email'] ?>">
                        </div>
                    </div>


                    <div class="bg-white p-4 rounded shadow border-2 ">
                        <div class="mb-4">
                            <label for="" class="block text-gray-700 font-bold mb-2">Select Province</label>
                            <select id="provinceOfHighSchool" name="ProvinceOfHighSchoolID" class="block w-full py-2 pl-3 pr-10 text-gray-700 bg-white border border-gray-300 rounded-lg appearance-none focus:outline-none focus:border-indigo-500">
                                <option selected disabled>Select Province</option>
                                <?php while ($row = mysqli_fetch_assoc($provinceOfHighSchool_qry)) : ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['khmer_name']; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded shadow border-2 ">
                        <div class="mb-4">
                            <label for="" class="block text-gray-700 font-bold mb-2">Select District</label>
                            <select id="districtOfHighSchool" name="DistrictOfHighSchoolID" class="block w-full py-2 pl-3 pr-10 text-gray-700 bg-white border border-gray-300 rounded-lg appearance-none focus:outline-none focus:border-indigo-500">
                                <option value="">Select District</option>
                            </select>
                        </div>
                    </div>
                    <!-- <div class="bg-white p-4 rounded shadow border-2 ">
                        <div class="mb-4">
                            <label for="" class="block text-gray-700 font-bold mb-2">Select HighSchool</label>
                            <select id="HighSchool" name="HighSchoolID" class="block w-full py-2 pl-3 pr-10 text-gray-700 bg-white border border-gray-300 rounded-lg appearance-none focus:outline-none focus:border-indigo-500">
                                <option value="">Select HighSchool</option>
                            </select>
                        </div>
                    </div> -->


                    <div class="bg-white p-4 rounded shadow border-2 ">
                        <div class="mb-4">
                            <label for="" class="block text-gray-700 font-bold mb-2">Select HighSchool</label>
                            <select id="HighSchool" name="FromHighSchool" class="block w-full py-2 pl-3 pr-10 text-gray-700 bg-white border border-gray-300 rounded-lg appearance-none focus:outline-none focus:border-indigo-500">
                                <option value="">Select HighSchool</option>
                            </select>
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded shadow border-2 ">
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="NationalExamYear">
                                NationalExamYear
                            </label>
                            <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="NationalExamYear" type="text" placeholder="Enter NationalExamYear" value="<?php if (!empty($_GET))
                                                                                                                                                                                                                                                    echo $_GET['NationalExamYear'] ?>">
                        </div>
                    </div>
                </div>


                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4" style="margin-top: 10px;">
                    <div class="bg-white p-4 rounded shadow border-2 ">
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="TransferedFromUniversity">
                                TransferedFromUniversity
                            </label>
                            <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="TransferedFromUniversity" type="text" placeholder="Enter TransferedFromUniversity" value="<?php if (!empty($_GET))
                                                                                                                                                                                                                                                                    echo $_GET['TransferedFromUniversity'] ?>">
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded shadow border-2 ">
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="TransferYearID">Select TransferYear</label>
                            <select name="TransferYearID" class="bg-white border border-gray-100 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option>
                                    <?php
                                    if (!empty($_GET)) {
                                        $sql = "SELECT YearName FROM tblyear where YearID = $_GET[YearID]";
                                        $query = mysqli_query($conn, $sql);
                                        $data = mysqli_fetch_array($query);
                                        echo $data['YearName'];
                                    }
                                    if (empty($_GET))
                                        echo "Select YearName"
                                    ?>
                                </option> <?php
                                            $query = "SELECT YearID,YearName FROM tblyear";
                                            $result = $conn->query($query);
                                            if ($result->num_rows > 0) {
                                                $options = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                            }
                                            foreach ($options as $option) {
                                            ?>
                                    <option value="<?php echo $option['YearID']; ?>"><?php echo $option['YearName']; ?></option>
                                <?php
                                            }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded shadow border-2 ">
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="CampusID">Select Campus</label>
                            <select name="CampusID" class="bg-white border border-gray-100 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option>
                                    <?php
                                    if (!empty($_GET)) {
                                        $sql = "SELECT CampusName FROM tblcampus where CampusID = $_GET[CampusID]";
                                        $query = mysqli_query($conn, $sql);
                                        $data = mysqli_fetch_array($query);
                                        echo $data['CampusName'];
                                    }
                                    if (empty($_GET))
                                        echo "Select Campus"
                                    ?>
                                </option> <?php
                                            $query = "SELECT CampusID,CampusName FROM tblcampus";
                                            $result = $conn->query($query);
                                            if ($result->num_rows > 0) {
                                                $options = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                            }
                                            foreach ($options as $option) {
                                            ?>
                                    <option value="<?php echo $option['CampusID']; ?>"><?php echo $option['CampusName']; ?></option>
                                <?php
                                            }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded shadow border-2 ">
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="ProgramID">Select Program</label>
                            <select name="ProgramID" class="bg-white border border-gray-100 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option>
                                    <?php
                                    if (!empty($_GET)) {
                                        $sql = "SELECT ProgramName FROM tblProgram where ProgramID = $_GET[ProgramID]";
                                        $query = mysqli_query($conn, $sql);
                                        $data = mysqli_fetch_array($query);
                                        echo $data['ProgramName'];
                                    }
                                    if (empty($_GET))
                                        echo "Select Program"
                                    ?>
                                </option> <?php
                                            $query = "SELECT ProgramID,ProgramName FROM tblProgram";
                                            $result = $conn->query($query);
                                            if ($result->num_rows > 0) {
                                                $options = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                            }
                                            foreach ($options as $option) {
                                            ?>
                                    <option value="<?php echo $option['ProgramID']; ?>">
                                        <?php echo $option['ProgramName']; ?>
                                    </option>
                                <?php
                                            }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>



                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4" style="margin-top: 10px;">
                    <div class=" bg-white p-4 rounded shadow border-2 ">
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="BatchID">Select Batch</label>
                            <select name="BatchID" class="bg-white border border-gray-100 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option>
                                    <?php
                                    if (!empty($_GET)) {
                                        $sql = "SELECT BatchName FROM tblBatch where BatchID = $_GET[BatchID]";
                                        $query = mysqli_query($conn, $sql);
                                        $data = mysqli_fetch_array($query);
                                        echo $data['BatchName'];
                                    }
                                    if (empty($_GET))
                                        echo "Select Batch"
                                    ?>
                                </option> <?php
                                            $query = "SELECT BatchID,BatchName FROM tblBatch";
                                            $result = $conn->query($query);
                                            if ($result->num_rows > 0) {
                                                $options = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                            }
                                            foreach ($options as $option) {
                                            ?>
                                    <option value="<?php echo $option['BatchID']; ?>">
                                        <?php echo $option['BatchName']; ?>
                                    </option>
                                <?php
                                            }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded shadow border-2 ">
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="DegreeID">Select Degree</label>
                            <select name="DegreeID" class="bg-white border border-gray-100 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option>
                                    <?php
                                    if (!empty($_GET)) {
                                        $sql = "SELECT DegreeName FROM tblDegree where DegreeID = $_GET[DegreeID]";
                                        $query = mysqli_query($conn, $sql);
                                        $data = mysqli_fetch_array($query);
                                        echo $data['DegreeName'];
                                    }
                                    if (empty($_GET))
                                        echo "Select Degree"
                                    ?>
                                </option> <?php
                                            $query = "SELECT DegreeID,DegreeName FROM tblDegree";
                                            $result = $conn->query($query);
                                            if ($result->num_rows > 0) {
                                                $options = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                            }
                                            foreach ($options as $option) {
                                            ?>
                                    <option value="<?php echo $option['DegreeID']; ?>"><?php echo $option['DegreeName']; ?></option>
                                <?php
                                            }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded shadow border-2 ">
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="FacultyID">Select Faculty</label>
                            <select id="faculty" name="FacultyID" class="bg-white border border-gray-100 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option>
                                    <?php
                                    if (!empty($_GET)) {
                                        $sql = "SELECT FacultyName FROM tblFaculty where FacultyID = $_GET[FacultyID]";
                                        $query = mysqli_query($conn, $sql);
                                        $data = mysqli_fetch_array($query);
                                        echo $data['FacultyName'];
                                    }
                                    if (empty($_GET))
                                        echo "Select Faculty"
                                    ?>
                                </option> <?php
                                            $query = "SELECT FacultyID,FacultyName FROM tblFaculty";
                                            $result = $conn->query($query);
                                            if ($result->num_rows > 0) {
                                                $options = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                            }
                                            foreach ($options as $option) {
                                            ?>
                                    <option value="<?php echo $option['FacultyID']; ?>">
                                        <?php echo $option['FacultyName']; ?>
                                    </option> <?php
                                            }
                                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded shadow border-2 ">
                        <div class="mb-4">
                            <label for="" class="block text-gray-700 font-bold mb-2">Select Major</label>
                            <select id="major" name="MajorID" class="block w-full py-2 pl-3 pr-10 text-gray-700 bg-white border border-gray-300 rounded-lg appearance-none focus:outline-none focus:border-indigo-500">
                                <option value="">Select Major</option>
                            </select>
                        </div>
                    </div>
                </div>



                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4" style="margin-top: 10px;">
                    <div class="bg-white p-4 rounded shadow border-2 ">
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="ShiftID">Select Shift</label>
                            <select name="ShiftID" class="bg-white border border-gray-100 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option>
                                    <?php
                                    if (!empty($_GET)) {
                                        $sql = "SELECT ShiftName FROM tblShift where ShiftID = $_GET[ShiftID]";
                                        $query = mysqli_query($conn, $sql);
                                        $data = mysqli_fetch_array($query);
                                        echo $data['ShiftName'];
                                    }
                                    if (empty($_GET))
                                        echo "Select Shift"
                                    ?>
                                </option>
                                <?php
                                $query = "SELECT ShiftID,ShiftName FROM tblShift";
                                $result = $conn->query($query);
                                if ($result->num_rows > 0) {
                                    $options = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                }
                                foreach ($options as $option) {
                                ?>
                                    <option value="<?php echo $option['ShiftID']; ?>"><?php echo $option['ShiftName']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded shadow border-2 ">
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="YearID">Select Year</label>
                            <select name="YearID" class="bg-white border border-gray-100 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option>
                                    <?php
                                    if (!empty($_GET)) {
                                        $sql = "SELECT YearName FROM tblyear where YearID = $_GET[YearID]";
                                        $query = mysqli_query($conn, $sql);
                                        $data = mysqli_fetch_array($query);
                                        echo $data['YearName'];
                                    }
                                    if (empty($_GET))
                                        echo "Select YearName"
                                    ?>
                                </option> <?php
                                            $query = "SELECT YearID,YearName FROM tblyear";
                                            $result = $conn->query($query);
                                            if ($result->num_rows > 0) {
                                                $options = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                            }
                                            foreach ($options as $option) {
                                            ?>
                                    <option value="<?php echo $option['YearID']; ?>"><?php echo $option['YearName']; ?></option>
                                <?php
                                            }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded shadow border-2 ">
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="EnrollmentTestID">Select EnrollmentTest</label>
                            <select name="EnrollmentTestID" class="bg-white border border-gray-100 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option>
                                    <?php
                                    if (!empty($_GET)) {
                                        $sql = "SELECT EnrollmentTestName FROM tblEnrollmentTest where EnrollmentTestID = $_GET[EnrollmentTestID]";
                                        $query = mysqli_query($conn, $sql);
                                        $data = mysqli_fetch_array($query);
                                        echo $data['EnrollmentTestName'];
                                    }
                                    if (empty($_GET))
                                        echo "Select EnrollmentTestName"
                                    ?>
                                </option> <?php
                                            $query = "SELECT EnrollmentTestID,EnrollmentTestName FROM tblEnrollmentTest";
                                            $result = $conn->query($query);
                                            if ($result->num_rows > 0) {
                                                $options = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                            }
                                            foreach ($options as $option) {
                                            ?>
                                    <option value="<?php echo $option['EnrollmentTestID']; ?>">
                                        <?php echo $option['EnrollmentTestName']; ?></option>
                                <?php
                                            }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded shadow border-2 ">
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="EnrollmentTestDescription">
                                EnrollmentTestDescription
                            </label>
                            <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="EnrollmentTestDescription" type="text" placeholder="Enter EnrollmentTestDescription" value="<?php if (!empty($_GET))                                                                                                                                                                                                                                echo $_GET['EnrollmentTestDescription'] ?>">
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4" style="margin-top: 10px;">
                    <div class="bg-white p-4 rounded shadow border-2 ">
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="TuitionFeePaymentID">Select TuitionFeePayment</label>
                            <select name="TuitionFeePaymentID" class="bg-white border border-gray-100 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option>
                                    <?php
                                    if (!empty($_GET)) {
                                        $sql = "SELECT TuitionFeePaymentName FROM tblTuitionFeePayment where TuitionFeePaymentID = $_GET[TuitionFeePaymentID]";
                                        $query = mysqli_query($conn, $sql);
                                        $data = mysqli_fetch_array($query);
                                        echo $data['TuitionFeePayment'];
                                    }
                                    if (empty($_GET))
                                        echo "Select TuitionFeePayment"
                                    ?>
                                </option> <?php
                                            $query = "SELECT TuitionFeePaymentID,TuitionFeePaymentName FROM tblTuitionFeePayment";
                                            $result = $conn->query($query);
                                            if ($result->num_rows > 0) {
                                                $options = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                            }
                                            foreach ($options as $option) {
                                            ?>
                                    <option value="<?php echo $option['TuitionFeePaymentID']; ?>">
                                        <?php echo $option['TuitionFeePaymentName']; ?></option>
                                <?php
                                            }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded shadow border-2 ">
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="ScholarshipID">Select Scholarship</label>
                            <select name="ScholarshipID" class="bg-white border border-gray-100 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option>
                                    <?php
                                    if (!empty($_GET)) {
                                        $sql = "SELECT ScholarshipName FROM tblScholarship where ScholarshipID = $_GET[ScholarshipID]";
                                        $query = mysqli_query($conn, $sql);
                                        $data = mysqli_fetch_array($query);
                                        echo $data['ScholarshipName'];
                                    }
                                    if (empty($_GET))
                                        echo "Select Scholarship"
                                    ?>
                                </option>
                                <?php
                                $query = "SELECT ScholarshipID,ScholarshipName FROM tblScholarship";
                                $result = $conn->query($query);
                                if ($result->num_rows > 0) {
                                    $options = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                }
                                foreach ($options as $option) {
                                ?>
                                    <option value="<?php echo $option['ScholarshipID']; ?>">
                                        <?php echo $option['ScholarshipName']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded shadow border-2 ">
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="BacIIDiploma">BacII Diploma</label>
                            <input class="block w-full text-lg text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none" id="BacIIDiploma" type="file" name=" BacIIDiploma" value="<?php if (!empty($_GET))
                                                                                                                                                                                                                                                echo $_GET['BacIIDiploma'] ?>">
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded shadow border-2 ">

                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="Photo">Photo</label>
                            <input class="block w-full text-lg text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none" id="Photo" type="file" name=" Photo" value="<?php if (!empty($_GET))
                                                                                                                                                                                                                                echo $_GET['Photo'] ?>">
                        </div>
                    </div>
                </div>


                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4" style="margin-top: 10px;">
                    <div class="bg-white p-4 rounded shadow border-2 ">
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="FoundationYearCertificateOrTranscript">Foundation Year Certificate Or Transcript</label>
                            <input class="block w-full text-lg text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none" id="FoundationYearCertificateOrTranscript" type="file" name="FoundationYearCertificateOrTranscript" value="<?php if (!empty($_GET))
                                                                                                                                                                                                                                                                                                echo $_GET['FoundationYearCertificateOrTranscript'] ?>">
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded shadow border-2 ">
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="TestResults">
                                TestResults
                            </label>
                            <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="TestResults" type="text" placeholder="Enter TestResults" value="<?php if (!empty($_GET))
                                                                                                                                                                                                                                            echo $_GET['TestResults'] ?>">
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded shadow border-2 ">
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="CommentsOfVPUC">
                                CommentsOfVPUC
                            </label>
                            <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="CommentsOfVPUC" type="text" placeholder="Enter CommentsOfVPUC" value="<?php if (!empty($_GET))
                                                                                                                                                                                                                                                echo $_GET['CommentsOfVPUC'] ?>">
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded shadow border-2 ">

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="RegisterDate">
                                RegisterDate
                            </label>
                            <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="RegisterDate" type="Date" placeholder="Enter Date Of Birth" value="<?php if (!empty($_GET))
                                                                                                                                                                                                                                            echo $_GET['RegisterDate'] ?>" min="1900-01-01" max="2100-12-31" class="w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                    </div>
                </div>





                <div class="flex items-center mx-3" style="margin-top: 20px;">
                    <button type="submit" name="insert" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Insert</button>
                    <button type="submit" name="search" class=" mx-3 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Search</button>
                    <button type="submit" name="update" class=" mx-3 bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update</button>
                    <button type="submit" name="delete" class=" mx-3 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Delete</button>
                </div>
            </form>
            <table class="table-auto min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student ID</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student Name (Khmer)</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student Name (Latin)</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sex</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nationality</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">DOB</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Photo</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Register Date</th>
                      
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php
                   
                    $sql = "SELECT * FROM `tblregistration`";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($result)) {
                        $id = $row['StudentID'];
                        $nameKh = $row['NameInKhmer'];
                        $nameEn = $row['NameInLatin'];
                        $sex = $row['SexID'];
                        $nationality = $row['Nationality'];
                        $dob = $row['DOB'];
                        $photo = $row['Photo'];
                        $registerDate = $row['RegisterDate'];
                    ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap"><?php echo $id; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?php echo $nameKh; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?php echo $nameEn; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?php echo $sex; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?php echo $nationality; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?php echo $dob; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><img src="images/Photo/<?= $row['Photo'] ?>" class="h-8 w-8 rounded-full"></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?php echo $registerDate; ?></td>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.15/tailwind.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.js">
    </script>
    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js">
    </script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script>
        function toggleDropdown() {
            const dropdownMenu = document.getElementById('dropdown-menu');
            dropdownMenu.classList.toggle('hidden');
        }


        $('#faculty').on('change', function() {
            var faculty_id = this.value;
            // console.log(this.value);
            $.ajax({
                url: 'major.php',
                type: "POST",
                data: {
                    faculty_data: faculty_id
                },
                success: function(result) {
                    $('#major').html(result);
                    // console.log(result);
                }
            })
        });

        $('#province').on('change', function() {
            var province_id = this.value;
            // console.log(this.value);
            $.ajax({
                url: 'district.php',
                type: "POST",
                data: {
                    province_data: province_id
                },
                success: function(result) {
                    $('#district').html(result);
                    // console.log(result);
                }
            })
        });
        $('#district').on('change', function() {
            var district_id = this.value;
            console.log(this.value);
            $.ajax({
                url: 'commune.php',
                type: "POST",
                data: {
                    district_data: district_id
                },
                success: function(data) {
                    $('#commune').html(data);
                    // console.log(data);
                }
            })
        });
        $('#commune').on('change', function() {
            var commune_id = this.value;
            console.log(this.value);
            $.ajax({
                url: 'village.php',
                type: "POST",
                data: {
                    commune_data: commune_id
                },
                success: function(data) {
                    $('#village').html(data);
                    // console.log(data);
                }
            })
        });


        $('#provinceOfHighSchool').on('change', function() {
            var provinceOfHighSchool_id = this.value;
            // console.log(this.value);
            $.ajax({
                url: 'districtOfHighSchool.php',
                type: "POST",
                data: {
                    provinceOfHighSchool_data: provinceOfHighSchool_id
                },
                success: function(result) {
                    $('#districtOfHighSchool').html(result);
                    // console.log(result);
                }
            })
            $.ajax({
                url: 'HighSchoolWhereProvinve.php',
                type: "POST",
                data: {
                    provinceOfHighSchool_data: provinceOfHighSchool_id
                },
                success: function(result) {
                    $('#HighSchool').html(result);
                    // console.log(result);
                }
            })
        });
        $('#districtOfHighSchool').on('change', function() {
            var districtOfHighSchool_id = this.value;
            $.ajax({
                url: 'HighSchool.php',
                type: "POST",
                data: {
                    districtOfHighSchool_data: districtOfHighSchool_id
                },
                success: function(result) {
                    $('#HighSchool').html(result);
                    // console.log(result);
                }
            })
        });
    </script>
    <!-- <script>
        function toggleDropdown() {
            const dropdownMenu = document.getElementById('dropdown-menu');
            dropdownMenu.classList.toggle('hidden');
        }
    </script> -->


</body>

</html>