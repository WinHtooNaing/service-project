<?php
include 'header.php';
$id = $_GET['id'];
$stmt = $pdo->prepare("select * from cities where id=$id");
$stmt->execute();
$result = $stmt->fetch();

if ($_POST) {
    $city = $_POST['city'];
    $region_id = $_POST['region_id'];
    if (empty($city) || empty($region_id)) {
        if (empty($city)) {
            $cityregionErr = "Invalid city";
        }
        if (empty($region_id)) {
            $regionErr = "invalid region";
        }
    } else {
        $stmtUpdate = $pdo->prepare("update cities set city='$city', region_id='$region_id' where id=$id");
        $resultUpdate = $stmtUpdate->execute();
        if ($resultUpdate) {
            echo "<script>alert('update successfully');window.location.href='city.php'</script>";
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
                        <form method="post" action="">
                            <div class="card-header">
                                <h4>Server-side Validation</h4>
                            </div>
                            <div class="card-body">

                                <div class="form-group">
                                    <label>Region && State</label>
                                    <input name='city' type="text" class="form-control" value="<?php echo $result['city'] ?>">
                                    <div class="invalid-feedback">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Default Select</label>
                                    <select class="form-control" name="region_id">
                                        <?php
                                        $stmtRegion = $pdo->prepare('select * from regions');
                                        $stmtRegion->execute();
                                        $resultRegion = $stmtRegion->fetchAll();
                                        foreach ($resultRegion as $values) {
                                            if ($values['id'] == $result['id']) {
                                        ?>
                                                <option value="<?php echo $values['id'] ?>" selected><?php echo $values['region'] ?></option>

                                            <?php

                                            } else {
                                            ?>
                                                <option value="<?php echo $values['id'] ?>"><?php echo $values['region'] ?></option>

                                            <?php
                                            }
                                            ?>
                                        <?php
                                        }
                                        ?>
                                    </select>
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