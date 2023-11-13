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
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Caprasimo&family=Koulen&family=Noto+Sans+Khmer:wght@800&family=Oswald:wght@500&family=Secular+One&family=Signika:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                <h1 class="text-4xl font-bold text-blue-600 tracking-wide">Professor
                    <span class="icon">
                        <i class="fa-solid fa-chalkboard-user text-3xl"></i>
                    </span>
                </h1>
            </div>



            <div class="container mx-auto px-4 py-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="card bg-white shadow-lg rounded-lg overflow-hidden">
                        <div class="relative">
                            <img src="./assets/imgs/Dean.PNG" alt="Placeholder Image" class="w-full h-64 object-cover" style="height: 35rem;">
                            <div class="absolute bottom-0 left-0 mb-4 ml-4 bg-blue-600 text-white py-1 px-3 rounded-tr rounded-br">
                                <a href="#">
                                    View
                                </a>
                            </div>
                        </div>
                        <div class="p-4 ">
                            <h2 class="text-2xl font-bold mb-4 text-center">Oem Chanthorn <br> Dean of Faculty Informatin Technology and Science</h2>
                            <!-- <p class="text-gray-600">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris lacinia velit quis sem dignissim porta.</p> -->
                        </div>
                    </div>
                    <div class="card bg-white shadow-lg rounded-lg overflow-hidden">
                        <div class="relative">
                            <img src="./assets/imgs/cher.PNG" alt="Placeholder Image" class="w-full h-64 object-cover" style="height: 35rem;">
                            <div class="absolute bottom-0 left-0 mb-4 ml-4 bg-blue-600 text-white py-1 px-3 rounded-tr rounded-br">
                                <a href="#">
                                    View
                                </a>
                            </div>
                        </div>
                        <div class="p-4">
                            <h2 class="text-2xl font-bold mb-4 text-center">Keo Tongheng <br> Lecturer teach in Professional Web Development </h2>
                           
                            <!-- <p class="text-gray-600">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris lacinia velit quis sem dignissim porta.</p> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full text-center py-4">
                <h1 class="text-4xl font-bold text-blue-600 tracking-wide">Acknowledgement
                    <span class="icon">
                        <i class="fa-solid fa-chalkboard-user text-3xl"></i>
                    </span>
                </h1>
            </div>
            <div class="container" style="width: 90%; margin:auto;">
                <p style="text-align: center; text-align:justify; font-family:'Noto Sans Khmer'; font-size:1.7rem;" >សូមស្វាគមន៍មិត្តៗនិស្សិត ប្រិយមិត្ត អ្នកសិក្សាស្រាវជ្រាវ និងអ្នកដែលចង់ស្វែងយល់នូវគំនិតថ្មីៗទាក់ទងនិង Project ផ្សេងៗជាទីរាប់អាន ពួកយើងជានិសិ្សតសិក្សានៅសាកលវិទ្យាល័យ ប៊ែលធី អន្តរជាតិ ឆ្នាំទី២ ឆមាសទី ២ ជំនាញ (Software Engineering) នៃមហាវិទ្យាល័យ ព័ត៌មានវិទ្យា និង វិទ្យាសាស្រ្ត។ ពួកយើងមានសេចក្ដីសប្បាយ រីករាយណាស់ ចំពោះការដាក់កិច្ចការ (Project) របស់លោកសាស្ត្រាចារ្យ កែវ តុងហេង ដែលទាក់ទងទៅនិង ប្រព័ន្ធសម្រាប់ធ្វើការគ្រប់គ្រង និស្សិតដែលជំពាក់ការសិក្សា ព្រោះវាជាកិច្ចការមួយដ៏ល្អដែលបានផ្តលនូវឱកាសអោយពួកយើង បានពង្រីកចំណេះដឹង ការស្រាវជ្រាវថ្មីៗ និងបទពិសោធន៍ថ្មីៗដែលអាចអោយពួកយើងយកទៅប្រើប្រាស់ទៅថ្ងៃក្រោយបានទៀតផង។ ហើយនេះគឺជាProjectដែលពួកយើងបានបង្កើតឡើងដោយជោគជ័យ ក៏ដូចជាបានចងគ្រងទុកជាស្នាដៃ សម្រាប់និស្សិតជំនាន់ក្រោយ ដើម្បីផ្តល់ជាគំនិតក្នុងការធ្វើកិច្ចការមួយនេះ យើងខ្ញុំសង្ឃឹមថា Project នេះវាជាមូលដ្ឋានមួយសម្រាប់និស្សិតជំនាន់ក្រោយទាំងអស់អាចយកទៅសិក្សាបន្ថែម ក័ដូចជាផ្តល់នូវ គំនិតថ្មីៗផងដែរ​ ។ ជាចុងក្រោយពួកយើង សូមថ្លែងអំណរគុណយ៉ាងជ្រាលជ្រៅទៅដល់ ព្រិទ្ធបុរស អ៊ឹម ចាន់ថន ដែលជាព្រិទ្ធបុរសនៃមហាវិទ្យាល័យ ព័ត៌មានវិទ្យា និង វិទ្យាសាស្រ្ត ក៏ដូចជា​​ លោកសាស្រ្តាចារ្យ កែវ តុងហេង ដែលបានខិតខំប្រឺងប្រែងបង្រៀន​ ទូន្មាន ប្រៀនប្រដៅ និងនាំផ្លូវអោយនិស្សិតទាំងអស់បានទៅដល់គោលដៅផងដែរ។ ជាថ្មីម្តងទៀត ពួកយើងនិងនៅរង់ចាំទទួលការរិះគន់ពីសំណាក់មិត្តអ្នកអាន អ្នកស្រាវជ្រាវ លោកគ្រូ សាស្ត្រាចារ្យ មិត្តរួមជំនាន់ និងប្អូនៗជំនាន់ក្រោយ រាល់កំហុសឆ្គងដែលកើតឡើងដោយអចេតនា និងចំណុចដែលខ្វះខាត ដើម្បីជួយកែលំអរឲ្យ Project នេះកាន់ល្អ និងមានភាពងាយស្រួលក្នុងការប្រើប្រាស់​ ហើយក៏សូមជូនពរ ព្រិទ្ធបុរស អ៊ឹម ចាន់ថន ក៏ដូចជា​​ លោកសាស្រ្តាចារ្យ កែវ តុងហេង អ្នកស្រាវជ្រាវ លោកគ្រូ សាស្ត្រាចារ្យ មិត្តរួមជំនាន់ ប្អូនៗជំនាន់ក្រោយ និងនិស្សិតទាំងអស់ ទទួលបាននូវ ពរទាំងឡាយបួនប្រការ សម្បត្តិបី អរីយទ្រព្យប្រាំពីរ និងមានសេចក្តីសុខ សំណាង ល្អគ្រប់ពេលវេលា ជោគជ័យលើការសិក្សា និងជោគជ័យនូវគោលបំណងដែលប៉ងគ្រប់ៗគ្នា។</p>
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