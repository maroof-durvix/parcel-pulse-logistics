<?php
session_start();
include('config/db.php');

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if email already exists
    $check_sql = "SELECT id FROM users WHERE email = '$email'";
    $check_res = $conn->query($check_sql);

    if ($check_res->num_rows > 0) {
        $error = "AI User ID (Email) already assigned.";
    } elseif ($password !== $confirm_password) {
        $error = "Passkeys do not match.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashed_password')";
        
        if ($conn->query($sql) === TRUE) {
            $success = "AI Clearance Granted! You can now initialize session (Login).";
        } else {
            $error = "Error during registration: " . $conn->error;
        }
    }
}
?>
<?php include('includes/header.php'); ?>

<style>
/* Smart Register Glassmorphism Styles */
.register-hero {
    min-height: 100vh;
    display: flex;
    align-items: center;
    background: linear-gradient(135deg, rgba(10,14,23,0.95), rgba(8,17,32,0.9)), url('assets/img/login_bg.jpg') no-repeat center center/cover;
    padding-top: 80px; /* nav offset */
    padding-bottom: 40px;
}
.login-glass-card {
    background: rgba(20, 25, 40, 0.6);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(0, 255, 255, 0.2);
    border-radius: 25px;
    padding: 40px;
    box-shadow: 0 0 40px rgba(0, 255, 255, 0.1);
    position: relative;
    overflow: hidden;
}
.login-glass-card::before {
    content: '';
    position: absolute;
    top: -50%; left: -50%; width: 200%; height: 200%;
    background: radial-gradient(circle, rgba(0,255,255,0.1) 0%, transparent 60%);
    animation: rotateBg 10s linear infinite;
    pointer-events: none;
    z-index: 0;
}
@keyframes rotateBg {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
.login-content {
    position: relative;
    z-index: 1;
}
.ai-scan-box {
    text-align: center;
    margin-bottom: 25px;
}
.ai-scan-icon {
    font-size: 3rem;
    color: #00ffff;
    margin-bottom: 10px;
    text-shadow: 0 0 15px #00ffff;
    animation: pulseScan 2s infinite;
}
@keyframes pulseScan {
    0% { transform: scale(1); opacity: 0.8; }
    50% { transform: scale(1.1); opacity: 1; }
    100% { transform: scale(1); opacity: 0.8; }
}
.input-group-glass {
    background: rgba(0,0,0,0.4);
    border: 1px solid rgba(0, 255, 255, 0.3);
    border-radius: 12px;
    overflow: hidden;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    transition: all 0.3s;
}
.input-group-glass:focus-within {
    border-color: #00ffff;
    box-shadow: 0 0 15px rgba(0,255,255,0.4);
}
.input-group-glass i {
    padding: 15px;
    color: #00ffff;
    background: rgba(255,255,255,0.05);
}
.glass-input {
    background: transparent;
    border: none;
    color: white;
    padding: 15px;
    width: 100%;
    outline: none;
}
.glass-input::placeholder {
    color: rgba(255,255,255,0.5);
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
    margin-top: 10px;
}
.glow-btn:hover {
    box-shadow: 0 0 25px rgba(0, 210, 255, 0.9);
    transform: translateY(-2px);
}
.form-footer {
    text-align: center;
    margin-top: 20px;
    font-size: 0.9rem;
}
.form-footer a {
    color: #00ffff;
    text-decoration: none;
    transition: 0.3s;
}
.form-footer a:hover {
    text-decoration: underline;
    text-shadow: 0 0 10px #00ffff;
}
</style>

<div class="register-hero">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="login-glass-card">
                    
                    <div class="login-content">
                        <div class="ai-scan-box">
                            <i class="fa-solid fa-user-astronaut ai-scan-icon"></i>
                            <h3 class="fw-bold text-light mt-2">Request Clearance</h3>
                            <p class="text-muted" style="font-size: 0.85rem;">Create AI Logistics Profile</p>
                        </div>

                        <?php if(!empty($error)): ?>
                            <div class="alert alert-danger" style="background: rgba(220, 53, 69, 0.2); border: 1px solid #dc3545; color: #ffcccc; border-radius: 10px;">
                                <?php echo $error; ?>
                            </div>
                        <?php endif; ?>

                        <?php if(!empty($success)): ?>
                            <div class="alert alert-success" style="background: rgba(40, 167, 69, 0.2); border: 1px solid #28a745; color: #ccffcc; border-radius: 10px;">
                                <?php echo $success; ?> <a href="login.php" class="text-info fw-bold">Login Here</a>
                            </div>
                        <?php endif; ?>

                        <form id="ai-register-form" method="POST" action="register.php">
                            <div class="input-group-glass">
                                <i class="fa-solid fa-user"></i>
                                <input type="text" name="name" class="glass-input" placeholder="Full Name" required>
                            </div>

                            <div class="input-group-glass">
                                <i class="fa-solid fa-envelope"></i>
                                <input type="email" name="email" class="glass-input" placeholder="AI User ID / Email" required>
                            </div>
                            
                            <div class="input-group-glass">
                                <i class="fa-solid fa-lock"></i>
                                <input type="password" name="password" class="glass-input" placeholder="Passkey" required>
                            </div>

                            <div class="input-group-glass">
                                <i class="fa-solid fa-check-double"></i>
                                <input type="password" name="confirm_password" class="glass-input" placeholder="Confirm Passkey" required>
                            </div>
                            
                            <button type="submit" name="register" class="glow-btn">
                                <i class="fa-solid fa-id-card"></i> Generate Identity
                            </button>
                        </form>
                        
                        <div class="form-footer">
                            <span class="text-muted">Already have clearance?</span> <a href="login.php">Initialize Session</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('ai-register-form').addEventListener('submit', function() {
    const btn = this.querySelector('.glow-btn');
    btn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin"></i> Processing Identity...';
});
</script>

<?php include('includes/footer.php'); ?>
