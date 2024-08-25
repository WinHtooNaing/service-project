<?php
include 'header.php';

?>
<?php
if (!empty($_GET['pageno'])) {
    $page = $_GET['pageno'];
} else {
    $page = 1;
}
$numOfrecs = 2;
$offset = ($page - 1) * $numOfrecs;

$stmt = $pdo->prepare("select * from regions order by id desc");
$stmt->execute();
$result1 = $stmt->fetchAll();
$total_page = ceil(count($result1) / $numOfrecs);
$stmt1 = $pdo->prepare("select * from regions order by id desc limit $offset,$numOfrecs");
$stmt1->execute();
$result = $stmt1->fetchAll();

?>
<div class="main-content">
    <section class="section">
        <div class="section-body">


            <div class="row" style="display:flex;justify-content:center;">
                <div class="col-12 col-md-10 col-lg-10">
                    <div class="card">
                        <div class="card-header">
                            <a href="create-region.php" class="btn btn-success">Create</a>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped table-md">
                                    <tr>
                                        <th>No</th>
                                        <th>Regions & States</th>
                                        <th>Created At</th>

                                        <th>Action</th>
                                    </tr>


                                    <?php
                                    $i = 1;
                                    foreach ($result as $value) {

                                    ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $value['region'] ?></td>
                                            <td><?php echo date('d/m/Y', strtotime($value['created_at'])) ?></td>

                                            <td><a href="edit-region.php?id=<?php echo $value['id'] ?>" class="btn btn-primary">Edit</a>
                                                <a href="delete-region.php?id=<?php echo $value['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete')">Delete</a>
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
                                    <li class="page-item  disabled">
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