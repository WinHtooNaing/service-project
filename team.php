<?php
include 'header.php';
?>

<?php
require 'config/config.php';
$stmt = $pdo->prepare('select * from workers');
$stmt->execute();
$result = $stmt->fetchAll();

?>
<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 py-5">
    <div class="container">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Technicians</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb text-uppercase">
                <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                <li class="breadcrumb-item text-white active" aria-current="page">Technicians</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->


<!-- Team Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="text-secondary text-uppercase">Our Technicians</h6>
            <h1 class="mb-5">Our Expert Technicians</h1>
        </div>
        <div class="row g-4">

            <?php
            if ($result) {
                foreach ($result as $values) {
            ?>
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="team-item">
                            <div class="position-relative overflow-hidden">
                                <img style="width:100%;height:300px;object-fit:cover" class="img-fluid" src="admin/assets/uploads/workers/<?php echo $values['image'] ?>" alt="">
                            </div>
                            <div class="team-text">
                                <div class="bg-light">
                                    <h5 class="fw-bold mb-0"><?php echo $values['name'] ?></h5>
                                    <?php
                                    $stmtservice = $pdo->prepare('select title from services where id=' . $values['service_id']);
                                    $stmtservice->execute();
                                    $resultservice = $stmtservice->fetch();
                                    ?>
                                    <small><?php echo $resultservice['title'] ?></small>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php
                }
            } else {
                ?>
                <p> No workers found</p>
            <?php
            }
            ?>
        </div>
    </div>
</div>
<!-- Team End -->

<?php
include 'footer.php';

?>