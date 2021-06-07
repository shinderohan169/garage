<?php 
include('commondb.php');

if(isset($_POST['action']) == "getPrice")
{
	$id = $_POST['pid'];

	$sql = "SELECT * FROM `products` WHERE id = $id";
	$res = mysqli_query($conn, $sql);


	while ($row = mysqli_fetch_array($res)) {
		echo $row['price'];
	}
}

?>