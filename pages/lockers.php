<?php include('../includes/header.php'); ?>

<style>
.locker-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
    margin-top: 20px;
}
.locker-door {
    background: rgba(6, 11, 20, 0.85);
    border: 1px solid rgba(0, 242, 254, 0.25);
    border-radius: var(--radius-md);
    height: 90px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    color: #fff;
    font-weight: 700;
    font-size: 1.1rem;
    transition: var(--transition);
    cursor: pointer;
    position: relative;
}
.locker-door:hover {
    border-color: var(--cyan);
    box-shadow: 0 0 15px rgba(0, 242, 254, 0.3);
}
.locker-door.occupied {
    background: rgba(239, 68, 68, 0.15);
    border-color: rgba(239, 68, 68, 0.4);
    color: #fca5a5;
}
.locker-door.unlocked {
    background: rgba(16, 185, 129, 0.25);
    border-color: #10b981;
    color: #86efac;
    box-shadow: 0 0 25px rgba(16, 185, 129, 0.5);
    animation: doorGlow 1.5s infinite alternate;
}
@keyframes doorGlow {
    from { box-shadow: 0 0 15px rgba(16, 185, 129, 0.3); }
    to { box-shadow: 0 0 30px rgba(16, 185, 129, 0.8); }
}

.nfc-reader {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    border: 2px dashed var(--cyan);
    margin: 20px auto;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 2.2rem;
    color: var(--cyan);
    transition: var(--transition);
}
.pin-input {
    background: rgba(6, 11, 20, 0.9) !important;
    border: 2px solid rgba(0, 242, 254, 0.3) !important;
    color: var(--cyan) !important;
    font-size: 1.8rem !important;
    text-align: center !important;
    letter-spacing: 12px !important;
    border-radius: var(--radius-md) !important;
}
</style>

<!-- HERO SECTION -->
<section class="page-hero hero-lockers">
    <div class="container text-center">
        <span class="badge-green mb-2 d-inline-block"><i class="fa-solid fa-vault me-1"></i> 24/7 Decentralized Vault Network</span>
        <h1 class="hero-title-gradient">Smart IoT Delivery Lockers</h1>
        <p class="text-secondary max-w-lg mx-auto" style="max-width: 650px;">
            Contactless parcel pick-up & drop-off. Authenticate via smartphone NFC tap or one-time encrypted PIN.
        </p>
    </div>
</section>

