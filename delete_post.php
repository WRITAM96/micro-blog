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
        // Get the post ID from the form
        echo $post_id = $_REQUEST['post_id'];

        // Load the database connection
        require_once('connection.php');

        // Delete the post from the database
        mysqli_query($conn, "DELETE FROM posts WHERE id='$post_id'");

        // Close the database connection
        mysqli_close($conn);

        // Redirect back to the display posts page
        header("Location: index.php");
        exit;
	}
?>
