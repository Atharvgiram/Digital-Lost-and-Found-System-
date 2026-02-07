<?php
session_start();
include 'db.php';

if (isset($_POST['register'])) {
    $name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // File upload handling
    $id_card = $_FILES['id_card']['name'];
    $tmp_name = $_FILES['id_card']['tmp_name'];
    $target_dir = "uploads/";
    $file_name = time() . "_" . basename($id_card);
    $target_file = $target_dir . $file_name;

    if (move_uploaded_file($tmp_name, $target_file)) {
        $sql = "INSERT INTO users (full_name, email, password, id_card, role) 
                VALUES ('$name', '$email', '$password', '$file_name', 'user')";
        if ($conn->query($sql)) {
            $_SESSION['success'] = "Registration successful. Please login.";
            header("Location: login.php");
            exit();
        } else {
            $error = "Error: " . $conn->error;
        }
    } else {
        $error = "Failed to upload ID card.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Registration</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow-lg rounded-3">
          <div class="card-body">
            <h3 class="card-title text-center mb-4">User Registration</h3>
            
            <?php if (isset($error)): ?>
              <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>
            <?php if (isset($_SESSION['success'])): ?>
              <div class="alert alert-success"><?= $_SESSION['success'] ?></div>
              <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <form action="" method="POST" enctype="multipart/form-data">
              <div class="mb-3">
                <label for="full_name" class="form-label">Full Name</label>
                <input type="text" name="full_name" id="full_name" class="form-control" required>
              </div>
              
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
              </div>

              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
              </div>

              <div class="mb-3">
                <label for="id_card" class="form-label">Upload ID Card</label>
                <input type="file" name="id_card" id="id_card" class="form-control" accept=".jpg,.jpeg,.png,.pdf" required>
              </div>

              <div class="d-grid">
                <button type="submit" name="register" class="btn btn-primary">Register</button>
              </div>
            </form>

            <div class="text-center mt-3">
              <p>Already have an account? <a href="login.php">Login here</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
