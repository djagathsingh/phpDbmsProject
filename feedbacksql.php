<?php	
	session_start();
    if(isset($_POST['feedbacksubmit']))
	{	if(!empty($_POST['comments']))
		{ 
			$conn = new mysqli("localhost","root", "" , "project");
			if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
			}
			$sessData=$_SESSION['sessData'];
			$sql="select fid from farmer where email='{$sessData['email']}'";
			$result=$conn->query($sql);
			if($result->num_rows == 1 )
			{	$row=$result->fetch_assoc();
				$fid=$row['fid'];
			}
			else
			{	header("Location:feedback.php");
				$sessData['status']['type'] = 'error';
				$sessData['status']['msg'] = 'Some problem occurred, please try again.';
			}
			$sql="insert into feedback values('{$fid}','{$_POST['comments']}')";
			if($conn->query($sql) == TRUE )
			{	header("Location:feedback.php");
				$sessData['status']['type'] = 'success';
				$sessData['status']['msg'] = 'We appreciate your time!!';
			}	
			else
			{	header("Location:feedback.php");
				$sessData['status']['type'] = 'error';
				$sessData['status']['msg'] = 'Some problem occurred, please try again.';
			}
			
		}
		else
		{	
			header("Location:feedback.php");
			$sessData['status']['type'] = 'error';
			$sessData['status']['msg'] = 'Some problem occurred, please try again.';
		}
		$_SESSION['sessData']=$sessData;			
    }
		
?>