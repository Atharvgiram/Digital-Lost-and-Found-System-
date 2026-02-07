<?php
include 'db.php';

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['em']);
    $password = mysqli_real_escape_string($conn, $_POST['pas']); // plain text

    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND password='$password'");
    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        session_start();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['fullname'] = $row['fullname'];

        echo "<script>
                alert('Login successful! Welcome, ".$row['fullname']."');
                window.location.href='index.php';
              </script>";
    } else {
        echo "<script>
                alert('Incorrect email or password.');
                window.location.href='login.html';
              </script>";
    }
}
?>
