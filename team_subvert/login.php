

<?php
error_reporting(0);
session_start();
include("includes/connection.php");

if(isset($_POST['login'])){
	$email = mysqli_escape_string($con,$_POST['email']);
	$pass = mysqli_escape_string($con,$_POST['pass']);

	$query = "select * from users where user_email = '$email' AND user_pass = '$pass'";

	$run_query = mysqli_query($con, $query);
	$check = mysqli_num_rows($run_query);
	$row = mysqli_fetch_array($run_query);
	$status = $row['status'];
	
	// if(!$row){
	// 	echo mysqli_error($con);
	// 	exit();
	// }


	if ($check == 1 AND $status == 'verified'){
			$_SESSION['user_email'] = $email;
			echo "<script>window.open('home.php')</script>";
		}
		elseif($check != 1)
			echo "<script>alert('Informations do not match, Please try again')</script>";
		  
		elseif($check == 1 && $status == 'unverified')
			echo "<script>alert('We have sent you the verification code. Please verify the email address.')</script>";

		

}



?>