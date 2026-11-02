<?php include('../includes/header.php'); ?>

<style>
/* Smart Lockers Glassmorphism */
.locker-hero {
    position: relative;
    padding: 120px 0 60px;
    background: url('../assets/img/lockers_bg.jpg') no-repeat center center/cover;
    background-color: #0a0e17; /* Fallback */
    border-bottom: 1px solid rgba(0, 255, 255, 0.2);
    min-height: 100vh;
}
.locker-hero::before {
    content: '';
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    background: linear-gradient(135deg, rgba(10,14,23,0.95) 0%, rgba(8,17,32,0.9) 100%);
}
.locker-content {
    position: relative;
    z-index: 2;
}
.glass-box {
    background: rgba(20, 25, 40, 0.6);
    backdrop-filter: blur(15px);
    border: 1px solid rgba(0, 255, 255, 0.3);
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 0 30px rgba(0, 255, 255, 0.1);
    height: 100%;
}
.locker-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
    margin-top: 20px;
}
.locker-door {
    background: rgba(0,0,0,0.5);
    border: 1px solid rgba(0, 255, 255, 0.3);
    border-radius: 10px;
    height: 80px;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #fff;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s;
    position: relative;
    overflow: hidden;
}
.locker-door:hover {
    background: rgba(0,255,255,0.1);
    box-shadow: 0 0 15px rgba(0,255,255,0.3);
}
.locker-door.occupied {
    background: rgba(220, 53, 69, 0.2);
    border-color: #dc3545;
    color: #ffcccc;
}
.locker-door.unlocked {
    background: rgba(40, 167, 69, 0.3);
    border-color: #28a745;
    color: #ccffcc;
    box-shadow: 0 0 20px rgba(40,167,69,0.5);
}
.nfc-reader {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    border: 2px dashed #00ffff;
    margin: 20px auto;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 2rem;
    color: #00ffff;
    animation: spinSlow 10s linear infinite;
}
@keyframes spinSlow {
    100% { transform: rotate(360deg); }
}
.pin-input {
    background: transparent;
    border: none;
    border-bottom: 2px solid #00ffff;
    color: #fff;
    font-size: 2rem;
    text-align: center;
    width: 60%;
    margin: 0 auto;
    outline: none;
    letter-spacing: 15px;
}
.glow-btn {
    background: linear-gradient(45deg, #00d2ff, #3a7bd5);
    border: none;
    color: white;
    font-weight: bold;
    border-radius: 50px;
    padding: 10px 30px;
    box-shadow: 0 0 15px rgba(0, 210, 255, 0.6);
    transition: all 0.3s ease;
}
.glow-btn:hover {
    box-shadow: 0 0 25px rgba(0, 210, 255, 0.9);
}
</style>

<div class="locker-hero text-light">
    <div class="container locker-content">
        
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold"><i class="fa-solid fa-vault text-info"></i> Smart Lockers</h1>
            <p class="lead text-muted">Module 9: 24/7 Secure AI-Monitored Parcel Retrieval.</p>
        </div>

        <div class="row g-4 justify-content-center">
            
            <!-- Locker Visualizer -->
            <div class="col-lg-5">
                <div class="glass-box">
                    <h5 class="text-info text-center mb-2">Pulse Locker Terminal #402</h5>
                    <p class="text-center text-muted small">Location: Central Mall, Karachi</p>
                    
                    <div class="locker-grid" id="lockerGrid">
                        <div class="locker-door">01</div>
                        <div class="locker-door">02</div>
                        <div class="locker-door occupied" title="Occupied">03 <i class="fa-solid fa-lock ms-2" style="font-size:0.6rem;"></i></div>
                        <div class="locker-door">04</div>
                        <div class="locker-door occupied" id="targetLocker" title="Your Parcel">05 <i class="fa-solid fa-box text-warning ms-2" style="font-size:0.6rem;"></i></div>
                        <div class="locker-door">06</div>
                        <div class="locker-door">07</div>
                        <div class="locker-door occupied" title="Occupied">08 <i class="fa-solid fa-lock ms-2" style="font-size:0.6rem;"></i></div>
                        <div class="locker-door">09</div>
                    </div>
                </div>
            </div>

            <!-- Interaction Panel -->
            <div class="col-lg-5">
                <div class="glass-box text-center">
                    <h5 class="text-info mb-4">Unlock Your Parcel</h5>
                    
                    <!-- Nav Tabs -->
                    <ul class="nav nav-pills justify-content-center mb-4" id="lockerTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active bg-transparent border border-info text-info rounded-pill mx-1" id="nfc-tab" data-bs-toggle="tab" data-bs-target="#nfc-pane" type="button" role="tab">NFC Unlock</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link bg-transparent border border-info text-info rounded-pill mx-1" id="pin-tab" data-bs-toggle="tab" data-bs-target="#pin-pane" type="button" role="tab">PIN Code</button>
                        </li>
                    </ul>
                    
                    <div class="tab-content" id="lockerTabsContent">
                        
                        <!-- NFC Mode -->
                        <div class="tab-pane fade show active" id="nfc-pane" role="tabpanel">
                            <p class="text-muted small">Hold your phone near the terminal scanner.</p>
                            <div class="nfc-reader" id="nfcReader">
                                <i class="fa-solid fa-wifi fa-rotate-90"></i>
                            </div>
                            <button class="glow-btn mt-3" onclick="simulateNFC()">Simulate NFC Tap</button>
                        </div>
                        
                        <!-- PIN Mode -->
                        <div class="tab-pane fade" id="pin-pane" role="tabpanel">
                            <p class="text-muted small">Enter the 4-digit PIN sent to your app.</p>
                            <input type="password" class="form-control pin-input mb-4" id="pinInput" maxlength="4" placeholder="••••">
                            <p class="text-danger small d-none" id="pinError">Invalid PIN. Try again.</p>
                            <button class="glow-btn mt-2" onclick="verifyPin()">Verify & Unlock</button>
                        </div>
                        
                    </div>

                    <!-- Success Message (Hidden) -->
                    <div id="unlockSuccess" class="mt-4 d-none">
                        <h4 class="text-success"><i class="fa-solid fa-check-circle"></i> Access Granted!</h4>
                        <p class="text-muted">Locker #05 is now unlocked. Please collect your parcel.</p>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<script>
// Simulate NFC Tap
function simulateNFC() {
    const reader = document.getElementById('nfcReader');
    reader.style.borderColor = "#28a745";
    reader.style.color = "#28a745";
    reader.innerHTML = '<i class="fa-solid fa-check"></i>';
    
    setTimeout(() => {
        unlockLocker();
    }, 1000);
}

// Verify PIN (Correct PIN is 1234 for demo)
function verifyPin() {
    const pin = document.getElementById('pinInput').value;
    if(pin === '1234') {
        document.getElementById('pinError').classList.add('d-none');
        document.getElementById('pinInput').style.borderColor = '#28a745';
        document.getElementById('pinInput').style.color = '#28a745';
        unlockLocker();
    } else {
        document.getElementById('pinError').classList.remove('d-none');
        document.getElementById('pinInput').style.borderColor = '#dc3545';
    }
}

// Global Unlock Action
function unlockLocker() {
    // Hide inputs, show success
    document.getElementById('lockerTabs').style.display = 'none';
    document.getElementById('lockerTabsContent').style.display = 'none';
    document.getElementById('unlockSuccess').classList.remove('d-none');
    
    // Change Locker UI
    const targetLocker = document.getElementById('targetLocker');
    targetLocker.classList.remove('occupied');
    targetLocker.classList.add('unlocked');
    targetLocker.innerHTML = '05 <i class="fa-solid fa-door-open ms-2"></i>';
}
</script>

<?php include('../includes/footer.php'); ?>
