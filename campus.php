<?php
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
include('db.php');
$province = "SELECT * FROM provinces";
$province_qry = mysqli_query($conn, $province);
$added = false;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <!-- ======= Styles ====== -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .text-left {
            text-align: left !important;

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
                    <a href="Report.php">
                        <span class="icon">
                        <i class="fa-solid fa-file-signature text-2xl"></i>
                        </span>
                        <span class="title">Report</span>
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



            <style>
                .card:hover .card-title {
                    opacity: 1;
                }

                .card:hover .facultie {
                    display: none;
                }
            </style>
            <div class="w-full text-center py-4">
                <h1 class="text-4xl font-bold text-blue-600 tracking-wide">2 Campus
                    <span class="icon">
                        <ion-icon name="business-outline"></ion-icon>
                    </span>
                </h1>
            </div>

            <div class="container mx-auto px-4 py-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="card bg-white shadow-lg rounded-lg overflow-hidden">
                        <div class="relative">
                            <img src="https://beltei-international-education.netlify.app/assets/images/campus-1.jpg" alt="Placeholder Image" class="w-full h-90">
                            <div class="absolute bottom-0 left-0 mb-4 ml-4 bg-blue-600 text-white py-1 px-3 rounded-tr rounded-br">
                               <a href="#">
                               View
                               </a>
                            </div>
                        </div>
                        <div class="p-4">
                            <h2 class="text-2xl font-bold mb-4">BELTEI International University Campus 1 (Toul Sleng)</h2>
                            <!-- <p class="text-gray-600">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris lacinia velit quis sem dignissim porta.</p> -->
                        </div>
                    </div>
                    <div class="card bg-white shadow-lg rounded-lg overflow-hidden">
                        <div class="relative">
                            <img src="https://beltei-international-education.netlify.app/assets/images/campus-2.jpg" alt="Placeholder Image" class="w-full h-90 ">
                            <div class="absolute bottom-0 left-0 mb-4 ml-4 bg-blue-600 text-white py-1 px-3 rounded-tr rounded-br">
                               <a href="#">
                               View
                               </a>
                            </div>
                        </div>
                        <div class="p-4">
                            <h2 class="text-2xl font-bold mb-4">BELTEI International University Campus 2 (Chaom Chao) </h2>
                            <!-- <p class="text-gray-600">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris lacinia velit quis sem dignissim porta.</p> -->
                        </div>
                    </div>

                    
                </div>
            </div>

        </div>
    </div>


    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>