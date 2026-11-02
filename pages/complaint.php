<?php
session_start();
include('../config/db.php');

$message = '';
$message_type = '';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_complaint'])) {
    $tracking_number = $conn->real_escape_string($_POST['tracking_number']);
    $category = $conn->real_escape_string($_POST['category']);
    $description = $conn->real_escape_string($_POST['description']);
    $user_id = $_SESSION['user_id'];
    
    $query = "INSERT INTO complaints (user_id, tracking_number, category, description) VALUES ('$user_id', '$tracking_number', '$category', '$description')";
    
    if ($conn->query($query) === TRUE) {
        $message = "Your complaint has been submitted successfully. Our AI support team will review it shortly.";
        $message_type = "success";
    } else {
        $message = "Error submitting complaint: " . $conn->error;
        $message_type = "danger";
    }
}
?>

<?php include('../includes/header.php'); ?>

<style>
/* Complaint Page Glassmorphism */
.complaint-hero {
    position: relative;
    padding: 120px 0 60px;
    background: url('../assets/img/tracking_bg.jpg') no-repeat center center/cover;
    background-color: #050a15;
    border-bottom: 1px solid rgba(0, 255, 255, 0.2);
    min-height: 100vh;
}
.complaint-hero::before {
    content: '';
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    background: linear-gradient(135deg, rgba(10,14,23,0.95) 0%, rgba(8,17,32,0.9) 100%);
}
.complaint-content {
    position: relative;
    z-index: 2;
}
.glass-form {
    background: rgba(20, 25, 40, 0.6);
    backdrop-filter: blur(15px);
    border: 1px solid rgba(0, 255, 255, 0.3);
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 0 40px rgba(0, 255, 255, 0.1);
}
.glow-input {
    background: rgba(0,0,0,0.5);
    border: 1px solid rgba(0, 255, 255, 0.3);
    color: white;
    border-radius: 10px;
    padding: 12px;
}
.glow-input:focus {
    background: rgba(0,0,0,0.7);
    border-color: #00ffff;
    color: white;
    box-shadow: 0 0 15px rgba(0, 255, 255, 0.3);
}
.glow-btn {
    background: linear-gradient(45deg, #00d2ff, #3a7bd5);
    border: none;
    color: white;
    font-weight: bold;
    border-radius: 50px;
    padding: 12px 30px;
    width: 100%;
    box-shadow: 0 0 15px rgba(0, 210, 255, 0.6);
    transition: all 0.3s ease;
}
.glow-btn:hover {
    box-shadow: 0 0 25px rgba(0, 210, 255, 0.9);
}
.history-card {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 10px;
    padding: 15px;
    margin-bottom: 15px;
}
.status-badge {
    font-size: 0.8rem;
    padding: 5px 10px;
    border-radius: 20px;
}
</style>

<div class="complaint-hero text-light">
    <div class="container complaint-content">
        
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold"><i class="fa-solid fa-headset text-info"></i> Automated Complaint System</h1>
            <p class="lead text-muted">Submit a ticket regarding your parcel, and our AI will prioritize the resolution.</p>
        </div>

        <div class="row justify-content-center">
            
            <!-- Complaint Form -->
            <div class="col-lg-6 mb-4">
                <div class="glass-form">
                    <h4 class="text-info mb-4"><i class="fa-solid fa-file-signature"></i> File a New Complaint</h4>
                    
                    <?php if($message): ?>
                        <div class="alert alert-<?php echo $message_type; ?> alert-dismissible fade show bg-transparent border-<?php echo $message_type; ?> text-<?php echo $message_type; ?>" role="alert">
                            <?php echo $message; ?>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <form action="complaint.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label text-muted small text-uppercase">Waybill / Tracking Number</label>
                            <input type="text" name="tracking_number" class="form-control glow-input" placeholder="e.g. PP-1234-AI" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small text-uppercase">Issue Category</label>
                            <select name="category" class="form-select glow-input" required>
                                <option value="" disabled selected>Select an issue...</option>
                                <option value="Delay">Delivery Delay</option>
                                <option value="Damage">Damaged Parcel</option>
                                <option value="Lost parcel">Lost Parcel</option>
                                <option value="Other">Other Issue</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label text-muted small text-uppercase">Description</label>
                            <textarea name="description" class="form-control glow-input" rows="4" placeholder="Briefly describe your issue..." required></textarea>
                        </div>
                        <button type="submit" name="submit_complaint" class="glow-btn">
                            <i class="fa-solid fa-paper-plane"></i> Submit Ticket
                        </button>
                    </form>
                </div>
            </div>

            <!-- Complaint History -->
            <div class="col-lg-5">
                <div class="glass-form" style="padding: 30px;">
                    <h5 class="text-info mb-4"><i class="fa-solid fa-clock-rotate-left"></i> Your Recent Complaints</h5>
                    
                    <?php
                    $user_id = $_SESSION['user_id'];
                    $hist_query = "SELECT * FROM complaints WHERE user_id = '$user_id' ORDER BY created_at DESC LIMIT 5";
                    $result = $conn->query($hist_query);
                    
                    if($result && $result->num_rows > 0):
                        while($row = $result->fetch_assoc()):
                            $status_class = 'bg-secondary';
                            if($row['status'] == 'Resolved') $status_class = 'bg-success';
                            if($row['status'] == 'In Progress') $status_class = 'bg-warning text-dark';
                    ?>
                        <div class="history-card">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-info fw-bold"><?php echo htmlspecialchars($row['tracking_number']); ?></span>
                                <span class="badge status-badge <?php echo $status_class; ?>"><?php echo $row['status']; ?></span>
                            </div>
                            <h6 class="mb-1 text-light"><?php echo htmlspecialchars($row['category']); ?></h6>
                            <p class="text-muted small mb-0 text-truncate" title="<?php echo htmlspecialchars($row['description']); ?>">
                                <?php echo htmlspecialchars($row['description']); ?>
                            </p>
                            <small class="text-muted" style="font-size:0.7rem;"><?php echo date('d M Y, H:i', strtotime($row['created_at'])); ?></small>
                        </div>
                    <?php 
                        endwhile; 
                    else:
                    ?>
                        <div class="text-center text-muted mt-5">
                            <i class="fa-solid fa-folder-open mb-3" style="font-size:2rem; opacity:0.5;"></i>
                            <p>No complaints filed yet.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include('../includes/footer.php'); ?>
