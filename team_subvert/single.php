
<!DOCTYPE html>
<?php
	session_start();
	include('includes/connection.php');
	include('functions/functions.php');
	?>

<html>
<head>
	<!-- <link rel = "stylesheet" type = "text/css" href = "styles/home_style.css">
	 --><title>Single Page</title>
<link rel="stylesheet" type="text/css" href="home_style.css">

<link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
	

	<div class="container">
		<!--Header-->
		<div class="header_wrapper" >
			<div class="header"  >
				<ul class="menu">
					<li><a href="home.php">Home</a></li>
					<li><a href="members.php">Members</a></li>
					<strong>Topics:</strong>
					<?php
						include('includes/connection.php');
						$get_topics = "select * from topics";
						$run_topics = mysqli_query($con,$get_topics);

						while ($row = mysqli_fetch_array($run_topics))
							 {
							$topic_id = $row['topic_id'];
							$topic_name = $row['topic_name'];

							echo "<li> <a href = 'topic.php?topic=$topic_name'>$topic_name</a></li>";
						}
					?>

				</ul>
					<form method="get" action="results.php" class="form1">
						<input type="text" name="user_query" placeholder="Search for a topic">
						<input type="submit" name="search" value="Search" 
						class="home_search">
					</form>
				</div>
			</div>
		<!--Header ends-->


		<!--Content-->
		<div class="content">
			<div class="user_timeline" >
				<div class="user_details" style=" background-image: url('user-bg.jpg'); ">
					<?php
						include('includes/connection.php');
						$user_email = $_SESSION['user_email'];
						$get_user = "select * from users where user_email = '$user_email'";
						$run_user = mysqli_query($con,$get_user);
						//fetches on the array of only one user.Here array is the total columns that is present in the specified user. All the column of one user combined forms a row.
						$row = mysqli_fetch_array($run_user);
						if(!$row){
							echo mysqli_error($con);
							exit();
						}

						$user_id = $row['user_id'];
						$user_name = $row['user_name'];
						$user_country = $row['user_country'];
						$user_image = $row['user_image'];
						$user_reg_date = $row['user_reg_date'];
						$user_last_login = $row['user_last_login'];
					

						$get_posts = "select * from posts where user_id = '$user_id'";
						$run_posts = mysqli_query($con, $get_posts);
						$count_posts = mysqli_num_rows($run_posts);

						//getting the number of unread messages
						$sel_msg = "select * from messages where receiver = '$user_id' AND status ='unread' ORDER by 1 DESC";
						$run_msg = mysqli_query($con,$sel_msg);
						$count_msg = mysqli_num_rows($run_msg);

						echo "
							<center>
							<img src = 'users/user_images/$user_image' alt = 'User Image' width='200' height='200'>
							</center>

							<div id = 'user_mention'>
								<p><strong>Name:</strong> $user_name </p>
								<p><strong>Country:</strong> $user_country </p>
								<p><strong>Last Login:</strong> $user_last_login </p>
								<p><strong>Member Since:</strong> $user_reg_date </p>
								
								<p><strong><a href = 'my_messages.php?inbox&u_id=$user_id'>Messages($count_msg)</a></strong><p>
								<p><strong><a href = 'my_posts.php?u_id=$user_id'>My Posts ($count_posts)</a></strong></p>
								<p><strong><a href = 'edit_profile.php?u_id=$user_id'>Edit My Account</a></strong></p>
								<p><strong><a href = 'logout.php'>Logout</a></strong></p>
							</div>
						";
						

					?>
				</div>
				
			</div>


			<div class="content_timeline">
				
				<h2>View this Discussion</h2>
				<?php display_singlePost(); ?>
			</div>	
		</div>
		<!--Content-->


</div>
<?php 
include("template/footer.php");
 ?>
</body>
</html>