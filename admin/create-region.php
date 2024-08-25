<?php
include 'header.php';
if ($_POST) {
    $region = $_POST['region'];
    if (empty($region)) {
        $regionErr = 'Invalid region';
    } else {
        $stmt = $pdo->prepare("insert into regions (region) values(:region)");
        $result = $stmt->execute(
            array(':region' => $region)
        );
        if ($result) {
            echo "<script>alert('create success');window.location.href='region.php'</script>";
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
                        <form method="post" action="create-region.php">
                            <div class="card-header">
                                <h4>Server-side Validation</h4>
                            </div>
                            <div class="card-body">

                                <div class="form-group">
                                    <label>Region && State</label>
                                    <input name='region' type="text" class="form-control <?php echo empty($regionErr) ? 'is-invalid' : '' ?>">
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