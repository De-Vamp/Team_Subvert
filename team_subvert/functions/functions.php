


		  
		
<link rel = "stylesheet" type = "text/css" href = "styles/home_style.css">
	<link rel = "stylesheet" type = "text/css" href = "styles/style.css">

<?php
$con = mysqli_connect("localhost","root","","team_subvert") or die ("Database connection failed");

function getTopics(){
	global $con;

	$get_topics = "select * from topics";
	$run_topics = mysqli_query($con,$get_topics);
	while($row = mysqli_fetch_array($run_topics)){
		$topic_id = $row['topic_id'];
		$topic_name = $row['topic_name'];
		echo "<option value = '$topic_id'>$topic_name</option>";
	}

}


function insertPost(){

	if(isset($_POST['sub'])){

		global $con;
		global $user_id;

		$title = addslashes($_POST['title']);
		$content = addslashes($_POST['content']);
		$topic = $_POST['topic'];

		if($content == '' OR $title == ''){
			echo "<h2>Please do not leave title and description empty</h2>";
			exit();
		}
		else {
			$insert = "insert into posts (user_id,topic_id,post_title,post_content,post_date) values ('$user_id','$topic','$title','$content',NOW())";

			$run_posts = mysqli_query($con,$insert);
			if($run_posts){
				echo "<h2>Congratulation you have successfuly posted a query</h2>";
			}

			$update = "update users set posts ='yes' where user_id = '$user_id'";
			$run_update = mysqli_query($con,$update);
			
			
		}

	}
	
}








function displayPosts(){
	global $con;
	// $per_page = 5;

	// //if the page exists, get it.
	// if (isset($_GET['page'])){
	// 	$page = $_GET['page'];
	// }//else make it one ie, initially the page does not exist
	// else {
	// 	$page = 1;
	// }

	// $start_from = ($page-1) * $per_page;

	$per_page = 5;

	if (isset($_GET['page'])){
		$page = $_GET['page'];
	}else {
		$page = 1;
	}

	$start_from = ($page-1) * $per_page;

	$select_posts = "select * from posts ORDER by 1 DESC LIMIT $start_from, $per_page";
	$run_posts = mysqli_query($con,$select_posts);
	while($row = mysqli_fetch_array($run_posts)) {
		$post_id = $row['post_id'];
		$user_id = $row['user_id'];
		$post_title = $row['post_title'];
		$post_content = substr($row['post_content'],0,100);
		$post_date = $row['post_date'];
		$topic_id = $row['topic_id'];



		$user = "select * from users where user_id = $user_id AND posts = 'yes'";
		$run_user = mysqli_query($con,$user);
		$row_user = mysqli_fetch_array($run_user);

		$user_name = $row_user['user_name'];
		$user_image = $row_user['user_image'];


		//for displaying the topic name
		$topic = "select * from topics where topic_id = $topic_id";
		$run_topic = mysqli_query($con,$topic);
		$row_topic = mysqli_fetch_array($run_topic);
		$topic_name = $row_topic['topic_name'];


		
		echo "<div class = 'posts' style=' width: 800px; border-radius:10px; padding-top :10px; '>
			<p><img src = 'users/user_images/$user_image' width = 50 height = 50 alt = 'user image' style = 'border-radius:10px;'></p>
			<h3><a href = 'user_profile.php?u_id=$user_id'>$user_name</a></h3>
			<h3>$post_title(in $topic_name)</h3>
			<p>$post_date</p>
			<p>$post_content</p>
			<a href = 'single.php?post_id=$post_id' ><button id='reply_btn'>See Replies or Reply to This</button></a>

		</div><br>
		";
	}

	include('pagination.php');

}


function display_singlePost(){
	global $con;

	if(isset($_GET['post_id'])){
		$post_id = $_GET['post_id'];
		$post = "select * from posts where post_id = '$post_id'";
		$run_post = mysqli_query($con,$post);
		$row_post = mysqli_fetch_array($run_post);

			$post_id = $row_post['post_id'];
			$user_id = $row_post['user_id'];
			$post_title = $row_post['post_title'];
			$post_content = $row_post['post_content'];
			$post_date = $row_post['post_date'];
			$topic_id = $row_post['topic_id'];


			//get the user who has posted the thread
		$user = "select * from users where user_id = '$user_id'";
		$run_user = mysqli_query($con,$user);
		$row_user = mysqli_fetch_array($run_user);

			$user_name = $row_user['user_name'];
			$user_image = $row_user['user_image'];

		//For displaying the topic name
		$topic = "select * from topics where topic_id = '$topic_id'";
		$run_topic = mysqli_query($con,$topic);
		$row_topic = mysqli_fetch_array($run_topic);
			$topic_name = $row_topic['topic_name'];


		//Get the user session
		$user_com = $_SESSION['user_email'];
		$get_com = "select * from users where user_email = '$user_com'";
		$run_com = mysqli_query($con,$get_com);
		$row_com = mysqli_fetch_array($run_com);
			$user_com_id = $row_com['user_id'];
			$user_com_name = $row_com['user_name'];



		echo "<div class = 'posts' style='border:1px solid black; width: 800px; border-radius:10px;'>
			<p><img src = 'users/user_images/$user_image' width = 50 height = 50 alt = 'user image' style = 'border-radius:10px;'></p>
			<h3><a href = 'user_profile.php?u_id=$user_id'>$user_name</a></h3>
			<h3>$post_title(in $topic_name)</h3>
			<p>$post_date</p>
			<p>$post_content</p>

		</div><br><br>";


	if (isset($_POST['reply'])){
			$comment = $_POST['comment'];

			$insert = "insert into comments (post_id, user_id, comment, comment_author, date) values ('$post_id', '$user_id', '$comment', '$user_com_name', NOW() )";

			$run_query = mysqli_query($con, $insert);
			echo "<h3 style = 'color:green;'>Congratulation you have successfully posted comment</h3>";
		}
		

		echo "
			<form method = 'post'>
			<textarea rows = '5' cols = '50' name = 'comment' placeholder ='Write your reply' required></textarea><br>
			<input type = 'submit' name = 'reply' value = 'Reply to This' />
			</form><br><br>
		";

		include('comments.php');


	

	}



}



function members(){
	global $con;
	$users = "select * from users";
	$run_user = mysqli_query($con,$users);

	while ($row = mysqli_fetch_array($run_user)){
		$user_id = $row['user_id'];
		$user_name = $row['user_name'];
		$user_image = $row['user_image'];


		echo "
			<span>
			<a href = 'user_profile.php?u_id=$user_id'>
				<img src = 'users/user_images/$user_image' width = 50 height = 50 alt = 'user image' title = '$user_name' style = 'border-radius:10px; margin-top: 30px; margin-left:10px;'>
			</a>
			</span>
		";
	}

}










?>