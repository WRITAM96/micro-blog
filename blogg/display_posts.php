<?php
	// Load the posts from the posts file
	$posts = array();
	if (file_exists('posts.json')) {
		$posts = json_decode(file_get_contents('posts.json'), true);
	}

	// Loop through the posts and display them
	foreach ($posts as $post) {
		echo '<div class="post">';
		echo '<div class="post_text">' . htmlspecialchars($post['text']) . '</div>';
		echo '<div class="post_date">' . $post['date'] . '</div>';
		echo '</div>';
	}
?>
