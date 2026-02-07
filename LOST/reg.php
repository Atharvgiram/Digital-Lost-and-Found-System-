<?php
include 'db.php';
session_start();

if (isset($_POST['submit'])) {
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $phone    = $_POST['phone'];
    $password = $_POST['pass'];

    // check if email already exists
    $check_sql = "SELECT * FROM users WHERE email='$email'";
    $check_res = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_res) > 0) {
        echo "<script>
                alert('Email already registered. Please login.');
                window.location.href = 'login.html';
              </script>";
        exit();
    }

    // handle ID card upload
    $idcard     = $_FILES['idcard']['name'];
    $tmp_name   = $_FILES['idcard']['tmp_name'];
    $target_dir = "idcards/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    $file_name   = time() . '_' . basename($idcard);
    $target_file = $target_dir . $file_name;

    if (move_uploaded_file($tmp_name, $target_file)) {
        $sql = "INSERT INTO users (fullname, email, phone, password, idcard, role) 
                VALUES ('$name', '$email', '$phone', '$password', '$file_name', 'user')";
        if (mysqli_query($conn, $sql)) {
            echo "<script>
                    alert('✅ Registration successful. Please login.');
                    window.location.href = 'login.html';
                  </script>";
            exit();
        } else {
            echo "Database Error: " . mysqli_error($conn);
        }
    } else {
        echo "<script>
                alert('❌ Failed to upload ID card.');
                window.location.href = 'login.html';
              </script>";
    }
}
?>
