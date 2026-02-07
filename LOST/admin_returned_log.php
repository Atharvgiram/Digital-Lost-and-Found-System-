<?php
session_start();

// ======= Database Connection (PHP 5.1 style) =======
$host = "localhost";
$user = "root"; // your MySQL username
$pass = "";     // your MySQL password
$db   = "lost_found";

$conn = mysql_connect($host, $user, $pass);
if (!$conn) die("Could not connect: " . mysql_error());
mysql_select_db($db, $conn) or die("Cannot select DB: " . mysql_error());

// ======= Initialize Variables =======
$msg = "";
$report_id = '';
$returnee_name = '';
$owner_name = '';
$return_date = date('Y-m-d');
$notes = '';

// ======= Pre-fill owner name if report_id is passed via GET =======
if (isset($_GET['report_id'])) {
    $report_id = intval($_GET['report_id']);
    $res = mysql_query("SELECT owner_name FROM reports WHERE id = $report_id", $conn);
    if ($row = mysql_fetch_assoc($res)) {
        $owner_name = $row['owner_name'];
    }
}

// ======= Handle Form Submission =======
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $report_id = intval($_POST['report_id']);
    $returnee_name = trim(mysql_real_escape_string($_POST['returnee_name'], $conn));
    $owner_name    = trim(mysql_real_escape_string($_POST['owner_name'], $conn));
    $return_date   = trim(mysql_real_escape_string($_POST['return_date'], $conn));
    $notes         = trim(mysql_real_escape_string($_POST['notes'], $conn));

    // ======= Simple Date Validation =======
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $return_date)) {
        $msg = "<div style='color:red'>❌ Invalid return date format.</div>";
    } else {
        // ======= Check if report exists =======
        $report_check = mysql_query("SELECT id FROM reports WHERE id = $report_id", $conn);
        if (mysql_num_rows($report_check) == 0) {
            $msg = "<div style='color:red'>❌ Report ID not found.</div>";
        } else {
            // ======= Insert into returned_items_log =======
            $sql_log = "INSERT INTO returned_items_log (report_id, returnee_name, owner_name, return_date, notes) 
                        VALUES ($report_id, '$returnee_name', '$owner_name', '$return_date', '$notes')";
            $res_log = mysql_query($sql_log, $conn);
            if (!$res_log) {
                $msg = "<div style='color:red'>❌ Error logging return: " . mysql_error() . "</div>";
            } else {
                // ======= Update report as resolved =======
                $sql_update = "UPDATE reports SET resolved = 1 WHERE id = $report_id";
                $res_update = mysql_query($sql_update, $conn);
                if (!$res_update) {
                    $msg = "<div style='color:red'>❌ Error updating report: " . mysql_error() . "</div>";
                } else {
                    $msg = "<div style='color:green'>✅ Return successfully logged and item marked as resolved.</div>";
                    // Clear form values
                    $report_id = '';
                    $returnee_name = '';
                    $owner_name = '';
                    $return_date = date('Y-m-d');
                    $notes = '';
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Log a Returned Item</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; }
        .card { border-radius: 12px; box-shadow: 0 4px 5px rgba(0,0,0,0.1); max-width: 600px; margin: auto; padding: 20px; background: #fff; margin-top: 50px; }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <h2 class="text-center mb-4">✍️ Log a Returned Item</h2>
        <?php echo $msg; ?>
        <form method="POST">
            <div class="form-group">
                <label>Report ID</label>
                <input type="number" name="report_id" class="form-control" value="<?php echo htmlspecialchars($report_id); ?>" required>
            </div>
            <div class="form-group">
                <label>Returnee Name</label>
                <input type="text" name="returnee_name" class="form-control" value="<?php echo htmlspecialchars($returnee_name); ?>" required>
            </div>
            <div class="form-group">
                <label>Owner's Name</label>
                <input type="text" name="owner_name" class="form-control" value="<?php echo htmlspecialchars($owner_name); ?>" required>
            </div>
            <div class="form-group">
                <label>Date of Return</label>
                <input type="date" name="return_date" class="form-control" value="<?php echo htmlspecialchars($return_date); ?>" required>
            </div>
            <div class="form-group">
                <label>Notes (Optional)</label>
                <textarea name="notes" class="form-control"><?php echo htmlspecialchars($notes); ?></textarea>
            </div>
            <button type="submit" class="btn btn-success btn-block">Log Return and Resolve</button>
            <a href="manage_returns.php" class="btn btn-default btn-block" style="margin-top:10px;">Cancel</a>
        </form>
    </div>
</div>

</body>
</html>
