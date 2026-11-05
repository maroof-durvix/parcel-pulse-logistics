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

$success = "";
$error = "";

// Handle Add Parcel
if (isset($_POST['add_shipment'])) {
    $tracking = $conn->real_escape_string(trim($_POST['tracking']));
    $sender = $conn->real_escape_string(trim($_POST['sender']));
    $receiver = $conn->real_escape_string(trim($_POST['receiver']));
    $origin = $conn->real_escape_string(trim($_POST['origin']));
    $destination = $conn->real_escape_string(trim($_POST['destination']));
    $method = $conn->real_escape_string($_POST['method']);
    $weight = (float)$_POST['weight'];
    $status = $conn->real_escape_string($_POST['status']);

    $sql = "INSERT INTO parcels (tracking_number, sender_name, receiver_name, origin, destination, shipping_method, weight, status) 
            VALUES ('$tracking', '$sender', '$receiver', '$origin', '$destination', '$method', $weight, '$status')";

    if ($conn->query($sql) === TRUE) {
        $new_id = $conn->insert_id;
        // Insert initial history node
        $conn->query("INSERT INTO tracking_history (parcel_id, location, status) VALUES ($new_id, '$origin', 'Manifest Registered & Processing')");
        $success = "Consignment manifest ($tracking) successfully registered into neural network!";
    } else {
        $error = "Error adding shipment: " . $conn->error;
    }
}

// Handle Delete Parcel
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM parcels WHERE id = $id");
    header("Location: shipment.php?deleted=1");
    exit();
}

