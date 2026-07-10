<?php
session_start();
$conn = mysqli_connect("localhost","root","","jhatpat-foods");

$order = $_SESSION['order_data'] ?? [];
?>

<!DOCTYPE html>
<html>
<head>
<title>Order Success</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

<div class="text-center">
<h2 class="text-success">✅ Order Placed Successfully</h2>
<p><b>Order ID:</b> <?php echo $order['order_id']; ?></p>
</div>

<hr>

<div class="card p-4">

<h4>Customer Details</h4>
<p><b>Name:</b> <?php echo $order['name']; ?></p>
<p><b>Phone:</b> <?php echo $order['phone']; ?></p>
<p><b>Address:</b> <?php echo $order['address']; ?></p>

<hr>

<h4>Order Items</h4>

<?php
if(!empty($order['items'])){
foreach($order['items'] as $id => $qty){

$res = mysqli_query($conn,"SELECT * FROM menu WHERE id=$id");
$row = mysqli_fetch_assoc($res);

$amount = $row['price'] * $qty;
?>

<p>
<?php echo $qty . " x " . $row['name']; ?>
<span style="float:right;">Rs. <?php echo $amount; ?></span>
</p>

<?php }} ?>

<hr>

<h4>Total: <span style="float:right;">Rs. <?php echo $order['total']; ?></span></h4>

</div>

<div class="text-center mt-4">
<a href="menu.php" class="btn btn-primary">Back to Menu</a>
</div>

</div>

</body>
</html>
<?php include('partials-f/footer.php'); ?>