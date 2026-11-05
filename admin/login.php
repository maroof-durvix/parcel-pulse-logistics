<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$error = "";

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (($username === "admin" || $username === "admin@parcelpulse.com") && $password === "12345") {
        $_SESSION['admin'] = true;
        $_SESSION['user_id'] = 1;
        $_SESSION['user_name'] = "System Administrator";
        $_SESSION['user_role'] = "admin";
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid Administrator Credentials.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parcel Pulse - Admin Terminal Gateway</title>
    <!-- Fonts & Bootstrap -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body style="background: radial-gradient(circle at 50% 30%, #0c172e 0%, #050912 100%); min-height: 100vh; display: flex; align-items: center;">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6">
            <div class="pulse-card">
                <div class="text-center mb-4">
                    <div class="p-3 rounded-circle mx-auto mb-3" style="width: 65px; height: 65px; background: rgba(0, 242, 254, 0.1); color: var(--cyan); display: flex; align-items: center; justify-content: center; font-size: 1.8rem;">
                        <i class="fa-solid fa-satellite-dish"></i>
                    </div>
                    <h4 class="fw-bold text-white mb-1">Pulse Admin Gateway</h4>
                    <span class="badge-cyan small">Operational Level 1 Security</span>
                </div>

                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger py-2 small border-0 rounded-3 text-white mb-3" style="background: rgba(239, 68, 68, 0.2); border: 1px solid #ef4444 !important;">
                        <i class="fa-solid fa-circle-exclamation me-1"></i> <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>

                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label text-secondary small">Admin Handle</label>
                        <input type="text" name="username" class="form-control pulse-input" placeholder="admin" value="admin" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-secondary small">Access Passkey</label>
                        <input type="password" name="password" class="form-control pulse-input" placeholder="•••••" value="12345" required>
                    </div>

                    <button type="submit" name="login" class="glow-btn mb-3">
                        <i class="fa-solid fa-lock-open me-1"></i> Unlock Admin Console
                    </button>
                </form>

                <div class="text-center pt-2">
                    <a href="../index.php" class="text-secondary small text-decoration-none hover-cyan">
                        <i class="fa-solid fa-arrow-left me-1"></i> Return to Public Site
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
