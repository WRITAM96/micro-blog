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

    // Get all posts from the database
    $query = "SELECT p.*, u.username FROM posts p INNER JOIN users u ON p.user_id = u.id ORDER BY p.date DESC";
    $result = mysqli_query($conn, $query);
    while ($post = mysqli_fetch_assoc($result)):
?>
    <div class="post-container">
        <div class="post-header">
            <span class="post-username"><?php echo $post['username']; ?></span>
            <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post['user_id']): ?>
                <div class="post-actions">
                    <div class="dropdown">
                        <button onclick="toggleDropdown(event)" class="dropbtn">...</button>
                        <div class="dropdown-menu">
                            <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode(htmlspecialchars($post['text'])); ?>">Tweet</a>
                            <a href="#" onclick="openUpdateModal(<?php echo $post['id']; ?>)">Update</a>
                            <a href="./delete_post.php?post_id=<?php echo $post['id']; ?>">Delete</a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="post-content"><?php echo htmlspecialchars($post['text']); ?></div>
        <div class="post-date"><?php echo date('j M Y g:i A', strtotime($post['date'])); ?></div>
    </div>
<?php endwhile; ?>
</body>

<!-- Update Modal -->
<div id="update-modal" class="modal">
    <div class="modal-content">
        <span id="update-modal-close" class="close">&times;</span>
        <div id="update-modal-content"></div>
    </div>
</div>

<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 9999;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        max-width: 600px;
        max-height: 80vh;
        overflow-y: auto;
        position: relative;
    }

    .close {
        position: absolute;
        top: 10px;
        right: 10px;
        cursor: pointer;
    }
</style>
</html>
<?php } ?>
