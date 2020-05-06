<?php
//start session
session_start();
//load and initialize user class
include 'user.php';
$user = new User();
if(isset($_POST['signupSubmit'])){
    //check whether user details are empty
    if(!empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['email']) && !empty($_POST['phone']) && !empty($_POST['password']) && !empty($_POST['confirm_password']) && !empty($_POST['gender']) && !empty($_POST['dob']) && !empty($_POST['area'])){
        //password and confirm password comparison
       
		if($_POST['password'] !== $_POST['confirm_password']){
            $sessData['status']['type'] = 'error';
            $sessData['status']['msg'] = 'Confirm password must match with the password.'; 
        }else{
            //check whether user exists in the database
            $prevCon['where'] = array('email'=>$_POST['email']);
            $prevCon['return_type'] = 'count';
            $prevUser = $user->getRows($prevCon);
            if($prevUser > 0){
                $sessData['status']['type'] = 'error';
                $sessData['status']['msg'] = 'Email already exists, please use another email.';
            }else{
                //insert user data in the database
                $userData = array(
                    'first_name' => $_POST['first_name'],
                    'last_name' => $_POST['last_name'],
                    'email' => $_POST['email'],
                    'password' => md5($_POST['password']),
                    'phone' => $_POST['phone'],
					'gender' => $_POST['gender'],
					'dob' => $_POST['dob'],
					'area' => $_POST['area']
                );
				$sessData['email'] = $userData['email'];
			    $sessData['area'] = $userData['area'];
				
				if($_SESSION['done']!=2)
				{	$_SESSION['id']=1;
					$_SESSION['done']=2;
				}	
				$conn = new mysqli("localhost","root", "" , "project");
				 // Check connection
				 if ($conn->connect_error) {
				 die("Connection failed: " . $conn->connect_error);
				 }
				 $name=$_POST['first_name']." ".$_POST['last_name'];
				 $sql1="SELECT aid from advisor where address like '%".$_POST['area']."%'order by rand() limit 1";
				 $result=$conn->query($sql1);
				 if($result ->num_rows >0 ){
					$row=$result -> fetch_assoc();					 
					$aid=$row["aid"];
				 }
				else{
					$sessData['status']['type'] = 'error';
                    $sessData['status']['msg'] = "Advisor couldn't be fount for your area";
				
				}	
				 $sql2="SELECT lid from location where lname='".$_POST['area']."'";
				 $result=$conn -> query($sql2);
				 if($result ->num_rows >0 ){
					$row=$result -> fetch_assoc();					 
					$lid=$row["lid"];
				 }
				else{
					$sessData['status']['type'] = 'error';
                    $sessData['status']['msg'] = "We do not exist in your area yet! We're working on it!!";
					
				}
			     $sql="INSERT INTO farmer (fid,dob,name,gender,lid,aid,phone,email) 
				       VALUES('".strval($_SESSION['id'])."','".$_POST['dob']."','".$name."','".$_POST['gender']."','".$lid."','".$aid."','".$_POST['phone']."','".$_POST['email']."')";
				 if($conn -> query($sql)==TRUE){
					 echo "New record created successfully";
				} else {
							echo "Error: " . $sql . "<br>" . $conn->error;
						}
				$_SESSION['id']=$_SESSION['id']+1;
                 				 
                 $insert = $user->insert($userData);
                //set status based on data insert
                if($insert){
                    $sessData['status']['type'] = 'success';
                    $sessData['status']['msg'] = 'You have registered successfully, log in with your credentials.';
                }else{
                    $sessData['status']['type'] = 'error';
                    $sessData['status']['msg'] = 'Some problem occurred, please try again.';
                }
            }
        }
    }else{
        $sessData['status']['type'] = 'error';
        $sessData['status']['msg'] = 'All fields are mandatory, please fill all the fields.'; 
    }
    //store signup status into the session
    $_SESSION['sessData'] = $sessData;
    $redirectURL = ($sessData['status']['type'] == 'success')?'index.php':'registration.php';
    //redirect to the home/registration page
    header("Location:".$redirectURL);
}elseif(isset($_POST['loginSubmit'])){
    //check whether login details are empty
    if(!empty($_POST['email']) && !empty($_POST['password'])){
    	 //get user data from user class
        $conditions['where'] = array(
            'email' => $_POST['email'],
            'password' => md5($_POST['password']),
            'status' => '1'
        );
        $conditions['return_type'] = 'single';
        $userData = $user->getRows($conditions);
        //set user data and status based on login credentials
        if($userData){
            $sessData['userLoggedIn'] = TRUE;
            $sessData['userID'] = $userData['id'];
			$sessData['email'] = $userData['email'];
			$sessData['area'] = $userData['area'];
            $sessData['status']['type'] = 'success';
            $sessData['status']['msg'] = 'Welcome '.$userData['first_name'].'!';
        }else{
            $sessData['status']['type'] = 'error';
            $sessData['status']['msg'] = 'Wrong email or password, please try again.'; 
        }
    }else{
        $sessData['status']['type'] = 'error';
        $sessData['status']['msg'] = 'Enter email and password.'; 
    }
    //store login status into the session
    $_SESSION['sessData'] = $sessData;
    //redirect to the home page
    header("Location:index.php");
}elseif(!empty($_REQUEST['logoutSubmit'])){
    //remove session data
    unset($_SESSION['sessData']);
    session_destroy();
    //store logout status into the ession
    $sessData['status']['type'] = 'success';
    $sessData['status']['msg'] = 'You have logout successfully from your account.';
    $_SESSION['sessData'] = $sessData;
    //redirect to the home page
    header("Location:index.php");
}else{
    //redirect to the home page
    header("Location:index.php");
}
?>
