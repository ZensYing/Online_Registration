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
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                <h1 class="text-4xl font-bold text-blue-600 tracking-wide">Students Registration Report
                    <span class="icon">
                        <i class="fa-solid fa-graduation-cap text-4xl"></i>
                    </span>
                </h1>
            </div>
            <?php
            // Include the database connection code
            include('db.php');

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
            INNER JOIN tblmajor ON tblregistration.MajorID = tblmajor.MajorID ORDER BY RegisterDate desc";
            $sql = mysqli_query($conn, $query);
            ?>
            <div class="flex flex-col md:flex-row gap-4 w-full md:w-3/4 lg:w-1/2 xl:w-1/3 m-auto"  >
                <div class="w-full md:w-1/2">
                    <label class="block mb-1" for="start_date">Start Date:</label>
                    <div class="relative max-w-sm">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                            </svg>
                        </div>
                        <input type="date" name="From" id="From" datepicker type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
                    </div>
                </div>

                <div class="w-full md:w-1/2">
                    <label class="block mb-1" for="end_date">End Date:</label>
                    <div class="relative max-w-sm">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                            </svg>
                        </div>
                        <input type="date" name="to" id="to" datepicker type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
                    </div>
                </div>
            </div>

            
            <div class="flex flex-col md:flex-row gap-4 m-auto" style="width: 50%; background-color:white;  padding:20px;">
                <div class="w-full md:w-1/3">
                    <div class="mb-4">
                        <label for="HighSchool" class="block text-gray-700 font-bold mb-2">Select HighSchool</label>
                        <select id="HighSchool"  name="FromHighSchool" class="bg-white border border-3 border-indigo-500 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <!-- <option value="">Select HighSchool</option> -->
                            <!-- <option value="">Select HighSchool</option> -->
                            <?php
                            $HighSchool = "SELECT * FROM tblhighschool";

                            $HighSchool_qry = mysqli_query($conn, $HighSchool);
                            // $output="";
                            $output = '<option value="">Select HighSchool</option>';
                            while ($HighSchool_row = mysqli_fetch_assoc($HighSchool_qry)) {
                                $output .= '<option value="' . $HighSchool_row['HighSchoolID'] . '">' . $HighSchool_row['HighSchoolName'] . '</option>';
                            }
                            echo $output;
                            ?>
                        </select>
                    </div>
                </div>
                <div class="w-full md:w-1/3">
                    <div class="mb-4">
                        <label for="faculty" class="block text-gray-700 font-bold mb-2">Select Faculty</label>
                        <select id="faculty" name="FacultyID" class="bg-white border border-3 border-indigo-500 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
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
                
                <div class="w-full md:w-1/3">
                    <div class="mb-4">
                        <label for="major" class="block text-gray-700 font-bold mb-2">Select Major</label>
                        <select id="major" name="MajorID" class="bg-white border border-3 border-indigo-500 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="">Select Major</option>

                        </select>
                    </div>
                </div>
            </div>

            <br>
            <div class="flex flex-col md:flex-row gap-4 w-1/2 " style=" margin:auto; display:flex; justify-content: center; align-items: center;">
                <button name="range" id="range" value="Range" class="bg-gradient-to-r bg-purple-500 hover:from-indigo-500 hover:to-purple-600 text-white font-semibold py-2 px-4 rounded-md shadow-md transition duration-300 ease-in-out">
                    Search <i class="fa-solid fa-magnifying-glass"></i>
                </button>
                <form method="post" action="export.php">
                    <button type="submit" name="export" class="bg-gradient-to-r  bg-purple-500 hover:from-indigo-500 hover:to-purple-600 text-white font-semibold py-2 px-4 rounded-md shadow-md transition duration-300 ease-in-out">
                        Export to excel <i class="fa-solid fa-file-export"></i>
                    </button>
                </form>
                <button onclick="window.print()" class="bg-gradient-to-r bg-purple-500 hover:from-indigo-500 hover:to-purple-600 text-white font-semibold py-2 px-4 rounded-md shadow-md transition duration-300 ease-in-out">
                    Print Report <i class="fa-solid fa-print"></i>
                </button>
            </div>


            <div class="flex flex-col " style="width: 95%; margin:auto;">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                        <div class="overflow-hidden">
                            <div class="" id="purchase_order">
                                <table class="min-w-full text-center text-sm font-light">
                                    <thead class="border-b bg-neutral-800 font-medium text-white dark:border-neutral-500 dark:bg-neutral-900">
                                        <tr>
                                            <th scope="col" class=" px-6 py-4">Student ID</th>
                                            <th scope="col" class=" px-6 py-4">Student Name(KH)</th>
                                            <th scope="col" class=" px-6 py-4">Student Name(EN)</th>
                                            <th scope="col" class=" px-6 py-4">Sex</th>
                                            <th scope="col" class=" px-6 py-4">From HighSchool</th>
                                            <th scope="col" class=" px-6 py-4"> Faculty</th>
                                            <th scope="col" class=" px-6 py-4"> Major</th>
                                            <th scope="col" class=" px-6 py-4">Register Date</th>
                                            <!-- <th scope="col" class=" px-6 py-4">Handle</th> -->
                                        </tr>
                                    </thead>
                                    <?php while ($row = mysqli_fetch_array($sql)) { ?>
                                        <tbody>

                                            <tr class="border-b dark:border-neutral-500">
                                                <td class="whitespace-nowrap  px-6 py-4"><?php echo $row['StudentID']; ?></td>
                                                <td class="whitespace-nowrap  px-6 py-4"><?php echo $row['NameInKhmer']; ?></td>
                                                <td class="whitespace-nowrap  px-6 py-4"><?php echo $row['NameInLatin']; ?></td>
                                                <td class="whitespace-nowrap  px-6 py-4"><?php echo $row['SexName']; ?></td>
                                                <td class="whitespace-nowrap  px-6 py-4"><?php echo $row['HighSchoolName']; ?></td>
                                                <td class="whitespace-nowrap  px-6 py-4"><?php echo $row['FacultyName']; ?></td>
                                                <td class="whitespace-nowrap  px-6 py-4"><?php echo $row['MajorName']; ?></td>
                                                <td class="whitespace-nowrap  px-6 py-4"><?php echo $row['RegisterDate']; ?></td>
                                            </tr>

                                        </tbody>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>
    <!-- Search date script -->
    <!-- ================================ -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
    <!-- ================================ -->
    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>

<script>
    $(document).ready(function() {
        // $.datepicker.setDefaults({
        //     dateFormat: 'yy-mm-dd'
        // });
        // $(function(){
        //     $("#From").datepicker();
        //     $("#to").datepicker();
        // });

        $('#range').click(function() {
            var From = $('#From').val();
            var to = $('#to').val();
            if (From != '' && to != '') {
                $.ajax({
                    url: "range.php",
                    method: "POST",
                    data: {
                        From: From,
                        to: to
                    },
                    success: function(data) {
                        $('#purchase_order').html(data);
                        $('#purchase_order').append(data.htmlresponse);
                    }
                });
            } else {
                alert("Please Select the Date");
            }
        });
    });
    $('#faculty').on('change', function() {
        var faculty_id = this.value;
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
</script>