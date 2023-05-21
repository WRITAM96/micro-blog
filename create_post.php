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

<form method="post" action="submit_post.php">
    <label for="post_text">What's on your mind?</label>
    <textarea id="post_text" name="post_text" maxlength="250" placeholder="<?php echo json_decode(@file_get_contents("https://api.quotable.io/random"),1)["content"]; ?>" oninput="updateCharacterCount()"></textarea>
    <div class="word-counter" id="char_counter">Character count: 0</div>
    <input type="submit" id="post_button" value="Post">
</form>

