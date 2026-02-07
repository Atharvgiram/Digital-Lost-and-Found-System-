<?php
session_start();
include 'db.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Report Item</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container mt-5">
  <h2 class="mb-4 text-primary">Report Lost/Found Item</h2>
  <form action="" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
      <label class="form-label">Title</label>
      <input type="text" name="title" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea name="description" class="form-control" required></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">Category</label>
      <input type="text" name="category" class="form-control">
    </div>
    <div class="mb-3">
      <label class="form-label">Status</label>
      <select name="status" class="form-select" required>
        <option value="lost">Lost</option>
        <option value="found">Found</option>
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Location</label>
      <input type="text" name="location" class="form-control">
    </div>
    <div class="mb-3">
      <label class="form-label">Upload Image</label>
      <input type="file" name="image" class="form-control">
    </div>
    <button type="submit" name="submit" class="btn btn-primary btn-custom">Submit</button>
  </form>
</div>
</body>
</html>

<?php
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $cat = $_POST['category'];
    $status = $_POST['status'];
    $loc = $_POST['location'];
    $user_id = $_SESSION['user_id'];

    $img = "";
    if ($_FILES['image']['name'] != "") {
        $img = "uploads/" . time() . "_" . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "../" . $img);
    }

    $sql = "INSERT INTO items (user_id,title,description,category,status,location,image) 
            VALUES ('$user_id','$title','$desc','$cat','$status','$loc','$img')";
    if ($conn->query($sql)) {
        echo "<div class='alert alert-success text-center mt-3'>Item Reported Successfully!</div>";
    } else {
        echo "<div class='alert alert-danger mt-3'>Error: ".$conn->error."</div>";
    }
}
?>