// Fetch all parcels
$parcels = $conn->query("SELECT * FROM parcels ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parcel Pulse - Shipments Hub</title>

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
            <a class="nav-link-admin active" href="shipment.php">
                <i class="fa-solid fa-boxes-stacked text-info"></i> Shipments Hub
            </a>
            <a class="nav-link-admin" href="complaints.php">
                <i class="fa-solid fa-headset"></i> Support Tickets
            </a>
            <a class="nav-link-admin" href="users.php">
                <i class="fa-solid fa-users"></i> Access Control
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
            <h2 class="fw-bold text-white mb-1">Shipment & Waybill Hub</h2>
            <p class="text-secondary small mb-0">Register, dispatch, and monitor freight across air, sea, drone, and highway corridors</p>
        </div>
        <button class="btn btn-pulse-primary" data-bs-toggle="collapse" data-bs-target="#newShipmentCollapse">
            <i class="fa-solid fa-plus me-1"></i> Register New Consignment
        </button>
    </div>

    <?php if (!empty($success)): ?>
        <div class="alert alert-success border-0 rounded-3 text-white py-2 small mb-4" style="background: rgba(16, 185, 129, 0.2); border: 1px solid #10b981 !important;">
            <i class="fa-solid fa-circle-check me-1"></i> <?php echo htmlspecialchars($success); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['deleted'])): ?>
        <div class="alert alert-info border-0 rounded-3 text-white py-2 small mb-4" style="background: rgba(0, 242, 254, 0.2); border: 1px solid #00f2fe !important;">
            <i class="fa-solid fa-trash me-1"></i> Consignment record removed successfully.
        </div>
    <?php endif; ?>

    <!-- Collapsible Add Shipment Form -->
    <div class="collapse mb-4" id="newShipmentCollapse">
        <div class="admin-card">
            <h5 class="text-white fw-bold mb-3"><i class="fa-solid fa-file-circle-plus text-info me-2"></i> Register Freight Manifest</h5>
            <form method="POST">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label text-secondary small">Waybill Tracking Number</label>
                        <input type="text" name="tracking" class="form-control pulse-input auto-waybill" value="PP-<?php echo rand(1000, 9999); ?>-AI" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-secondary small">Sender Name / Enterprise</label>
                        <input type="text" name="sender" class="form-control pulse-input" placeholder="e.g. Apex Global Tech" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-secondary small">Receiver Name / Destination Contact</label>
                        <input type="text" name="receiver" class="form-control pulse-input" placeholder="e.g. Ahmed Durwesh" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-secondary small">Origin Hub / Facility</label>
                        <input type="text" name="origin" class="form-control pulse-input" placeholder="e.g. Dubai Central Depot" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-secondary small">Destination Hub / Facility</label>
                        <input type="text" name="destination" class="form-control pulse-input" placeholder="e.g. Karachi Port Hub" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-secondary small">Shipping Corridor</label>
                        <select name="method" class="form-select pulse-select">
                            <option value="Air">Air Cargo</option>
                            <option value="Drone">Autonomous Drone</option>
                            <option value="Road">Highway Overland</option>
                            <option value="Sea">Ocean Bulk</option>
                            <option value="EV Delivery">EV Urban Delivery</option>
                            <option value="Crowd Shipping">Crowd Shipping</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-secondary small">Weight (kg)</label>
                        <input type="number" step="0.1" name="weight" class="form-control pulse-input" value="2.5" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-secondary small">Initial Status</label>
                        <select name="status" class="form-select pulse-select">
                            <option value="Pending">Pending Manifest</option>
                            <option value="In Transit" selected>In Transit</option>
                            <option value="Delivered">Delivered</option>
                        </select>
                    </div>
                    <div class="col-12 mt-4 text-end">
                        <button type="submit" name="add_shipment" class="btn btn-pulse-primary px-4">
                            <i class="fa-solid fa-satellite-dish me-1"></i> Register Manifest
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- SHIPMENTS TABLE -->
    <div class="admin-card">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold text-white mb-0">Active Cargo Manifests</h5>
            <span class="badge-cyan small">Total: <?php echo $parcels ? $parcels->num_rows : 0; ?></span>
        </div>

        <div class="table-responsive">
            <table class="table-dark-glass">
                <thead>
                    <tr>
                        <th>Tracking ID</th>
                        <th>Sender</th>
                        <th>Recipient</th>
                        <th>Route</th>
                        <th>Mode</th>
                        <th>Weight</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($parcels && $parcels->num_rows > 0): ?>
                        <?php while ($row = $parcels->fetch_assoc()): ?>
                            <?php
                            $badge = 'bg-info text-dark';
                            if ($row['status'] === 'Delivered') $badge = 'bg-success text-white';
                            elseif ($row['status'] === 'Pending') $badge = 'bg-secondary text-white';
                            ?>
                            <tr>
                                <td class="font-monospace fw-bold" style="color: #00f2fe;">
                                    <?php echo htmlspecialchars($row['tracking_number']); ?>
                                </td>
                                <td class="text-white"><?php echo htmlspecialchars($row['sender_name']); ?></td>
                                <td class="text-white"><?php echo htmlspecialchars($row['receiver_name']); ?></td>
                                <td>
                                    <small class="text-white"><?php echo htmlspecialchars($row['origin']); ?></small>
                                    <div class="text-secondary small">&rarr; <?php echo htmlspecialchars($row['destination']); ?></div>
                                </td>
                                <td>
                                    <span class="badge bg-dark border border-secondary"><?php echo htmlspecialchars($row['shipping_method']); ?></span>
                                </td>
                                <td class="font-monospace"><?php echo htmlspecialchars($row['weight']); ?> kg</td>
                                <td><span class="badge <?php echo $badge; ?> rounded-pill px-2 py-1"><?php echo htmlspecialchars($row['status']); ?></span></td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="../pages/tracking.php?id=<?php echo urlencode($row['tracking_number']); ?>" class="btn btn-sm btn-outline-info" title="Inspect Radar">
                                            <i class="fa-solid fa-radar"></i>
                                        </a>
                                        <a href="shipment.php?delete=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Confirm cancellation of this consignment?')" title="Delete Manifest">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="8" class="text-center py-4 text-secondary">No cargo manifests logged.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
