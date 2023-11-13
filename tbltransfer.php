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
<?php

// insert data to tbl sex

if (isset($_POST['insert'])) {
    // $SexID = $_POST['SexID'];
    $StudentID = $_POST['StudentID'];
    $TransferedFromUniversity = $_POST['TransferedFromUniversity'];
    $TransferYearID = $_POST['TransferYearID'];


    $sql = "INSERT INTO `tbltransfer` (`StudentID`,`TransferedFromUniversity`,`TransferYearID`) VALUES ('$StudentID','$TransferedFromUniversity','$TransferYearID') ";

    if (mysqli_query($conn, $sql)) {
        echo '<script>
            Swal.fire({
              title: "Success!",
              text: "New record has been added successfully!",
              icon: "success",
              confirmButtonText: "OK"
            }).then(function() {
              window.location = "your_page.php";
            });
          </script>';
    } else {
        echo '<script>
            Swal.fire({
              title: "Error!",
              text: "Error adding new record: ' . mysqli_error($conn) . '",
              icon: "error",
              confirmButtonText: "OK"
            });
          </script>';
    }
}
if (isset($_POST['search'])){
    $TransferID = $_POST['TransferID'];
    $sql = "SELECT * from tbltransfer Where TransferID=$TransferID ";

    $query = mysqli_query($conn, $sql);
    while ($data = mysqli_fetch_array($query)) {
        header("location:tbltransfer.php?TransferID=" . $data['TransferID'] . "&StudentID=" . $data['StudentID']. "&TransferedFromUniversity=" . $data['TransferedFromUniversity']. "&TransferYearID=" . $data['TransferYearID']);
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

                <li>
                    <a href="PersonalInformation.php">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Insert Personal Information</span>
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
            <div class="cardBox">
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



            <!-- Button to trigger SweetAlert -->
            <!-- <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="showForm()">
            Show Form
        </button> -->
            <form action="tbltransfer.php" method="POST" class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md">
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="sex_id">
                    Transfer ID
                    </label>
                    <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="sex_id" name="TransferID" type="text" placeholder="Enter Transfer ID" value="<?php if (!empty($_GET)) echo $_GET['TransferID'] ?>">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="sex_name">
                    Student ID
                    </label>
                    <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="sex_name" name="StudentID" type="text" placeholder="Enter Student ID " value="<?php if (!empty($_GET)) echo $_GET['StudentID'] ?>">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="sex_id">
                    Transfered From University
                    </label>
                    <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="sex_id" name="TransferedFromUniversity" type="text" placeholder="Enter Transfered From University" value="<?php if (!empty($_GET)) echo $_GET['TransferedFromUniversity'] ?>">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="sex_id">
                    Transfer Year ID
                    </label>
                    <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="sex_id" name="TransferYearID" type="text" placeholder="Enter Transfer Year ID" value="<?php if (!empty($_GET)) echo $_GET['TransferYearID'] ?>">
                </div>
                <div class="flex items-center mx-3">
                        <button type="submit" name="insert" class="  bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Insert</button>
                        <button type="submit" name="search" class=" mx-3 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Search</button>
                        <button type="submit" name="update" class=" mx-3 bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update</button>
                        <button type="submit" name="delete" class=" mx-3 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Delete</button>
                    </div>
            </form>
        
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