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
                <h1 class="text-4xl font-bold text-blue-600 tracking-wide">12 Faculties
                     <span class="icon">
                        <ion-icon name="school"></ion-icon>
                    </span>
                </h1>
            </div>
            <div class="container mx-auto px-4 py-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="card bg-white shadow-md rounded p-4 relative overflow-hidden">
                        <div class="mb-4">
                            <img src="https://beltei-international-education.netlify.app/assets/images/products/jacket-3.jpg" alt="Placeholder Image" class="w-full h-78  rounded">
                        </div>
                        <div class="card-title  text-center absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white text-xl font-bold opacity-0 transition-opacity duration-300 ease-in-out">
                            Faculty of Business Admenistration
                        </div>
                        <h1 class="facultie">Faculty of Business Admenistration</h1>
                    </div>
                    <div class="card bg-white shadow-md rounded p-4 relative overflow-hidden">
                        <div class="mb-4">
                            <img src="https://beltei-international-education.netlify.app/assets/images/Finance01.jpg" alt="Placeholder Image" class="w-full h-78  rounded">
                        </div>
                        <div class="card-title  text-center absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white text-xl font-bold opacity-0 transition-opacity duration-300 ease-in-out">
                           Faculty of Finace and Banking
                        </div>
                        <h1 class="facultie">Faculty of Finace and Banking</h1>
                    </div>
                    <div class="card bg-white shadow-md rounded p-4 relative overflow-hidden">
                        <div class="mb-4">
                            <img src="https://beltei-international-education.netlify.app/assets/images/products/jacket-5.jpg" alt="Placeholder Image" class="w-full h-78  rounded">
                        </div>
                        <div class="card-title  text-center absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white text-xl font-bold opacity-0 transition-opacity duration-300 ease-in-out">
                           Faculty of Economics
                        </div>
                        <h1 class="facultie"> Faculty of Economics</h1>
                    </div>
                    <div class="card bg-white shadow-md rounded p-4 relative overflow-hidden">
                        <div class="mb-4">
                            <img src="https://beltei-international-education.netlify.app/assets/images/products/law-1.jpg" alt="Placeholder Image" class="w-full h-78  rounded">
                        </div>
                        <div class="card-title  text-center absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white text-xl font-bold opacity-0 transition-opacity duration-300 ease-in-out">
                            Faclty of Law
                        </div>
                        <h1 class="facultie">Faclty of Law</h1>
                    </div>

                    <!-- Repeat the card markup for the remaining 3 cards -->
                </div>
            </div>
            <div class="container mx-auto px-4 py-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="card bg-white shadow-md rounded p-4 relative overflow-hidden">
                        <div class="mb-4">
                            <img src="https://beltei-international-education.netlify.app/assets/images/products/education-1.jpg" alt="Placeholder Image" class="w-full h-78  rounded">
                        </div>
                        <div class="card-title  text-center absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white text-xl font-bold opacity-0 transition-opacity duration-300 ease-in-out">
                            Faculty of Education Arts and Humanities
                        </div>
                        <h1 class="facultie">  Faculty of Education Arts and Humanities</h1>
                    </div>
                    <div class="card bg-white shadow-md rounded p-4 relative overflow-hidden">
                        <div class="mb-4">
                            <img src="https://beltei-international-education.netlify.app/assets/images/products/tourism-1.jpg" alt="Placeholder Image" class="w-full h-78  rounded">
                        </div>
                        <div class="card-title  text-center absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white text-xl font-bold opacity-0 transition-opacity duration-300 ease-in-out">
                            Faculty of Tourism and Hospitality
                        </div>
                        <h1 class="facultie"> Faculty of Tourism and Hospitality</h1>
                    </div>
                    <div class="card bg-white shadow-md rounded p-4 relative overflow-hidden">
                        <div class="mb-4">
                            <img src="https://beltei-international-education.netlify.app/assets/images/products/information-1.jpg" alt="Placeholder Image" class="w-full h-78  rounded">
                        </div>
                        <div class="card-title  text-center text-center absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white text-xl font-bold opacity-0 transition-opacity duration-300 ease-in-out">
                            Faculty of Information Technology and Science
                        </div>
                        <h1 class="facultie"> Faculty of Information Technology and Science</h1>
                    </div>
                    <div class="card bg-white shadow-md rounded p-4 relative overflow-hidden">
                        <div class="mb-4">
                            <img src="https://beltei-international-education.netlify.app/assets/images/products/digital-1.jpg" alt="Placeholder Image" class="w-full h-78  rounded">
                        </div>
                        <div class="card-title  text-center absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white text-xl font-bold opacity-0 transition-opacity duration-300 ease-in-out">
                            Faculty of Digital Technology and Telecommunication
                        </div>
                        <h1 class="facultie">Faculty of Digital Technology and Telecommunication</h1>
                    </div>

                    <!-- Repeat the card markup for the remaining 3 cards -->
                </div>
            </div>
            <div class="container mx-auto px-4 py-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="card bg-white shadow-md rounded p-4 relative overflow-hidden">
                        <div class="mb-4">
                            <img src="https://beltei-international-education.netlify.app/assets/images/products/engineering-1.jpg" alt="Placeholder Image" class="w-full h-78  rounded">
                        </div>
                        <div class="card-title  text-center absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white text-xl font-bold opacity-0 transition-opacity duration-300 ease-in-out">
                            Faculty of Engineering
                        </div>
                        <h1 class="facultie">  Faculty of Engineering</h1>
                    </div>
                    <div class="card bg-white shadow-md rounded p-4 relative overflow-hidden">
                        <div class="mb-4">
                            <img src="https://beltei-international-education.netlify.app/assets/images/products/archotecture-1.jpg" alt="Placeholder Image" class="w-full h-78  rounded">
                        </div>
                        <div class="card-title  text-center absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white text-xl font-bold opacity-0 transition-opacity duration-300 ease-in-out">
                           Faculty of Architecture
                        </div>
                        <h1 class="facultie"> Faculty of Architecture</h1>
                    </div>
                    <div class="card bg-white shadow-md rounded p-4 relative overflow-hidden">
                        <div class="mb-4">
                            <img src="https://beltei-international-education.netlify.app/assets/images/products/relation-1.jpg" alt="Placeholder Image" class="w-full h-78  rounded">
                        </div>
                        <div class="card-title  text-center absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white text-xl font-bold opacity-0 transition-opacity duration-300 ease-in-out">
                            Faculty of International Relations
                        </div>
                        <h1 class="facultie"> Faculty of International Relations</h1>
                    </div>
                    <div class="card bg-white shadow-md rounded p-4 relative overflow-hidden">
                        <div class="mb-4">
                            <img src="https://beltei-international-education.netlify.app/assets/images/products/civil-1.jpg" alt="Placeholder Image" class="w-full h-78  rounded">
                        </div>
                        <div class="card-title text-center absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white text-xl font-bold opacity-0 transition-opacity duration-300 ease-in-out">
                            Faculty of Civil Aviation
                        </div>
                        <h1 class="facultie">  Faculty of Civil Aviation</h1>
                    </div>

                    <!-- Repeat the card markup for the remaining 3 cards -->
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