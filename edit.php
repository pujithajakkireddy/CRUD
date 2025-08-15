<?php

require_once 'includes/header.php';
require_once 'includes/db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$message = '';
$post = null;

// Check if a post ID is provided in the URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid post ID.");
}

$postId = $_GET['id'];

// Handle form submission for updating a post
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    if (empty($title) || empty($content)) {
        $message = '<div class="message error">Title and content are required.</div>';
    } else {
        try {
            // Prepare the SQL statement to prevent SQL injection
            $stmt = $pdo->prepare("UPDATE posts SET title = :title, content = :content WHERE id = :id");
            $stmt->execute(['title' => $title, 'content' => $content, 'id' => $postId]);
            $message = '<div class="message success">Post updated successfully! <a href="index.php">View Posts</a></div>';
        } catch (PDOException $e) {
            $message = '<div class="message error">Error updating post: ' . $e->getMessage() . '</div>';
        }
    }
}

// Fetch the post data to pre-fill the form
try {
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE id = :id");
    $stmt->execute(['id' => $postId]);
    $post = $stmt->fetch();

    if (!$post) {
        die("Post not found.");
    }
} catch (PDOException $e) {
    die("Error fetching post: " . $e->getMessage());
}

?>

<div class="form-container">
    <h2>Edit Post</h2>
    <?php echo $message; ?>
    <form action="edit.php?id=<?php echo $postId; ?>" method="post">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required>

        <label for="content">Content:</label>
        <textarea id="content" name="content" rows="10" required><?php echo htmlspecialchars($post['content']); ?></textarea>

        <button type="submit">Update Post</button>
    </form>
</div>

<?php require_once 'includes/footer.php'; ?>

