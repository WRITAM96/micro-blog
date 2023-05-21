<?php
      // Start the session if it hasn't been started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    // If the user is not logged in, redirect to the login page
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    } else {
		// Include the database connection file
    require_once('connection.php');

    // Get the post text from the form data
    $post_text = $_POST['post_text'];

		// Get the current user's ID
    $user_id = $_SESSION['user_id'];

    // Check if the user ID exists in the users table
    $query = "SELECT id FROM users WHERE id = '{$user_id}'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 0) {
        // User ID not found, redirect to an error page or show an error message
        header('Location: error.php');
        exit;
    }

    // Set timezone to Asia/Kolkata
    date_default_timezone_set('Asia/Kolkata');
    
    // Create a new post object with the text and current date/time
    $post = array(
    'text' => $post_text,
    'date' => date("j M Y g:i:s A"),
    'user_id' => $user_id,
    'hidden' => false
	);

    // Insert the post into the database
    $query = "INSERT INTO posts (id, user_id, text, date, hidden) VALUES (".substr(bin2hex(md5($user_id.$post_text)),0,5).", '{$post['user_id']}', '{$post['text']}', '{$post['date']}', '{$post['hidden']}')";
    mysqli_query($conn, $query);

    // Close the database connection
    mysqli_close($conn);

    // Redirect back to the homepage
    header('Location: index.php');
    exit;
	}
?>
