<?php
session_start();

// Logout check
if (isset($_GET["logout"])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
}

// Already logged in check
if (isset($_SESSION["user_id"])) {
    header("Location: dashboard.php");
    exit;
}

$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    // Demo login check
    if ($email === 'knitheesh@gmail.com' && ($password === '12345' || $password === 'demo-only')) {
        $_SESSION["user_id"] = 1;
        $_SESSION["username"] = "student";
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Student Expense Tracker</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body class="login-page">
<div class="login-box">
<h1>Student Expense Tracker</h1>
<p class="muted">Login to manage your expenses</p>
<?php if($error): ?>
<div class="alert error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>
<form method="post">
<label>Email</label>
<input type="email" name="email"
 placeholder="student@example.com" required>
<label>Password</label>
<input type="password" name="password"
 placeholder="12345" required>
<button type="submit">Login</button>
</form>
<p class="hint">Demo: student@example.com / 12345</p>
</div>
</body>
</html>