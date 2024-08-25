<?php
session_start();

if (empty($_SESSION['service'])) {
    header('location: booking.php');
}
$username = $_SESSION['name'];
$phone = $_SESSION['phone'];
$service_date = $_SESSION['service_date'];
$special_request = $_SESSION['special_request'];
$address = $_SESSION['address'];
$service = htmlspecialchars($_SESSION['service']);
$price = $_SESSION['price'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <section class="w-full flex justify-center mt-20 mb-20">
        <div class="w-3/5 border-2 p-5 shadow-md ">
            <h1 class="text-center text-xl font-bold">Booking Details</h1>
            <div class="px-5 text-lg mt-10">
                <p class="pb-2"><strong>Name:</strong> <?php echo $username; ?></p>
                <p class="pb-2"><strong>Phone:</strong> <?php echo $phone; ?></p>
                <p class="pb-2"><strong>Service Date: </strong><?php echo $service_date; ?></p>
                <p class="text-base pb-2"><strong>Special Request: </strong><?php echo $special_request; ?></p>
                <p class="pb-2"><strong>Address:</strong> <?php echo $address; ?></p>
                <p class="pb-2"><strong>Service:</strong> <?php echo $service; ?></p>
                <p class="pb-2"><strong>Price:</strong> <?php echo $price; ?></p>

            </div><br>
            <a href="destory.php" class="w-20 h-5 bg-blue-500 p-2 text-white rounded-sm">Back to Home</a>
            <p class="text-center text-base text-center text-orange-500">write screenshot for your blabla</p>
        </div>
    </section>
</body>

</html>