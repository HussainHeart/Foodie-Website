<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "jhatpat-foods");

if (!$conn) die("DB Error");

// ADD TO CART
if (isset($_POST['add'])) {
    $id = $_POST['id'];
    $qty = $_POST['qty'];

    $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + $qty;
}

$sql = "SELECT * FROM menu";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>Menu</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
<h2 class="text-center">Menu</h2>

<div class="row">

<?php while ($row = mysqli_fetch_assoc($result)) { ?>
<div class="col-md-4 mb-4">
<div class="card shadow">

<img src="dataimg/<?php echo $row['image']; ?>" height="200">

<div class="card-body">
<h5><?php echo $row['name']; ?></h5>
<p><?php echo $row['detail']; ?></p>

<h6>Rs. <?php echo $row['price']; ?></h6>

<form method="post">
<input type="hidden" name="id" value="<?php echo $row['id']; ?>">

<div class="d-flex align-items-center mb-2">
<button type="button" onclick="dec(this)">-</button>
<input type="text" name="qty" value="1" class="mx-2" style="width:40px;text-align:center;">
<button type="button" onclick="inc(this)">+</button>
</div>

<button name="add" class="btn btn-primary w-100">Add to Cart</button>
</form>

</div>
</div>
</div>
<?php } ?>

</div>

<a href="cart.php" class="btn btn-success">Go to Cart</a>

</div>

<script>
function inc(btn){
    let input = btn.parentElement.querySelector("input");
    input.value = parseInt(input.value) + 1;
}
function dec(btn){
    let input = btn.parentElement.querySelector("input");
    if(input.value > 1) input.value--;
}
</script>

</body>
</html>

<?php include('partials-f/footer.php'); ?>