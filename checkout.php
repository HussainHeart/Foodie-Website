<?php
session_start();
$conn = mysqli_connect("localhost","root","","jhatpat-foods");

$total = 0;
?>

<!DOCTYPE html>
<html>
<head>
<title>Checkout</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

<h2>Checkout</h2>

<div class="row">

<div class="col-md-6">
<h4>Cart Summary</h4>

<?php
if(!empty($_SESSION['cart'])){
foreach($_SESSION['cart'] as $id => $qty){

$res = mysqli_query($conn,"SELECT * FROM menu WHERE id=$id");
$row = mysqli_fetch_assoc($res);

$amount = $row['price'] * $qty;
$total += $amount;
?>

<p><?php echo $qty . " x " . $row['name']; ?> = Rs. <?php echo $amount; ?></p>

<?php }} ?>

<hr>
<h4>Total: Rs. <?php echo $total; ?></h4>

</div>

<div class="col-md-6">
<h4>Delivery Details</h4>

<form action="order_now.php" method="post">

<input type="text" name="name" class="form-control mb-2" placeholder="Your Name" required>

<input type="text" name="phone" class="form-control mb-2" placeholder="Mobile Number" required>

<textarea name="address" class="form-control mb-2" placeholder="Address" required></textarea>

<input type="radio" checked> Cash on Delivery <br><br>

<button type="submit" class="btn btn-success w-100">Order Now</button>

</form>

</div>

</div>

</div>

</body>
</html>
<?php include('partials-f/footer.php'); ?>