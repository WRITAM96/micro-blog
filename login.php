<?php
    // Start a new session or resume an existing one
    session_start();

    // If the user is already logged in, redirect to the homepage
    if (isset($_SESSION['user_id'])) {
        header('Location: index.php');
        exit;
    }

    // Check if the login form has been submitted
    if (isset($_POST['login'])) {
        // Include the database connection file
        require_once('connection.php');

        // Get the username and password from the form data
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        // Check if the username and password are valid
        $query = "SELECT id FROM users WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            // Set the user ID in the session variable
            $row = mysqli_fetch_assoc($result);
            $_SESSION['user_id'] = $row['id'];

            // Redirect to the homepage
            header('Location: index.php');
            exit;
        } else {
            // Display an error message
            $error = 'Invalid username or password';
        }

        // Close the database connection
        mysqli_close($conn);
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="./css/stylreg.css">
</head>
<body>
    <?php if (isset($error)): ?>
        <div><?php echo $error; ?></div>
    <?php endif; ?> 
<form method="post" action="login.php">
    <div>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username">
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
    </div>
    <div>
        <input type="submit" name="login" value="Login">
    </div>
	<div>Don't have an account? <a href="register.php">Sign up</a></div>
</form>

</body>
</html>