
<!DOCTYPE html>
<?php
	error_reporting(0);
	session_start();

	include('includes/connection.php');
	include('functions/functions.php');

?>
	
<html>
<head>
	<title>HomePage</title>
	<link rel = "stylesheet" type = "text/css" href = "styles/home_style.css">
	<link rel = "stylesheet" type = "text/css" href = "styles/style.css">
	<link rel = "stylesheet" type = "text/css" href = "styles/index.css">

	<!-- <style type="text/css" media="screen">
	 -->
	
</head>
<body>
	

	<div class="container">
		<!--Header-->
		<div class="header_wrapper">
			<!-- <img src="logo.png" id="img_log">
 -->			<div class="header">
				<ul class="menu">
					<li><a href="home.php" class="header_id">Home</a></li>
					<li><a href="members.php" class="header_id">Members</a></li>
					<strong class="header_id"> Topics:</strong>
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
						<input type="text" name="user_query" placeholder="Search for a topic" class="search_box">
						<input type="submit" name="search" value="Search" 
						class="home_search">
					</form>
				</div>
			</div>
		<!--Header ends-->


		<!--Content-->
		<div class="content">
			<div class="user_timeline">
				<div class="user_details">
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
				<h1>What's your question today? Let's discuss!</h1>
				<form action="home.php?id=<?php echo $user_id; ?>" class="fm" method="post">
					<input type="text" name="title" placeholder="Write the title" size="84" required  class="fm_questions"><br>
					<textarea cols="83" rows="5" placeholder="Write description" name="content" class="fm_questions"></textarea><br>
					<select name="topic">	
						<option>Select Topic</option>
						<?php getTopics(); ?>
					</select>
					<input type="submit" name="sub" value="Post to Timeline"
					class="post_submit">
				</form>
				<?php insertPost(); ?>
				<h2>Most Recent Discussion</h2>
				<?php displayPosts(); ?>
			</div>	
		</div>
		<!--Content-->


</div>
<?php 
include("template/footer.php");
 ?>
</body>
</html>