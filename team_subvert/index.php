<!DOCTYPE html>
<html>
<head>
	<title>index</title>
	<link rel = "stylesheet" type = "text/css" href = "styles/index.css">
	<style type="text/css" media="screen">
		body{
		background-image: url('bg.jpg');
	}	
	</style>
</head>
<body >

	<!-- <div class="header_wrapper"> -->
		<div class="header_right">
			<a href="home.php" class="header_cont_text">Home</a>
			<a href="members.php" class="header_cont_text">Topics</a>
		</div>
		<!-- <div class="header_left"> -->
			<form method="get" action="results.php" class="home_search">	
					<input type="text" name="user_query" placeholder="Search for a topic" class="home_search_text_values">
				<input type="submit" name="search" value="Search" 
				class="home_search_btn">
			</form>
		<!-- </div>		 -->
	<!-- </div> -->
		<!--Header ends-->

	<div class='main'>
		<div class="logo">
			<img src="logo.png" id="img_log">
		</div>
		<div class="information">
			<p style="color: #034726; font-size: 40px;"> <b> The reason why Prima is helpful :</b></p>
			<p  style="text-decoration: bold; color: #034726; font-size: 25px;">
				<b> &#187; Professional help form different people</b><br>
				<b> &#187; Sharing of ideas</b><br>
				<b> &#187; Quick response to your question</b><br>
				<b> &#187; Higher accuracy to your answers</b><br>
			</p>

			
		</div>
	<!-- 	<div id="LoginSignupContMain"> -->
			
	
		<div class="login_cont">
			<input type="button" name="login" id="login_btn" value="Log in" onclick="login();">
			
		</div>
		<div  id="login_form">
			<form method = "post" id="form1">
				<center><h1>Log in Here</h1>
				<table id="main_form_cont">
					<tr>
						<td><strong>Email:</strong></td>
						<td><input type="email" name="email" placeholder="Email..." required="required"></td>
					</tr>

					<tr>
						<td><strong>Password:</strong></td>
						<td><input type="password" name="pass" placeholder="Password..." required="required"></td>
					</tr>
					<tr>
						<td><button id="log_in0" name="login">Log In</button></td>
					</tr>
				</table></center>
					
					
					
				</form>
			
		</div>
		<div class="signup_cont" >
		 <input type="button" name="Sign up" value="Sign Up"  id="signup_btn" onclick="signup();">
		</div>
		<div id="signup_form">
			<!--Form Contents form here-->
			<div id="form_content">	
				<form id="form2" method="post">
					<center><h1>Sign up here</h1>
					<table id="main_form_cont">
						<tr>
							<td><strong>Name:</strong></td>
							<td><input type="text" name="u_name" required="required" placeholder="Your full name"></td>
						</tr>

						<tr>
							<td><strong>Email:</strong></td>
							<td><input type="email" name="u_email" required="required" placeholder="Your email"></td>
						</tr>

						<tr>
							<td><strong>Password:</strong></td>
							<td><input type="password" name="u_pass" required="required" placeholder="Your password"></td>
						</tr>
						<tr>
							<td><strong>Country:</strong></td>
							<td>
								<select name="u_country">
									<option>Nepal</option>
									<option>Japan</option>
									<option>China</option>
									<option>U.S.A</option>
									<option>U.K</option>
									<option>Austria</option>
									<option>Iraq</option>
									<option>India</option>
									<option>Thiland</option>
									<option>Bhutan</option>
									<option>Sri lanka</option>
									<option>Africa</option>
								</select>
							</td>
						</tr>

						<tr>
							<td><strong>Gender:</strong></td>
							<td>
								<select name="u_gender">
									<option>Male</option>
									<option>Female</option>
									
								</select>
								<!-- <input type="radio" name="u_gender">Male
								<input type="radio" name="u_gender">Female -->
							</td>
						</tr>

						<tr>
							<td><strong>Date of Birth:</strong></td>
							<td><input type="date" name="u_birthday" required="required"></td>
						</tr>

						<tr>
							<td colspan="2">
								<button name="sign_up" id="sign_up0">Sign Up</button>
							</td>
						</tr>
					</table></center>
				</form>
			</div>
			<!--Form Contents ends here-->
			<?php include("insert_user.php"); ?>

		</div>
		<!-- Content ends here-->

			

		<?php 
			include("login.php");
		 ?>
	</div>
	
	<div id="foooter">
			<center><h3 id="foooter_text"> &copy; Prima's Inc 2018. All Rights Reserved. </center> 
			</h3>
	</div>

	<script type="text/javascript">
		function signup()
		{
			document.getElementById('login_form').style.display='none';
			document.getElementById('signup_form').style.display='block';

		}
		function login(){
			document.getElementById('signup_form').style.display='none';
			document.getElementById('login_form').style.display='block';
		}
	</script>
</body>
</html>