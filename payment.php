<?php

session_start();
require 'config/config.php';

if (empty($_SESSION['service'])) {
    header('location: booking.php');
}

$username = $_SESSION['name'];
$phone = $_SESSION['phone'];
$service_date = $_SESSION['service_date'];
$special_request = $_SESSION['special_request'];
$address = $_SESSION['address'];
$service = htmlspecialchars($_SESSION['service']);

$stmt = $pdo->prepare('SELECT price FROM services WHERE title = :title');

// Bind the value to the placeholder
$stmt->bindParam(':title', $service, PDO::PARAM_STR);

// Execute the statement
$stmt->execute();

// Fetch the result
$result = $stmt->fetch(PDO::FETCH_ASSOC);

$price = $result['price'];
?>
<?php
if ($_POST) {
    $card_number = $_POST['card'];
    $expiration = $_POST['exp'];
    $cv_code = $_POST['cv_code'];
    $card_owner = $_POST['owner'];
    if (empty($card_number) && empty($expiration) && empty($cv_code) && empty($card_owner)) {
        if (empty($card_number)) {
            $card_numberErr = "Invalid card number";
        }
        if (empty($expiration)) {
            $expErr = "Invalid";
        }
        if (empty($cv_code)) {
            $cv_codeErr = "Invalid code";
        }
        if (empty($card_owner)) {
            $card_ownerErr = "Invalid owner";
        }
    } else {
        $stmtpayment = $pdo->prepare('
    INSERT INTO bookings (username, phone, address, service, price, service_date, special_request)
    VALUES (:username, :phone, :address, :service, :price, :service_date, :special_request)
');

        $resultpayment = $stmtpayment->execute(array(
            ':username' => $username,
            ':phone' => $phone,
            ':address' => $address,
            ':service' => $service,
            ':price' => $price,
            ':service_date' => $service_date,
            ':special_request' => $special_request
        ));
        if ($resultpayment) {
            $_SESSION['price'] = $price;
            echo "<script>alert('payment successfully');window.location.href='screenshot.php'</script>";
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style>
        .inlineimage {
            max-width: 470px;
            margin-right: 8px;
            margin-left: 10px
        }

        .images {
            display: inline-block;
            max-width: 98%;
            height: auto;
            width: 22%;
            margin: 1%;
            left: 20px;
            text-align: center
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="page-header text-center">
            <h1>Credit Card Payment Gateway</h1>
        </div>
        <!-- Credit Card Payment Form - START -->



        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <h3 class="text-center">Payment Details</h3>
                    <div class="inlineimage"> <img class="img-responsive images" src="https://cdn0.iconfinder.com/data/icons/credit-card-debit-card-payment-PNG/128/Mastercard-Curved.png"> <img class="img-responsive images" src="https://cdn0.iconfinder.com/data/icons/credit-card-debit-card-payment-PNG/128/Discover-Curved.png"> <img class="img-responsive images" src="https://cdn0.iconfinder.com/data/icons/credit-card-debit-card-payment-PNG/128/Paypal-Curved.png"> <img class="img-responsive images" src="https://cdn0.iconfinder.com/data/icons/credit-card-debit-card-payment-PNG/128/American-Express-Curved.png"> </div>
                </div>
            </div>
            <div class="panel-body">
                <form role="form" action="payment.php" method="post">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group"> <label>CARD NUMBER</label>
                                <div class="input-group"> <input type="tel" name="card" class="form-control" placeholder="Valid Card Number" /> <span class="input-group-addon"><span class="fa fa-credit-card"></span></span> </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-7 col-md-7">
                            <div class="form-group"> <label><span class="hidden-xs">EXPIRATION</span><span class="visible-xs-inline">EXP</span> DATE</label> <input type="tel" name="exp" class="form-control" placeholder="MM / YY" /> </div>
                        </div>
                        <div class="col-xs-5 col-md-5 pull-right">
                            <div class="form-group"> <label>CV CODE</label> <input type="tel" name="cv_code" class="form-control" placeholder="CVC" /> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group"> <label>CARD OWNER</label> <input type="text" name="owner" class="form-control" placeholder="Card Owner Name" /> </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-xs-12"> <button type="submit" class="btn btn-success btn-lg btn-block">Confirm Payment</button> </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-xs-12"><a href="booking.php"><button class="btn btn-default btn-lg btn-block">Back</button></a> </div>
                        </div>
                    </div>

                </form>
            </div>

        </div>


    </div>
</body>

</html>