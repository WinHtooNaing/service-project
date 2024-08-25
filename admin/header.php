<?php
session_start();

if (empty($_SESSION['logged_in'])) {
    header('location: auth.php');
}


$link = $_SERVER['PHP_SELF'];
$link_array = explode('/', $link);
$page = end($link_array);


?>
<?php
require '../config/config.php';
$stmt = $pdo->prepare('select * from contacts where read_as=1');
$stmt->execute();
$result = $stmt->fetchAll();
$count = $pdo->prepare('SELECT COUNT(*) AS total_count FROM contacts where read_as=1');

$count->execute();

$count_result = $count->fetch();




?>

<!DOCTYPE html>
<html lang="en">


<!-- index.html  21 Nov 2019 03:44:50 GMT -->

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Otika - Admin Dashboard Template</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="assets/css/app.min.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
</head>

<body>

    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar sticky">
                <div class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i data-feather="align-justify"></i></a></li>
                        <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                                <i data-feather="maximize"></i>
                            </a></li>

                    </ul>
                </div>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link nav-link-lg message-toggle"><i data-feather="bell"></i>

                            <?php
                            if ($count_result['total_count'] != 0) {
                            ?>
                                <span class="badge headerBadge1">
                                    <?php
                                    echo $count_result['total_count'];

                                    ?> </span>
                            <?php
                            }

                            ?>
                        </a>
                        <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
                            <div class="dropdown-header">
                                Messages

                            </div>

                            <div class="dropdown-list-content dropdown-list-message">

                                <?php
                                if ($result) {

                                    foreach ($result as $value) {
                                ?>
                                        <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar
											text-white">
                                            </span> <span class="dropdown-item-desc"> <span class="message-user"><?php echo $value['username'] ?></span>
                                                <span class="time messege-text"><?php echo $value['subject'] ?></span></span>
                                            <span class="time"><?php echo date('d-m-Y', strtotime($value['created_at'])) ?></span>
                                            </span>
                                        </a>
                                <?php

                                    }
                                }

                                ?>
                            </div>
                            <div class="dropdown-footer text-center">
                                <a href="noti.php">View All <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </li>

                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user"><i data-feather="user" style="margin-top:5px;width:25px;height:25px"></i> <span class=" d-sm-none d-lg-inline-block"></span></a>
                        <div class="dropdown-menu dropdown-menu-right pullDown">
                            <div class="dropdown-title">Hello <?php echo $_SESSION['username'] ?></div>
                            <a href="profile.php" class="dropdown-item has-icon"> <i class="far
										fa-user"></i> Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="logout.php" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="index.html"> <img alt="image" src="assets/img/logo.png" class="header-logo" /> <span class="logo-name">Otika</span>
                        </a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Main</li>
                        <li class="dropdown <?php echo $page == 'index.php' ? 'active' : '' ?>">
                            <a href="index.php" class="nav-link"><i class="fas fa-home"></i><span>Dashboard</span></a>
                        </li>
                        <li class="dropdown <?php echo $page == 'service.php' ? 'active' : '' ?>">
                            <a href="service.php" class="nav-link"><i class="fab fa-servicestack"></i><span>Services</span></a>
                        </li>
                        <li class="dropdown <?php echo $page == 'region.php' ? 'active' : '' ?>">
                            <a href="region.php" class="nav-link"><i class="fas fa-signal"></i><span>Regions & States</span></a>
                        </li>
                        <li class="dropdown <?php echo $page == 'city.php' ? 'active' : '' ?>">
                            <a href="city.php" class="nav-link"><i class="
far fa-compass"></i><span>City</span></a>
                        </li>
                        <li class="dropdown <?php echo $page == 'worker.php' ? 'active' : '' ?>">
                            <a href="worker.php" class="nav-link"><i class="
fas fa-user-friends"></i><span>Workers</span></a>
                        </li>
                        <li class="dropdown <?php echo $page == 'noti.php' ? 'active' : '' ?>">
                            <a href="noti.php" class="nav-link"><i class="
fas fa-bell"></i><span>Notification</span></a>
                        </li>

                        <li class="dropdown <?php echo $page == 'profile.php' ? 'active' : '' ?>">
                            <a href="profile.php" class="nav-link"><i class="
fas fa-portrait"></i><span>Profile</span></a>
                        </li>




                    </ul>
                </aside>
            </div>