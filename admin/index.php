<?php
include 'header.php';
?>
<?php

if ($_POST) {
    $id = $_POST['id'];
    $stmtupdate = $pdo->prepare("update bookings set done=1 where id=" . $id);
    $resultupdate = $stmtupdate->execute();
    if ($resultupdate) {
        echo "<script>alert('Done')</script>";
    }
}



?>
<?php
if (!empty($_GET['pageno'])) {
    $page = $_GET['pageno'];
} else {
    $page = 1;
}
$numOfrecs = 2;
$offset = ($page - 1) * $numOfrecs;


$stmt = $pdo->prepare("select * from bookings where done=0 order by id desc");
$stmt->execute();
$result1 = $stmt->fetchAll();

$total_page = ceil(count($result1) / $numOfrecs);
$stmt1 = $pdo->prepare("select * from bookings where done=0 order by id desc limit $offset,$numOfrecs");
$stmt1->execute();
$result = $stmt1->fetchAll();

?>
<?php
$countbooking = $pdo->prepare('SELECT COUNT(*) AS total_count FROM bookings where done=0');

$countbooking->execute();

$booking_count_result = $countbooking->fetch();

$countcustomer = $pdo->prepare('select count(*) as total_count from bookings');
$countcustomer->execute();
$customer_count_result = $countcustomer->fetch();

$countservice = $pdo->prepare('select count(*) as total_count from services');
$countservice->execute();
$service_count_result = $countservice->fetch();
?>


<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="row ">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15">New Booking</h5>
                                        <h2 class="mb-3 font-18"><?php echo $booking_count_result['total_count'] ?></h2>

                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <img src="assets/img/banner/1.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15"> Customers</h5>
                                        <h2 class="mb-3 font-18"><?php echo $customer_count_result['total_count'] ?></h2>

                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <img src="assets/img/banner/2.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15">Services</h5>
                                        <h2 class="mb-3 font-18"><?php echo $service_count_result['total_count'] ?></h2>

                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <img src="assets/img/banner/3.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15">Revenue</h5>
                                        <h2 class="mb-3 font-18">$48,697</h2>
                                        <p class="mb-0"><span class="col-green">42%</span> Increase</p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <img src="assets/img/banner/4.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Assign Task Table</h4>
                        <div class="card-header-form">

                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <th class="text-center">
                                        No.
                                    </th>
                                    <th>User Name</th>
                                    <th>Service</th>
                                    <th>Service Date</th>

                                    <th>Action</th>
                                </tr>
                                <?php
                                $i = 1;
                                foreach ($result as $value) {
                                ?>
                                    <tr>
                                        <td class="p-0 text-center">
                                            <?php echo $i ?>
                                        </td>
                                        <td><?php echo $value['username'] ?></td>
                                        <td><?php echo $value['service'] ?></td>


                                        <td><?php echo $value['service_date'] ?></td>

                                        <td style="display:flex;flex-direction:row">
                                            <div style="margin-right:2px"> <a href="detail.php?id=<?php echo $value['id'] ?>" class="btn btn-outline-primary">Detail</a></div>
                                            <form action="" method="post">
                                                <input type="hidden" name="id" value="<?php echo $value['id'] ?>">
                                                <button class="btn btn-outline-success">Done</button>
                                            </form>
                                        </td>
                                    </tr>

                                <?php
                                    $i++;
                                }

                                ?>

                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <nav class="d-inline-block">
                            <ul class="pagination mb-0">

                                <li class="page-item"><a class="page-link" href="?pageno=1">First</a></li>
                                <li class="page-item <?php if ($page <= 1) {
                                                            echo 'disabled';
                                                        } ?>">
                                    <a class="page-link" href="?pageno=<?php echo $page - 1 ?>" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                                </li>

                                <li class="page-item disabled">
                                    <a class="page-link" href="#"><?php echo $page ?></a>
                                </li>

                                <li class="page-item <?php if ($page >= $total_page) {
                                                            echo 'disabled';
                                                        } ?>">
                                    <a class="page-link" href="?pageno=<?php echo $page + 1 ?>"><i class="fas fa-chevron-right"></i></a>
                                </li>
                                <li class="page-item"><a class="page-link" href="?pageno=<?php echo $total_page ?>">Last</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <div class="settingSidebar">
        <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
        </a>
        <div class="settingSidebar-body ps-container ps-theme-default">
            <div class=" fade show active">
                <div class="setting-panel-header">Setting Panel
                </div>
                <div class="p-15 border-bottom">
                    <h6 class="font-medium m-b-10">Select Layout</h6>
                    <div class="selectgroup layout-color w-50">
                        <label class="selectgroup-item">
                            <input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" checked>
                            <span class="selectgroup-button">Light</span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout">
                            <span class="selectgroup-button">Dark</span>
                        </label>
                    </div>
                </div>
                <div class="p-15 border-bottom">
                    <h6 class="font-medium m-b-10">Sidebar Color</h6>
                    <div class="selectgroup selectgroup-pills sidebar-color">
                        <label class="selectgroup-item">
                            <input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar">
                            <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip" data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" checked>
                            <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip" data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                        </label>
                    </div>
                </div>
                <div class="p-15 border-bottom">
                    <h6 class="font-medium m-b-10">Color Theme</h6>
                    <div class="theme-setting-options">
                        <ul class="choose-theme list-unstyled mb-0">
                            <li title="white" class="active">
                                <div class="white"></div>
                            </li>
                            <li title="cyan">
                                <div class="cyan"></div>
                            </li>
                            <li title="black">
                                <div class="black"></div>
                            </li>
                            <li title="purple">
                                <div class="purple"></div>
                            </li>
                            <li title="orange">
                                <div class="orange"></div>
                            </li>
                            <li title="green">
                                <div class="green"></div>
                            </li>
                            <li title="red">
                                <div class="red"></div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="p-15 border-bottom">
                    <div class="theme-setting-options">
                        <label class="m-b-0">
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" id="mini_sidebar_setting">
                            <span class="custom-switch-indicator"></span>
                            <span class="control-label p-l-10">Mini Sidebar</span>
                        </label>
                    </div>
                </div>
                <div class="p-15 border-bottom">
                    <div class="theme-setting-options">
                        <label class="m-b-0">
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" id="sticky_header_setting">
                            <span class="custom-switch-indicator"></span>
                            <span class="control-label p-l-10">Sticky Header</span>
                        </label>
                    </div>
                </div>
                <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
                    <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
                        <i class="fas fa-undo"></i> Restore Default
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'footer.php';
?>