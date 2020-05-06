
<?php	
	header("Location:sorry.php");
	session_start();
	$sessData=$_SESSION['sessData'];
	$conn = new mysqli("localhost","root", "" , "project");
	if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
	}
	$sql="delete from farmer where email='{$sessData['email']}'";
	$sql1="delete from users where email='{$sessData['email']}'";
	if($conn->query($sql) == TRUE && $conn ->query($sql1)==TRUE)
	{	
		$sessData['status']['type'] = 'success';
        $sessData['status']['msg'] = 'We are sorry to see you leave!! :(';
		$_SESSION['sessData']=$sessData;
		header("Location:sorry.php");
		exit(0);
	}	
	else
	{	
		$sessData['status']['type'] = 'error';
        $sessData['status']['msg'] = 'Some problem occurred, please try again.';
		$_SESSION['sessData']=$sessData;
		header("Location:sorry.php");
		exit(0);
	}
	$_SESSION['sessData']=$sessData;
	header("Location:sorry.php");
	
?>