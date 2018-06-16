

<!--Content starts here -->
		<div id="content">
			<div id="welcomeImage">
				<img src="images/image.jpg">
			</div>



			<!--Form Contents form here-->
			<div id="form_content">	
				<form id="form2" method="post">
					<center><h1>Sign up here</h1></center>
					<table>
						<tr>
							<td><strong>Name:</strong></td>
							<td><input type="text" name="u_name" required="required" placeholder="Your full name"></td>
						</tr>

						<tr>
							<td><strong>Password:</strong></td>
							<td><input type="password" name="u_pass" required="required" placeholder="Your password"></td>
						</tr>

						
						<tr>
							<td><strong>Email:</strong></td>
							<td><input type="email" name="u_email" required="required" placeholder="Your email"></td>
						</tr>

						

						<tr>
							<td><strong>Country:</strong></td>
							<td>
								<select name="u_country">
									<option>Japan</option>
									<option>Nepal</option>
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
								<button name="sign_up" class="sign_up0">Sign Up</button>
							</td>
						</tr>
					</table>
				</form>
			</div>
			<!--Form Contents ends here-->
			<?php include("insert_user.php"); ?>

		</div>
		<!-- Content ends here-->




