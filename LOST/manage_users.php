<?php
include 'db.php';

// Handle block/unblock/delete actions
if (isset($_GET['action'], $_GET['id'])) {
    $id = (int)$_GET['id'];

    // Fetch the user role
    $check = $conn->query("SELECT role FROM users WHERE user_id=$id LIMIT 1");
    if ($check && $check->num_rows === 1) {
        $row = $check->fetch_assoc();

        if ($row['role'] !== 'admin') { // Only non-admin users
            if ($_GET['action'] === 'delete') {
                $conn->query("DELETE FROM users WHERE user_id=$id");
            }
            // Optional: block/unblock logic if you have status column
        } else {
            echo "<script>alert('You cannot modify an admin user!');</script>";
        }
    }
    header("Location: manage_users.php");
    exit();
}

// Search functionality
$search = '';
if (isset($_GET['search'])) {
    $search = $conn->real_escape_string($_GET['search']);
}

// Fetch users
$sql = "SELECT user_id, fullname, email, phone, created_at, role 
        FROM users 
        WHERE fullname LIKE '%$search%' OR email LIKE '%$search%' OR role LIKE '%$search%' 
        ORDER BY user_id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Manage Users</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body { background: #f0f2f5; padding: 20px; font-family: Arial, sans-serif; }
h1 { text-align: center; margin-bottom: 20px; color: #2c3e50; }
.table-container { background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
</style>
</head>
<body>

<h1>👥 Manage Users</h1>

<!-- Search Bar -->
<div class="d-flex justify-content-center mb-3">
    <form method="get" class="d-flex w-50">
        <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" class="form-control me-2" placeholder="Search by Name, Email, Role">
        <button type="submit" class="btn btn-primary">Search</button>
        <a href="manage_users.php" class="btn btn-secondary ms-2">Reset</a>
    </form>
</div>

<div class="table-container table-responsive">
<?php
if ($result && $result->num_rows > 0) {
    echo '<table class="table table-bordered table-hover text-center">';
    echo '<thead class="table-dark"><tr>';
    echo '<th>ID</th><th>Full Name</th><th>Email</th><th>Phone</th><th>Created At</th><th>Role</th><th>Actions</th>';
    echo '</tr></thead><tbody>';

    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['user_id']) . '</td>';
        echo '<td>' . htmlspecialchars($row['fullname']) . '</td>';
        echo '<td>' . htmlspecialchars($row['email']) . '</td>';
        echo '<td>' . htmlspecialchars($row['phone']) . '</td>';
        echo '<td>' . htmlspecialchars($row['created_at']) . '</td>';
        echo '<td>' . htmlspecialchars($row['role']) . '</td>';
        echo '<td>';

        // Only show actions if not admin
        if ($row['role'] !== 'admin') {
            echo '<a href="?action=delete&id=' . $row['user_id'] . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure you want to delete this user?\');">Delete</a>';
            // Optional: Add Block/Unblock buttons here if status column exists
        } else {
            echo '<em>Admin</em>';
        }

        echo '</td>';
        echo '</tr>';
    }

    echo '</tbody></table>';
} else {
    echo '<div class="alert alert-info text-center">No users found.</div>';
}
$conn->close();
?>
</div>

</body>
</html>
