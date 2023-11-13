<?php
include_once 'db.php';
if(isset($_POST['insert']))
{    
     $ScholarshipID = $_POST['ScholarshipID'];
     $StudentID = $_POST['StudentID'];
     $ProviderID = $_POST['ProviderID'];
     $Requester = $_POST['Requester'];
     $DegreeID = $_POST['DegreeID'];
     $MajorID = $_POST['MajorID'];
     $Duration = $_POST['Duration'];
     $GrantedPercent = $_POST['GrantedPercent'];
     $SchoolFee = $_POST['SchoolFee'];
     $FixAmount = $_POST['FixAmount'];
     $ScholarshipDate = $_POST['ScholarshipDate'];
     
     $sql = "INSERT INTO tblScholarship (ScholarshipID,StudentID,ProviderID,Requester,DegreeID,MajorID,Duration,GrantedPercent,SchoolFee,FixAmount,ScholarshipDate) VALUES ('$ScholarshipID', '$StudentID','$ProviderID', '$Requester','$DegreeID', '$MajorID','$Duration', '$GrantedPercent','$SchoolFee,'$FixAmount', '$ScholarshipDate')";
     if (mysqli_query($conn, $sql)) {
        echo '<script>alert("New record has been added successfully !")</script>';
        // header("location: Faculty.php");
     } else {
        echo "Error: " . $sql . ":-" . mysqli_error($conn);
     }
     mysqli_close($conn);
}
if(isset($_POST['update'])){

    $ScholarshipID = $_POST['ScholarshipID'];
    $StudentID = $_POST['StudentID'];
    $ProviderID = $_POST['ProviderID'];
    $Requester = $_POST['Requester'];
    $DegreeID = $_POST['DegreeID'];
    $MajorID = $_POST['MajorID'];
    $Duration = $_POST['Duration'];
    $GrantedPercent = $_POST['GrantedPercent'];
    $SchoolFee = $_POST['SchoolFee'];
    $FixAmount = $_POST['FixAmount'];
    $ScholarshipDate = $_POST['ScholarshipDate'];

    $sql = "UPDATE tblScholarship SET StudentID='$StudentID',ProviderID='$ProviderID',Requester='$Requester',DegreeID='$DegreeID',MajorID='$MajorID',Duration='$Duration,GrantedPercent='$GrantedPercent,SchoolFee='$SchoolFee,FixAmount='$FixAmount,ScholarshipDate='$ScholarshipDate WHERE ScholarshipID=$ScholarshipID";

    if (mysqli_query($conn, $sql)) {
        echo "Record updated successfully";
        // header("location: Faculty.php");
    } else {
        echo "Error updating record: " . $sql . ":-" . mysqli_error($conn);
    }
}
if(isset($_POST['delete'])){

    $ScholarshipID = $_POST['ScholarshipID'];
    $sql = "delete from tblScholarship Where ScholarshipID = $ScholarshipID";
    if(mysqli_query($conn,$sql)){
      echo '<script>alert("Delete TuitionFee successfully!!!")</script>';
      // header("location: Faculty.php");
    }
    else{
        echo "Error: ".$sql. ":-" . mysqli_error($conn);
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
            <div class="container ml-5 py-10">
                <div class="relative inline-block text-left">
                    <button onclick="toggleDropdown()" type="button" class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium text-white bg-gray-600 rounded-md hover:bg-red-800 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75" aria-haspopup="true" aria-expanded="true">
                        Options
                        <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 12a2 2 0 100-4 2 2 0 000 4zm-7-2a7 7 0 1114 0 7 7 0 01-14 0z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div id="dropdown-menu" class="hidden origin-top-right absolute left-5 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 overflow-y-auto max-h-48">
                        <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                            <!-- Add your menu items here -->
                            <!-- Example: -->
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Option 1</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Option 2</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Option 1</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Option 2</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Option 1</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Option 2</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Option 1</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Option 2</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Option 1</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Option 2</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Option 1</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Option 2</a>
                            <!-- More menu items -->
                        </div>
                    </div>
                </div>
            </div>
            <script>
                function toggleDropdown() {
                    const dropdownMenu = document.getElementById('dropdown-menu');
                    dropdownMenu.classList.toggle('hidden');
                }
            </script>
            <form action="tblscholarship.php" method="POST" class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md">
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="sex_id">
                    Scholarship ID
                    </label>
                    <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"  name="ScholarshipID" type="text" placeholder="Enter Scholarship ID" value="<?php if (!empty($_GET)) echo $_GET['ScholarshipID'] ?>">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="sex_name">
                    Student ID
                    </label>
                    <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"  name="StudentID" type="text" placeholder="Enter Student ID" value="<?php if (!empty($_GET)) echo $_GET['StudentID'] ?>">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="sex_name">
                    Provider ID
                    </label>
                    <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"  name="ProviderID" type="text" placeholder="Enter Provider ID" value="<?php if (!empty($_GET)) echo $_GET['ProviderID'] ?>">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="sex_name">
                    Requester
                    </label>
                    <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"  name="Requester" type="text" placeholder="Enter Requester" value="<?php if (!empty($_GET)) echo $_GET['Requester'] ?>">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="sex_name">
                    Degree ID
                    </label>
                    <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"  name="DegreeID" type="text" placeholder="Enter DegreeID" value="<?php if (!empty($_GET)) echo $_GET['DegreeID'] ?>">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="sex_name">
                    MajorID
                    </label>
                    <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"  name="MajorID" type="text" placeholder="Enter MajorID" value="<?php if (!empty($_GET)) echo $_GET['MajorID'] ?>">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="sex_name">
                    Duration
                    </label>
                    <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"  name="Duration" type="text" placeholder="Enter Duration" value="<?php if (!empty($_GET)) echo $_GET['Duration'] ?>">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="sex_name">
                    Granted Percent
                    </label>
                    <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"  name="GrantedPercent" type="text" placeholder="Enter GrantedPercent" value="<?php if (!empty($_GET)) echo $_GET['GrantedPercent'] ?>">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="sex_name">
                    SchoolFee
                    </label>
                    <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"  name="SchoolFee" type="text" placeholder="Enter SchoolFee" value="<?php if (!empty($_GET)) echo $_GET['SchoolFee'] ?>">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="sex_name">
                    FixAmount
                    </label>
                    <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"  name="FixAmount" type="text" placeholder="Enter Fix Amount" value="<?php if (!empty($_GET)) echo $_GET['FixAmount'] ?>">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="sex_name">
                    Scholarship Date
                    </label>
                    <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"  name="ScholarshipDate" type="date" placeholder="Enter ScholarshipDate" value="<?php if (!empty($_GET)) echo $_GET['ScholarshipDate'] ?>">
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