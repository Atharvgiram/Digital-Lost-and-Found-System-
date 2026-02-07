<?php
include 'db.php'; // your database connection

// Get user_id from GET (e.g., user_my_items.php?user_id=1)
if (!isset($_GET['user_id']) || empty($_GET['user_id'])) {
    die("User ID not provided.");
}

$user_id = intval($_GET['user_id']); // sanitize input

// Fetch user's reported items
$sql = "SELECT * FROM reports WHERE user_id = $user_id ORDER BY id DESC";
$result = mysql_query($sql, $conn);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Reported Items</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2 class="text-center">📦 My Reported Items</h2>
    <div class="list-group">

    <?php
    if (!$result) {
        echo "<div class='alert alert-danger'>Error fetching items: " . mysql_error() . "</div>";
    } elseif (mysql_num_rows($result) == 0) {
        echo "<div class='alert alert-info'>You have not reported any items yet.</div>";
    } else {
        while ($row = mysql_fetch_assoc($result)) {
            echo "<div class='list-group-item'>";
            echo "<h4 class='list-group-item-heading'>" . htmlspecialchars($row['item_name']) . "</h4>";
            echo "<p class='list-group-item-text'>Description: " . htmlspecialchars($row['description']) . "</p>";
            echo "<p>Status: " . ($row['resolved'] ? "<span style='color:green'>Resolved</span>" : "<span style='color:red'>Pending</span>") . "</p>";
            echo "</div>";
        }
    }
    ?>

    </div>
</div>
</body>
</html>
