<?php
include("includes/connection.php");

if(isset($_POST['sign_up'])){
	 $name = mysqli_escape_string($con,$_POST['u_name']);
	 $pass = mysqli_escape_string($con,$_POST['u_pass']);
	 $email = mysqli_escape_string($con,$_POST['u_email']);
	 $country = mysqli_escape_string($con,$_POST['u_country']);
	 $gender = mysqli_escape_string($con,$_POST['u_gender']);
	 $birthday = mysqli_escape_string($con,$_POST['u_birthday']);
	 $status = "unverified";
	 $posts = "no";
	 $ver_code = mt_rand();



	 if(strlen($pass) < 8){
	 	echo "<script>alert('Password must be at least 8 characters long')</script>";
	 	exit();
	 }


	 //Selects all the email users have inserted
	 $getAll_email = "select * from users where user_email = '$email'";
	 //Pass it to the mysql query method for manipulation. Here mysqli_query() method translates the above variable in SQL query.
	 $run_email = mysqli_query($con, $getAll_email);

	 //Check if the email exists in the list
	 $check = mysqli_num_rows($run_email);


	 if($check == 1){
	 	echo "<script>alert('Email already used. Please use another')</script>";
	 	exit();
	 }

	 $insert = "insert into users (user_name, user_pass, user_email, user_country, user_gender, user_birthday,user_image,user_reg_date,status,ver_code,posts) values('$name','$pass','$email','$country','$gender','$birthday','default.jpg',NOW(),'$status','$ver_code','$posts')";

	 $run_query = mysqli_query($con, $insert);

	 if($run_query){
	 	echo "<h3>Hi, $name congratulations! Registration is almost completed. Please check your email for final verification.</h3>";
	 }else {
	 	echo "Registration failed.Try again";
	 }

}

?>