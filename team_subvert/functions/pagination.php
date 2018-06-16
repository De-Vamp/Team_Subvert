<?php
	
	// $posts_query = "select * from posts";
	// $run_posts = mysqli_query($con, $posts_query);
	// $count_posts = mysqli_num_rows($run_posts);

	// $total_pages = ceil($count_posts/$per_page);

	// echo "<center>
	// 		<div id = 'pagination'>
	// 		<a href = 'home.php?page=1'>First Page  </a>";

	// for ($i=1; $i < $total_pages; $i++) { 
	// 	echo "<a href ='home.php?page=$i>$i      </a>";
	// }

	// echo "<a href='home.php?page=$total_pages'>Last Page   </a></center>"


$get_posts = "select * from posts";
$run_posts = mysqli_query($con,$get_posts);
$count_posts = mysqli_num_rows($run_posts);
$total_pages = ceil($count_posts/$per_page);

echo "<center>
		<div id = 'pagination'>
		<a href = 'home.php?page=1'><span> First Page </span></a>";

for ($i=2; $i < $total_pages; $i++) { 
	echo "<a href = 'home.php?page=$i'> <span> $i </span> </a>";
}

echo "<a href = 'home.php?page=$total_pages'><span> Last Page </span> </a></div></center>";

?>