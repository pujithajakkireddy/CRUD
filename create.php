<?php
// create.php
// Form to add new posts.
require_once 'includes/header.php';
require_once 'includes/db.php';


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$title = '';
$context = ''; 
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $context = trim($_POST['context']); 

    if (empty($title) || empty($context)) {
        $message = '<div class="message error">Title and context are required.</div>';
    } else {
        try {
          
            $stmt = $pdo->prepare("INSERT INTO posts (title, context) VALUES (:title, :context)");
            $stmt->execute(['title' => $title, 'context' => $context]);
            $message = '<div class="message success">Post created successfully! <a href="index.php">View Posts</a></div>';
            $title = '';
            $context = '';
        } catch (PDOException $e) {
            $message = '<div class="message error">Error creating post: ' . $e->getMessage() . '</div>';
        }
    }
}
?>

<div class="form-container">
    <h2>Create a New Post</h2>
    <?php echo $message; ?>
    <form action="create.php" method="post">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($title); ?>" required>

        <label for="context">Content:</label> 
        <textarea id="context" name="context" rows="10" required><?php echo htmlspecialchars($context); ?></textarea>

        <button type="submit">Create Post</button>
    </form>
</div>

<?php require_once 'includes/footer.php'; ?>
