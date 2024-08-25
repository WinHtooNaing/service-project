<?php
include 'header.php';
$id = $_GET['id'];
$stmt = $pdo->prepare('select * from services where id=' . $id);
$stmt->execute();
$result = $stmt->fetch();

$stmtimage = $pdo->prepare('select * from images where service_id=' . $id);
$stmtimage->execute();
$resultimage = $stmtimage->fetchAll();

?>


<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row" style="display:flex;justify-content:center;">

                <div class="col-12 col-md-10 col-lg-10">
                    <div class="card">
                        <form method="post" action="" enctype="multipart/form-data">
                            <div class="card-header">
                                <?php
                                if ($_POST) {
                                    $title = $_POST['title'];
                                    $description = $_POST['description'];
                                    $price = $_POST['price'];
                                    $imagevalid = true;
                                    if (empty($title) || empty($description) || empty($price)) {
                                        if (empty($title)) {
                                            $titleErr = "Invalid title";
                                        }
                                        if (empty($description)) {
                                            $descriptionErr = "Invalid description";
                                        }
                                        if (empty($price)) {
                                            $priceErr = "Invalid price";
                                        }
                                    }

                                    if (isset($title) && isset($description) && isset($price) && empty($_FILES['image']['name'][0])) {
                                        $stmtupdate = $pdo->prepare("update services set title='$title',description='$description',price='$price' where id=$id");
                                        $resultupdate = $stmtupdate->execute();
                                        if ($resultupdate) {
                                            echo "<script>alert('update successfully');window.location.href='service.php'</script>";
                                        }
                                    }
                                    if (isset($title) && isset($description) && isset($price) && $_FILES['image']['name'][0] != null) {
                                        $image = $_FILES['image'];
                                        foreach ($image['name'] as $imageName) {
                                            $file = 'assets/uploads/services/' . $imageName;
                                            $imageType = pathinfo($file, PATHINFO_EXTENSION);
                                            if ($imageType !== 'jpeg' && $imageType !== 'png' && $imageType !== 'jpg') {
                                                $imagevalid = false;
                                                break;
                                            }
                                        }
                                        if ($imagevalid) {
                                            $stmtupdate = $pdo->prepare("update services set title='$title',description='$description',price='$price' where id=$id");
                                            $resultupdate = $stmtupdate->execute();

                                            $stmtdelete = $pdo->prepare("delete from images where service_id=$id");
                                            $stmtdelete->execute();

                                            foreach ($image['name'] as $key => $imageName) {
                                                $file = 'assets/uploads/services/' . $imageName;
                                                if (move_uploaded_file($image['tmp_name'][$key], $file)) {
                                                    $stmtupdate = $pdo->prepare('insert into images(service_id,image) values (:service_id,:image)');
                                                    $stmtupdate->execute(
                                                        array(
                                                            ':service_id' => $id,
                                                            ':image' => $imageName

                                                        )
                                                    );
                                                }
                                            }
                                            echo "<script>alert('update successfully');window.location.href='service.php'</script>";
                                        } else {
                                            echo "<script>alert('image must be jpeg,jpg,png')</script>";
                                        }
                                    }
                                }



                                ?>
                                <h4>Edit</h4>
                            </div>
                            <div class="card-body">

                                <div class="form-group">
                                    <label>Title</label>
                                    <input name='title' type="text" class="form-control " value="<?php echo $result['title'] ?>">
                                    <div class="invalid-feedback">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" name="description"><?php echo $result['description'] ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Image</label><br>
                                    <?php
                                    foreach ($resultimage as $image) {
                                    ?>
                                        <img src="assets/uploads/services/<?php echo $image['image'] ?>" alt="" width="100" height="100">

                                    <?php

                                    }
                                    ?>
                                    <input name='image[]' multiple type="file" class="form-control">
                                    <div class="invalid-feedback">

                                    </div>
                                </div>


                                <div class="form-group">
                                    <label>Price</label>
                                    <input name='price' type="number" class="form-control" value="<?php echo $result['price'] ?>">
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