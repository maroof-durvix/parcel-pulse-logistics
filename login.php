<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include('config/db.php');

$error = "";

// If already logged in, redirect
if (isset($_SESSION['user_id'])) {
    if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
        header("Location: admin/dashboard.php");
    } else {
        header("Location: index.php");
    }
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $email = $conn->real_escape_string(trim($_POST['email']));
    $password = $_POST['password'];

    // Direct admin shortcut support
    if (($email === 'admin' || $email === 'admin@parcelpulse.com') && $password === '12345') {
        $_SESSION['user_id'] = 1;
        $_SESSION['user_name'] = 'System Administrator';
        $_SESSION['user_role'] = 'admin';
        $_SESSION['admin'] = true;
        header("Location: admin/dashboard.php");
        exit();
    }

    $sql = "SELECT id, name, password, role FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_role'] = $user['role'];
            if ($user['role'] === 'admin') {
                $_SESSION['admin'] = true;
                header("Location: admin/dashboard.php");
            } else {
                header("Location: index.php");
            }
            exit();
        } else {
            $error = "Authentication failed: Invalid Passkey.";
        }
    } else {
        $error = "Authentication failed: AI User Account not found.";
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
                        <div class="p-3 rounded-circle mx-auto mb-3" style="width: 70px; height: 70px; background: rgba(0, 242, 254, 0.1); color: var(--cyan); display: flex; align-items: center; justify-content: center; font-size: 2rem;">
                            <i class="fa-solid fa-fingerprint"></i>
                        </div>
                        <h3 class="fw-bold text-white mb-1">Client Secure Portal</h3>
                        <p class="text-secondary small">Authenticate to access AI telemetry and manage shipments</p>
                    </div>

                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger border-0 rounded-3 text-white py-2 small mb-4" style="background: rgba(239, 68, 68, 0.2); border: 1px solid #ef4444 !important;">
                            <i class="fa-solid fa-circle-exclamation me-1"></i> <?php echo htmlspecialchars($error); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_GET['notice']) && $_GET['notice'] === 'login_required'): ?>
                        <div class="alert alert-warning border-0 rounded-3 text-white py-2 small mb-4" style="background: rgba(245, 158, 11, 0.2); border: 1px solid #f59e0b !important;">
                            <i class="fa-solid fa-shield-halved me-1"></i> Please sign in to submit a support ticket or access telemetry.
                        </div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label text-secondary small">AI User ID / Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text border-0" style="background: rgba(0, 242, 254, 0.1); color: var(--cyan);"><i class="fa-solid fa-user"></i></span>
                                <input type="text" name="email" id="loginEmail" class="form-control pulse-input" placeholder="e.g. user@parcelpulse.com" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <label class="form-label text-secondary small">Encrypted Passkey</label>
                                <a href="#" class="text-secondary small text-decoration-none hover-cyan" onclick="alert('Demo Passkeys:\nUser: user123\nAdmin: 12345'); return false;">Forgot Passkey?</a>
                            </div>
                            <div class="input-group">
                                <span class="input-group-text border-0" style="background: rgba(0, 242, 254, 0.1); color: var(--cyan);"><i class="fa-solid fa-lock"></i></span>
                                <input type="password" name="password" id="loginPass" class="form-control pulse-input" placeholder="••••••••" required>
                                <button type="button" class="btn btn-outline-secondary border-0" style="background: rgba(6, 11, 20, 0.8);" onclick="togglePasswordVisibility()">
                                    <i class="fa-solid fa-eye text-secondary" id="eyeIcon"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-4 d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="rememberMe" checked>
                                <label class="form-check-label text-secondary small" for="rememberMe">Remember Session</label>
                            </div>
                        </div>

                        <button type="submit" name="login" class="glow-btn mb-3">
                            <i class="fa-solid fa-arrow-right-to-bracket me-1"></i> Initialize Session
                        </button>
                    </form>

                    <!-- Fast Demo Auto-fill Helper -->
                    <div class="p-3 rounded-3 mb-3" style="background: rgba(6, 11, 20, 0.7); border: 1px solid rgba(255,255,255,0.06);">
                        <span class="text-secondary small d-block mb-2 text-center">Instant Demo Fill:</span>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-sm btn-outline-info w-50" onclick="fillCreds('user@parcelpulse.com', 'user123')">
                                <i class="fa-solid fa-user me-1"></i> Client User
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-warning w-50" onclick="fillCreds('admin@parcelpulse.com', '12345')">
                                <i class="fa-solid fa-shield-halved me-1"></i> Admin Console
                            </button>
                        </div>
                    </div>

                    <div class="text-center pt-2 text-secondary small">
                        New client? <a href="register.php" class="text-info text-decoration-none fw-bold">Request AI Clearance (Register)</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function togglePasswordVisibility() {
    const input = document.getElementById('loginPass');
    const icon = document.getElementById('eyeIcon');
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
}

function fillCreds(email, pass) {
    document.getElementById('loginEmail').value = email;
    document.getElementById('loginPass').value = pass;
}
</script>

<?php include('includes/footer.php'); ?>
