<?php
// index.php
// Home page - displays all posts.

// Include the necessary files
require_once 'includes/db.php';
require_once 'includes/header.php';

// Fetch all posts from the database, ordered by creation date
try {
    $stmt = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC");
    $posts = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Error fetching posts: " . $e->getMessage());
}

?>

<h2 style="text-align: center;">All Posts</h2>

<?php if (empty($posts)): ?>
    <p style="text-align: center;">No posts found. Why not create one?</p>
<?php else: ?>
    <?php foreach ($posts as $post): ?>
        <div class="post">
            <h2><?php echo htmlspecialchars($post['title']); ?></h2>
            <p class="post-meta">Posted on <?php echo date('F j, Y', strtotime($post['created_at'])); ?></p>
            <div class="post-content">
                <!-- I have updated this line to use 'context' -->
                <?php echo nl2br(htmlspecialchars($post['context'])); ?>
            </div>
            <?php if (isset($_SESSION['user_id'])): ?>
                <div class="post-actions">
                    <a href="edit.php?id=<?php echo $post['id']; ?>">Edit</a>
                    <a href="delete.php?id=<?php echo $post['id']; ?>" onclick="return confirm('Are you sure you want to delete this post?');">Delete</a>
                </div>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<?php require_once 'includes/footer.php'; ?>
