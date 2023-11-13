<?php include('db.php');

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}


?>
<?php
if (isset($_POST['insert'])) {
    $StudentNameKH = $_POST['StudentNameKH'];
    $StudentNameEN = $_POST['StudentNameEN'];
    $SexID = $_POST['SexID'];
    $NationalityID = $_POST['NationalityID'];
    $DOB = $_POST['DOB'];
    $POB = $_POST['POB'];
    $PhoneNumber1 = $_POST['PhoneNumber1'];
    $PhoneNumber2 = $_POST['PhoneNumber2'];
    $TelegramNumber = $_POST['TelegramNumber'];
    $Email = $_POST['Email'];
    $RegisterDate = $_POST['RegisterDate'];
    if (move_uploaded_file($_FILES["Photo"]["tmp_name"], "studentinfo/" . date("Ymdhis") . $_FILES["Photo"]["name"])) {
        $Photo = date("Ymdhis") . $_FILES["Photo"]["name"];
    }
    // if (move_uploaded_file($_FILES["Photo"]["tmp_name"], "studentinfo/" . date("Ymdhis") . $_FILES["Photo"]["name"])) {
    //     $Photo = date("ymdhis") . $_FILES["Photo"]["name"];
    // }
    $sql = "INSERT INTO `tblpersonalinformation` (`StudentNameKH`,`StudentNameEN`,`SexID`,`NationalityID`
    ,`DOB`,`POB`,`PhoneNumber1`,`PhoneNumber2`,`TelegramNumber`,`Email`,`Photo`,`RegisterDate`)
     VALUES ('$StudentNameKH','$StudentNameEN','$SexID','$NationalityID','$DOB','$POB'
     ,'$PhoneNumber1','$PhoneNumber2','$TelegramNumber','$Email','$Photo','$RegisterDate')";

    if (mysqli_query($conn, $sql)) {
        echo '<script>
    Swal.fire({
      title: "Success!",
      text: "New record has been added successfully!",
      icon: "success",
      confirmButtonText: "OK"
    }).then(function() {
      window.location = "PersonalInformation.php";
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
if (isset($_POST['search'])) {
    $StudentID = $_POST['StudentID'];

    $sql = "SELECT * from tblpersonalinformation Where StudentID=$StudentID ";

    $query = mysqli_query($conn, $sql);
    while ($data = mysqli_fetch_array($query)) {
        header("location:PersonalInformation.php?StudentID=" . $data['StudentID'] . "&StudentNameKH=" . $data['StudentNameKH']
            . "&StudentNameEN=" . $data['StudentNameEN'] . "&SexID=" . $data['SexID'] . "&NationalityID=" . $data['NationalityID']
            . "&DOB=" . $data['DOB'] . "&POB=" . $data['POB'] . "&PhoneNumber1=" . $data['PhoneNumber1']
            . "&PhoneNumber2=" . $data['PhoneNumber2'] . "&TelegramNumber=" . $data['TelegramNumber'] . "&Email=" . $data['Email']
            . "&Photo=" . $data['Photo'] . "&RegisterDate=" . $data['RegisterDate']);
    }
}
if (isset($_POST['update'])) {
    $StudentID = $_POST['StudentID']; // You need to get the record ID to update the correct record
    $StudentNameKH = $_POST['StudentNameKH'];
    $StudentNameEN = $_POST['StudentNameEN'];
    $SexID = $_POST['SexID'];
    $NationalityID = $_POST['NationalityID'];
    $DOB = $_POST['DOB'];
    $POB = $_POST['POB'];
    $PhoneNumber1 = $_POST['PhoneNumber1'];
    $PhoneNumber2 = $_POST['PhoneNumber2'];
    $TelegramNumber = $_POST['TelegramNumber'];
    $Email = $_POST['Email'];
    $Photo = $_FILES['Photo'];
    $RegisterDate = $_POST['RegisterDate'];
    // if (move_uploaded_file($_FILES["NewsImageName"]["tmp_name"], "images/NewsImageName/" . date("Ymdhis") . $_FILES["NewsImageName"]["name"])) {
    //     $NewsImageName = date("Ymdhis") . $_FILES["NewsImageName"]["name"];
    // }
    if (move_uploaded_file($_FILES["Photo"]["tmp_name"], "studentinfo/" . date("Ymdhis") . $_FILES["Photo"]["name"])) {
        $Photo = date("Ymdhis") . $_FILES["Photo"]["name"];
    }

    $sql = "UPDATE `tblpersonalinformation` SET `StudentNameKH` = '$StudentNameKH', `StudentNameEN` = '$StudentNameEN', `SexID` = '$SexID', `NationalityID` = '$NationalityID', `DOB` = '$DOB', `POB` = '$POB', `PhoneNumber1` = '$PhoneNumber1', `PhoneNumber2` = '$PhoneNumber2', `TelegramNumber` = '$TelegramNumber', `Email` = '$Email', `Photo` = '$Photo', `RegisterDate` = '$RegisterDate' WHERE `StudentID` = $StudentID";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
            Swal.fire({
              title: \"Success!\",
              text: \"Record has been updated successfully!\",
              icon: \"success\",
              confirmButtonText: \"OK\"
            }).then(function() {
              window.location = \"PersonalInformation.php\";
            });
          </script>";
    } else {
        echo "<script>
            Swal.fire({
              title: \"Error!\",
              text: \"Error updating record: " . mysqli_error($conn) . "\",
              icon: \"error\",
              confirmButtonText: \"OK\"
            });
          </script>";
    }
}
if (isset($_POST['delete'])) {
    $StudentID = $_POST['StudentID'];
    $sql = "DELETE FROM `tblpersonalinformation` WHERE `StudentID` = '$StudentID'";
    if (mysqli_query($conn, $sql)) {
        echo '<script>
            Swal.fire({
              title: "Success!",
              text: "Record has been deleted successfully!",
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
              text: "Error deleting record: ' . mysqli_error($conn) . '",
              icon: "error",
              confirmButtonText: "OK"
            });
          </script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Admin Dashboard</title>
    <!-- ======= Styles ====== -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                            <ion-icon name="chatbubble-outline"></ion-icon>
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
                    <ion-icon name="menu-outline" style="position:fixed;"></ion-icon>
                </div>

                <div class="search">
                    <label>
                        <input type="text" placeholder="Search here">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>

                <div class="user">
                    <img src="assets/imgs/customer01.jpg" alt="">
                </div>
            </div>

            <div class="container w-1/2 items-center border mx-auto px-4">
                <h1 class="text-2xl font-bold mb-6 text-center text-blue-600">Student Personal Information</h1>
                <form class="mb-4" action="#" method="POST" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="student-id">Student ID:</label>
                        <input type="text" name="StudentID" id="StudentID" class="py-2 px-3 rounded-lg border-2 w-full border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" value="<?php if (!empty($_GET)) echo $_GET['StudentID'] ?>">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="student-name-kh">Student Name (KH):</label>
                        <input type="text" name="StudentNameKH" id="StudentNameKH" class="py-2 px-3 rounded-lg border-2 w-full border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" value="<?php if (!empty($_GET)) echo $_GET['StudentNameKH'] ?>">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="student-name-en">Student Name (EN):</label>
                        <input type="text" name="StudentNameEN" id="StudentNameEN" class="py-2 px-3 rounded-lg border-2 w-full border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" value="<?php if (!empty($_GET)) echo $_GET['StudentNameEN'] ?>">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="sex-id">Sex:</label>
                        <select name="SexID" id="SexID" class="py-2 px-3 rounded-lg border-2 w-full border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" value="<?php if (!empty($_GET)) echo $_GET['SexID'] ?>">
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="nationality-id">Nationality:</label>
                        <select name="NationalityID" id="NationalityID" class="py-2 px-3 rounded-lg border-2 w-full border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" value="<?php if (!empty($_GET)) echo $_GET['NationalityID'] ?>">
                            <option value="1">Cambodian</option>
                            <option value="2">American</option>
                            <option value="3">Chinese</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="dob">Date of Birth:</label>
                        <input type="date" name="DOB" id="DOB" class="py-2 px-3 rounded-lg border-2 w-full border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" value="<?php if (!empty($_GET)) echo $_GET['DOB'] ?>">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="pob">Place of Birth:</label>
                        <input type="text" name="POB" id="POB" class="py-2 px-3 rounded-lg border-2 w-full border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" value="<?php if (!empty($_GET)) echo $_GET['POB'] ?>">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="phone-number-1">Phone Number 1:</label>
                        <input type="tel" name="PhoneNumber1" id="PhoneNumber1" class="py-2 px-3 rounded-lg border-2 w-full border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" value="<?php if (!empty($_GET)) echo $_GET['PhoneNumber1'] ?>">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="phone-number-2">Phone Number 2:</label>
                        <input type="tel" name="PhoneNumber2" id="PhoneNumber2" class="py-2 px-3 rounded-lg border-2 w-full border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" value="<?php if (!empty($_GET)) echo $_GET['PhoneNumber2'] ?>">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="telegram-number">Telegram Number:</label>
                        <input type="text" name="TelegramNumber" id="TelegramNumber" class="py-2 px-3 rounded-lg border-2 w-full border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" value="<?php if (!empty($_GET)) echo $_GET['TelegramNumber'] ?>">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="email">Email:</label>
                        <input type="email" name="Email" id="Email" class="py-2 px-3 rounded-lg border-2 w-full border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" value="<?php if (!empty($_GET)) echo $_GET['Email'] ?>">
                    </div>
                    <div class="mb-4">
                        <label class='flex flex-col border-4 border-dashed w-full h-32 hover:bg-gray-100 hover:border-purple-300 group'>
                            <div class='flex flex-col items-center justify-center pt-7'>
                                <svg class="w-10 h-10 text-purple-400 group-hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    
                                </svg>
                                <p class='lowercase text-sm text-gray-400 group-hover:text-purple-600 pt-1 tracking-wider'>Select a photo</p>
                            </div>
                            <input type='file' class="hidden" name="Photo" id="Photo" />

                        </label>
                        <div class="mb-4">
                            <div class="border p-2 ml-2">
                                <?php if (!empty($_GET['Photo'])) : ?>
                                    <a href="studentinfo/<?php echo $_GET['Photo'] ?>" target="_blank">
                                        <img src="studentinfo/<?= $_GET['Photo'] ?>" alt="" class="max-h-32 Rounded-lg border-4 border-white-300">
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="register-date">Register Date:</label>
                        <input type="date" name="RegisterDate" id="RegisterDate" class="py-2 px-3 rounded-lg border-2 w-full border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" value="<?php if (!empty($_GET)) echo $_GET['RegisterDate'] ?>">
                    </div>

                    <div class="flex justify-center items-center mt-4">
                        <button type="submit" name="insert" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">Insert</button>
                        <button type="submit" name="search" class="mx-2 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">Search</button>
                        <button type="submit" name="update" class="mx-2 bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">Update</button>
                        <button type="submit" name="delete" class="mx-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">Delete</button>
                    </div>
                </form>
            </div>


            <!-- ================ Order Details List ================= -->
            <div class="overflow-x-auto">
                <br>
                <div class="w-full max-w-xs ml-2">
                    <form>
                        <div class="relative">
                            <input type="text" placeholder="Search" class="w-full py-2 pl-10 pr-3 text-gray-700 rounded-lg border border-gray-300 focus:outline-none focus:border-indigo-500">
                            <div class="absolute top-0 left-0 inline-flex items-center justify-center w-10 h-full text-gray-400">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6">
                                    <path d="M22 22L15.5 15.5M4 11C4 8.23858 6.23858 6 9 6H15C17.7614 6 20 8.23858 20 11C20 13.7614 17.7614 16 15 16H9C6.23858 16 4 13.7614 4 11Z"></path>
                                </svg>
                            </div>
                        </div>
                    </form>
                </div>





                <table class="table-auto min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student ID</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student Name (Khmer)</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student Name (English)</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sex</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nationality</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">DOB</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">POB</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone Number 1</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone Number 2</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telegram Number</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Photo</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Register Date</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php
                        // Replace this with your own code to retrieve data from the database
                        $sql = "SELECT * FROM `tblpersonalinformation`";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_array($result)) {
                            $id = $row['StudentID'];
                            $nameKh = $row['StudentNameKH'];
                            $nameEn = $row['StudentNameEN'];
                            $sex = $row['SexID'];
                            $nationality = $row['NationalityID'];
                            $dob = $row['DOB'];
                            $pob = $row['POB'];
                            $phone1 = $row['PhoneNumber1'];
                            $phone2 = $row['PhoneNumber2'];
                            $telegram = $row['TelegramNumber'];
                            $email = $row['Email'];
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
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo $pob; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo $phone1; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo $phone2; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo $telegram; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo $email; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap"><img src="studentinfo/<?= $row['Photo'] ?>" class="h-8 w-8 rounded-full"></td>
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo $registerDate; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="edit.php?id=<?php echo $id; ?>" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    <a href="delete.php?id=<?php echo $id; ?>" class="text-red-600 hover:text-red-900">Delete</a>
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