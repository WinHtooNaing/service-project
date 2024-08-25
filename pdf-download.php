<?php
session_start();
require 'config/config.php';
$username = $_SESSION['name'];
$phone = $_SESSION['phone'];
$service_date = $_SESSION['service_date'];
$special_request = $_SESSION['special_request'];
$address = $_SESSION['address'];
$service = htmlspecialchars($_SESSION['service']);
$price = $_SESSION['price'];

require('fpdf/fpdf.php');


$pdf = new FPDF();
$pdf->AddPage(); // Add a page
$pdf->SetFont('Arial', 'B', 16); // Set font for title

// Title
$pdf->Cell(0, 10, 'Service Invoice', 0, 1, 'C');
$pdf->Ln(10); // Line break

// Set font for details
$pdf->SetFont('Arial', '', 12);

// Add details
$pdf->Cell(0, 10, "Username: $username", 0, 1);
$pdf->Cell(0, 10, "Phone: $phone", 0, 1);
$pdf->Cell(0, 10, "Address: $address", 0, 1);
$pdf->Cell(0, 10, "Service: $service", 0, 1);
$pdf->Cell(0, 10, "Price: $price", 0, 1);
$pdf->Cell(0, 10, "Service Date: $service_date", 0, 1);

// Send PDF to browser
$pdf->Output('D', 'download.pdf'); // 'D' to force download, 'I' to display in browser


// After the PDF output, then send other outputs
session_destroy();
echo "<script>window.location.href='index.php'</script>";
