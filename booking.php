<?php
session_start();
include 'header.php';
require 'config/config.php';

$stmtservice = $pdo->prepare('select * from services');
$stmtservice->execute();
$resultservice = $stmtservice->fetchAll();

$stmtregion = $pdo->prepare('select * from regions');
$stmtregion->execute();
$resultregion = $stmtregion->fetchAll();



?>
<?php
if ($_POST) {
    $address1 = $_POST['address'];
    $region = $_POST['region'];


    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $service = $_POST['service'];
    $service_date = $_POST['service_date'];
    $special_request = $_POST['special_request'];
    $address = $address1 . "၊" . $region;
    if (empty($username) || empty($phone) || empty($service) || empty($special_request) || empty($address1) || empty($region) || empty($service_date)) {

        if (empty($username)) {
            $usernameErr = "Invalid username";
        }
        if (empty($phone)) {
            $phoneErr = "Invalid phone";
        }
        if (empty($service)) {
            $serviceErr = "no service";
        }
        if (empty($special_request)) {
            $special_requestErr = "Invalid request";
        }
        if (empty($address1)) {
            $address1Err = "Invalid Err";
        }
        if (empty($region)) {
            $regionErr = "Invalid region";
        }
        if (empty($service_date)) {
            $service_dateErr = "invalid service date";
        }
    } else {
        $_SESSION['name'] = $username;
        $_SESSION['phone'] = $phone;
        $_SESSION['service'] = $service;
        $_SESSION['special_request'] = $special_request;
        $_SESSION['service_date'] = $service_date;
        $_SESSION['address'] = $address;
        echo "<script>window.location.href='payment.php'</script>";
    }
}


?>
<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 py-5">
    <div class="container">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Booking</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb text-uppercase">
                <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                <li class="breadcrumb-item text-white active" aria-current="page">Booking</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->


<!-- Booking Start -->
<div class="container-fluid px-0" style="margin: 6rem 0;">
    <div class="video wow fadeInUp" data-wow-delay="0.1s">
        <button type="button" class="btn-play" data-bs-toggle="modal" data-src="https://www.youtube.com/embed/DWRcNpR6Kdc" data-bs-target="#videoModal">
            <span></span>
        </button>

        <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Youtube Video</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- 16:9 aspect ratio -->
                        <div class="ratio ratio-16x9">
                            <iframe class="embed-responsive-item" src="" id="video" allowfullscreen allowscriptaccess="always" allow="autoplay"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h1 class="text-white mb-4">Emergency Plumbing Service</h1>
        <h3 class="text-white mb-0">24 Hours 7 Days a Week</h3>
    </div>
    <div class="container position-relative wow fadeInUp" data-wow-delay="0.1s" style="margin-top: -6rem;">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="bg-light text-center p-5">
                    <h1 class="mb-4">Book For A Service</h1>
                    <form action="booking.php" method="post">
                        <div class="row g-3">
                            <div class="col-12 col-sm-6">
                                <input type="text" class="form-control border-0" placeholder="Your Name" name="username" style="height: 55px;">
                            </div>
                            <div class="col-12 col-sm-6">
                                <input type="number" class="form-control border-0" placeholder="Your Phone Number" name="phone" style="height: 55px;">
                            </div>
                            <div class="col-12 col-sm-6">
                                <select name="service" class="form-select border-0" style="height: 55px;">
                                    <option selected>Select A Service</option>
                                    <?php
                                    foreach ($resultservice as $service) {
                                    ?>
                                        <option value="<?php echo $service['title'] ?>"><?php echo $service['title'] ?></option>
                                    <?php
                                    }

                                    ?>
                                </select>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="date" id="date1" data-target-input="nearest">
                                    <input name="service_date" type="text" class="form-control border-0 datetimepicker-input" placeholder="Service Date" data-target="#date1" data-toggle="datetimepicker" style="height: 55px;">
                                </div>
                            </div>
                            <div class="col-12 ">
                                <select name="region" class="form-select border-0" style="height: 55px;">

                                    <?php
                                    foreach ($resultregion as $region) {
                                        $stmtcity = $pdo->prepare('select * from cities where region_id=' . $region['id']);
                                        $stmtcity->execute();
                                        $resultcity = $stmtcity->fetchAll();
                                    ?>
                                        <optgroup label="<?php echo $region['region'] ?>">
                                            <?php
                                            foreach ($resultcity as $city) {
                                            ?>
                                                <option value="<?php echo $city['city'] ?>၊<?php echo $region['region'] ?>"><?php echo $city['city'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </optgroup>
                                    <?php
                                    }

                                    ?>
                                </select>
                            </div>

                            <div class="col-12 ">
                                <input type="text" class="form-control border-0" placeholder="Address" name="address" style="height: 55px;">
                            </div>
                            <div class="col-12">
                                <textarea class="form-control border-0" placeholder="Special Request" name="special_request"></textarea>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" type="submit">Book Now</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Booking End -->

<?php
include 'footer.php';
?>