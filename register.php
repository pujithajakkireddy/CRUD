<?php
// register.php
// User registration form.
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
            // Check if username already exists
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
            $stmt->execute(['username' => $username]);
            if ($stmt->fetchColumn() > 0) {
                $message = '<div class="message error">Username already taken. Please choose another.</div>';
            } else {
                // Hash the password before storing it
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                // Insert the new user into the database
                $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
                $stmt->execute(['username' => $username, 'password' => $hashedPassword]);
                $message = '<div class="message success">Registration successful! You can now <a href="login.php">log in</a>.</div>';
            }
        } catch (PDOException $e) {
            $message = '<div class="message error">Error: ' . $e->getMessage() . '</div>';
        }
    }
}
?>

<div class="form-container">
    <h2>Register</h2>
    <?php echo $message; ?>
    <form action="register.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Register</button>
    </form>
</div>

<?php require_once 'includes/footer.php'; ?>
