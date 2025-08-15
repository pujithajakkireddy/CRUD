<?php
// login.php
// User login form.
require_once 'includes/header.php';
require_once 'includes/db.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $message = '<div class="message error">Username and password are required.</div>';
    } else {
        try {
            // Fetch the user from the database
            $stmt = $pdo->prepare("SELECT id, password FROM users WHERE username = :username");
            $stmt->execute(['username' => $username]);
            $user = $stmt->fetch();

            // Check if user exists and password is correct
            if ($user && password_verify($password, $user['password'])) {
                // Password is correct, set session variables
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $username;
                header("Location: index.php");
                exit();
            } else {
                $message = '<div class="message error">Invalid username or password.</div>';
            }
        } catch (PDOException $e) {
            $message = '<div class="message error">Error: ' . $e->getMessage() . '</div>';
        }
    }
}
?>

<div class="form-container">
    <h2>Login</h2>
    <?php echo $message; ?>
    <form action="login.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Login</button>
    </form>
</div>

<?php require_once 'includes/footer.php'; ?>