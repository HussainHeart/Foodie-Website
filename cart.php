<?php
session_start();
$conn = mysqli_connect("localhost","root","","jhatpat-foods");

if(isset($_GET['remove'])){
    unset($_SESSION['cart'][$_GET['remove']]);
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Cart</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">
<h2>Cart</h2>

<table class="table">
<tr>
<th>Item</th>
<th>Price</th>
<th>Qty</th>
<th>Total</th>
<th>Remove</th>
</tr>

<?php
$total = 0;

if(!empty($_SESSION['cart'])){
foreach($_SESSION['cart'] as $id => $qty){

$res = mysqli_query($conn,"SELECT * FROM menu WHERE id=$id");
$row = mysqli_fetch_assoc($res);

$amount = $row['price'] * $qty;
$total += $amount;
?>

<tr>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['price']; ?></td>
<td><?php echo $qty; ?></td>
<td><?php echo $amount; ?></td>
<td><a href="?remove=<?php echo $id; ?>" class="btn btn-danger">Remove</a></td>
</tr>

<?php }} ?>

</table>

<h4>Subtotal: Rs. <?php echo $total; ?></h4>

<a href="checkout.php" class="btn btn-warning">Checkout</a>

</div>

</body>
</html>
<?php include('partials-f/footer.php'); ?>