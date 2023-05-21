<?php
	// Get the post text from the form data
	$post_text = $_POST['post_text'];

	// Create a new post object with the text and current date/time
	$post = array(
		'text' => $post_text,
		'date' => date('Y-m-d H:i:s')
	);

	// Add the post to the posts file
	$posts = array();
	if (file_exists('posts.json')) {
		$posts = json_decode(file_get_contents('posts.json'), true);
	}
	$posts[] = $post;
	file_put_contents('posts.json', json_encode($posts));

	// Redirect back to the homepage
	header('Location: index.php');
	exit;
?>
