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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@latest/dist/alpine.min.js" defer></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

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

                <li>
                    <a href="PersonalInformation.php">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Insert Personal Information</span>
                    </a>
                </li>
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
                    <div class="container w-full mx-auto px-4">
                        <div id="user-image-box" class="user-image-box bg-white shadow-lg rounded-lg p-1 md:p-2 lg:p-3 inline-block text-center cursor-pointer">
                            <img src="https://via.placeholder.com/80" alt="User Avatar" class="w-8 h-8 md:w-10 md:h-10 lg:w-12 lg:h-12 rounded-full border-2 border-blue-500">
                            <h2 class="text-xs md:text-sm lg:text-base font-bold">User Name</h2>
                            <p class="text-xs text-gray-600">@username</p>
                        </div>


                    </div>
                    <!-- <div class="container mx-auto px-4 py-8">
                        <div class="user-profile bg-white shadow-lg rounded-lg p-4 w-full md:w-1/2 lg:w-1/3 mx-auto">
                            <div class="flex items-center mb-4">
                                <img src="https://via.placeholder.com/80" alt="User Avatar" class="w-16 h-16 rounded-full border-2 border-blue-500">
                                <div class="ml-4">
                                    <h2 class="text-xl font-bold">User Name</h2>
                                    <p class="text-gray-600">@username</p>
                                </div>
                            </div>
                            <div class="text-center">
                                <button id="view-profile-btn" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">View Profile</button>
                            </div>
                        </div>
                        <div id="profile-details" class="bg-white shadow-lg rounded-lg p-4 w-full md:w-1/2 lg:w-1/3 mx-auto mt-4 hidden">
                            <h2 class="text-xl font-bold mb-4">Profile Details</h2>
                            <p><strong>Name:</strong> User Name</p>
                            <p><strong>Username:</strong> @username</p>
                            <p><strong>Email:</strong> user@example.com</p>

                            <button id="close-profile-btn" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded mt-4">Close</button>
                        </div>
                    </div>

                    <script>
                        const viewProfileBtn = document.getElementById('view-profile-btn');
                        const closeProfileBtn = document.getElementById('close-profile-btn');
                        const profileDetails = document.getElementById('profile-details');

                        viewProfileBtn.addEventListener('click', () => {
                            profileDetails.classList.remove('hidden');
                        });

                        closeProfileBtn.addEventListener('click', () => {
                            profileDetails.classList.add('hidden');
                        });
                    </script> -->
                </div>
            </div>
           
               
                    <div style="background-color: gray; color:white;" id="profile-details" class="bg-white shadow-lg rounded-lg p-4 w-full md:w-1/2 lg:w-1/3 float-right mt-4 hidden">
                        <img src="https://via.placeholder.com/80" alt="User Avatar" class="w-8 h-8 md:w-10 md:h-10 lg:w-12 lg:h-12 rounded-full border-2 border-blue-500">
                        <h2 class="text-xl font-bold mb-4">Profile Details</h2>
                        <p><strong>Name:</strong> User Name</p>
                        <p><strong>Username:</strong> @username</p>
                        <p><strong>Email:</strong> user@example.com</p>

                        <button id="close-profile-btn" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded mt-4">Close</button>
                    </div>
              
           

            <script>
                const userImageBox = document.getElementById('user-image-box');
                const closeProfileBtn = document.getElementById('close-profile-btn');
                const profileDetails = document.getElementById('profile-details');

                userImageBox.addEventListener('click', () => {
                    profileDetails.classList.remove('hidden');
                });

                closeProfileBtn.addEventListener('click', () => {
                    profileDetails.classList.add('hidden');
                });
            </script>

            <!-- ======================= Cards ================== -->
            <div class="container mx-auto px-4 py-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="bg-blue-500 text-white p-4 rounded">
                        <span style="font-size: 1.5rem;"> <ion-icon name="log-out-outline"></ion-icon> Total Students:</span>

                    </div>
                    <div class="bg-green-500 text-white p-4 rounded">
                        <!-- <p>Students News Registration</p> -->
                        <span style="font-size: 1.5rem;"> <ion-icon name="pencil-outline"></ion-icon> News Registration:</span>
                    </div>
                    <div class="bg-yellow-500 text-white p-4 rounded">
                        <!-- <p>Faculties</p> -->
                        <span style="font-size: 1.5rem;"> <ion-icon name="school"></ion-icon> Faculties:</span>
                    </div>
                    <div class="bg-red-500 text-white p-4 rounded">
                        <p>.....</p>
                    </div>
                </div>
            </div>
            <div class="container mx-auto px-4 py-8">
                <div class="bg-gray-500 text-center text-white p-4 rounded w-full">
                    <p class="text-2xl sm:text-3xl md:text-4xl lg:text-2xl">
                        Choose Province <ion-icon name="location-outline"></ion-icon>
                    </p>
                </div>
            </div>
            <div class="container mx-auto px-4 py-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="bg-red-900 text-white p-4 rounded">
                        <label for="province" class="block mb-2 font-medium text-white-500 text-2xl"> <ion-icon name="location-outline"></ion-icon> Province</label>
                        <div class="relative">
                            <select id="province" name="province" class="block w-full py-2 pl-3 pr-10 text-gray-700 bg-white border border-gray-300 rounded-lg appearance-none focus:outline-none focus:border-indigo-500">
                                <option selected disabled>Select Province</option>
                                <?php while ($row = mysqli_fetch_assoc($province_qry)) : ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['khmer_name']; ?></option>
                                <?php endwhile; ?>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                <svg class="w-4 h-4 fill-current text-gray-500" viewBox="0 0 20 20">
                                    <path d="M10 12l-6-6h12l-6 6z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="bg-green-900 text-white p-4 rounded">
                        <label for="district" class="block mb-2 font-medium text-white-500 text-2xl"><ion-icon name="location-outline"></ion-icon> District</label>
                        <div class="relative">
                            <select id="district" name="district" class="block w-full py-2 pl-3 pr-10 text-gray-700 bg-white border border-gray-300 rounded-lg appearance-none focus:outline-none focus:border-indigo-500">
                                <option value="">Select District</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                <svg class="w-4 h-4 fill-current text-gray-500" viewBox="0 0 20 20">
                                    <path d="M10 12l-6-6h12l-6 6z" />
                                </svg>
                            </div>
                        </div>

                    </div>
                    <div class="bg-yellow-900 text-white p-4 rounded">
                        <label for="commune" class="block mb-2 font-medium text-white-500 text-2xl"><ion-icon name="location-outline"></ion-icon> Commune</label>
                        <div class="relative">
                            <select id="commune" name="commune" class="block w-full py-2 pl-3 pr-10 text-gray-700 bg-white border border-gray-300 rounded-lg appearance-none focus:outline-none focus:border-indigo-500">
                                <option value="">Select Commune</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                <svg class="w-4 h-4 fill-current text-gray-500" viewBox="0 0 20 20">
                                    <path d="M10 12l-6-6h12l-6 6z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="bg-red-700 text-white p-4 rounded">
                        <label for="village" class="block mb-2 font-medium text-white-500 text-2xl"><ion-icon name="location-outline"></ion-icon> Village</label>
                        <div class="relative">
                            <select id="village" name="village" class="block w-full py-2 pl-3 pr-10 text-gray-700 bg-white border border-gray-300 rounded-lg appearance-none focus:outline-none focus:border-indigo-500">
                                <option value="">Select Village</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                <svg class="w-4 h-4 fill-current text-gray-500" viewBox="0 0 20 20">
                                    <path d="M10 12l-6-6h12l-6 6z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="cardBox ">
                <div class="card">

                  

                </div>

                <div class="card">

                  
                </div>

                <div class="card">

                    

                </div>

                <div class="card">

                   

                </div>
            </div> -->


            
            <div class=" container overflow-x-auto mx-auto ">
                <h1 class="font-bold text-indigo-600 text-center text-4xl mt-4"> Student Registration <ion-icon name="people-outline" class="text-4xl"></ion-icon></h1>
                <br>
                <!-- <label>Search:<input type="search" class="" placeholder="" aria-controls="myTable"></label> -->
                <table class="table-auto min-w-full divide-y divide-gray-200" id="myTable">
                    <thead class="bg-red-900 ">
                        <tr>
                            <th scope="col" class="px-6  py-3 text-left  text-xs font-medium text-white uppercase tracking-wider">Student ID</th>
                            <th scope="col" class="px-6 py-3 text-left  text-xs font-medium text-white uppercase tracking-wider">Student Name (khmer)</th>
                            <th scope="col" class="px-6 py-3 text-left  text-xs font-medium text-white uppercase tracking-wider">Student Name (English)</th>
                            <th scope="col" class="px-6 py-3 text-left  text-xs font-medium text-white uppercase tracking-wider">Sex</th>
                            <th scope="col" class="px-6 py-3 text-left  text-xs font-medium text-white uppercase tracking-wider">Nationality</th>
                            <th scope="col" class="px-6 py-3 text-left  text-xs font-medium text-white uppercase tracking-wider">Photo</th>
                            <th scope="col" class="px-6 py-3 text-left  text-xs font-medium text-white uppercase tracking-wider">Register Date</th>
                            <th scope="col" class="px-6 py-3 text-left  text-xs font-medium text-white uppercase tracking-wider">See More</th>

                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php

                        $sql = "SELECT * FROM `tblpersonalinformation`";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_array($result)) {
                            $id = $row['StudentID'];
                            $nameKh = $row['StudentNameKH'];
                            $nameEn = $row['StudentNameEN'];
                            $sex = $row['SexID'];
                            $NationalityID = $row['NationalityID'];
                            $photo = $row['Photo'];
                            $registerDate = $row['RegisterDate'];
                            $dob = $row['DOB'];
                            $pob = $row['POB'];
                            $phone1 = $row['PhoneNumber1'];
                            $phone2 = $row['PhoneNumber2'];
                            $telegram = $row['TelegramNumber'];
                            $email = $row['Email'];


                        ?>

                            <tr>

                                <td class="px-6 text-left  py-4 whitespace-nowrap"><?php echo $id; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo $nameKh; ?></td>
                                <td class="px-6 text-center  py-4 whitespace-nowrap"><?php echo $nameEn; ?></td>
                                <td class="px-6 text-left  py-4 whitespace-nowrap"><?php echo $sex; ?></td>
                                <td class="px-6  text-left py-4 whitespace-nowrap"><?php echo $NationalityID; ?></td>
                                <td class="px-6 text-left  py-4 whitespace-nowrap"><img src="studentinfo/<?= $row['Photo'] ?>" class="h-8 w-8 rounded-full"></td>
                                <td class="px-6 text-left   py-4 whitespace-nowrap"><?php echo $registerDate; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="#" onclick="showSweetAlert('<?php echo $id; ?>', '<?php echo htmlspecialchars(addslashes($nameKh), ENT_QUOTES, 'UTF-8'); ?>', '<?php echo htmlspecialchars(addslashes($nameEn), ENT_QUOTES, 'UTF-8'); ?>', '<?php echo htmlspecialchars(addslashes($sex), ENT_QUOTES, 'UTF-8'); ?>', '<?php echo htmlspecialchars(addslashes($photo), ENT_QUOTES, 'UTF-8'); ?>', '<?php echo htmlspecialchars(addslashes($NationalityID), ENT_QUOTES, 'UTF-8'); ?>', '<?php echo htmlspecialchars(addslashes($registerDate), ENT_QUOTES, 'UTF-8'); ?>', '<?php echo htmlspecialchars(addslashes($dob), ENT_QUOTES, 'UTF-8'); ?>', '<?php echo htmlspecialchars(addslashes($pob), ENT_QUOTES, 'UTF-8'); ?>', '<?php echo htmlspecialchars(addslashes($phone1), ENT_QUOTES, 'UTF-8'); ?>', '<?php echo htmlspecialchars(addslashes($phone2), ENT_QUOTES, 'UTF-8'); ?>', '<?php echo htmlspecialchars(addslashes($telegram), ENT_QUOTES, 'UTF-8'); ?>', '<?php echo htmlspecialchars(addslashes($email), ENT_QUOTES, 'UTF-8'); ?>')" class="inline-flex items-center px-3 py-1.5 bg-indigo-600 text-white font-semibold text-xs rounded hover:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        <span class="mr-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3-9a1 1 0 10-2 0v1H9a1 1 0 100 2h2v1a1 1 0 102 0v-1h2a1 1 0 100-2h-2V9z" clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                        See more
                                    </a>
                                </td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
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
<script>
    function showSweetAlert(id, nameKh, nameEn, sex, photo, NationalityID, registerDate, dob, pob, phone1, phone2, telegram, email) {
        Swal.fire({
            title: '<span class="swal-custom">Information for ID: ' + id + '</span>',
            html: '<div class="flex">' +
                '<div><img src="studentinfo/' + photo + '" style="width: 150px; height: auto; border-radius: 20px; border:3px solid #dedee2;"></div>' +
                '<div class="swal-custom">' +
                '<div class="border border-black-300 p-4 hover:bg-red-500 transition-colors duration-300 hover:text-white">Student Name (KH): ' + nameKh + '</div>' +
                '<div class="border border-black-300 p-4 hover:bg-red-500 transition-colors duration-300 hover:text-white">Student Name (EN): ' + nameEn + '</div>' +
                '<div class="border border-black-300 p-4 hover:bg-red-500 transition-colors duration-300 hover:text-white">Student Sex: ' + sex + '</div>' +
                '<div class="border border-black-300 p-4 hover:bg-red-500 transition-colors duration-300 hover:text-white">Nationality ID: ' + NationalityID + '</div>' +
                '<div class="border border-black-300 p-4 hover:bg-red-500 transition-colors duration-300 hover:text-white">Register Date: ' + registerDate + '</div>' +
                '<div class="border border-black-300 p-4 hover:bg-red-500 transition-colors duration-300 hover:text-white">Date of Birth: ' + dob + '</div>' +
                '<div class="border border-black-300 p-4 hover:bg-red-500 transition-colors duration-300 hover:text-white">Place of Birth: ' + pob + '</div>' +
                '<div class="border border-black-300 p-4 hover:bg-red-500 transition-colors duration-300 hover:text-white">Phone 1: ' + phone1 + '</div>' +
                '<div class="border border-black-300 p-4 hover:bg-red-500 transition-colors duration-300 hover:text-white">Phone 2: ' + phone2 + '</div>' +
                '<div class="border border-black-300 p-4 hover:bg-red-500 transition-colors duration-300 hover:text-white">Telegram: ' + telegram + '</div>' +
                '<div class="border border-black-300 p-4 hover:bg-red-500 transition-colors duration-300 hover:text-white">Email: ' + email + '</div>' +
                '</div>' +
                '</div>',
            confirmButtonText: 'Exit',
            allowOutsideClick: false,
            customClass: {
                htmlContainer: 'text-left'
            },
            background: 'white',
            confirmButtonColor: 'red',
            cancelButtonColor: '#E53E3E'
        });
    }

    function fetchData(type, id, target) {
        $.ajax({
            url: 'fetch_data.php',
            type: 'POST',
            data: {
                type: type,
                id: id
            },
            dataType: 'json',
            success: function(data) {
                $(target).html('<option value="">Select ' + type.charAt(0).toUpperCase() + type.slice(1) + '</option>');
                $.each(data, function(index, item) {
                    $(target).append('<option value="' + item.id + '">' + item.name + '</option>');
                });
            },
        });
    }

    $(document).ready(function() {
        fetchData('provinces', null, '#provinces');

        $('#provinces').on('change', function() {
            var provinceId = $(this).val();
            fetchData('districts', provinceId, '#districts');
        });

        $('#districts').on('change', function() {
            var districtId = $(this).val();
            fetchData('communes', districtId, '#communes');
        });

        $('#communes').on('change', function() {
            var communeId = $(this).val();
            fetchData('villages', communeId, '#villages');
        });
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
</script>
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();

    });
</script>