<!DOCTYPE html>
<html>
<head>
	<title>My Microblogging Platform</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<header>
		<h1>My Microblogging Platform</h1>
	</header>

	<div id="content">
		<div id="posts">
			<!-- PHP code to display all posts goes here -->
			<?php include 'display_posts.php'; ?>
		</div>

		<form method="post" action="submit_post.php">
			<label for="post_text">What's on your mind?</label>
			<textarea id="post_text" name="post_text" placeholder="Type your post here"></textarea>
			<input type="submit" value="Post">
		</form>
	</div>

	<script type="text/javascript" src="script.js"></script>
</body>
</html>
