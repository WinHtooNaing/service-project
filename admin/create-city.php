<?php
include 'header.php';

$stmtRegion = $pdo->prepare("select * from regions");
$stmtRegion->execute();
$resultRegion = $stmtRegion->fetchAll();


if ($_POST) {
    $city = $_POST['city'];
    $region_id = $_POST['region_id'];
    if (empty($city) || empty($region_id)) {
        if (empty($city)) {
            $cityErr = 'Invalid city';
        }
        if (empty($region_id)) {
            $region_idErr = 'Invalid region_id';
        }
    } else {
        $stmt = $pdo->prepare("insert into cities (city,region_id) values(:city,:region_id)");
        $result = $stmt->execute(
            array(':city' => $city, ':region_id' => $region_id)
        );
        if ($result) {
            echo "<script>alert('create success');window.location.href='city.php'</script>";
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
                        <form method="post" action="create-city.php">
                            <div class="card-header">
                                <h4>Server-side Validation</h4>
                            </div>
                            <div class="card-body">

                                <div class="form-group">
                                    <label>City names</label>
                                    <input name='city' type="text" class="form-control <?php echo empty($cityErr) ? 'is-invalid' : '' ?>">
                                    <div class="invalid-feedback">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Default Select</label>
                                    <select class="form-control" name="region_id">
                                        <?php
                                        foreach ($resultRegion as $values) {
                                        ?>
                                            <option value="<?php echo $values['id'] ?>"><?php echo $values['region'] ?></option>
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