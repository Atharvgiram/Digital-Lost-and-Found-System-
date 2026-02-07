<?php
include 'db.php';

// Handle Approve
if (isset($_GET['approve'])) {
    $id = intval($_GET['approve']);
    mysqli_query($conn, "UPDATE reports SET approved = 1 WHERE id = $id");
    header("Location: manage_reports.php");
    exit;
}

// Handle Reject/Delete
if (isset($_GET['reject'])) {
    $id = intval($_GET['reject']);
    mysqli_query($conn, "DELETE FROM reports WHERE id = $id");
    header("Location: manage_reports.php");
    exit;
}

$result = mysqli_query($conn, "SELECT * FROM reports ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Reports (Admin)</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f8f9fa;
    }
    h2 {
      font-weight: bold;
      color: #dc3545;
    }
    .table img {
      border-radius: 6px;
    }
  </style>
</head>
<body>

<div class="container mt-4">
  <h2 class="text-center mb-4">⚙️ Manage Reported Items</h2>

  <?php if (mysqli_num_rows($result) > 0) { ?>
    <table class="table table-bordered table-striped text-center align-middle">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Image</th>
          <th>Title</th>
          <th>Category</th>
          <th>Price Range</th>
          <th>Status</th>
          <th>Location</th>
          <th>Reported On</th>
          <th>Approved?</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
          <tr>
            <td><?php echo $row['id']; ?></td>
            <td>
              <?php if (!empty($row['image'])) { ?>
                <img src="uploads/<?php echo $row['image']; ?>" width="80" height="60">
              <?php } else { ?>
                <img src="https://via.placeholder.com/80x60?text=No+Image">
              <?php } ?>
            </td>
            <td><?php echo htmlspecialchars($row['title']); ?></td>
            <td><?php echo htmlspecialchars($row['category']); ?></td>
            <td><?php echo htmlspecialchars($row['price_range']); ?></td>
            <td><?php echo ucfirst($row['status']); ?></td>
            <td><?php echo htmlspecialchars($row['location']); ?></td>
            <td><?php echo $row['created_at']; ?></td>
            <td>
              <?php if ($row['approved'] == 1) { ?>
                ✅ Approved
              <?php } else { ?>
                ⏳ Pending
              <?php } ?>
            </td>
            <td>
              <?php if ($row['approved'] == 0) { ?>
                <a href="?approve=<?php echo $row['id']; ?>" class="btn btn-success btn-sm">Approve</a>
              <?php } ?>
              <a href="?reject=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Reject</a>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  <?php } else { ?>
    <div class="alert alert-info text-center">No reports available yet.</div>
  <?php } ?>
</div>

</body>
</html>
