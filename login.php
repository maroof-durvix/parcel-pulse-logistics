<?php
session_start();
include('config/db.php');

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT id, name, password, role FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_role'] = $user['role'];
            header("Location: index.php");
            exit();
        } else {
            $error = "Invalid Passkey.";
        }
    } else {
        $error = "AI User ID not found.";
    }
}
?>
<?php include('includes/header.php'); ?>

<style>
/* Smart Login Glassmorphism Styles */
.login-hero {
    min-height: 100vh;
    display: flex;
    align-items: center;
    background: linear-gradient(135deg, rgba(10,14,23,0.95), rgba(8,17,32,0.9)), url('assets/img/login_bg.jpg') no-repeat center center/cover;
    padding-top: 80px; /* nav offset */
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
    font-size: 3.5rem;
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
    margin-bottom: 20px;
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
.face-id-btn {
    background: rgba(0, 255, 255, 0.1);
    border: 1px solid #00ffff;
    color: #00ffff;
    border-radius: 50px;
    padding: 10px 20px;
    width: 100%;
    margin-top: 15px;
    transition: all 0.3s ease;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
}
.face-id-btn:hover {
    background: rgba(0, 255, 255, 0.2);
    box-shadow: 0 0 15px rgba(0,255,255,0.5);
}
/* Scanning Animation Overlay */
#scan-overlay {
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    background: rgba(10,14,23,0.9);
    z-index: 10;
    display: none;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    border-radius: 25px;
}
.scan-line {
    width: 80%;
    height: 2px;
    background: #00ffff;
    box-shadow: 0 0 10px #00ffff, 0 0 20px #00ffff;
    animation: scanUpDown 2s ease-in-out infinite;
}
@keyframes scanUpDown {
    0% { transform: translateY(-50px); }
    50% { transform: translateY(50px); }
    100% { transform: translateY(-50px); }
}
</style>

<div class="login-hero">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="login-glass-card">
                    
                    <!-- Scanner Overlay -->
                    <div id="scan-overlay">
                        <i class="fa-solid fa-face-viewfinder mb-3 text-info" style="font-size: 4rem;"></i>
                        <div class="scan-line"></div>
                        <p class="text-info mt-3 fw-bold">Authenticating via AI...</p>
                    </div>

                    <div class="login-content">
                        <div class="ai-scan-box">
                            <i class="fa-solid fa-fingerprint ai-scan-icon"></i>
                            <h3 class="fw-bold text-light mt-2">Secure Portal</h3>
                            <p class="text-muted" style="font-size: 0.85rem;">Encrypted AI Gateway Access</p>
                        </div>

                        <?php if(!empty($error)): ?>
                            <div class="alert alert-danger" style="background: rgba(220, 53, 69, 0.2); border: 1px solid #dc3545; color: #ffcccc; border-radius: 10px;">
                                <?php echo $error; ?>
                            </div>
                        <?php endif; ?>

                        <form id="ai-login-form" method="POST" action="login.php">
                            <div class="input-group-glass">
                                <i class="fa-solid fa-envelope"></i>
                                <input type="email" name="email" class="glass-input" placeholder="AI User ID / Email" required>
                            </div>
                            
                            <div class="input-group-glass">
                                <i class="fa-solid fa-lock"></i>
                                <input type="password" name="password" class="glass-input" placeholder="Passkey" required>
                            </div>
                            
                            <div class="d-flex justify-content-between mb-3" style="font-size: 0.85rem;">
                                <div>
                                    <input type="checkbox" id="remember" class="form-check-input" style="background: rgba(0,0,0,0.5); border-color: #00ffff;">
                                    <label for="remember" class="text-light ms-1">Remember Device</label>
                                </div>
                                <a href="#" style="color: #00ffff; text-decoration: none;">Forgot Key?</a>
                            </div>

                            <button type="submit" name="login" class="glow-btn">
                                <i class="fa-solid fa-right-to-bracket"></i> Initialize Session
                            </button>
                            
                            <div class="text-center mt-3 mb-2 text-muted">OR</div>
                            
                            <button type="button" class="face-id-btn" id="face-id-login">
                                <i class="fa-solid fa-face-smile"></i> Login with AI FaceID
                            </button>
                        </form>
                        
                        <div class="form-footer">
                            <span class="text-muted">No account?</span> <a href="register.php">Request AI Clearance</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('face-id-login').addEventListener('click', function() {
    const overlay = document.getElementById('scan-overlay');
    overlay.style.display = 'flex';
    
    setTimeout(() => {
        overlay.innerHTML = '<i class="fa-solid fa-check-circle text-success" style="font-size: 4rem; text-shadow: 0 0 15px #28a745;"></i><p class="text-success mt-3 fw-bold">Identity Confirmed</p>';
        setTimeout(() => {
            window.location.href = 'index.php'; // FaceID mock fallback
        }, 1000);
    }, 2500);
});

// Removed the e.preventDefault() to allow the form to submit to PHP
document.getElementById('ai-login-form').addEventListener('submit', function() {
    const btn = this.querySelector('.glow-btn');
    btn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin"></i> Authenticating...';
});
</script>

<?php include('includes/footer.php'); ?>
