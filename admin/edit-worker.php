<?php
include 'header.php';
$stmt = $pdo->prepare('select * from  workers where id=' . $_GET['id']);
$stmt->execute();
$resultworker = $stmt->fetch();

if ($_POST) {
    $id = $_GET['id'];
    $name = $_POST['name'];
    $service_id = $_POST['service_id'];

    if (empty($name) || empty($service_id)) {
        if (empty($name)) {
            $nameErr = "name not specified";
        }
        if (empty($service_id)) {
            $serviceErr = "service not specified";
        }
    } else {

        if ($_FILES['image']['name'] != null) {
            $file = 'assets/uploads/workers/' . ($_FILES['image']['name']);
            $imageType = pathinfo($file, PATHINFO_EXTENSION);
            if ($imageType != 'png' && $imageType != 'jpeg' && $imageType != 'jpg') {
                echo '<script>alert("Imgae must be png,jpeg,jpg")</script>';
            } else {
                $image = $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], $file);
                $stmtupdate = $pdo->prepare("update  workers set name='$name',service_id='$service_id',image='$image' where id=" . $id);
                $result = $stmtupdate->execute();

                if ($result) {
                    echo "<script>alert('Update Success');window.location.href='worker.php'</script>";
                }
            }
        } else {
            $stmtupdate = $pdo->prepare("update  workers set name='$name',service_id='$service_id' where id=" . $id);
            $result = $stmtupdate->execute();

            if ($result) {
                echo "<script>alert('Update Success');window.location.href='worker.php'</script>";
            }
        }
    }
}


?>


<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row" style="display:flex;justify-content:center;">

                <div class="col-12 col-md-10 col-lg-10">
                    <div class="card">
                        <form method="post" action="" enctype="multipart/form-data">
                            <div class="card-header">
                                <h4>worker create</h4>
                            </div>
                            <div class="card-body">

                                <div class="form-group">
                                    <label>Name</label>
                                    <input name='name' type="text" class="form-control " value="<?php echo $resultworker['name'] ?>">
                                    <div class="invalid-feedback">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Service Name</label>
                                    <select class="form-control" name="service_id">
                                        <?php
                                        $stmtservice = $pdo->prepare('select * from services');
                                        $stmtservice->execute();
                                        $resultservice = $stmtservice->fetchAll();
                                        foreach ($resultservice as $values) {
                                            if ($values['id'] == $resultworker['service_id']) {
                                        ?>
                                                <option value="<?php echo $values['id'] ?>" selected><?php echo $values['title'] ?></option>

                                            <?php

                                            } else {
                                            ?>
                                                <option value="<?php echo $values['id'] ?>"><?php echo $values['title'] ?></option>

                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label>Image</label><br>
                                    <img src="assets/uploads/workers/<?php echo $resultworker['image'] ?>" width='100' height='100' alt="">
                                    <input name='image' type="file" class="form-control">
                                    <div class="invalid-feedback">

                                    </div>
                                </div>




                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
<?php
include 'footer.php';
?>