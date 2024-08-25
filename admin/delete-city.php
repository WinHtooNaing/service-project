<?php
require '../config/config.php';
$stmt = $pdo->prepare("delete from cities where id=" . $_GET['id']);
$stmt->execute();
header('location: city.php');
