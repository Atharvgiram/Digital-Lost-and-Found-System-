<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Report Item - Lost & Found</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f4f6f9;
    }
    .form-card {
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.1);
      padding: 30px;
      margin-top: 40px;
    }
    .form-card h2 {
      font-weight: 700;
      color: #0d6efd;
      margin-bottom: 20px;
    }
    .btn-custom {
      border-radius: 30px;
      padding: 10px 25px;
      font-size: 1.1rem;
      transition: all 0.3s ease-in-out;
    }
    .btn-custom:hover {
      transform: scale(1.05);
    }
    label {
      font-weight: 500;
    }
    .alert {
      border-radius: 10px;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-7 col-md-9">
      <div class="form-card">
        <h2 class="text-center">📢 Report Lost/Found Item</h2>
        <p class="text-center text-muted mb-4">Fill in the details below to report an item.</p>
        
        <form action="" method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label class="form-label">Title <span class="text-danger">*</span></label>
            <input type="text" name="title" class="form-control" placeholder="e.g. Lost Phone" required>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Description <span class="text-danger">*</span></label>
            <textarea name="description" class="form-control" rows="3" placeholder="Enter details about the item..." required></textarea>
          </div>
          
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Category <span class="text-danger">*</span></label>
              <select name="category" class="form-select" required>
                <option value="">-- Select Category --</option>
                <option value="Electronics">Electronics</option>
                <option value="Documents">Documents</option>
                <option value="Jewelry">Jewelry</option>
                <option value="Accessories">Student Daily Accessories</option>
              </select>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Price Range <span class="text-danger">*</span></label>
              <select name="price_range" class="form-select" required>
                <option value="">-- Select Price Range --</option>
                <option value="100-500">₹100 – ₹500</option>
                <option value="500-5000">₹500 – ₹5000</option>
                <option value="5000+">₹5000+</option>
              </select>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Status <span class="text-danger">*</span></label>
              <select name="status" class="form-select" required>
                <option value="">-- Select Status --</option>
                <option value="lost">Lost</option>
                <option value="found">Found</option>
              </select>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Location</label>
              <input type="text" name="location" class="form-control" placeholder="e.g. Near Auditorium /CR">
            </div>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Upload Image</label>
            <input type="file" name="image" class="form-control">
          </div>
          
          <div class="text-center">
            <button type="submit" name="submit" class="btn btn-primary btn-custom">Report Item</button>
          </div>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $title = mysqli_real_escape_string($conn, $_POST['title']);
            $description = mysqli_real_escape_string($conn, $_POST['description']);
            $category = mysqli_real_escape_string($conn, $_POST['category']);
            $price_range = mysqli_real_escape_string($conn, $_POST['price_range']);
            $status = mysqli_real_escape_string($conn, $_POST['status']);
            $location = mysqli_real_escape_string($conn, $_POST['location']);

            $image = "";
            if (!empty($_FILES['image']['name'])) {
                $image = time() . "_" . basename($_FILES['image']['name']);
                $target = "uploads/" . $image;
                move_uploaded_file($_FILES['image']['tmp_name'], $target);
            }

            $sql = "INSERT INTO reports (title, description, category, price_range, status, location, image)
                    VALUES ('$title', '$description', '$category', '$price_range', '$status', '$location', '$image')";

            if (mysqli_query($conn, $sql)) {
                echo '<div class="alert alert-success mt-3">Item reported successfully!</div>';
            } else {
                echo '<div class="alert alert-danger mt-3">Error: ' . mysqli_error($conn) . '</div>';
            }
        }
        ?>
      </div>
    </div>
  </div>
</div>

</body>
</html>
