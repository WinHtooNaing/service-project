<?php
include 'header.php';


?>
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row" style="display:flex;justify-content:center;">

                <div class="col-12 col-md-10 col-lg-10">
                    <div class="card">
                        <form method="post" action="createservice.php" enctype="multipart/form-data">
                            <div class="card-header">
                                <?php
                                if ($_POST) {
                                    $title = $_POST['title'];
                                    $description = $_POST['description'];
                                    $price = $_POST['price'];

                                    $imagevalid = true;

                                    if (empty($title) || empty($description) || empty($price) || empty($_FILES['image'])) {
                                        if (empty($title)) {
                                            $titleErr = "title not specified";
                                        }
                                        if (empty($description)) {
                                            $descriptionErr = "description not specified";
                                        }
                                        if (empty($price)) {
                                            $priceErr = "price not specified";
                                        }
                                        if (empty($_FILES['image']['name'][0])) {
                                            $imageErr = "image must be required";
                                        }
                                    } else {

                                        $images = $_FILES['image'];
                                        foreach ($images['name'] as $imageName) {
                                            $file = 'assets/uploads/services/' . $imageName;
                                            $imageType = pathinfo($file, PATHINFO_EXTENSION);
                                            if ($imageType != 'png' && $imageType != 'jpeg' && $imageType != 'jpg') {
                                                $imagevalid = false;
                                                break;
                                            }
                                        }
                                        if ($imagevalid) {
                                            $stmt = $pdo->prepare('insert into services (title,description,price) values (:title,:description,:price)');
                                            $stmt->execute(
                                                array(
                                                    ':title' => $title,
                                                    ':description' => $description,
                                                    ':price' => $price
                                                )
                                            );
                                            $service_id = $pdo->lastInsertId();

                                            foreach ($images['name'] as $key => $imageName) {
                                                $file = 'assets/uploads/services/' . $imageName;
                                                if (move_uploaded_file($images['tmp_name'][$key], $file)) {
                                                    $stmt = $pdo->prepare("INSERT INTO images(service_id, image) VALUES (:service_id, :image)");
                                                    $stmt->execute(array(':service_id' => $service_id, ':image' => $imageName));
                                                }
                                            }

                                            echo "<script>alert('Successfully added');window.location.href='service.php';</script>";
                                        } else {
                                            echo "<script>alert('image must be jpeg,png,jpg')</script>";
                                        }
                                    }
                                }

                                ?>
                                <h4>Server-side Validation</h4>
                            </div>
                            <div class="card-body">

                                <div class="form-group">
                                    <label>Title</label>
                                    <input name='title' type="text" class="form-control ">
                                    <div class="invalid-feedback">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" name="description"></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Image</label>
                                    <input name='image[]' multiple type="file" class="form-control">
                                    <div class="invalid-feedback">

                                    </div>
                                </div>


                                <div class="form-group">
                                    <label>Price</label>
                                    <input name='price' type="number" class="form-control">
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