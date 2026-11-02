<?php
session_start();

if(!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin'){
    if(!isset($_SESSION['admin'])) {
        header("Location: ../login.php");
        exit();
    }
}
include('../config/db.php');

// Handle status update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_status'])) {
    $complaint_id = (int)$_POST['complaint_id'];
    $new_status = $conn->real_escape_string($_POST['status']);
    
    $query = "UPDATE complaints SET status = '$new_status' WHERE id = $complaint_id";
    $conn->query($query);
}

// Fetch all complaints
$query = "SELECT c.*, u.name as user_name FROM complaints c JOIN users u ON c.user_id = u.id ORDER BY c.created_at DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin - Complaints Management</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>
body {
    background: linear-gradient(135deg, rgba(10,14,23,1), rgba(8,17,32,1)) fixed;
    color: #fff;
    font-family: 'Poppins', sans-serif;
    overflow-x: hidden;
}
.sidebar {
    position: fixed;
    top: 0; left: 0;
    width: 250px;
    height: 100vh;
    background: rgba(20, 25, 40, 0.7);
    backdrop-filter: blur(20px);
    border-right: 1px solid rgba(0, 255, 255, 0.2);
    padding: 20px 0;
    z-index: 1000;
}
.sidebar-brand {
    font-size: 1.5rem;
    font-weight: 700;
    text-align: center;
    color: #fff;
    margin-bottom: 30px;
    text-transform: uppercase;
    letter-spacing: 2px;
}
.nav-link {
    color: rgba(255,255,255,0.7);
    padding: 15px 25px;
    display: flex;
    align-items: center;
    gap: 15px;
    transition: 0.3s;
    font-weight: 500;
}
.nav-link:hover, .nav-link.active {
    color: #00ffff;
    background: rgba(0, 255, 255, 0.1);
    border-right: 3px solid #00ffff;
}
.main-content {
    margin-left: 250px;
    padding: 30px;
}
.glass-card {
    background: rgba(20, 25, 40, 0.6);
    backdrop-filter: blur(15px);
    border: 1px solid rgba(0, 255, 255, 0.2);
    border-radius: 15px;
    padding: 20px;
    box-shadow: 0 0 20px rgba(0, 255, 255, 0.05);
}
.table-glass {
    color: #fff;
}
.table-glass th {
    background: rgba(0, 255, 255, 0.1);
    border-bottom: 1px solid rgba(0,255,255,0.3);
    color: #00ffff;
}
.table-glass td {
    border-bottom: 1px solid rgba(255,255,255,0.1);
    color: rgba(255,255,255,0.8);
    vertical-align: middle;
}
.status-select {
    background: rgba(0,0,0,0.5);
    border: 1px solid rgba(0, 255, 255, 0.3);
    color: white;
    border-radius: 5px;
    padding: 5px;
    font-size: 0.85rem;
}
.status-select:focus {
    outline: none;
    border-color: #00ffff;
}
</style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <div class="sidebar-brand">
        <i class="fa-solid fa-satellite-dish text-info"></i> Pulse Admin
    </div>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link" href="dashboard.php"><i class="fa-solid fa-chart-pie"></i> AI Analytics</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="shipment.php"><i class="fa-solid fa-boxes-stacked"></i> Shipments</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="complaints.php"><i class="fa-solid fa-headset"></i> Complaints</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="users.php"><i class="fa-solid fa-users"></i> Users</a>
        </li>
        <li class="nav-item mt-5">
            <a class="nav-link text-danger" href="../logout.php"><i class="fa-solid fa-power-off"></i> Logout</a>
        </li>
    </ul>
</div>

<!-- Main Content -->
<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold m-0 text-light">Complaints Management</h2>
            <p class="text-muted m-0">Review and resolve customer issues</p>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="glass-card">
                <div class="table-responsive">
                    <table class="table table-glass table-borderless">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Customer</th>
                                <th>Tracking No.</th>
                                <th>Category</th>
                                <th>Description</th>
                                <th>Date</th>
                                <th>Status Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($result && $result->num_rows > 0): ?>
                                <?php while($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td>#<?php echo $row['id']; ?></td>
                                        <td><?php echo htmlspecialchars($row['user_name']); ?></td>
                                        <td class="text-info fw-bold"><?php echo htmlspecialchars($row['tracking_number']); ?></td>
                                        <td><?php echo htmlspecialchars($row['category']); ?></td>
                                        <td style="max-width: 250px;" class="text-truncate" title="<?php echo htmlspecialchars($row['description']); ?>">
                                            <?php echo htmlspecialchars($row['description']); ?>
                                        </td>
                                        <td><small><?php echo date('d M Y', strtotime($row['created_at'])); ?></small></td>
                                        <td>
                                            <form method="POST" action="complaints.php" class="d-flex gap-2">
                                                <input type="hidden" name="complaint_id" value="<?php echo $row['id']; ?>">
                                                <select name="status" class="status-select">
                                                    <option value="Pending" <?php if($row['status']=='Pending') echo 'selected'; ?>>Pending</option>
                                                    <option value="In Progress" <?php if($row['status']=='In Progress') echo 'selected'; ?>>In Progress</option>
                                                    <option value="Resolved" <?php if($row['status']=='Resolved') echo 'selected'; ?>>Resolved</option>
                                                </select>
                                                <button type="submit" name="update_status" class="btn btn-sm btn-outline-info"><i class="fa-solid fa-check"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">No complaints found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
