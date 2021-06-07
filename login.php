<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: dashboard.php");
    exit;
}

// Include config file
require_once "commondb.php";

// Define variables and initialize with empty values
$username     = $password     = "";
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
        $sql = "SELECT id, username, password, role, worker_id FROM users WHERE username = ?";

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
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $role, $workerid);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"]  = true;
                            $_SESSION["id"]        = $id;
                            $_SESSION["username"]  = $username;
                            $_SESSION["role"]      = $role;
                            $_SESSION['worker_id'] = $workerid;

                            if ($role == "WORKER") {
                                $currentuser   = mysqli_query($conn, "SELECT * FROM `workers` WHERE id = '$workerid'");
                                $workerdetails = mysqli_fetch_array($currentuser);

                                $_SESSION['image'] = $workerdetails['image'];
                                $_SESSION['name']  = $workerdetails['name'];
                                $_SESSION['address'] = $workerdetails['address'];
                                $_SESSION['phone'] = $workerdetails['phone'];
                            } else {

                                $_SESSION['image'] = "admin-image.png";
                                $_SESSION['name']  = "ADMIN";
                            }

                            // Redirect user to welcome page
                            header("location: dashboard.php");
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

<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from admincast.com/adminca/preview/admin_1/html/login-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 18 Aug 2019 08:11:03 GMT -->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title> Login</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="assets/vendors/line-awesome/css/line-awesome.min.css" rel="stylesheet" />
    <link href="assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
    <link href="assets/vendors/animate.css/animate.min.css" rel="stylesheet" />
    <link href="assets/vendors/toastr/toastr.min.css" rel="stylesheet" />
    <link href="assets/vendors/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" />
    <!-- PLUGINS STYLES-->
    <!-- THEME STYLES-->
    <link href="assets/css/main.min.css" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
    <style>
        body {
            background-color: #f2f3fa;
        }

        .login-content {
            max-width: 400px;
            margin: 100px auto 50px;
            box-shadow: 0 2px 5px 0 rgba(0, 0, 0, .16), 0 2px 10px 0 rgba(0, 0, 0, .12);
        }

        .auth-head-icon {
            position: relative;
            height: 60px;
            width: 60px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            background-color: #fff;
            color: #5c6bc0;
            box-shadow: 0 5px 20px #d6dee4;
            border-radius: 50%;
            transform: translateY(-50%);
            z-index: 2;
        }
    </style>
</head>

<body>
    <div class="row login-content">
        <div class="col-12 bg-white">
            <div class="text-center">
                <span class="auth-head-icon"><i class="la la-user"></i></span>
            </div>
            <div class="ibox m-0" style="box-shadow: none;">
                <form class="ibox-body" id="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <h4 class="font-strong text-center mb-5">LOG IN</h4>
                    <div class="form-group mb-4 <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                        <input class="form-control form-control-air" type="text" name="username" placeholder="Username" value="<?php echo $username; ?>">
                         <span class="help-block"><?php echo $username_err; ?></span>
                    </div>
                    <div class="form-group mb-4 <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                        <input class="form-control form-control-air" type="password" name="password" placeholder="Password">
                        <span class="help-block"><?php echo $password_err; ?></span>
                    </div>
                    <div class="flexbox mb-5">
                        <label class="checkbox checkbox-primary">
                            <input type="checkbox" checked>
                            <span class="input-span"></span> Remember</label>
                        <!-- <a class="text-primary" href="forgot_password.html">Forgot password?</a> -->
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary btn-rounded btn-block btn-air">LOGIN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- CORE PLUGINS-->
    <script src="assets/vendors/jquery/dist/jquery.min.js"></script>
    <script src="assets/vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/vendors/metisMenu/dist/metisMenu.min.js"></script>
    <script src="assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/vendors/jquery-idletimer/dist/idle-timer.min.js"></script>
    <script src="assets/vendors/toastr/toastr.min.js"></script>
    <script src="assets/vendors/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="assets/vendors/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <!-- PAGE LEVEL PLUGINS-->
    <!-- CORE SCRIPTS-->
    <script src="assets/js/app.min.js"></script>
    <!-- PAGE LEVEL SCRIPTS-->
    <script>
        $(function() {
            $('#login-form').validate({
                errorClass: "help-block",
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true
                    }
                },
                highlight: function(e) {
                    $(e).closest(".form-group").addClass("has-error")
                },
                unhighlight: function(e) {
                    $(e).closest(".form-group").removeClass("has-error")
                },
            });
        });
    </script>
</body>

</html>