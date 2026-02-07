<?php
include 'db.php';

// Fetch only items that are NOT resolved, to be shown to the public
$sql = "SELECT * FROM reports WHERE resolved = 0 ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View Items</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f8f9fa;
    }
    h2 {
      font-weight: bold;
      color: #0d6efd;
    }
    .card {
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      transition: transform 0.2s;
    }
    .card:hover {
      transform: translateY(-5px);
    }
    .card img {
  height: 200px;
  object-fit: contain;  /* Show full image */
  width: 100%;
  background: #f8f9fa;  /* Add background for empty space */
  padding: 5px;         /* Prevent image from touching edges */
}

    }
    .badge {
      font-size: 0.9rem;
      padding: 6px 10px;
      border-radius: 8px;
    }
  </style>
</head>
<body>

<div class="container mt-4">
  <h2 class="text-center mb-4">📋 Available Items</h2>

  <div class="row g-4">
    <?php if (mysqli_num_rows($result) > 0) { ?>
      <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="col-md-4">
          <div class="card">
            <?php if (!empty($row['image'])) { ?>
              <img src="uploads/<?php echo $row['image']; ?>" alt="Item Image">
            <?php } else { ?>
              <img src="https://via.placeholder.com/300x200?text=No+Image" alt="No Image">
            <?php } ?>
            <div class="card-body">
              <h5 class="card-title"><?php echo htmlspecialchars($row['title']); ?></h5>
              <p class="card-text"><?php echo nl2br(htmlspecialchars($row['description'])); ?></p>
              
              <ul class="list-group list-group-flush mb-3">
                <li class="list-group-item"><strong>Category:</strong> 
                    <span class="badge bg-primary"><?php echo htmlspecialchars($row['category']); ?></span>
                </li>
                <li class="list-group-item"><strong>Price Range:</strong> 
                    <span class="badge bg-warning text-dark"><?php echo htmlspecialchars($row['price_range']); ?></span>
                </li>
                <li class="list-group-item"><strong>Status:</strong> 
                    <?php if ($row['status'] == 'lost') { ?>
                        <span class="badge bg-danger">Lost</span>
                    <?php } else { ?>
                        <span class="badge bg-success">Found</span>
                    <?php } ?>
                </li>
                <li class="list-group-item"><strong>Approval:</strong>
                    <?php if ($row['approved'] == 1) { ?>
                        <span class="badge bg-success">✅ Approved</span>
                    <?php } else { ?>
                        <span class="badge bg-warning text-dark">⏳ Pending Approval</span>
                    <?php } ?>
                </li>
                <li class="list-group-item"><strong>Location:</strong> <?php echo htmlspecialchars($row['location']); ?></li>
                <li class="list-group-item"><small class="text-muted">Reported on: <?php echo $row['created_at']; ?></small></li>
              </ul>
            </div>
          </div>
        </div>
      <?php } ?>
    <?php } else { ?>
      <div class="col-12 text-center">
        <div class="alert alert-info">No active items available.</div>
      </div>
    <?php } ?>
  </div>
</div>

</body>
</html>