<?php
    error_reporting(0);
    // Start the session if it hasn't been started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // If the user is not logged in, redirect to the login page
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    } else {
        // Check if the form has been submitted
        if (isset($_POST['submit'])) {
            // Validate the form data
            $post_id = $_POST['post_id'];
            $text = trim($_POST['text']);
            $errors = array();

            if (empty($text)) {
                $errors[] = 'Text is required.';
            } else if (strlen($text) > 250) {
                $errors[] = 'Text must be no more than 250 characters.';
            }

            // If there are no errors, update the post in the database
            if (empty($errors)) {
                require_once('connection.php');
                $text = mysqli_real_escape_string($conn, $text);
                $sql = "UPDATE posts SET text='$text' WHERE id=$post_id";
                if (mysqli_query($conn, $sql)) {
                    mysqli_close($conn);
                    header('Location: index.php');
                    exit;
                } else {
                    $errors[] = 'An error occurred while updating the post.';
                }
            }
        } else {
            // Load the post data from the database
            if (isset($_GET['post_id'])) {
                $post_id = $_GET['post_id'];
                require_once('connection.php');
                $result = mysqli_query($conn, "SELECT * FROM posts WHERE id=$post_id");
                if ($result && mysqli_num_rows($result) > 0) {
                    $post = mysqli_fetch_assoc($result);
                } else {
                    header('Location: index.php');
                    exit;
                }
                mysqli_close($conn);
            } else {
                header('Location: index.php');
                exit;
            }
        }
    }
?>
<h1>Update Post</h1>
<?php if (!empty($errors)) { ?>
    <div class="error">
        <ul>
            <?php foreach ($errors as $error) { ?>
                <li><?php echo $error; ?></li>
            <?php } ?>
        </ul>
    </div>
<?php } ?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
    <label for="text">Text:</label>
    <textarea name="text" id="post_text" rows="5" maxlength="250"><?php echo $post['text']; ?></textarea>
    <br>
    <input type="submit" name="submit" id="post_button" value="Update">
</form>   