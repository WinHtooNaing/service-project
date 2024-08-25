<?php
require '../config/config.php';
$stmt = $pdo->prepare('delete from workers where id=' . $_GET['id']);
$stmt->execute();
header('location: worker.php');
