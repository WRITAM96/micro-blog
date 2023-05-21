<?php
    // Start a new session or resume an existing one
    session_start();

    // If the user is already logged in, redirect to the homepage
    if (isset($_SESSION['user_id'])) {
        header('Location: index.php');
        exit;
    }

    // Step 1: Get email and password from the user
    if (isset($_POST['step1_submit'])) {
        // Include the database connection file
        require_once('connection.php');

        // Get the form data
        $email = mysqli_real_escape_string($conn, trim($_POST['email']));
        $password = mysqli_real_escape_string($conn, trim($_POST['password']));

        // Generate and send OTP to user's email
        $otp = generateOTP(); // Generate OTP
        sendOTP($email, $otp); // Send OTP to user's email

        // Store the email, password, and OTP in session variables
        $_SESSION['register_email'] = $email;
        $_SESSION['register_password'] = $password;
        $_SESSION['register_otp'] = $otp;

        // Proceed to step 2: OTP verification
        $step = 2;

        // Close the database connection
        mysqli_close($conn);
    }

    // Step 2: Verify OTP and create the user account
    if (isset($_POST['step2_submit'])) {
        // Include the database connection file
        require_once('connection.php');

        // Get the form data
        $otp = mysqli_real_escape_string($conn, trim($_POST['otp']));

        // Validate the OTP
        $storedOTP = $_SESSION['register_otp'];

        if ($otp !== $storedOTP) {
            $error = 'Invalid OTP';
        } else {
            // Get email and password from session variables
            $email = $_SESSION['register_email'];
            $password = $_SESSION['register_password'];

            // Check if the email already exists in the database
            $query = "SELECT id FROM users WHERE email='$email'";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                $error = 'Email already exists';
            } else {
                // Insert the new user into the database
                $query = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
                mysqli_query($conn, $query);

                // Get the ID of the new user
                $user_id = mysqli_insert_id($conn);

                // Set the user ID in the session variable
                $_SESSION['user_id'] = $user_id;

                // Redirect to the homepage or the upload option interface
                // Modify the following line according to your requirements
                header('Location: upload_option.php');
                exit;
            }
        }

        // Close the database connection
        mysqli_close($conn);
    }

    // Function to generate OTP
    function generateOTP() {
        // Generate a random 6-digit number
        $otp = rand(100000, 999999);

        return $otp;
    }

// Function to send OTP to user's email
function sendOTP($email, $otp) {
    $subject = 'OTP Verification';
    $message = 'Your OTP is: ' . $otp;
    $headers = 'From: your_email@example.com' . "\r\n" .
               'Reply-To: your_email@example.com' . "\r\n" .
               'X-Mailer: PHP/' . phpversion();

    if (mail($email, $subject, $message, $headers)) {
        echo "done";
    } else {
        echo 'Error sending email. Please check your email configuration.';
    }
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

    <?php if (!isset($step) || $step === 1): ?>
        <!-- Step 1: Get email and password -->
        <form method="post" action="register.php">
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email">
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password">
            </div>
            <div>
                <input type="submit" name="step1_submit" value="Proceed to Step 2">
            </div>
            <div>Already have an account? <a href="login.php">Log in</a></div>
        </form>
    <?php elseif ($step === 2): ?>
        <!-- Step 2: Verify OTP -->
        <form method="post" action="register.php">
            <div>
                <label for="otp">Enter OTP:</label>
                <input type="text" id="otp" name="otp">
            </div>
            <div>
                <input type="submit" name="step2_submit" value="Verify OTP">
            </div>
        </form>
    <?php endif; ?>
</body>
</html>
