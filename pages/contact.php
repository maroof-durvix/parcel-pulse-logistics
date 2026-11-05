<?php include('../includes/header.php'); ?>

<!-- CONTACT HERO -->
<section class="page-hero hero-contact">
    <div class="container text-center">
        <span class="badge-cyan mb-2 d-inline-block"><i class="fa-solid fa-headset me-1"></i> Global Operations Hubs</span>
        <h1 class="hero-title-gradient">Contact Our Global Logistics Core</h1>
        <p class="text-secondary max-w-lg mx-auto" style="max-width: 650px;">
            Connect with our enterprise solutions team, regional hub dispatchers, or automated AI triage network 24/7.
        </p>
    </div>
</section>

<!-- CONTACT SECTION -->
<section class="py-5" style="background: var(--bg-main);">
    <div class="container">
        <div class="row g-5">
            <!-- Left Info & Hubs -->
            <div class="col-lg-5">
                <span class="badge-cyan mb-2 d-inline-block">24/7 Connectivity</span>
                <h3 class="fw-bold text-white mb-4">Regional Logistics Nodes</h3>

                <div class="d-flex flex-column gap-3 mb-4">
                    <div class="p-3 rounded-3" style="background: rgba(6, 11, 20, 0.85); border: 1px solid rgba(0, 242, 254, 0.2);">
                        <div class="d-flex align-items-center gap-3">
                            <div class="p-3 rounded-circle" style="background: rgba(0, 242, 254, 0.1); color: var(--cyan);"><i class="fa-solid fa-phone"></i></div>
                            <div>
                                <small class="text-secondary text-uppercase">Enterprise Support</small>
                                <h6 class="text-white fw-bold mb-0">+92 21 111-PULSE (78573)</h6>
                                <small class="text-info">Toll-free 24/7</small>
                            </div>
                        </div>
                    </div>

                    <div class="p-3 rounded-3" style="background: rgba(6, 11, 20, 0.85); border: 1px solid rgba(0, 242, 254, 0.2);">
                        <div class="d-flex align-items-center gap-3">
                            <div class="p-3 rounded-circle" style="background: rgba(16, 185, 129, 0.1); color: #10b981;"><i class="fa-solid fa-envelope"></i></div>
                            <div>
                                <small class="text-secondary text-uppercase">AI Inbound Dispatch</small>
                                <h6 class="text-white fw-bold mb-0">operations@parcelpulse.io</h6>
                                <small class="text-success">< 15 mins typical triage</small>
                            </div>
                        </div>
                    </div>

                    <div class="p-3 rounded-3" style="background: rgba(6, 11, 20, 0.85); border: 1px solid rgba(0, 242, 254, 0.2);">
                        <div class="d-flex align-items-center gap-3">
                            <div class="p-3 rounded-circle" style="background: rgba(245, 158, 11, 0.1); color: #f59e0b;"><i class="fa-solid fa-location-dot"></i></div>
                            <div>
                                <small class="text-secondary text-uppercase">Primary Hub Coordinates</small>
                                <h6 class="text-white fw-bold mb-0">DHA Phase 6, Karachi, PK</h6>
                                <small class="text-secondary">Connected with Dubai (DXB) Node</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Message Form -->
            <div class="col-lg-7">
                <div class="pulse-card">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fa-solid fa-envelope-open-text text-info fs-5"></i>
                            <h4 class="fw-bold text-white mb-0">Direct Enterprise Inquiry</h4>
                        </div>
                        <span class="badge-cyan small">Rapid Response</span>
                    </div>

                    <div id="contactToast" class="alert alert-success d-none border-0 text-white" style="background: rgba(16, 185, 129, 0.2); border: 1px solid #10b981 !important;">
                        <i class="fa-solid fa-circle-check me-2"></i> Your inquiry has been transmitted to our corporate logistics triage team.
                    </div>

                    <form id="contactForm" onsubmit="handleContact(event)">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-secondary small">Your Full Name</label>
                                <input type="text" class="form-control pulse-input" placeholder="e.g. Ahmed Durwesh" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-secondary small">Corporate Email Address</label>
                                <input type="email" class="form-control pulse-input" placeholder="e.g. name@company.com" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-secondary small">Inquiry Subject</label>
                                <select class="form-select pulse-select" required>
                                    <option value="enterprise">Enterprise Cargo Volume Account</option>
                                    <option value="drone">Autonomous Drone Network Deployment</option>
                                    <option value="api">Carrier API Telemetry Integration</option>
                                    <option value="other">General Commercial Inquiry</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-secondary small">Phone Number</label>
                                <input type="tel" class="form-control pulse-input" placeholder="+92 300 1234567">
                            </div>
                            <div class="col-12">
                                <label class="form-label text-secondary small">Message / Freight Scope</label>
                                <textarea class="form-control pulse-input" rows="4" placeholder="Detail your monthly volume, freight corridors, or specialized delivery requirements..." required></textarea>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="glow-btn" id="contactSubmitBtn">
                                    <i class="fa-solid fa-paper-plane me-1"></i> Transmit Message to Operations
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function handleContact(e) {
    e.preventDefault();
    const btn = document.getElementById('contactSubmitBtn');
    btn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin me-1"></i> Transmitting...';

    setTimeout(() => {
        btn.innerHTML = '<i class="fa-solid fa-check me-1"></i> Message Transmitted';
        document.getElementById('contactToast').classList.remove('d-none');
        document.getElementById('contactForm').reset();
    }, 700);
}
</script>

<?php include('../includes/footer.php'); ?>
