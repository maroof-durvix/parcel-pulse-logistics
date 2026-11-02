<?php
session_start();

// Updated session check based on the new logic in login.php
if(!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin'){
    // Fallback to old admin session if exists, otherwise redirect
    if(!isset($_SESSION['admin'])) {
        header("Location: ../login.php");
        exit();
    }
}
include('../config/db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Parcel Pulse - AI Analytics Dashboard</title>

<!-- Fonts & Bootstrap -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
/* Dashboard Glassmorphism Styles */
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
    transition: transform 0.3s;
}
.glass-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 0 30px rgba(0, 255, 255, 0.15);
    border-color: rgba(0, 255, 255, 0.5);
}
.kpi-icon {
    font-size: 2.5rem;
    color: #00ffff;
    background: rgba(0, 255, 255, 0.1);
    padding: 15px;
    border-radius: 12px;
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
}
.table-glass tbody tr:hover td {
    background: rgba(255,255,255,0.05);
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
            <a class="nav-link active" href="dashboard.php"><i class="fa-solid fa-chart-pie"></i> AI Analytics</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="shipment.php"><i class="fa-solid fa-boxes-stacked"></i> Shipments</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#"><i class="fa-solid fa-drone"></i> Drone Monitor</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#"><i class="fa-solid fa-leaf"></i> Eco Reports</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#"><i class="fa-solid fa-user-shield"></i> Fraud Alerts</a>
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
            <h2 class="fw-bold m-0 text-light">Dashboard Overview</h2>
            <p class="text-muted m-0">Real-time Logistics & AI Telemetry</p>
        </div>
        <div>
            <span class="badge bg-info text-dark p-2"><i class="fa-solid fa-circle text-danger fa-fade"></i> System Online</span>
        </div>
    </div>

    <!-- KPI Cards -->
    <div class="row g-4 mb-4">
        <div class="col-lg-3 col-md-6">
            <div class="glass-card d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-muted">Total Revenue</h6>
                    <h3 class="fw-bold m-0">$124,500</h3>
                    <small class="text-success"><i class="fa-solid fa-arrow-trend-up"></i> +14% vs last month</small>
                </div>
                <i class="fa-solid fa-wallet kpi-icon"></i>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="glass-card d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-muted">Active Shipments</h6>
                    <h3 class="fw-bold m-0">1,430</h3>
                    <small class="text-info"><i class="fa-solid fa-truck-fast"></i> 450 in transit</small>
                </div>
                <i class="fa-solid fa-box-open kpi-icon"></i>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="glass-card d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-muted">AI Success Rate</h6>
                    <h3 class="fw-bold m-0">99.8%</h3>
                    <small class="text-success"><i class="fa-solid fa-check-circle"></i> Highly accurate</small>
                </div>
                <i class="fa-solid fa-brain kpi-icon"></i>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="glass-card d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-muted">Carbon Saved</h6>
                    <h3 class="fw-bold m-0">14.2t</h3>
                    <small class="text-success"><i class="fa-solid fa-leaf"></i> Eco-routes active</small>
                </div>
                <i class="fa-solid fa-seedling kpi-icon text-success" style="background: rgba(40,167,69,0.1);"></i>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row g-4 mb-4">
        <div class="col-lg-8">
            <div class="glass-card h-100">
                <h5 class="mb-4">Revenue & Shipment Trends</h5>
                <canvas id="revenueChart" height="100"></canvas>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="glass-card h-100">
                <h5 class="mb-4">AI Shipping Methods</h5>
                <canvas id="methodChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Data Table Row -->
    <div class="row">
        <div class="col-12">
            <div class="glass-card">
                <h5 class="mb-3">Recent AI Predictions & Alerts</h5>
                <div class="table-responsive">
                    <table class="table table-glass table-borderless align-middle">
                        <thead>
                            <tr>
                                <th>Waybill ID</th>
                                <th>Method</th>
                                <th>ETA</th>
                                <th>AI Insight / Alert</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>PP-8492-AI</td>
                                <td><i class="fa-solid fa-drone text-info"></i> Drone</td>
                                <td>14:00 Today</td>
                                <td>Clear skies, optimal flight path.</td>
                                <td><span class="badge bg-success">On Time</span></td>
                            </tr>
                            <tr>
                                <td>PP-7742-AI</td>
                                <td><i class="fa-solid fa-ship text-info"></i> Sea Freight</td>
                                <td>24-May-2026</td>
                                <td>Storm detected. Rerouted, +2 days delay.</td>
                                <td><span class="badge bg-warning text-dark">Delayed</span></td>
                            </tr>
                            <tr>
                                <td>PP-1092-AI</td>
                                <td><i class="fa-solid fa-truck text-info"></i> EV Delivery</td>
                                <td>18:30 Today</td>
                                <td>Battery low on EV-04. Charging stop added.</td>
                                <td><span class="badge bg-info">In Transit</span></td>
                            </tr>
                            <tr>
                                <td>PP-9900-AI</td>
                                <td><i class="fa-solid fa-plane text-info"></i> Air Freight</td>
                                <td>-</td>
                                <td><span class="text-danger"><i class="fa-solid fa-triangle-exclamation"></i> Fake tracking detected.</span></td>
                                <td><span class="badge bg-danger">Blocked</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Chart.js Scripts -->
<script>
// Chart Global Config
Chart.defaults.color = 'rgba(255,255,255,0.7)';
Chart.defaults.font.family = "'Poppins', sans-serif";

// Revenue Line Chart
const ctxRev = document.getElementById('revenueChart').getContext('2d');
new Chart(ctxRev, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        datasets: [{
            label: 'Revenue ($)',
            data: [65000, 72000, 80000, 85000, 105000, 124500],
            borderColor: '#00ffff',
            backgroundColor: 'rgba(0, 255, 255, 0.1)',
            borderWidth: 3,
            tension: 0.4,
            fill: true
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
            y: { grid: { color: 'rgba(255,255,255,0.05)' } },
            x: { grid: { display: false } }
        }
    }
});

// Shipping Method Doughnut Chart
const ctxMethod = document.getElementById('methodChart').getContext('2d');
new Chart(ctxMethod, {
    type: 'doughnut',
    data: {
        labels: ['EV Truck', 'Drone', 'Air', 'Sea', 'Crowd'],
        datasets: [{
            data: [45, 20, 15, 10, 10],
            backgroundColor: [
                '#00ffff', '#3a7bd5', '#ff0055', '#28a745', '#ffc107'
            ],
            borderWidth: 0,
            hoverOffset: 10
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { position: 'bottom' }
        },
        cutout: '75%'
    }
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>