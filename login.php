<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
  header("location:index.php");
  exit;
}

// Include config file
require_once "db.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Check if username is empty
  if (empty(trim($_POST["username"]))) {
    $username_err = "Please enter username.";
  } else {
    $username = trim($_POST["username"]);
  }

  // Check if password is empty
  if (empty(trim($_POST["password"]))) {
    $password_err = "Please enter your password.";
  } else {
    $password = trim($_POST["password"]);
  }

  // Validate credentials
  if (empty($username_err) && empty($password_err)) {
    // Prepare a select statement
    $sql = "SELECT id, username, password FROM users WHERE username = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
      // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "s", $param_username);

      // Set parameters
      $param_username = $username;

      // Attempt to execute the prepared statement
      if (mysqli_stmt_execute($stmt)) {
        // Store result
        mysqli_stmt_store_result($stmt);

        // Check if username exists, if yes then verify password
        if (mysqli_stmt_num_rows($stmt) == 1) {
          // Bind result variables
          mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
          if (mysqli_stmt_fetch($stmt)) {
            if (password_verify($password, $hashed_password)) {
              // Password is correct, so start a new session
              session_start();

              // Store data in session variables
              $_SESSION["loggedin"] = true;
              $_SESSION["id"] = $id;
              $_SESSION["username"] = $username;

              // Redirect user to welcome page
              header("location: index.php");
            } else {
              // Display an error message if password is not valid
              $password_err = "The password you entered was not valid.";
            }
          }
        } else {
          // Display an error message if username doesn't exist
          $username_err = "No account found with that username.";
        }
      } else {
        echo "Oops! Something went wrong. Please try again later.";
      }
    }

    // Close statement
    mysqli_stmt_close($stmt);
  }

  // Close connection
  mysqli_close($conn);
}
?>


<!--Writing HTML Code here from bootstrap templates-->

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/png" href="images/favicon.png" />
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <title>Admin Login | Coding Cush</title>
  <style>
    body {
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background-image: url('https://beltei.edu.kh/biue/images/homepics/document/beltei_international_university_in_cambodia_building.jpg');
      background-size: cover;
      background-position: center;
      font-family: 'Roboto', sans-serif;
    }

    .overlay {
      /* margin-top: 30px; */
      display: flex;
      justify-content: center;
      align-items: center;
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.7);
    }

    .card {
      background-color: rgba(255, 255, 255, 0.8);
      border-radius: 10px;
      box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.15);
    }

    .card-img-top {
      border-radius: 10%;
    }

    .form-control {
      border: none;
      border-bottom: 2px solid #ffcc00;
      border-radius: 0;
      box-shadow: none;
    }

    .form-control:focus {
      border-color: #ffaa00;
      box-shadow: none;
    }

    .form-control::placeholder {
      color: #999;
    }

    .form-floating>label {
      color: #555;
    }

    .form-floating>.form-control:focus+label {
      color: #222;
    }

    .btn {
      border-radius: 25px;
      font-weight: bold;
      box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.1);
    }

    .btn-warning {
      background-color: #ffcc00;
      border-color: #ffaa00;
    }

    .btn-warning:hover {
      background-color: #ffaa00;
      border-color: #ff8800;
    }

    .btn-danger {
      background-color: #dd3333;
      border-color: #cc0000;
    }

    .btn-danger:hover {
      background-color: #cc0000;
      border-color: #aa0000;
    }

    .btn-success {
      background-color: #33cc33;
      border-color: #00aa00;
    }

    .btn-success:hover {
      background-color: #00aa00;
      border-color: #008800;
    }

    .card-footer a {
      color: #555;
    }

    .card-footer a:hover {
      color: #222;
      text-decoration: underline;
    }
  </style>
</head>

<body>
  <!-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#" style="font-size:30px;"><strong>Login Page</strong></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>


  </nav> -->
  <div class="overlay">
    <div class="container my-5 shake">

      <div class="card mx-auto" style="width: 30rem;">
        <img class="card-img-top mx-auto my-4" src="https://www.u-fukui.ac.jp/wp/wp-content/uploads/BELTEI-Logo.png" style="width: 60%;" alt="Card image cap">
        <div class="card-body">
          <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <div class="form-floating mb-3">
              <label for="username">Username <ion-icon name="person-add-outline"></ion-icon></label>
              <input type="text" name="username" class="form-control" id="username" placeholder="Username" value="<?php echo $username; ?>">

              <div class="text-danger fst-italic"><?php echo $username_err; ?></div>
            </div>
            <div class="form-floating mb-3">
              <label for="password">Password
              <ion-icon name="keypad-outline"></ion-icon>
              </label>
             <div class="d-flex">
             <input type="password" name="password" class="form-control" id="password" placeholder="Password"  > <ion-icon id="toggle-password" style="font-size: 2rem;" name="eye-outline"></ion-icon>
             </div>
              <div class="text-danger fst-italic"><?php echo $password_err; ?></div>

              <script>
                const togglePassword = document.getElementById('toggle-password');
                const passwordInput = document.getElementById('password');

                togglePassword.style.cursor = 'pointer';
                togglePassword.addEventListener('click', function(e) {
                  // toggle the type attribute
                  const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                  passwordInput.setAttribute('type', type);
                  // toggle the eye slash icon
                  this.name = this.name === 'eye-outline' ? 'eye-off-outline' : 'eye-outline';
                });
              </script>
            </div>
            <button type="submit" class="btn btn-warning mb-2 w-100">
              <i class="fa fa-lock">&nbsp;</i> Login
            </button>
            <!-- <button type="reset" class="btn btn-danger mb-3 w-100">
              <i class="fa fa-repeat">&nbsp;</i> Reset
            </button>
            <a href="register.php" class="btn btn-success w-100 mb-3">Create Account</a>
          </form>
          <div class="card-footer">
            <a href="reset-password.php" class="text-decoration-none">Forgot Password?</a>
          </div> -->
        </div>
      </div>
    </div>
  </div>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

  <!--footer section-->

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>