<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include('../config/db.php');

$message = '';
$message_type = '';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php?notice=login_required");
    exit();
}

$user_id = (int)$_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_complaint'])) {
    $tracking_number = $conn->real_escape_string(trim($_POST['tracking_number']));
    $category = $conn->real_escape_string($_POST['category']);
    $description = $conn->real_escape_string(trim($_POST['description']));

    $query = "INSERT INTO complaints (user_id, tracking_number, category, description) 
              VALUES ($user_id, '$tracking_number', '$category', '$description')";

    if ($conn->query($query) === TRUE) {
        $message = "Your support ticket has been submitted successfully. A ticket ID has been generated for resolution.";
        $message_type = "success";
    } else {
        $message = "Error submitting complaint: " . $conn->error;
        $message_type = "danger";
    }
}

// Fetch user complaints
$complaints_res = $conn->query("SELECT * FROM complaints WHERE user_id = $user_id ORDER BY created_at DESC");
?>

<?php include('../includes/header.php'); ?>

<!-- HERO -->
<section class="page-hero hero-complaint">
    <div class="container text-center">
        <span class="badge-cyan mb-2 d-inline-block"><i class="fa-solid fa-headset me-1"></i> 24/7 Client Support</span>
        <h1 class="hero-title-gradient">Resolution & Support Tickets</h1>
        <p class="text-secondary max-w-lg mx-auto" style="max-width: 650px;">
            Submit inquiries regarding delayed waybills, damaged packages, or customs clearances. Our support engineers prioritize all tickets within 2 hours.
        </p>
    </div>
</section>

<!-- MAIN SUPPORT PORTAL -->
<section class="py-5" style="background: var(--bg-main);">
    <div class="container">
        <!-- Alert message if any -->
        <?php if (!empty($message)): ?>
            <div class="alert alert-<?php echo $message_type; ?> alert-dismissible fade show mb-4 border-0 rounded-3 text-white" style="background: <?php echo $message_type === 'success' ? 'rgba(16, 185, 129, 0.2)' : 'rgba(239, 68, 68, 0.2)'; ?>; border: 1px solid <?php echo $message_type === 'success' ? '#10b981' : '#ef4444'; ?> !important;" role="alert">
                <i class="fa-solid <?php echo $message_type === 'success' ? 'fa-circle-check text-success' : 'fa-circle-exclamation text-danger'; ?> me-2"></i>
                <?php echo htmlspecialchars($message); ?>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="row g-4">
            <!-- Ticket Submission Form -->
            <div class="col-lg-6">
                <div class="pulse-card h-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fa-solid fa-ticket text-info fs-5"></i>
                            <h4 class="fw-bold text-white mb-0">File a Support Ticket</h4>
                        </div>
                        <span class="badge-cyan small">Client: <?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                    </div>
                    <p class="text-secondary small mb-4">Provide your tracking reference and details so our support engineers can investigate immediately.</p>

                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label text-secondary small">Waybill / Consignment Tracking Number</label>
                            <input type="text" name="tracking_number" class="form-control pulse-input auto-waybill" placeholder="e.g. PP-8492-AI" value="PP-8492-AI" required style="letter-spacing: 1.5px; font-weight: 600;">
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-secondary small">Issue Category</label>
                            <select name="category" class="form-select pulse-select" required>
                                <option value="Delay">Transit Delay / Weather Hold</option>
                                <option value="Damage">Package Damage / Inspection</option>
                                <option value="Lost parcel">Missed Delivery / Lost Parcel</option>
                                <option value="Other">Customs Documentation / Other</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-secondary small">Detailed Description</label>
                            <textarea name="description" class="form-control pulse-input" rows="4" placeholder="Describe the consignment issue, location, or requested assistance..." required></textarea>
                        </div>

                        <button type="submit" name="submit_complaint" class="glow-btn">
                            <i class="fa-solid fa-paper-plane me-1"></i> Transmit Ticket to Support Core
                        </button>
                    </form>
                </div>
            </div>

            <!-- Active Tickets History -->
            <div class="col-lg-6">
                <div class="pulse-card h-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fa-solid fa-clock-rotate-left text-info fs-5"></i>
                            <h4 class="fw-bold text-white mb-0">Your Support Tickets</h4>
                        </div>
                        <span class="badge-cyan small">Active Log</span>
                    </div>
                    <p class="text-secondary small mb-4">Live status updates from our customer response triage team.</p>

                    <div class="d-flex flex-column gap-3">
                        <?php if ($complaints_res && $complaints_res->num_rows > 0): ?>
                            <?php while ($c = $complaints_res->fetch_assoc()): ?>
                                <?php
                                $status_badge = 'bg-warning text-dark';
                                if ($c['status'] === 'Resolved') $status_badge = 'bg-success text-white';
                                elseif ($c['status'] === 'In Progress') $status_badge = 'bg-info text-dark';
                                ?>
                                <div class="p-3 rounded-3" style="background: rgba(6, 11, 20, 0.8); border: 1px solid rgba(0, 242, 254, 0.2);">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="fw-bold text-white">#<?php echo $c['id']; ?></span>
                                            <span class="text-info fw-semibold font-monospace"><?php echo htmlspecialchars($c['tracking_number']); ?></span>
                                        </div>
                                        <span class="badge <?php echo $status_badge; ?> rounded-pill px-2 py-1" style="font-size: 0.75rem;">
                                            <?php echo htmlspecialchars($c['status']); ?>
                                        </span>
                                    </div>
                                    <div class="small text-secondary mb-2">
                                        <span class="text-white fw-semibold"><?php echo htmlspecialchars($c['category']); ?></span> &bull; 
                                        <span><?php echo date('M d, Y H:i', strtotime($c['created_at'])); ?></span>
                                    </div>
                                    <p class="small text-light mb-0" style="opacity: 0.9;">
                                        <?php echo nl2br(htmlspecialchars($c['description'])); ?>
                                    </p>
                                </div>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <div class="text-center py-5 text-secondary">
                                <i class="fa-solid fa-circle-check fs-1 text-success opacity-50 mb-3"></i>
                                <h6>No Open Tickets Found</h6>
                                <p class="small">All your consignments are currently in smooth transit.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('../includes/footer.php'); ?>
