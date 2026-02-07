<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contact Us - Lost & Found System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f8f9fa;
      padding-top: 80px;
    }
    .contact-box {
      max-width: 600px;
      margin: auto;
      padding: 30px;
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>
<div class="container">
  <div class="contact-box">
    <h2 class="text-center mb-4">Contact Us</h2>
    <form action="contact_submit.php" method="post">
      <div class="mb-3">
        <label>Name</label>
        <input type="text" class="form-control" name="name" required>
      </div>
      <div class="mb-3">
        <label>Email</label>
        <input type="email" class="form-control" name="email" required>
      </div>
      <div class="mb-3">
        <label>Message</label>
        <textarea class="form-control" name="message" rows="5" required></textarea>
      </div>
      <button type="submit" class="btn btn-primary w-100">Send Message</button>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
