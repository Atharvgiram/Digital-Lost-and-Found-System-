<?php
include 'db.php';
$msg = "";

if (isset($_POST['submit'])) {
    $report_id = intval($_POST['report_id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $sql = "INSERT INTO returns (report_id, returnee_name, contact, message) 
            VALUES ('$report_id', '$name', '$contact', '$message')";
    if (mysqli_query($conn, $sql)) {
        $msg = "<div class='alert alert-success'>✅ Item return request submitted successfully!</div>";
    } else {
        $msg = "<div class='alert alert-danger'>❌ Error: " . mysqli_error($conn) . "</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Return Item</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f8f9fa;
    }
    .card {
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      max-width: 600px;
      margin: auto;
    }
  </style>
</head>
<body>

<div class="container mt-5">
  <div class="card p-4">
    <h2 class="text-center mb-3">↩️ Return an Item</h2>
    <?php echo $msg; ?>
    <form method="POST">
      <div class="mb-3">
        <label class="form-label">Item ID (Report ID)</label>
        <input type="number" name="report_id" class="form-control" placeholder="Enter the Report ID of the item" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Your Name</label>
        <input type="text" name="name" class="form-control" placeholder="Enter your full name" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Contact Info</label>
        <input type="text" name="contact" class="form-control" placeholder="Phone or Email" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Message (Optional)</label>
        <textarea name="message" class="form-control" rows="3" placeholder="Any note about the return..."></textarea>
      </div>
      <button type="submit" name="submit" class="btn btn-warning w-100">Submit Return</button>
    </form>
  </div>
</div>

</body>
</html>
