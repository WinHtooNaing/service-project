<?php
include 'header.php';
$id = $_GET['id'];
$stmt = $pdo->prepare("select * from regions where id=$id");
$stmt->execute();
$result = $stmt->fetch();

if ($_POST) {
    $region = $_POST['region'];
    if (empty($region)) {
        $regionErr = "Invalid region";
    } else {
        $stmtUpdate = $pdo->prepare("update regions set region='$region' where id=$id");
        $resultUpdate = $stmtUpdate->execute();
        if ($resultUpdate) {
            echo "<script>alert('update successfully');window.location.href='region.php'</script>";
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
                                    <input name='region' type="text" class="form-control <?php echo empty($regionErr) ? '' : 'is-invalid' ?>" value="<?php echo $result['region'] ?>">
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