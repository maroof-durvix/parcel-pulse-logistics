<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    if (!isset($_SESSION['admin'])) {
        header("Location: ../login.php");
        exit();
    }
}
include('../config/db.php');

$notice = "";

// Handle user deletion
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_user'])) {
    $del_id = (int)$_POST['user_id'];
    $current_admin_id = isset($_SESSION['user_id']) ? (int)$_SESSION['user_id'] : 1;
    if ($del_id !== $current_admin_id && $del_id !== 1) {
        $conn->query("DELETE FROM users WHERE id = $del_id");
        $notice = "User account #$del_id removed from system.";
    } else {
        $notice = "Protected: Cannot delete root administrator account.";
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
    <title>Parcel Pulse - User Identity & Access Control</title>
    <!-- Fonts & Bootstrap -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">

    <style>
    body { background: #060b14; color: #ffffff; font-family: 'Poppins', sans-serif; overflow-x: hidden; }
    .sidebar {
        position: fixed; top: 0; left: 0; width: 260px; height: 100vh;
        background: rgba(10, 17, 32, 0.95); backdrop-filter: blur(20px);
        border-right: 1px solid rgba(0, 242, 254, 0.15); padding: 24px 0;
        z-index: 1000; display: flex; flex-direction: column; justify-content: space-between;
    }
    .nav-link-admin {
        color: #ffffff !important; padding: 13px 25px; display: flex; align-items: center; gap: 12px;
        transition: all 0.25s ease; font-weight: 500; font-size: 0.92rem; text-decoration: none;
    }
    .nav-link-admin:hover, .nav-link-admin.active {
        color: #00f2fe !important; background: rgba(0, 242, 254, 0.08); border-left: 3px solid #00f2fe;
    }
    .main-content { margin-left: 260px; padding: 35px; min-height: 100vh; }
    .admin-card {
        background: rgba(14, 23, 42, 0.7); backdrop-filter: blur(15px);
        border: 1px solid rgba(0, 242, 254, 0.2); border-radius: 16px;
        padding: 24px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
    }
    .admin-card span, .admin-card small, .admin-card p { color: #ffffff !important; }
    .table-dark-glass { color: #ffffff; width: 100%; }
    .table-dark-glass th {
        background: rgba(0, 242, 254, 0.08); color: #00f2fe;
        border-bottom: 1px solid rgba(0, 242, 254, 0.2); font-size: 0.82rem;
        text-transform: uppercase; padding: 12px 16px;
    }
    .table-dark-glass td {
        border-bottom: 1px solid rgba(255, 255, 255, 0.06); color: #ffffff !important;
        padding: 12px 16px; vertical-align: middle; font-size: 0.88rem;
    }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <div>
        <div class="sidebar-brand text-center mb-4">
            <h5 class="fw-bold mb-0 text-white">PULSE <span style="color: #00f2fe;">OPS</span></h5>
        </div>
        <nav class="d-flex flex-column gap-1">
            <a class="nav-link-admin" href="dashboard.php">
                <i class="fa-solid fa-chart-line"></i> AI Analytics
            </a>
            <a class="nav-link-admin" href="shipment.php">
                <i class="fa-solid fa-boxes-stacked"></i> Shipments Hub
            </a>
            <a class="nav-link-admin" href="complaints.php">
                <i class="fa-solid fa-headset"></i> Support Tickets
            </a>
            <a class="nav-link-admin active" href="users.php">
                <i class="fa-solid fa-users text-info"></i> Access Control
            </a>
        </nav>
    </div>
    <div>
        <hr class="border-secondary opacity-25 mx-3 my-3">
        <a class="nav-link-admin text-secondary" href="../index.php">
            <i class="fa-solid fa-arrow-up-right-from-square"></i> Open Public Site
        </a>
        <a class="nav-link-admin text-danger" href="../logout.php">
            <i class="fa-solid fa-power-off"></i> Terminate Session
        </a>
    </div>
</div>

<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-white mb-1">Identity & Access Control</h2>
            <p class="text-secondary small mb-0">Manage authorized clients, enterprise accounts, and administrator permissions</p>
        </div>
    </div>

    <?php if (!empty($notice)): ?>
        <div class="alert alert-info border-0 rounded-3 text-white py-2 small mb-4" style="background: rgba(0, 242, 254, 0.2); border: 1px solid #00f2fe !important;">
            <i class="fa-solid fa-circle-info me-1"></i> <?php echo htmlspecialchars($notice); ?>
        </div>
    <?php endif; ?>

    <div class="admin-card">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold text-white mb-0">Authorized Users Database</h5>
            <span class="badge-cyan small">Total Users: <?php echo $result ? $result->num_rows : 0; ?></span>
        </div>

        <div class="table-responsive">
            <table class="table-dark-glass">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Shipper Name</th>
                        <th>Email (Login ID)</th>
                        <th>Role Clearance</th>
                        <th>Registered On</th>
                        <th>Account Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result && $result->num_rows > 0): ?>
                        <?php while ($u = $result->fetch_assoc()): ?>
                            <tr>
                                <td class="font-monospace text-info fw-bold">#<?php echo $u['id']; ?></td>
                                <td class="text-white fw-semibold">
                                    <i class="fa-solid fa-user-astronaut text-secondary me-2"></i>
                                    <?php echo htmlspecialchars($u['name']); ?>
                                </td>
                                <td class="font-monospace"><?php echo htmlspecialchars($u['email']); ?></td>
                                <td>
                                    <?php if ($u['role'] === 'admin'): ?>
                                        <span class="badge bg-danger rounded-pill px-3 py-1 font-monospace">ROOT ADMIN</span>
                                    <?php else: ?>
                                        <span class="badge bg-info text-dark rounded-pill px-3 py-1 font-monospace">CLIENT SHIPPER</span>
                                    <?php endif; ?>
                                </td>
                                <td class="small text-secondary font-monospace"><?php echo date('M d, Y H:i', strtotime($u['created_at'])); ?></td>
                                <td>
                                    <?php if ($u['id'] !== 1 && $u['role'] !== 'admin'): ?>
                                        <form method="POST" onsubmit="return confirm('Confirm revocation of user clearance?')" class="d-inline">
                                            <input type="hidden" name="user_id" value="<?php echo $u['id']; ?>">
                                            <button type="submit" name="delete_user" class="btn btn-sm btn-outline-danger" title="Revoke User Access">
                                                <i class="fa-solid fa-user-xmark"></i>
                                            </button>
                                        </form>
                                    <?php else: ?>
                                        <span class="badge bg-dark text-secondary border border-secondary">Protected</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="6" class="text-center py-4 text-secondary">No user records found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
