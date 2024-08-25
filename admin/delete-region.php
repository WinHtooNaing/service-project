<?php
require "../config/config.php";
$stmt = $pdo->prepare("delete from regions where id=" . $_GET['id']);
$stmt->execute();
header('location: region.php');
