<!DOCTYPE html>
<html>
<head >
<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="home.css">
</head>
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
  <a href="help.php">Need Help</a>
  <a href="feedback.php">Feedback</a>
  <a href="home.php">Home</a>
  <a href="userAccount.php?logoutSubmit=1" class="logout">Logout</a>
  <a href="deletefarmer.php">Delete Account</a>
  
</div>
<?php
session_start();
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';
if(!empty($sessData['status']['msg'])){
    $statusMsg = $sessData['status']['msg'];
    $statusMsgType = $sessData['status']['type'];
    unset($_SESSION['sessData']['status']);
}
?>
<div class="container">
    <?php
        if(!empty($sessData['userLoggedIn']) && !empty($sessData['userID'])){
            include 'user.php';
            $user = new User();
            $conditions['where'] = array(
                'id' => $sessData['userID'],
            );
            $conditions['return_type'] = 'single';
            $userData = $user->getRows($conditions);
    ?>
    <h2 style="font-size:55px">Welcome <?php echo $userData['first_name'];
				?>!
	</h2>
    <div class="regisFrm">
        <p style="font-size:32px"><b>Name: </b><?php echo $userData['first_name'].' '.$userData['last_name']; ?></p>
        <p  style="font-size:32px"> <b>Email: </b><?php echo $userData['email']; ?></p>
        <p  style="font-size:32px"><b>Phone: </b><?php echo $userData['phone']; ?></p>
    </div>
		<?php } ?>
</div>	
</body>
</html>