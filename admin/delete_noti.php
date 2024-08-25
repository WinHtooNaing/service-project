<?php
require '../config/config.php';
$stmt = $pdo->prepare('delete from contacts where id=' . $_GET['id']);
$stmt->execute();
header('Location: noti.php');
