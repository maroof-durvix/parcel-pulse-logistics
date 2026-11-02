<?php
session_start();

if(!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin'){
    if(!isset($_SESSION['admin'])) {
        header("Location: ../login.php");
        exit();
    }
}
include('../config/db.php');

// Handle user deletion
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_user'])) {
    $del_id = (int)$_POST['user_id'];
    // Don't let admin delete themselves
    if($del_id !== $_SESSION['user_id']) {
        $query = "DELETE FROM users WHERE id = $del_id";
        $conn->query($query);
    }
}

// Fetch all users
$query = "SELECT * FROM users ORDER BY created_at DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin - User Management</title>
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
            <a class="nav-link" href="complaints.php"><i class="fa-solid fa-headset"></i> Complaints</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="users.php"><i class="fa-solid fa-users"></i> Users</a>
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
            <h2 class="fw-bold m-0 text-light">User Management</h2>
            <p class="text-muted m-0">View and manage registered accounts</p>
        </div>
        <div>
            <span class="badge bg-info text-dark p-2"><i class="fa-solid fa-users"></i> <?php echo $result->num_rows; ?> Total Users</span>
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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Joined Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($result && $result->num_rows > 0): ?>
                                <?php while($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td>#<?php echo $row['id']; ?></td>
                                        <td class="fw-bold text-info"><?php echo htmlspecialchars($row['name']); ?></td>
                                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                                        <td>
                                            <?php if($row['role'] == 'admin'): ?>
                                                <span class="badge bg-danger">Admin</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">User</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo date('d M Y', strtotime($row['created_at'])); ?></td>
                                        <td>
                                            <?php if($row['id'] !== $_SESSION['user_id']): ?>
                                            <form method="POST" action="users.php" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                                                <button type="submit" name="delete_user" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i> Delete</button>
                                            </form>
                                            <?php else: ?>
                                                <span class="text-muted small">Current User</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">No users found.</td>
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
