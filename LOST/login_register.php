<?php
session_start();
include 'db.php';

// Enable error reporting for debugging
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// ========================
// Handle Registration
// ========================
$reg_success = $reg_error = "";
if (isset($_POST['register'])) {
    $fullname = $conn->real_escape_string($_POST['fullname']);
    $email    = $conn->real_escape_string($_POST['email']);
    $phone    = $conn->real_escape_string($_POST['phone']);
    $password = md5($_POST['password']); // MD5 for older PHP
    $role     = 'user'; // default role

    // Check if email already exists
    $check = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($check->num_rows > 0) {
        $reg_error = "Email already registered!";
    } else {
        $sql = "INSERT INTO users (fullname, email, password, phone, role, created_at)
                VALUES ('$fullname', '$email', '$password', '$phone', '$role', NOW())";
        if ($conn->query($sql)) {
            $reg_success = "Registration successful! You can now log in.";
        } else {
            $reg_error = "Registration failed: " . $conn->error;
        }
    }
}

// ========================
// Handle Login
// ========================
$login_error = "";
if (isset($_POST['login'])) {
    $email = $conn->real_escape_string($_POST['email']);
    $password = md5($_POST['password']); // MD5

    $res = $conn->query("SELECT * FROM users WHERE email='$email' AND password='$password' LIMIT 1");
    if ($res && $res->num_rows == 1) {
        $user = $res->fetch_assoc();
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['fullname'] = $user['fullname'];
        $_SESSION['role'] = $user['role'];

        // Redirect based on role
        if ($user['role'] === 'admin') {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: index.php");
        }
        exit();
    } else {
        $login_error = "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Lost & Found - Login/Register</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body {
    background: linear-gradient(to right, #6a11cb, #2575fc);
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: 'Segoe UI', sans-serif;
}
.card {
    border-radius: 15px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.3);
}
.card-header {
    text-align: center;
    font-weight: bold;
    font-size: 1.5rem;
    color: white;
    background: #2575fc;
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
}
.btn-custom {
    background: #6a11cb;
    color: white;
}
.btn-custom:hover {
    background: #2575fc;
    color: white;
}
.alert { font-size: 0.9rem; }
.switch-link {
    cursor: pointer;
    color: #2575fc;
    text-decoration: underline;
}
</style>
<script>
function toggleForms() {
    document.getElementById('loginForm').classList.toggle('d-none');
    document.getElementById('registerForm').classList.toggle('d-none');
}
</script>
</head>
<body>

<div class="card p-3" style="width: 400px;">
    <div class="card-header">
        Lost & Found
    </div>

    <!-- LOGIN FORM -->
    <div id="loginForm">
        <?php if($login_error) echo "<div class='alert alert-danger mt-2'>$login_error</div>"; ?>
        <?php if($reg_success) echo "<div class='alert alert-success mt-2'>$reg_success</div>"; ?>
        <form method="post" class="mt-3">
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" name="login" class="btn btn-custom w-100">Login</button>
        </form>
        <p class="mt-3 text-center">Don't have an account? <span class="switch-link" onclick="toggleForms()">Register here</span></p>
    </div>

    <!-- REGISTER FORM -->
    <div id="registerForm" class="d-none">
        <?php if($reg_error) echo "<div class='alert alert-danger mt-2'>$reg_error</div>"; ?>
        <form method="post" class="mt-3">
            <div class="mb-3">
                <label>Full Name</label>
                <input type="text" name="fullname" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" name="register" class="btn btn-custom w-100">Register</button>
        </form>
        <p class="mt-3 text-center">Already have an account? <span class="switch-link" onclick="toggleForms()">Login here</span></p>
    </div>
</div>

</body>
</html>
