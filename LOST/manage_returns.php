<?php
// ====== Database connection ======
$host = "localhost";
$user = "root";    // your MySQL username
$pass = "";        // your MySQL password
$db   = "lost_found";

$conn = mysql_connect($host, $user, $pass);
if (!$conn) {
    die("Could not connect to MySQL: " . mysql_error());
}

$db_selected = mysql_select_db($db, $conn);
if (!$db_selected) {
    die("Could not select database '$db': " . mysql_error());
}

// ====== Fetch all returned items log ======
$sql = "SELECT r.id AS report_id, r.item_name, r.owner_name, r.resolved, 
               l.returnee_name, l.return_date, l.notes
        FROM returned_items_log l
        LEFT JOIN reports r ON l.report_id = r.id
        ORDER BY l.id DESC";

$result = mysql_query($sql, $conn);
if (!$result) {
    die("Query failed: " . mysql_error());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Returns</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2 class="text-center">📦 Manage Returned Items</h2>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Report ID</th>
                <th>Item Name</th>
                <th>Owner</th>
                <th>Returnee</th>
                <th>Return Date</th>
                <th>Notes</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if (mysql_num_rows($result) == 0) {
            echo "<tr><td colspan='7'>No returned items found.</td></tr>";
        } else {
            while ($row = mysql_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['report_id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['item_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['owner_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['returnee_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['return_date']) . "</td>";
                echo "<td>" . htmlspecialchars($row['notes']) . "</td>";
                echo "<td>" . ($row['resolved'] ? "<span style='color:green'>Resolved</span>" : "<span style='color:red'>Pending</span>") . "</td>";
                echo "</tr>";
            }
        }
        ?>
        </tbody>
    </table>
    <a href="admin_dashboard.php" class="btn btn-primary">⬅ Back to Dashboard</a>
</div>
</body>
</html>
