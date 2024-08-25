<?php
include 'header.php';

?>
<?php
require 'config/config.php';
$stmt = $pdo->prepare('select * from services where id=' . $_GET['id']);
$stmt->execute();
$result = $stmt->fetchAll();

$stmtimage = $pdo->prepare('select * from images where service_id=' . $_GET['id']);
$stmtimage->execute();
$resultimage = $stmtimage->fetchAll();

?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<style>
    .sectioncontainer {
        width: 90%;
        height: auto;
        margin-left: 5%;
        background-color: #f1f1f1;
        margin-top: 50px;
        box-shadow: inset #f1f1f1;
    }

    .sectioncontainer .container1 {
        width: 90%;
        margin: 5%;
    }

    .sectioncontainer .container1 h1 {
        text-align: center;
        color: #222;
        font-size: 3rem;
        padding-top: 20px;
    }

    .sectioncontainer .container1 div {
        display: flex;
        justify-content: space-between;
        margin: 0px 20px 0px 20px;
    }

    .description {
        padding-top: 20px;
        font-size: 20px;
    }

    .image {
        width: 60%;
        margin-left: 20%;
        height: 400px;
        object-fit: cover;
        margin-bottom: 20px;
    }
</style>
<?php
if ($result) {

?>
    <section class="sectioncontainer">
        <div class="container1">
            <h1><?php echo $result[0]['title'] ?></h1>
            <div>
                <p>Price-<?php echo $result[0]['price'] ?></p>
                <p>Created_at-<?php echo date('d-m-Y', strtotime($result[0]['created_at'])) ?></p>
            </div>

            <p class="description"><?php echo $result[0]['description'] ?></p>

            <div class="lightbox" data-mdb-lightbox-init>
                <div class="multi-carousel" data-mdb-multi-carousel-init>
                    <div class="multi-carousel-inner">
                        <?php
                        foreach ($resultimage as $image) {
                        ?>
                            <div class="multi-carousel-item">
                                <img
                                    src="admin/assets/uploads/services/<?php echo $image['image'] ?>"
                                    data-mdb-img="https://mdbcdn.b-cdn.net/img/Photos/Slides/1.webp"
                                    alt="Table Full of Spices"
                                    class="w-100" />
                            </div>
                        <?php
                        }
                        ?>




                    </div>
                    <button data-mdb-button-init
                        class="carousel-control-prev"
                        type="button"
                        tabindex="0"
                        data-mdb-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    </button>
                    <button data-mdb-button-init
                        class="carousel-control-next"
                        type="button"
                        tabindex="0"
                        data-mdb-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    </button>
                </div>
            </div>
            <br><br>


        </div>
    </section>
<?php

} else {
?>
    <p>No data found</p>
<?php
}

?>

<?php
include 'footer.php';
?>