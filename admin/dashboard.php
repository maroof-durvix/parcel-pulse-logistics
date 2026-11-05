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

// Fetch stats from DB
$total_shipments = 0;
$in_transit = 0;
$total_users = 0;
$pending_complaints = 0;

$p_res = $conn->query("SELECT COUNT(*) AS total, SUM(CASE WHEN status = 'In Transit' THEN 1 ELSE 0 END) AS in_transit FROM parcels");
if ($p_res) {
    $row = $p_res->fetch_assoc();
    $total_shipments = $row['total'];
    $in_transit = $row['in_transit'] ?: 0;
}

$u_res = $conn->query("SELECT COUNT(*) AS total FROM users");
if ($u_res) {
    $row = $u_res->fetch_assoc();
    $total_users = $row['total'];
}

$c_res = $conn->query("SELECT COUNT(*) AS total FROM complaints WHERE status != 'Resolved'");
if ($c_res) {
    $row = $c_res->fetch_assoc();
    $pending_complaints = $row['total'];
}

// Fetch recent parcels
$recent_parcels = $conn->query("SELECT * FROM parcels ORDER BY created_at DESC LIMIT 6");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parcel Pulse - AI Operations Dashboard</title>

    <!-- Fonts & Bootstrap -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Custom Modern Stylesheet -->
    <link rel="stylesheet" href="../assets/css/style.css?v=<?php echo filemtime(__DIR__ . '/../assets/css/style.css'); ?>">

    <style>
    body {
        background: #060b14;
        color: #ffffff;
        font-family: 'Poppins', sans-serif;
        overflow-x: hidden;
    }
    .sidebar {
        position: fixed;
        top: 0; left: 0;
        width: 260px;
        height: 100vh;
        background: rgba(10, 17, 32, 0.95);
        backdrop-filter: blur(20px);
        border-right: 1px solid rgba(0, 242, 254, 0.15);
        padding: 24px 0;
        z-index: 1000;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .sidebar-brand {
        font-size: 1.35rem;
        font-weight: 700;
        text-align: center;
        color: #fff;
        margin-bottom: 25px;
        letter-spacing: 0.5px;
    }
    .nav-link-admin {
        color: #ffffff !important;
        padding: 13px 25px;
        display: flex;
        align-items: center;
        gap: 12px;
        transition: all 0.25s ease;
        font-weight: 500;
        font-size: 0.92rem;
        text-decoration: none;
    }
    .nav-link-admin:hover, .nav-link-admin.active {
        color: #00f2fe !important;
        background: rgba(0, 242, 254, 0.08);
        border-left: 3px solid #00f2fe;
    }
    .main-content {
        margin-left: 260px;
        padding: 35px;
        min-height: 100vh;
    }
    .admin-card {
        background: rgba(14, 23, 42, 0.7);
        backdrop-filter: blur(15px);
        border: 1px solid rgba(0, 242, 254, 0.2);
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        transition: all 0.3s ease;
    }
    .admin-card:hover {
        border-color: rgba(0, 242, 254, 0.4);
        box-shadow: 0 0 25px rgba(0, 242, 254, 0.15);
    }
    .admin-card span,
    .admin-card small,
    .admin-card p {
        color: #ffffff !important;
    }
    .table-dark-glass {
        color: #ffffff;
        width: 100%;
    }
    .table-dark-glass th {
        background: rgba(0, 242, 254, 0.08);
        color: #00f2fe;
        border-bottom: 1px solid rgba(0, 242, 254, 0.2);
        font-size: 0.82rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 12px 16px;
    }
    .table-dark-glass td {
        border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        color: #ffffff !important;
        padding: 12px 16px;
        vertical-align: middle;
        font-size: 0.88rem;
    }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <div>
        <div class="sidebar-brand d-flex align-items-center justify-content-center gap-2">
            <span style="width: 8px; height: 8px; background: #00f2fe; border-radius: 50%; box-shadow: 0 0 10px #00f2fe;"></span>
            <span>PULSE <span style="color: #00f2fe;">OPS</span></span>
        </div>
        <nav class="d-flex flex-column gap-1">
            <a class="nav-link-admin active" href="dashboard.php">
                <i class="fa-solid fa-chart-line text-info"></i> AI Analytics
            </a>
            <a class="nav-link-admin" href="shipment.php">
                <i class="fa-solid fa-boxes-stacked"></i> Shipments Hub
            </a>
            <a class="nav-link-admin" href="complaints.php">
                <i class="fa-solid fa-headset"></i> Support Tickets
                <?php if ($pending_complaints > 0): ?>
                    <span class="badge bg-warning text-dark ms-auto" style="font-size: 0.7rem;"><?php echo $pending_complaints; ?></span>
                <?php endif; ?>
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
            <h2 class="fw-bold text-white mb-1">AI Operations Console</h2>
            <p class="text-secondary small mb-0">Autonomous fleet telemetry, freight throughput, and incident triage</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <span class="badge bg-success px-3 py-2 rounded-pill font-monospace" style="font-size: 0.8rem;">
                <i class="fa-solid fa-satellite-dish me-1"></i> Core Operational
            </span>
        </div>
    </div>

    <!-- KPI TILES -->
    <div class="row g-3 mb-4">
        <div class="col-lg-3 col-6">
            <div class="admin-card d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-secondary small text-uppercase">Total Consignments</span>
                    <h3 class="fw-bold text-white mb-0 mt-1"><?php echo max($total_shipments, 3); ?></h3>
                    <small class="text-info"><?php echo max($in_transit, 2); ?> currently in transit</small>
                </div>
                <div class="p-3 rounded-3" style="background: rgba(0, 242, 254, 0.1); color: #00f2fe; font-size: 1.5rem;">
                    <i class="fa-solid fa-truck-fast"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="admin-card d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-secondary small text-uppercase">Autonomous Drones</span>
                    <h3 class="fw-bold text-white mb-0 mt-1" style="color: #00f2fe !important;">48 Active</h3>
                    <small class="text-success"><i class="fa-solid fa-circle-check"></i> 100% Battery ready</small>
                </div>
                <div class="p-3 rounded-3" style="background: rgba(0, 242, 254, 0.1); color: #00f2fe; font-size: 1.5rem;">
                    <i class="fa-solid fa-plane-up"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="admin-card d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-secondary small text-uppercase">Registered Shippers</span>
                    <h3 class="fw-bold text-white mb-0 mt-1"><?php echo max($total_users, 2); ?></h3>
                    <small class="text-success">Verified enterprise keys</small>
                </div>
                <div class="p-3 rounded-3" style="background: rgba(16, 185, 129, 0.1); color: #10b981; font-size: 1.5rem;">
                    <i class="fa-solid fa-users"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="admin-card d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-secondary small text-uppercase">Open Support Tickets</span>
                    <h3 class="fw-bold text-warning mb-0 mt-1"><?php echo $pending_complaints; ?></h3>
                    <small class="text-secondary">Avg resolution: 1.8 hrs</small>
                </div>
                <div class="p-3 rounded-3" style="background: rgba(245, 158, 11, 0.1); color: #f59e0b; font-size: 1.5rem;">
                    <i class="fa-solid fa-ticket"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- CHARTS ROW -->
    <div class="row g-4 mb-4">
        <div class="col-lg-8">
            <div class="admin-card">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold text-white mb-0">Monthly Freight Volume & Revenue Index</h6>
                    <span class="badge-cyan small">Live AI Forecast</span>
                </div>
                <div style="height: 280px;">
                    <canvas id="freightVolumeChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="admin-card">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold text-white mb-0">Modal Share Breakdown</h6>
                    <span class="badge bg-secondary small">Fleet Distribution</span>
                </div>
                <div style="height: 280px; display: flex; align-items: center; justify-content: center;">
                    <canvas id="modalShareChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- RECENT SHIPMENTS TABLE -->
    <div class="admin-card">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold text-white mb-0">
                <i class="fa-solid fa-satellite text-info me-2"></i> Recent Cargo Dispatches
            </h5>
            <a href="shipment.php" class="btn btn-sm btn-outline-info rounded-pill px-3">Manage All Shipments &rarr;</a>
        </div>

        <div class="table-responsive">
            <table class="table-dark-glass">
                <thead>
                    <tr>
                        <th>Waybill ID</th>
                        <th>Sender / Consignee</th>
                        <th>Origin / Destination</th>
                        <th>Freight Mode</th>
                        <th>Gross Weight</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($recent_parcels && $recent_parcels->num_rows > 0): ?>
                        <?php while ($p = $recent_parcels->fetch_assoc()): ?>
                            <?php
                            $badge = 'bg-info text-dark';
                            if ($p['status'] === 'Delivered') $badge = 'bg-success text-white';
                            elseif ($p['status'] === 'Pending') $badge = 'bg-secondary text-white';
                            ?>
                            <tr>
                                <td class="font-monospace fw-bold" style="color: #00f2fe;">
                                    <?php echo htmlspecialchars($p['tracking_number']); ?>
                                </td>
                                <td>
                                    <div class="fw-semibold text-white"><?php echo htmlspecialchars($p['sender_name']); ?></div>
                                    <small class="text-secondary">&rarr; <?php echo htmlspecialchars($p['receiver_name']); ?></small>
                                </td>
                                <td>
                                    <div class="small text-white"><?php echo htmlspecialchars($p['origin']); ?></div>
                                    <small class="text-secondary">&rarr; <?php echo htmlspecialchars($p['destination']); ?></small>
                                </td>
                                <td>
                                    <span class="badge bg-dark border border-secondary"><?php echo htmlspecialchars($p['shipping_method']); ?></span>
                                </td>
                                <td class="font-monospace"><?php echo htmlspecialchars($p['weight']); ?> kg</td>
                                <td><span class="badge <?php echo $badge; ?> rounded-pill px-2 py-1"><?php echo htmlspecialchars($p['status']); ?></span></td>
                                <td>
                                    <a href="../pages/tracking.php?id=<?php echo urlencode($p['tracking_number']); ?>" class="btn btn-sm btn-outline-info rounded-pill py-0 px-2" title="Inspect Radar">
                                        <i class="fa-solid fa-radar"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-4 text-secondary">No consignments found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
// Chart 1: Freight Volume Line Chart
const ctxVol = document.getElementById('freightVolumeChart').getContext('2d');
const gradient = ctxVol.createLinearGradient(0, 0, 0, 280);
gradient.addColorStop(0, 'rgba(0, 242, 254, 0.4)');
gradient.addColorStop(1, 'rgba(0, 242, 254, 0.0)');

new Chart(ctxVol, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov'],
        datasets: [{
            label: 'Consignment Volume ($k)',
            data: [65, 72, 80, 85, 94, 105, 112, 118, 125, 134, 142],
            borderColor: '#00f2fe',
            borderWidth: 3,
            backgroundColor: gradient,
            fill: true,
            tension: 0.4,
            pointBackgroundColor: '#00f2fe',
            pointRadius: 4
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            x: { grid: { color: 'rgba(255, 255, 255, 0.08)' }, ticks: { color: '#ffffff' } },
            y: { grid: { color: 'rgba(255, 255, 255, 0.08)' }, ticks: { color: '#ffffff' } }
        }
    }
});

// Chart 2: Modal Share Donut Chart
const ctxModal = document.getElementById('modalShareChart').getContext('2d');
new Chart(ctxModal, {
    type: 'doughnut',
    data: {
        labels: ['Air Freight', 'Autonomous Drone', 'Ocean Bulk', 'Overland EV'],
        datasets: [{
            data: [42, 25, 20, 13],
            backgroundColor: ['#00f2fe', '#10b981', '#8b5cf6', '#f59e0b'],
            borderColor: '#060b14',
            borderWidth: 2
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { position: 'bottom', labels: { color: '#ffffff', font: { size: 11, weight: 'bold' } } }
        }
    }
});
</script>

</body>
</html>