<!-- LOCKER TERMINAL INTERFACE -->
<section class="py-5" style="background: var(--bg-main);">
    <div class="container">
        <div class="row g-4 justify-content-center">
            <!-- Locker Grid Visualizer -->
            <div class="col-lg-5">
                <div class="pulse-card">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fa-solid fa-server text-info"></i>
                            <h5 class="fw-bold text-white mb-0">Pulse Terminal #402</h5>
                        </div>
                        <span class="badge-cyan small">DHA Phase 6, Karachi</span>
                    </div>
                    <p class="text-secondary small mb-4">Click target locker or use the controller on the right to authenticate.</p>

                    <div class="locker-grid" id="lockerGrid">
                        <div class="locker-door"><span>01</span><small class="text-secondary font-monospace" style="font-size: 0.65rem;">Empty</small></div>
                        <div class="locker-door"><span>02</span><small class="text-secondary font-monospace" style="font-size: 0.65rem;">Empty</small></div>
                        <div class="locker-door occupied" title="Occupied"><span>03</span><small class="text-danger" style="font-size: 0.65rem;"><i class="fa-solid fa-lock"></i> Locked</small></div>
                        <div class="locker-door"><span>04</span><small class="text-secondary font-monospace" style="font-size: 0.65rem;">Empty</small></div>
                        <div class="locker-door occupied" id="targetLocker" title="Your Incoming Parcel (PP-8492-AI)">
                            <span>05</span>
                            <small class="text-warning" style="font-size: 0.65rem;"><i class="fa-solid fa-box"></i> Your Parcel</small>
                        </div>
                        <div class="locker-door"><span>06</span><small class="text-secondary font-monospace" style="font-size: 0.65rem;">Empty</small></div>
                        <div class="locker-door"><span>07</span><small class="text-secondary font-monospace" style="font-size: 0.65rem;">Empty</small></div>
                        <div class="locker-door occupied" title="Occupied"><span>08</span><small class="text-danger" style="font-size: 0.65rem;"><i class="fa-solid fa-lock"></i> Locked</small></div>
                        <div class="locker-door"><span>09</span><small class="text-secondary font-monospace" style="font-size: 0.65rem;">Empty</small></div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4 small text-secondary">
                        <div><span style="display:inline-block; width:10px; height:10px; border-radius:2px; background:rgba(6,11,20,0.85); border:1px solid #00f2fe;" class="me-1"></span> Available</div>
                        <div><span style="display:inline-block; width:10px; height:10px; border-radius:2px; background:rgba(239,68,68,0.4);" class="me-1"></span> In Use</div>
                        <div><span style="display:inline-block; width:10px; height:10px; border-radius:2px; background:#10b981;" class="me-1"></span> Unlocked</div>
                    </div>
                </div>
            </div>

            <!-- Interaction Unlock Controller -->
            <div class="col-lg-5">
                <div class="pulse-card text-center h-100 d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="fw-bold text-white mb-2"><i class="fa-solid fa-key text-info me-2"></i> Terminal Authentication</h5>
                        <p class="text-secondary small mb-4">Choose verification method to unlock your reserved locker:</p>

                        <!-- Nav Tabs -->
                        <ul class="nav nav-pills justify-content-center mb-4" id="lockerTabs" role="tablist">
                            <li class="nav-item me-2">
                                <button class="btn btn-pulse-outline active" id="nfc-tab" data-bs-toggle="tab" data-bs-target="#nfc-pane" type="button" role="tab">
                                    <i class="fa-solid fa-wifi fa-rotate-90 me-1"></i> NFC Tap Mode
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="btn btn-pulse-outline" id="pin-tab" data-bs-toggle="tab" data-bs-target="#pin-pane" type="button" role="tab">
                                    <i class="fa-solid fa-hashtag me-1"></i> 4-Digit PIN Mode
                                </button>
                            </li>
                        </ul>

                        <div class="tab-content" id="lockerTabsContent">
                            <!-- NFC Mode -->
                            <div class="tab-pane fade show active" id="nfc-pane" role="tabpanel">
                                <p class="text-secondary small">Position your NFC-enabled mobile device near the digital sensor.</p>
                                <div class="nfc-reader" id="nfcReader">
                                    <i class="fa-solid fa-mobile-screen"></i>
                                </div>
                                <button class="glow-btn mt-3" onclick="simulateNFC()">
                                    <i class="fa-solid fa-satellite-dish me-1"></i> Simulate Mobile NFC Tap
                                </button>
                            </div>

                            <!-- PIN Mode -->
                            <div class="tab-pane fade" id="pin-pane" role="tabpanel">
                                <p class="text-secondary small">Demo Access PIN: <strong class="text-info">1234</strong></p>
                                <div class="my-4">
                                    <input type="password" class="form-control pin-input mx-auto" id="pinInput" maxlength="4" placeholder="••••" style="max-width: 200px;">
                                </div>
                                <p class="text-danger small d-none" id="pinError"><i class="fa-solid fa-circle-exclamation me-1"></i> Incorrect PIN code. Try 1234.</p>
                                <button class="glow-btn" onclick="verifyPin()">
                                    <i class="fa-solid fa-unlock me-1"></i> Verify Code & Release
                                </button>
                            </div>
                        </div>

                        <!-- Success Box -->
                        <div id="unlockSuccess" class="mt-4 p-4 rounded-3 d-none" style="background: rgba(16, 185, 129, 0.1); border: 1px solid #10b981;">
                            <h4 class="text-success fw-bold mb-1"><i class="fa-solid fa-circle-check"></i> Door Released!</h4>
                            <p class="text-secondary small mb-3">Locker <strong>#05</strong> has unlocked. Please retrieve package (PP-8492-AI) and shut the vault door.</p>
                            <button class="btn btn-sm btn-outline-light rounded-pill px-3" onclick="resetTerminal()">Reset Simulation</button>
                        </div>
                    </div>

                    <div class="pt-4 border-top border-secondary border-opacity-25 mt-4 text-secondary small">
                        <i class="fa-solid fa-shield-halved text-success me-1"></i> AES-256 Encrypted Session &bull; Tamper-Proof Sensors Active
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function simulateNFC() {
    const reader = document.getElementById('nfcReader');
    reader.style.borderColor = "#10b981";
    reader.style.color = "#10b981";
    reader.innerHTML = '<i class="fa-solid fa-check"></i>';

    setTimeout(() => {
        unlockLocker();
    }, 700);
}

function verifyPin() {
    const pin = document.getElementById('pinInput').value;
    if (pin === '1234') {
        document.getElementById('pinError').classList.add('d-none');
        unlockLocker();
    } else {
        document.getElementById('pinError').classList.remove('d-none');
    }
}

function unlockLocker() {
    document.getElementById('lockerTabs').style.display = 'none';
    document.getElementById('lockerTabsContent').style.display = 'none';
    document.getElementById('unlockSuccess').classList.remove('d-none');

    const target = document.getElementById('targetLocker');
    target.classList.remove('occupied');
    target.classList.add('unlocked');
    target.innerHTML = '<span>05</span><small class="text-success fw-bold"><i class="fa-solid fa-door-open"></i> OPEN</small>';
}

function resetTerminal() {
    document.getElementById('lockerTabs').style.display = 'flex';
    document.getElementById('lockerTabsContent').style.display = 'block';
    document.getElementById('unlockSuccess').classList.add('d-none');
    document.getElementById('pinInput').value = '';
    
    const reader = document.getElementById('nfcReader');
    reader.style.borderColor = "var(--cyan)";
    reader.style.color = "var(--cyan)";
    reader.innerHTML = '<i class="fa-solid fa-mobile-screen"></i>';

    const target = document.getElementById('targetLocker');
    target.classList.remove('unlocked');
    target.classList.add('occupied');
    target.innerHTML = '<span>05</span><small class="text-warning"><i class="fa-solid fa-box"></i> Your Parcel</small>';
}
</script>

<?php include('../includes/footer.php'); ?>
