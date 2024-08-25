<?php
include 'header.php';
require 'config/config.php';
$stmt = $pdo->prepare('select * from regions');
$stmt->execute();
$result = $stmt->fetchAll();
?>


<section style="width:80%;margin-left:10%;margin-top:100px">
    <h3 style="text-align:center">Region & City</h3>
    <p style="text-align:center">cities are bla bla bla</p>

    <?php
    foreach ($result as $value) {
        $stmtCity = $pdo->prepare(
            'select * from cities where region_id=' . $value['id']
        );
        $stmtCity->execute();
        $resultCity = $stmtCity->fetchAll();
    ?>
        <div style="border:1px solid gray;border-radius:5px;margin-bottom:5px;padding:30px 50px">
            <h2 style="font-size:30px"><?php echo $value['region']; ?></h2>
            <ul style="margin-left:20px;margin-top:30px">
                <?php
                if ($resultCity) {
                    foreach ($resultCity as $city) {
                ?>
                        <li style="font-size:20px;padding-top:5px"><?php echo $city['city']; ?></li>
                    <?php
                    }
                } else {
                    ?>
                    <p>No data</p>
                <?php
                }
                ?>
            </ul>
        </div>
    <?php
    }
    ?>

</section>
<?php
include 'footer.php';

?>