<?php
session_start();

if(!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin'){
    if(!isset($_SESSION['admin'])) {
        header("Location: ../login.php");
        exit();
    }
}
include('../config/db.php');

$success = "";
$error = "";

// Handle Add Parcel
if(isset($_POST['add'])){
    $tracking = $conn->real_escape_string($_POST['tracking']);
    $sender = $conn->real_escape_string($_POST['sender']);
    $receiver = $conn->real_escape_string($_POST['receiver']);
    $origin = $conn->real_escape_string($_POST['origin']);
    $destination = $conn->real_escape_string($_POST['destination']);
    $method = $conn->real_escape_string($_POST['method']);
    $weight = (float)$_POST['weight'];
    
    // Default values for missing fields to prevent errors
    $status = 'Pending';
    
    $sql = "INSERT INTO parcels (tracking_number, sender_name, receiver_name, origin, destination, shipping_method, weight, status) 
            VALUES ('$tracking', '$sender', '$receiver', '$origin', '$destination', '$method', $weight, '$status')";
            
    if($conn->query($sql) === TRUE){
        $success = "AI Waybill Generated & Parcel Registered Successfully!";
    } else {
        $error = "Error adding parcel: " . $conn->error;
    }
}

// Handle Delete Parcel
if(isset($_GET['delete'])){
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM parcels WHERE id=$id");
    header("Location: shipment.php");
    exit();
}

// Fetch Parcels
$parcels = $conn->query("SELECT * FROM parcels ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Parcel Pulse - Manage Shipments</title>

<!-- Fonts & Bootstrap -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>
/* Dashboard Glassmorphism Styles (Shared) */
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
    padding: 25px;
    box-shadow: 0 0 20px rgba(0, 255, 255, 0.05);
}
.glass-input {
    background: rgba(0,0,0,0.4);
    border: 1px solid rgba(0, 255, 255, 0.3);
    color: white;
}
.glass-input:focus {
    background: rgba(0,0,0,0.6);
    border-color: #00ffff;
    color: white;
    box-shadow: 0 0 10px rgba(0,255,255,0.3);
}
.glow-btn {
    background: linear-gradient(45deg, #00d2ff, #3a7bd5);
    border: none;
    color: white;
    font-weight: bold;
    border-radius: 5px;
    padding: 10px 25px;
    transition: all 0.3s ease;
}
.glow-btn:hover {
    box-shadow: 0 0 15px rgba(0, 210, 255, 0.6);
    transform: translateY(-2px);
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
            <a class="nav-link" href="dashboard.php"><i class="fa-solid fa-chart-pie"></i> AI Analytics</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="shipment.php"><i class="fa-solid fa-boxes-stacked"></i> Shipments</a>
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
            <h2 class="fw-bold m-0 text-light">Manage Shipments</h2>
            <p class="text-muted m-0">Logistics & Parcel Database</p>
        </div>
    </div>

    <?php if($success): ?>
        <div class="alert alert-success" style="background: rgba(40, 167, 69, 0.2); border-color: #28a745; color: #ccffcc;">
            <?php echo $success; ?>
        </div>
    <?php endif; ?>
    <?php if($error): ?>
        <div class="alert alert-danger" style="background: rgba(220, 53, 69, 0.2); border-color: #dc3545; color: #ffcccc;">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <div class="row g-4 mb-4">
        <!-- Add Form -->
        <div class="col-lg-4">
            <div class="glass-card">
                <h5 class="mb-4 text-info"><i class="fa-solid fa-plus-circle"></i> Create New Waybill</h5>
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label small text-uppercase text-muted">Tracking ID (Auto/Manual)</label>
                        <input type="text" name="tracking" class="form-control glass-input" value="PP-<?php echo rand(1000,9999); ?>-AI" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small text-uppercase text-muted">Sender Name</label>
                        <input type="text" name="sender" class="form-control glass-input" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small text-uppercase text-muted">Receiver Name</label>
                        <input type="text" name="receiver" class="form-control glass-input" required>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label small text-uppercase text-muted">Origin</label>
                            <input type="text" name="origin" class="form-control glass-input" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label small text-uppercase text-muted">Destination</label>
                            <input type="text" name="destination" class="form-control glass-input" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label small text-uppercase text-muted">Method</label>
                            <select name="method" class="form-control glass-input" required>
                                <option style="color:#000" value="Air">Air</option>
                                <option style="color:#000" value="Sea">Sea</option>
                                <option style="color:#000" value="Road">Road</option>
                                <option style="color:#000" value="Drone">Drone</option>
                                <option style="color:#000" value="EV Delivery">EV Delivery</option>
                            </select>
                        </div>
                        <div class="col-6 mb-4">
                            <label class="form-label small text-uppercase text-muted">Weight (kg)</label>
                            <input type="number" step="0.1" name="weight" class="form-control glass-input" required>
                        </div>
                    </div>
                    <button type="submit" name="add" class="glow-btn w-100">Register Parcel</button>
                </form>
            </div>
        </div>

        <!-- Table -->
        <div class="col-lg-8">
            <div class="glass-card h-100">
                <h5 class="mb-4 text-info"><i class="fa-solid fa-list"></i> Active Shipments Directory</h5>
                <div class="table-responsive">
                    <table class="table table-glass table-borderless align-middle">
                        <thead>
                            <tr>
                                <th>Waybill ID</th>
                                <th>Route</th>
                                <th>Method</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($parcels && $parcels->num_rows > 0): ?>
                                <?php while($row = $parcels->fetch_assoc()): ?>
                                <tr>
                                    <td class="fw-bold"><?php echo $row['tracking_number']; ?></td>
                                    <td><?php echo $row['origin']; ?> <i class="fa-solid fa-arrow-right text-muted mx-1"></i> <?php echo $row['destination']; ?></td>
                                    <td><span class="badge bg-secondary"><?php echo $row['shipping_method']; ?></span></td>
                                    <td>
                                        <?php 
                                            $badgeClass = 'bg-info';
                                            if($row['status'] == 'Delivered') $badgeClass = 'bg-success';
                                            if($row['status'] == 'Delayed') $badgeClass = 'bg-warning text-dark';
                                        ?>
                                        <span class="badge <?php echo $badgeClass; ?>"><?php echo $row['status']; ?></span>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-info rounded-circle me-1" title="Update Route"><i class="fa-solid fa-pen"></i></a>
                                        <a href="shipment.php?delete=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-danger rounded-circle" onclick="return confirm('Are you sure you want to delete this waybill?');" title="Delete"><i class="fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">No parcels registered yet.</td>
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