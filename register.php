<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include('config/db.php');

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $name = $conn->real_escape_string(trim($_POST['name']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if email already exists
    $check_sql = "SELECT id FROM users WHERE email = '$email'";
    $check_res = $conn->query($check_sql);

    if ($check_res && $check_res->num_rows > 0) {
        $error = "An account with this Email (AI User ID) is already registered.";
    } elseif ($password !== $confirm_password) {
        $error = "Passkeys do not match. Please re-enter.";
    } elseif (strlen($password) < 4) {
        $error = "Passkey must be at least 4 characters long.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$hashed_password', 'user')";

        if ($conn->query($sql) === TRUE) {
            $success = "AI Clearance Granted! Your profile has been initialized. You may now log in.";
        } else {
            $error = "Error during registration: " . $conn->error;
        }
    }
}
?>
<?php include('includes/header.php'); ?>

<section class="page-hero hero-auth" style="min-height: 85vh; display: flex; align-items: center;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8">
                <div class="pulse-card">
                    <div class="text-center mb-4">
                        <div class="p-3 rounded-circle mx-auto mb-3" style="width: 70px; height: 70px; background: rgba(16, 185, 129, 0.1); color: #10b981; display: flex; align-items: center; justify-content: center; font-size: 2rem;">
                            <i class="fa-solid fa-user-shield"></i>
                        </div>
                        <h3 class="fw-bold text-white mb-1">Request AI Clearance</h3>
                        <p class="text-secondary small">Register your corporate or individual shipper identity</p>
                    </div>

                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger border-0 rounded-3 text-white py-2 small mb-4" style="background: rgba(239, 68, 68, 0.2); border: 1px solid #ef4444 !important;">
                            <i class="fa-solid fa-circle-exclamation me-1"></i> <?php echo htmlspecialchars($error); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($success)): ?>
                        <div class="alert alert-success border-0 rounded-3 text-white py-3 small mb-4" style="background: rgba(16, 185, 129, 0.2); border: 1px solid #10b981 !important;">
                            <i class="fa-solid fa-circle-check text-success me-1"></i> <?php echo htmlspecialchars($success); ?>
                            <div class="mt-2">
                                <a href="login.php" class="btn btn-sm btn-pulse-primary py-1 px-3">Go to Login &rarr;</a>
                            </div>
                        </div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label text-secondary small">Full Name / Organization</label>
                            <input type="text" name="name" class="form-control pulse-input" placeholder="e.g. Sarah Jenkins" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-secondary small">AI User ID (Email)</label>
                            <input type="email" name="email" class="form-control pulse-input" placeholder="e.g. sarah@company.com" required>
                        </div>

                        <div class="row g-2 mb-4">
                            <div class="col-md-6">
                                <label class="form-label text-secondary small">Passkey</label>
                                <input type="password" name="password" class="form-control pulse-input" placeholder="••••••••" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-secondary small">Confirm Passkey</label>
                                <input type="password" name="confirm_password" class="form-control pulse-input" placeholder="••••••••" required>
                            </div>
                        </div>

                        <button type="submit" name="register" class="glow-btn mb-3">
                            <i class="fa-solid fa-id-card me-1"></i> Initialize Identity
                        </button>
                    </form>

                    <div class="text-center pt-2 text-secondary small">
                        Already have clearance? <a href="login.php" class="text-info text-decoration-none fw-bold">Authenticate Session (Login)</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('includes/footer.php'); ?>
