<style>
    .dis {
        background-color: #f3f3f3 !important;
    }
</style>

<?php
include 'header.php';

?>
<?php
$stmt = $pdo->prepare('select * from contacts order by read_as desc');
$stmt->execute();
$result = $stmt->fetchAll();


?>
<?php
if ($_POST) {
    $id = $_POST['id'];
    $stmtupdate = $pdo->prepare('update contacts set read_as=0 where id=' . $id);
    $resultupdate = $stmtupdate->execute();
    if ($resultupdate) {
        echo "<script>alert('You read as');window.location.href='noti.php'</script>";
    }
}

?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <h2 class="section-title">Notification</h2>
            <div class="row">
                <div class="col-12">
                    <div class="activities">

                        <?php
                        if ($result) {
                            foreach ($result as $values) {
                        ?>
                                <div class="activity ">

                                    <div class="activity-detail <?php if ($values['read_as'] == 0) {
                                                                    echo 'dis';
                                                                } ?>">
                                        <div class="mb-2 ">
                                            <span class="bullet"></span>
                                            <a class="text-job" href="#"><?php echo $values['username'] ?></a>
                                            <span class="bullet"></span>
                                            <a class="text-job" href="#"><?php echo $values['email'] ?></a>
                                            <div class="float-right dropdown">
                                                <a href="#" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                                                <div class="dropdown-menu">
                                                    <div class="dropdown-title">Options</div>
                                                    <?php
                                                    if ($values['read_as'] == 1) {
                                                    ?>
                                                        <form action="" method="post">

                                                            <input type="hidden" name="id" value="<?php echo $values['id'] ?>">
                                                            <button class="dropdown-item has-icon"><i class="fas fa-eye"></i> Read as</button>
                                                        </form>

                                                    <?php

                                                    }

                                                    ?>
                                                    <div class="dropdown-divider"></div>
                                                    <a href="delete_noti.php?id=<?php echo $values['id'] ?>" class="dropdown-item has-icon text-danger" data-confirm="Wait, wait, wait...|This action can't be undone. Want to take risks?" data-confirm-text-yes="Yes, IDC" onclick="return confirm('Are you sure to delete')"><i class="fas fa-trash-alt"></i> Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                        <h6><?php echo $values['subject'] ?></h6>
                                        <p><?php echo $values['message'] ?></p>
                                    </div>
                                </div>
                            <?php
                            }
                        } else {
                            ?>
                            <p> notification is empty</p>
                        <?php
                        }
                        ?>
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