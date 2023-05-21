<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blog App</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="./css/stextyle.css">
    <link rel="stylesheet" type="text/css" href="./css/dropdown.css">
    <link rel="stylesheet" type="text/css" href="./css/post.css">
    <link rel="stylesheet" type="text/css" href="./css/index.css">
    <link rel="stylesheet" type="text/css" href="./css/navbar.css">
    <style>

    </style>
    <script type="text/javascript" src="./js/script.js"></script>
    <script type="text/javascript" src="./js/dropdown.js"></script>
    <script type="text/javascript" src="./js/wordcount.js"></script>
</head>
<body>
<div class="container">
  <nav class="navbar">
    <a class="navbar__logo" href="#" onclick="scrollToTop()">
      <i class="fab fa-twitter"></i> My Blog App
    </a>
    <div class="navbar__links">
      <a class="navbar__link" href="#" onclick="scrollToTop()">
        <i class="fas fa-home"></i> Home
      </a>
      <a class="navbar__link" href="#">
        <i class="far fa-envelope"></i> Direct Message
      </a>
      <a class="navbar__link" href="#">
        <i class="far fa-bell"></i> Notifications
      </a>
      <a class="navbar__link" href="#">
        <i class="far fa-user"></i> Profile
      </a>
      <a class="navbar__link" href="#">
        <i class="far fa-bookmark"></i> Bookmarks
      </a>
      <a class="navbar__link" href="#">
        <i class="fas fa-ellipsis-h"></i> More
      </a>
      <a class="navbar__link" href="logout.php">
        <i class="fas fa-sign-out-alt"></i> Logout
      </a>
    </div>
  </nav>
  <div id="explore">
    <h2>Explore</h2>
    <!-- Add your explore content here -->
  </div>
  <h2 class="post-heading">Posts</h2>
  <div id="posts">
    <!-- PHP code to display all posts goes here -->
    <?php include 'display_posts.php'; ?>
  </div>
  <div id="create-post">
    <!-- PHP code to create a new post goes here -->
    <?php include 'create_post.php'; ?>
  </div>
</div>
</body>
</html>
