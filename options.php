<?php
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
include('db.php');
$added = false;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Admin Dashboard | Korsat X Parmaga</title>
    <!-- ======= Styles ====== -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="assets/css/style.css">
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
            <div class="container mx-auto px-4 py-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 ">
                    <div class="bg-blue-500 text-white p-4  rounded" style="height:8rem;">
                        <span style="font-size: 1.5rem;"> <ion-icon name="log-out-outline"></ion-icon> Total Students: 
                        <?php
                        $sql = "SELECT count(*) FROM `tblregistration`";
                        $result = mysqli_query($conn, $sql);
                        if ($result) {
                            $row = mysqli_fetch_array($result);
                            $count = $row[0]; // The count value is in the first column of the result row
                    
                            echo "Count: " . $count;
                        } else {
                            echo "Error executing the query: " . mysqli_error($conn);
                        }
                        ?>
                    </span>

                    </div>
                    <div class="bg-green-500 text-white p-4 rounded" style="height:8rem;">
                        <!-- <p>Students News Registration</p> -->
                        <span style="font-size: 1.5rem;"> <ion-icon name="pencil-outline" ></ion-icon> News Registration:</span>
                    </div>
                    <div class="bg-yellow-500 text-white p-4 rounded" style="height:8rem;">
                        <!-- <p>Faculties</p> -->
                        <span style="font-size: 1.5rem;"> <ion-icon name="school"></ion-icon> Faculties:
                        <?php
                        $sql = "SELECT count(*) FROM `tblfaculty`";
                        $result = mysqli_query($conn, $sql);
                        if ($result) {
                            $row = mysqli_fetch_array($result);
                            $count = $row[0]; // The count value is in the first column of the result row
                    
                            echo "Count: " . $count;
                        } else {
                            echo "Error executing the query: " . mysqli_error($conn);
                        }
                        ?>
                    </span>
                    </div>
                    <div class="bg-red-500 text-white p-4 rounded" style="height:8rem;">
                           <!-- <p>Faculties</p> -->
                           <span style="font-size: 1.5rem;"> <ion-icon name="school"></ion-icon> Major:
                        <?php
                        $sql = "SELECT count(*) FROM `tblmajor`";
                        $result = mysqli_query($conn, $sql);
                        if ($result) {
                            $row = mysqli_fetch_array($result);
                            $count = $row[0]; // The count value is in the first column of the result row
                    
                            echo "Count: " . $count;
                        } else {
                            echo "Error executing the query: " . mysqli_error($conn);
                        }
                        ?>
                    </span>
                    
                    </div>
                </div>
            </div>

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
            <!-- <a href="tblsex.php">
                <button style="margin-left: 1.5rem; transition:0.5s;" class="bg-gradient-to-r from-purple-400 to-blue-500 hover:from-pink-500 hover:to-yellow-500 text-white font-bold py-2 px-4 rounded-full">
                    Tbl Sex
                </button>
            </a>
            <button class="px-4 py-2 text-white font-semibold bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg shadow-md hover:shadow-xl hover:from-indigo-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                Click me
            </button> -->
            <!-- Button to open the modal -->
            

            <!-- Modal component -->
            
            <div class="container mx-auto px-4 py-12">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                    <!-- Button 1 -->
                    <a href="tblsex.php" class="col-span-1">
                        <button class="w-full px-4 py-2 text-white font-semibold bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg shadow-md hover:shadow-xl hover:from-indigo-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                            Insert Sex
                        </button>
                    </a>
                    <!-- Button 2 -->
                    <a href="tblnationality.php" class="col-span-1">
                        <button class="w-full px-4 py-2 font-semibold text-indigo-600 bg-white border border-indigo-600 rounded-lg hover:bg-indigo-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                            Insert Nationality
                        </button>
                    </a>

                    <!-- Button 3 -->
                    <a href="tblacademicinformation.php" class="col-span-1">
                        <button class="w-full px-4 py-2 text-white font-semibold bg-green-500 rounded-lg shadow-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                            Insert Academic Information
                        </button>
                    </a>

                    <!-- Button 4 -->
                    <a href="tblhighschool.php" class="col-span-1">
                        <button class="w-full px-4 py-2 font-semibold text-red-600 bg-white border border-red-600 rounded-lg hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                            Insert Highschool
                        </button>
                    </a>

                    <!-- Button 5 -->
                    <a href="tbltransfer.php" class="col-span-1">
                        <button class="w-full px-4 py-2 text-white font-semibold bg-yellow-500 rounded-lg shadow-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50">
                            Insert Tranfered
                        </button>
                    </a>

                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 mt-5">
                    <!-- Button 1 -->
                    <a href="tblstudentstatus.php" class="col-span-1">
                        <button class="w-full px-4 py-2 text-white font-semibold bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg shadow-md hover:shadow-xl hover:from-indigo-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                            Insert Student Status
                        </button>
                    </a>

                    <!-- Button 2 -->
                    <a href="tblacademicprogram.php" class="col-span-1">
                        <button class="w-full px-4 py-2 font-semibold text-indigo-600 bg-white border border-indigo-600 rounded-lg hover:bg-indigo-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                            Insert Academic Program
                        </button>
                    </a>

                    <!-- Button 3 -->
                    <a href="tblacademicinformation.php" class="col-span-1">
                        <button class="w-full px-4 py-2 text-white font-semibold bg-green-500 rounded-lg shadow-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                            Insert Academic Information
                        </button>
                    </a>

                    <!-- Button 4 -->
                    <a href="tblhighschool.php" class="col-span-1">
                        <button class="w-full px-4 py-2 font-semibold text-red-600 bg-white border border-red-600 rounded-lg hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                            Insert Highschool
                        </button>
                    </a>

                    <!-- Button 5 -->
                    <a href="£" class="col-span-1">
                        <button class="w-full px-4 py-2 text-white font-semibold bg-yellow-500 rounded-lg shadow-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50">
                            Insert Transfer
                        </button>
                    </a>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">

                
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 mt-5">
                    <!-- Button 1 -->
                    <a href="tblstudentstatus.php" class="col-span-1">
                        <button class="w-full px-4 py-2 text-white font-semibold bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg shadow-md hover:shadow-xl hover:from-indigo-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                            Insert Student Status
                        </button>
                    </a>

                    <!-- Button 2 -->
                    <a href="tblacademicprogram.php" class="col-span-1">
                        <button class="w-full px-4 py-2 font-semibold text-indigo-600 bg-white border border-indigo-600 rounded-lg hover:bg-indigo-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                            Insert Academic Program
                        </button>
                    </a>

                    <!-- Button 3 -->
                    <a href="tblcampus.php" class="col-span-1">
                        <button class="w-full px-4 py-2 text-white font-semibold bg-green-500 rounded-lg shadow-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                            Insert Campus
                        </button>
                    </a>

                    <!-- Button 4 -->
                    <a href="tblbatch.php" class="col-span-1">
                        <button class="w-full px-4 py-2 font-semibold text-red-600 bg-white border border-red-600 rounded-lg hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                            Insert Batch
                        </button>
                    </a>

                    <!-- Button 5 -->
                    <a href="tblyear.php" class="col-span-1">
                        <button class="w-full px-4 py-2 text-white font-semibold bg-yellow-500 rounded-lg shadow-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50">
                           Insert Year
                        </button>
                    </a>
                    <a href="tblprogram.php" class="col-span-1">
                        <button class="w-full px-4 py-2 text-white font-semibold bg-yellow-500 rounded-lg shadow-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50">
                           Insert Program
                        </button>
                    </a>
                    <a href="tbldegree.php" class="col-span-1">
                        <button class="w-full px-4 py-2 text-white font-semibold bg-yellow-500 rounded-lg shadow-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50">
                           Insert Degree
                        </button>
                    </a>
                    <a href="tblfaculty.php" class="col-span-1">
                        <button class="w-full px-4 py-2 text-white font-semibold bg-yellow-500 rounded-lg shadow-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50">
                           Insert Faculty
                        </button>
                    </a>
                    <a href="tblmajor.php" class="col-span-1">
                        <button class="w-full px-4 py-2 text-white font-semibold bg-yellow-500 rounded-lg shadow-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50">
                           Insert Major
                        </button>
                    </a>
                    <a href="tblsemester.php" class="col-span-1">
                        <button class="w-full px-4 py-2 text-white font-semibold bg-yellow-500 rounded-lg shadow-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50">
                           Insert Semester
                        </button>
                    </a>
                    <a href="tblshift.php" class="col-span-1">
                        <button class="w-full px-4 py-2 text-white font-semibold bg-yellow-500 rounded-lg shadow-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50">
                           Insert Shift
                        </button>
                    </a>
                    <a href="tblenrollmenttest.php" class="col-span-1">
                        <button class="w-full px-4 py-2 text-white font-semibold bg-yellow-500 rounded-lg shadow-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50">
                           Insert Enrollment Test
                        </button>
                    </a>
                    <a href="tbltuitionfee.php" class="col-span-1">
                        <button class="w-full px-4 py-2 text-white font-semibold bg-yellow-500 rounded-lg shadow-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50">
                           Insert Tuition Fee
                        </button>
                    </a>
                    <a href="tblscholarship.php" class="col-span-1">
                        <button class="w-full px-4 py-2 text-white font-semibold bg-yellow-500 rounded-lg shadow-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50">
                           Insert Scholarship
                        </button>
                    </a>
                    <a href="tblprovider.php" class="col-span-1">
                        <button class="w-full px-4 py-2 text-white font-semibold bg-yellow-500 rounded-lg shadow-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50">
                           Insert Provider
                        </button>
                    </a>
                    <a href="tblattacheddocument.php" class="col-span-1">
                        <button class="w-full px-4 py-2 text-white font-semibold bg-yellow-500 rounded-lg shadow-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50">
                           Insert Attached Document
                        </button>
                    </a>
                    <a href="tbltestresult.php" class="col-span-1">
                        <button class="w-full px-4 py-2 text-white font-semibold bg-yellow-500 rounded-lg shadow-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50">
                           Insert Test Result
                        </button>
                    </a>
                    <a href="tbladdress.php" class="col-span-1">
                        <button class="w-full px-4 py-2 text-white font-semibold bg-yellow-500 rounded-lg shadow-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50">
                           Insert Address
                        </button>
                    </a>
                    <a href="tbladdresstype.php" class="col-span-1">
                        <button class="w-full px-4 py-2 text-white font-semibold bg-yellow-500 rounded-lg shadow-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50">
                           Insert Address Type
                        </button>
                    </a>
                </div>
            </div>



            <!-- Button to trigger SweetAlert -->
            <!-- <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="showForm()">
            Show Form
        </button> -->


        </div>

    </div>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.15/tailwind.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.js"></script>
    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script>
        function toggleDropdown() {
            const dropdownMenu = document.getElementById('dropdown-menu');
            dropdownMenu.classList.toggle('hidden');
        }
        
    </script>
    <!-- <script>
        function toggleDropdown() {
            const dropdownMenu = document.getElementById('dropdown-menu');
            dropdownMenu.classList.toggle('hidden');
        }
    </script> -->



</body>

</html>