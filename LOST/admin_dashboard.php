<?php  
// Note: Session-based user verification has been removed. 
// This page is now publicly accessible.

include 'db.php'; 

// Fetch dashboard statistics
$total_reports_result = mysqli_query($conn, "SELECT COUNT(*) AS count FROM reports");
$total_reports_row = mysqli_fetch_assoc($total_reports_result);
$total_reports = $total_reports_row['count'];

$pending_reports_result = mysqli_query($conn, "SELECT COUNT(*) AS count FROM reports WHERE approved = 0");
$pending_reports_row = mysqli_fetch_assoc($pending_reports_result);
$pending_reports = $pending_reports_row['count'];

$resolved_items_result = mysqli_query($conn, "SELECT COUNT(*) AS count FROM reports WHERE resolved = 1");
$resolved_items_row = mysqli_fetch_assoc($resolved_items_result);
$resolved_items = $resolved_items_row['count'];
?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background: linear-gradient(135deg, #1E2A38, #243B55);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .dashboard-card {
            background: rgba(255, 255, 255, 0.07);
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(15px);
            padding: 50px;
            text-align: center;
            max-width: 900px;
            width: 100%;
            color: #fff;
        }

        .dashboard-card h2 {
            font-weight: 700;
            margin-bottom: 10px;
            color: #FFD700;
        }

        .dashboard-card p {
            margin-bottom: 30px;
            color: #E0E0E0;
        }

        .btn-custom {
            padding: 15px 25px;
            font-size: 1.1rem;
            border-radius: 12px;
            transition: all 0.3s ease-in-out;
        }

        .btn-custom:hover {
            transform: translateY(-3px);
            opacity: 0.9;
        }

        .stat-card {
            border-radius: 16px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
            padding: 25px;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: #fff;
        }

        .bg-primary {
            background: linear-gradient(135deg, #4F8EF7, #1F6FEB);
        }

        .bg-warning {
            background: linear-gradient(135deg, #F8C26B, #F19336);
            color: #333;
        }

        .bg-success {
            background: linear-gradient(135deg, #34D399, #10B981);
        }

        footer {
            margin-top: 30px;
            font-size: 0.9rem;
            color: #AAA;
        }
    </style>
</head>
<body>
    <div class="dashboard-card">
        <h2>👋 Welcome, Admin</h2>
        <p class="text-muted">Manage your platform efficiently</p>

        <!-- Statistics Section -->
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="stat-card bg-primary">
                    <h5 class="mb-0">Total Reports</h5>
                    <h3><?php echo $total_reports; ?></h3>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card bg-warning text-dark">
                    <h5 class="mb-0">Pending Reports</h5>
                    <h3><?php echo $pending_reports; ?></h3>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card bg-success">
                    <h5 class="mb-0">Resolved Items</h5>
                    <h3><?php echo $resolved_items; ?></h3>
                </div>
            </div>
        </div>

        <!-- Buttons Section -->
        <div class="d-grid gap-3 mt-4">
            <a href="manage_reports.php" class="btn btn-success btn-custom">
                <i class="bi bi-file-earmark-text-fill"></i> Manage Reports
            </a>
            <a href="manage_users.php" class="btn btn-warning btn-custom">
                <i class="bi bi-people-fill"></i> Manage Users
            </a>
            <a href="admin_returned_log.php" class="btn btn-info btn-custom">
                <i class="bi bi-arrow-repeat"></i> Manage Returned Items
            </a>
            <a href="logout.php" class="btn btn-danger btn-custom">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </div>

        <!-- Footer -->
        <footer>
            &copy; 2025 Digital Lost & Found System. Admin Panel
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
