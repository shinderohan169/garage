
<?php
session_start();
// Check if the user is already logged in, if yes then redirect him to welcome page
if (!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] != true) {
    header("location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <!-- GLOBAL MAINLY STYLES-->
    <link href="assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="assets/vendors/line-awesome/css/line-awesome.min.css" rel="stylesheet" />
    <link href="assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
    <link href="assets/vendors/animate.css/animate.min.css" rel="stylesheet" />
    <link href="assets/vendors/toastr/toastr.min.css" rel="stylesheet" />
    <link href="assets/vendors/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" />
    <!-- PLUGINS STYLES-->

    <link href="assets/vendors/dataTables/datatables.min.css" rel="stylesheet" />

    <link href="assets/vendors/jvectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="assets/css/main.min.css" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->

    <style type="text/css">
        .content-wrapper{
            min-height: 100vh;
        }
    </style>
</head>


<body class="fixed-navbar">
    <div class="page-wrapper">
        <!-- START HEADER-->
        <header class="header">
            <div class="page-brand">
                <a href="index.php">
                    <span class="brand" title="home">Garage Go</span>
                    <span class="brand-mini" title="home">GG</span>
                </a>
            </div>
            <div class="flexbox flex-1">
                <!-- START TOP-LEFT TOOLBAR-->
                <ul class="nav navbar-toolbar">
                    <li>
                        <a class="nav-link sidebar-toggler js-sidebar-toggler" href="javascript:;">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </a>
                    </li>
                    
                </ul>

                <ul class="nav navbar-toolbar">
                <li class="dropdown dropdown-user">
                        <a class="nav-link dropdown-toggle link" data-toggle="dropdown">
                            <span>
                                <?php
                                    echo $_SESSION['name'];
                                ?>
                            </span>
                            <img src="uploads/<?php echo $_SESSION['image'] ?>" alt="image" />
                        </a>
                        <div class="dropdown-menu dropdown-arrow dropdown-menu-right admin-dropdown-menu">
                            <div class="dropdown-arrow"></div>
                            <div class="dropdown-header">
                                <div class="admin-avatar">
                                    <img src="uploads/<?php echo $_SESSION['image'] ?>" alt="image" />
                                </div>
                                <div>
                                    <h5 class="font-strong text-white">
                                        <?php
                                            echo $_SESSION['name'];
                                        ?>
                                    </h5>
                                    <div>
                                        <span class="admin-badge mr-3"><i class="ti-user mr-2"></i><?php echo $_SESSION['role']; ?></span>
                                        <!-- <span class="admin-badge"><i class="ti-lock mr-2"></i>Safe Mode</span> -->
                                    </div>
                                </div>
                            </div>
                            <div class="admin-menu-features">
                                <?php if($_SESSION['role'] == "WORKER") { ?>
                                    <a class="admin-features-item" href="profile.php"><i class="ti-user"></i>
                                        <span>PROFILE</span>
                                    </a>
                                <?php } ?>
                                <!-- <a class="admin-features-item" href="javascript:;"><i class="ti-support"></i>
                                    <span>SUPPORT</span>
                                </a> -->
                                <a class="admin-features-item" href="logout.php"><i class="ti-power-off"></i>
                                    <span>LOGOUT</span>
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </header>

        <nav class="page-sidebar" id="sidebar">
            <div id="sidebar-collapse">
                <!-- <ul class="side-menu metismenu">
                <?php if ($_SESSION['role'] == "ADMIN") {?>
                    <li id="dashboard">
                        <a href="dashboard.php"><i class="sidebar-item-icon ti-home"></i>
                            <span class="nav-label">Dashboard </span>
                        </a>
                    </li>

                   <li id="workers">
                        <a href="workers.php"><i class="sidebar-item-icon ti-user"></i>
                            <span class="nav-label">Workers</span>
                        </a>
                    </li>

                    <li id="invoice">
                        <a href="invoice.php"><i class="sidebar-item-icon ti-file"></i>
                            <span class="nav-label">Invoice</span>
                        </a>
                    </li>
                    
                    <li id="products">
                        <a href="products.php"><i class="sidebar-item-icon ti-layers"></i>
                            <span class="nav-label">Products</span>
                        </a>
                    </li>

                <?php } elseif ($_SESSION['role'] == "WORKER") {?>
                    <li id="dashboard">
                        <a href="dashboard.php"><i class="sidebar-item-icon ti-home"></i>
                            <span class="nav-label">Dashboard </span>
                        </a>
                    </li>

                    <li id="invoice">
                        <a href="invoice.php"><i class="sidebar-item-icon ti-file"></i>
                            <span class="nav-label">Invoice</span>
                        </a>
                    </li>
                <?php } ?>

                </ul> -->
               <div class="sidebar-footer" title="Logout">

                    <a href="logout.php"><i class="ti-power-off"></i></a>
                </div>
            </div>
        </nav>