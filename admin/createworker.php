<?php
include 'header.php';
if ($_POST) {
    $name = $_POST['name'];
    $service_id = $_POST['service_id'];

    if (empty($name) || empty($service_id) || empty($_FILES['image'])) {
        if (empty($name)) {
            $nameErr = "name not specified";
        }
        if (empty($service_id)) {
            $serviceErr = "service not specified";
        }

        if (empty($_FILES['image']['name'])) {
            $imageErr = "image must be required";
        }
    } else {
        $file = 'assets/uploads/workers/' . ($_FILES['image']['name']);
        $imageType = pathinfo($file, PATHINFO_EXTENSION);
        if ($imageType != 'png' && $imageType != 'jpeg' && $imageType != 'jpg') {
            echo '<script>alert("Imgae must be png,jpeg,jpg")</script>';
        } else {
            $image = $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], $file);

            $stmt = $pdo->prepare('insert into workers (name,service_id,image) values(:name,:service_id,:image)');
            $result = $stmt->execute(
                array(
                    ':name' => $name, ':service_id' => $service_id, ':image' => $image
                )

            );
            if ($result) {
                echo "<script>alert('Create Success');window.location.href='worker.php'</script>";
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
                        <form method="post" action="createworker.php" enctype="multipart/form-data">
                            <div class="card-header">
                                <h4>worker create</h4>
                            </div>
                            <div class="card-body">

                                <div class="form-group">
                                    <label>Name</label>
                                    <input name='name' type="text" class="form-control ">
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
                                        ?>
                                            <option value="<?php echo $values['id'] ?>"><?php echo $values['title'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label>Image</label>
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