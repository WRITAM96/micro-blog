<?php
    // Start a new session or resume an existing one
    session_start();

    // If the user is already logged in, redirect to the homepage
    if (isset($_SESSION['user_id'])) {
        header('Location: index.php');
        exit;
    }

    // Check if the registration form has been submitted
    if (isset($_POST['register'])) {
        // Include the database connection file
        require_once('connection.php');

        // Get the form data
        $username = mysqli_real_escape_string($conn, trim($_POST['username']));
        $password = mysqli_real_escape_string($conn, trim($_POST['password']));
        $confirm_password = mysqli_real_escape_string($conn, trim($_POST['confirm_password']));

        // Check if the password and confirm password match
        if ($password != $confirm_password) {
            $error = 'Password and confirm password do not match';
        } else {
            // Check if the username already exists in the database
            $query = "SELECT id FROM users WHERE username='$username'";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                $error = 'Username already exists';
            } else {
                // Insert the new user into the database
                $query = "INSERT INTO users (id, username, password, is_admin) VALUES (".substr(bin2hex(md5($password.$username)),0,5).", '$username', '$password', false)";
                mysqli_query($conn, $query);

                // Get the ID of the new user
                $user_id = mysqli_insert_id($conn);

                // Set the user ID in the session variable
                $_SESSION['user_id'] = $user_id;

                // Redirect to the homepage
                header('Location: index.php');
                exit;
            }
        }

        // Close the database connection
        mysqli_close($conn);
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="./css/stylreg.css">
</head>
<body>
    <?php if (isset($error)): ?>
        <div><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="post" action="register.php">
        <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username">
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
        </div>
        <div>
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password">
        </div>
        <div>
            <input type="submit" name="register" value="Register">
        </div>
		<div>Already have an account? <a href="login.php">Log in</a></div>
    </form>
    
    <div> </div>
</body>
</html>
