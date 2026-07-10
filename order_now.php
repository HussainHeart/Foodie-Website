<?php
session_start();
$conn = mysqli_connect("localhost","root","","jhatpat-foods");

if (!$conn) die("DB Error");

if(empty($_SESSION['cart'])){
    die("Cart is empty");
}

// GET FORM DATA
$name = $_POST['name'];
$phone = $_POST['phone'];
$address = $_POST['address'];

$order_id = "ORD" . rand(10000,99999);
$total = 0;
$items = "";

// LOOP CART
foreach($_SESSION['cart'] as $id => $qty){

    $res = mysqli_query($conn,"SELECT * FROM menu WHERE id=$id");
    $row = mysqli_fetch_assoc($res);

    $amount = $row['price'] * $qty;
    $total += $amount;

    $items .= $row['name']." (".$qty."), ";
}

// SAVE INTO DATABASE
mysqli_query($conn,"INSERT INTO orders 
(order_id, name, phone, address, items, total, order_date)
VALUES 
('$order_id','$name','$phone','$address','$items','$total',NOW())");

// SAVE SESSION FOR SUCCESS PAGE
$_SESSION['order_data'] = [
    "order_id" => $order_id,
    "name" => $name,
    "phone" => $phone,
    "address" => $address,
    "items" => $_SESSION['cart'],
    "total" => $total
];

// CLEAR CART
unset($_SESSION['cart']);

// REDIRECT
header("Location: order_sucess.php");
exit;
?>

<?php include('partials-f/footer.php'); ?>