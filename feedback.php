<!DOCTYPE html>
<?php
   session_start();
?> 
<html>
<head >
<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
}

input[type=submit] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
</style>
<link rel="stylesheet" href="home.css">
</head>
<body>
<?php
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';
if(!empty($sessData['status']['msg'])){
    $statusMsg = $sessData['status']['msg'];
    $statusMsgType = $sessData['status']['type'];

    unset($_SESSION['sessData']['status']);
}
?>

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

<div class="container" method="post">
  <form action="feedbacksql.php" method="post">
    <label for="comments">Comments</label>
    <textarea id="comments" name="comments" placeholder="Let us have your constructive criticism here.. :)" style="height:200px"></textarea>
    <input type="submit" name="feedbacksubmit">
  </form>
</div>
 <?php echo !empty($statusMsg)?'<p class="'.$statusMsgType.'" style="font-size:20px;color:white;">'.$statusMsg.'</p>':''; ?>

</body>
</html>
