<?php
require '../config/config.php';
$stmt = $pdo->prepare("delete from services where id=" . $_GET['id']);

$stmt->execute();
$stmtimage = $pdo->prepare("delete from images where service_id=" . $_GET['id']);
$stmtimage->execute();
header('location: service.php');
