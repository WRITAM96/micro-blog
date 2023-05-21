<?php 
    // Start the session if it hasn't been started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    // If the user is not logged in, redirect to the login page
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>My Blog App</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-ia/Vt1I+9y8f7RRzLZv+fsZMzBKDj3q+b3u2QJbEAd+loMy9X3qOgKj2ic/DYvkPOOZPuA8pUfR6R+cPx6U5sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
            /* Style the navigation bar */
            .navbar {
                background-color: #333;
                overflow: hidden;
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 10px;
            }

            /* Style the links inside the navigation bar */
            .navbar a {
                color: white;
                text-align: center;
                text-decoration: none;
                font-size: 20px;
                margin: 0 10px;
            }

            /* Change the color of links on hover */
            .navbar a:hover {
                background-color: #ddd;
                color: black;
            }

            /* Add an active class to the current link */
            .active {
                background-color: #4CAF50;
                color: white;
            }

            /* Style the blog name */
            .blog-name {
                font-size: 28px;
                font-weight: bold;
                color: white;
                margin-left: 10px;
            }

            /* Align the navigation links to the right */
            .nav-links {
                display: flex;
                align-items: center;
            }
        </style>
    </head>
    <body>
        <!-- Navigation Bar -->
        <div class="navbar">
            <div>
                <span class="blog-name">My Blog App</span>
            </div>
            <div class="nav-links">
                <a href="index.php"><i class="fas fa-home"></i> Home</a>
                <a href="create_post.php"><i class="fas fa-pencil-alt"></i> Create Post</a>
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>
    </body>
</html>
