<?php
include('../dbcon.php');
?>

<!DOCTYPE html>
<html>
<head>
<title>Order Detail</title>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>

<body>

<div align="center" class="bg-dark text-light pt-4 pb-4">
    <a href="../logout.php"><button style="float:right;" class="btn btn-danger">LOGOUT</button></a>
    <a href="admindash.php"><button style="float:left;" class="btn btn-success"><< BACK</button></a>
    <h1>ORDER DETAIL</h1>
</div>

<table align="center" border="1" width="90%" class="mt-4">
<tr class="bg-dark text-light text-center">
    <th>Order ID</th>
    <th>Items</th>
    <th>Total</th>
    <th>Name</th>
    <th>Phone</th>
    <th>Address</th>
</tr>

<?php
$query = "SELECT * FROM orders";
$run = mysqli_query($conn, $query);

if(mysqli_num_rows($run) < 1){
    echo "<tr><td colspan='6' align='center'>No data found</td></tr>";
}
else{
    while($data = mysqli_fetch_assoc($run)){
?>

<tr align="center">
    <td><?php echo $data['order_id']; ?></td>
    <td><?php echo $data['items']; ?></td>
    <td><?php echo $data['total']; ?></td>
    <td><?php echo $data['name']; ?></td>
    <td><?php echo $data['phone']; ?></td>
    <td><?php echo $data['address']; ?></td>
</tr>

<?php
    }
}
?>

</table>

</body>
</html>

<?php include('partials/footer.php'); ?>