<!DOCTYPE html>
<html>
<head >
<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="home.css">
</head>
<style>
table{
	 border-collapse:collapse;
}

table,th,td
{
	   border:1px solid black;
}
</style>
<body>

<div class="dropdown">
    <button class="dropbtn">Buy 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="buy_fertilizer.php">Fertilizers</a>
      <a href="buy_seed.php">Seeds</a>
      <a href="buy_equipment.php">Equipments</a>
    </div>
  </div> 
<div class="dropdown">
    <button class="dropbtn">Information
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="pest.php">Pests</a>
      <a href="crop.php">Crop</a>
      <a href="seed.php">Seed</a>
      <a href="fertilizer.php">Fertilizers</a>
 <!-- <a href="supplier.php">Suppliers</a> -->
    </div>
</div> 
  <div class="navbar">
  <a href="help.php">Need Help?</a>
  <a href="feedback.php">Feedback?</a>
  <a href="home.php">Home</a>
  <a href="userAccount.php?logoutSubmit=1" class="logout">Logout</a>
  <a href="deletefarmer.php">Delete Account</a>
</div>
<?php	
	$conn = new mysqli("localhost","root", "" , "project");
			 // Check connection
	if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
	}
	$sql="SELECT f.name as fname,sf.cost,s.name,s.number,s.address FROM fertilizer f,sell_fertilizer sf,supplier s WHERE sf.fid=f.fid and sf.sid=s.sid";
	$result = $conn->query($sql);
?>
    <table>
    <tr>
		<th>Fertilizer Name</th>
		<th>Cost</th>
		<th>Supplier Name</th>
		<th>Supplier Contact Number</th>
		<th>Supplier Address</th>
	</tr>
<?php	
	if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
					<td>{$row['fname']}</td>
					<td>{$row['cost']}</td>
					<td>{$row['name']}</td>
					<td>{$row['number']}</td>
					<td>{$row['address']}</td>
			  </tr>
             ";			  
    }
} else {
    echo "0 results";
}
?>
	</table>
</body>
</html>