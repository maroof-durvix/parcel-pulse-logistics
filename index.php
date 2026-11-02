<?php include('includes/header.php'); ?>
<?php include('includes/ai_slider.php'); ?>

<style>
/* Hero Section Enhancements */
.hero-section {
    position: relative;
    padding: 180px 0 100px;
    background: url('assets/img/hero_bg.jpg') no-repeat center center/cover;
    background-color: #050a15;
    border-bottom: 1px solid rgba(0, 255, 255, 0.2);
}
.hero-section::before {
    content: '';
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    background: linear-gradient(135deg, rgba(5,10,21,0.9) 0%, rgba(10,14,23,0.8) 100%);
}
.hero-content {
    position: relative;
    z-index: 2;
}
.hero-title {
    font-size: 3.5rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 2px;
    background: -webkit-linear-gradient(45deg, #00ffff, #3a7bd5);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    margin-bottom: 20px;
}
.tracking-box-hero {
    background: rgba(20, 25, 40, 0.6);
    backdrop-filter: blur(15px);
    border: 1px solid rgba(0, 255, 255, 0.3);
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 0 40px rgba(0, 255, 255, 0.15);
}
.tracking-input {
    background: rgba(0,0,0,0.5);
    border: 1px solid rgba(0, 255, 255, 0.3);
    color: white;
    height: 55px;
    font-size: 1.2rem;
    text-align: center;
    letter-spacing: 2px;
}
.tracking-input:focus {
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
    border-radius: 10px;
    padding: 15px;
    font-size: 1.1rem;
    width: 100%;
    box-shadow: 0 0 15px rgba(0, 210, 255, 0.5);
    transition: all 0.3s ease;
}
.glow-btn:hover {
    box-shadow: 0 0 25px rgba(0, 210, 255, 0.8);
    transform: translateY(-2px);
}
.module-card {
    background: rgba(20, 25, 40, 0.5);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 15px;
    padding: 30px 20px;
    text-align: center;
    transition: all 0.4s ease;
    height: 100%;
    text-decoration: none;
    display: block;
    color: inherit;
}
.module-card:hover {
    border-color: #00ffff;
    box-shadow: 0 0 30px rgba(0, 255, 255, 0.2);
    transform: translateY(-10px);
    color: inherit;
}
.module-icon {
    font-size: 3.5rem;
    margin-bottom: 20px;
    background: -webkit-linear-gradient(45deg, #00ffff, #3a7bd5);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
</style>

<!-- HERO SECTION -->
<section class="hero-section text-light">
    <div class="container hero-content">
        <div class="row align-items-center">
            
            <div class="col-lg-6 mb-5 mb-lg-0">
                <h1 class="hero-title">AI Hybrid Logistics</h1>
                <p class="lead text-muted mb-4">Experience the next generation of supply chain management. Real-time predictive routing, autonomous drones, and crowd-sourced delivery—all powered by an advanced AI Neural Core.</p>
                <div class="d-flex gap-3">
                    <a href="pages/quotes.php" class="btn btn-outline-info rounded-pill px-4 py-2"><i class="fa-solid fa-calculator"></i> AI Price Estimator</a>
                    <a href="pages/services.php" class="btn btn-outline-light rounded-pill px-4 py-2"><i class="fa-solid fa-list"></i> Explore Services</a>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="tracking-box-hero text-center">
                    <h3 class="text-info fw-bold mb-4"><i class="fa-solid fa-satellite-dish"></i> Live AI Tracking</h3>
                    <form action="pages/tracking.php" method="GET">
                        <div class="mb-4">
                            <input type="text" name="id" class="form-control tracking-input" placeholder="e.g. PP-1234-AI" required>
                        </div>
                        <button type="submit" class="glow-btn"><i class="fa-solid fa-crosshairs"></i> Initialize Tracking Protocol</button>
                    </form>
                    <p class="text-muted small mt-3 mb-0">Enter your 10-digit AI Waybill to view live telemetry.</p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- AI ECOSYSTEM HIGHLIGHTS -->
<section class="py-5 bg-dark text-light border-bottom" style="border-color: rgba(0,255,255,0.1) !important;">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="text-info fw-bold display-6">The Parcel Pulse Ecosystem</h2>
            <p class="text-light lead">Next-generation smart modules designed for absolute logistics efficiency.</p>
        </div>
        <div class="row g-4">
            <!-- Drone Delivery Card -->
            <div class="col-lg-4 col-md-6">
                <a href="pages/drone.php" class="module-card">
                    <i class="fa-solid fa-plane-up module-icon"></i>
                    <h4 class="fw-bold text-white">Drone Delivery</h4>
                    <p class="small mt-3 text-start" style="color: #e0e0e0; line-height: 1.8;">
                        <i class="fa-solid fa-check text-info me-2"></i> Autonomous aerial drops<br>
                        <i class="fa-solid fa-check text-info me-2"></i> Live wind & telemetry analysis<br>
                        <i class="fa-solid fa-check text-info me-2"></i> AI vision landing detection<br>
                        <i class="fa-solid fa-check text-info me-2"></i> Zero-carbon emission flight
                    </p>
                    <p class="small mt-3 text-light" style="opacity: 0.8;">Experience the future with our fully automated drone fleet, avoiding road traffic for ultra-fast deliveries directly to your location.</p>
                </a>
            </div>
            <!-- Smart Lockers Card -->
            <div class="col-lg-4 col-md-6">
                <a href="pages/lockers.php" class="module-card">
                    <i class="fa-solid fa-vault module-icon text-success"></i>
                    <h4 class="fw-bold text-white">Smart Lockers</h4>
                    <p class="small mt-3 text-start" style="color: #e0e0e0; line-height: 1.8;">
                        <i class="fa-solid fa-check text-success me-2"></i> 24/7 Secure parcel retrieval<br>
                        <i class="fa-solid fa-check text-success me-2"></i> NFC mobile tap integration<br>
                        <i class="fa-solid fa-check text-success me-2"></i> OTP & PIN Code verification<br>
                        <i class="fa-solid fa-check text-success me-2"></i> City-wide terminal network
                    </p>
                    <p class="small mt-3 text-light" style="opacity: 0.8;">Never miss a delivery again. Our secure, AI-monitored smart lockers keep your parcels safe until you are ready to collect them.</p>
                </a>
            </div>
            <!-- Crowd Shipping Card -->
            <div class="col-lg-4 col-md-6">
                <a href="pages/crowd_shipping.php" class="module-card">
                    <i class="fa-solid fa-users module-icon text-warning"></i>
                    <h4 class="fw-bold text-white">Crowd Shipping</h4>
                    <p class="small mt-3 text-start" style="color: #e0e0e0; line-height: 1.8;">
                        <i class="fa-solid fa-check text-warning me-2"></i> Peer-to-peer delivery network<br>
                        <i class="fa-solid fa-check text-warning me-2"></i> Match drivers heading your way<br>
                        <i class="fa-solid fa-check text-warning me-2"></i> Save up to 40% on shipping<br>
                        <i class="fa-solid fa-check text-warning me-2"></i> Earn money on your daily commute
                    </p>
                    <p class="small mt-3 text-light" style="opacity: 0.8;">Join our community-driven delivery system. Send parcels cheaper or earn passive income by delivering packages along your daily route.</p>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- STATS SECTION -->
<section class="stats-section py-5" style="background: linear-gradient(0deg, #050a15, #141928);">
    <div class="container py-4">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h3 class="text-info fw-bold"><i class="fa-solid fa-satellite-dish fa-fade text-danger"></i> Live AI Operations Dashboard</h3>
            </div>
            <div class="col-lg-3 col-6 mb-4">
                <div class="stat-box text-center p-4 border rounded-3" style="background:rgba(0,255,255,0.05); border-color:rgba(0,255,255,0.2)!important;">
                    <h2 id="live-deliveries" class="text-light fw-bold">1,430</h2>
                    <p class="text-info mb-0">Active Deliveries</p>
                </div>
            </div>
            <div class="col-lg-3 col-6 mb-4">
                <div class="stat-box text-center p-4 border rounded-3" style="background:rgba(0,255,255,0.05); border-color:rgba(0,255,255,0.2)!important;">
                    <h2 id="live-hubs" class="text-light fw-bold">152</h2>
                    <p class="text-info mb-0">Connected Hubs</p>
                </div>
            </div>
            <div class="col-lg-3 col-6 mb-4">
                <div class="stat-box text-center p-4 border rounded-3" style="background:rgba(0,255,255,0.05); border-color:rgba(0,255,255,0.2)!important;">
                    <h2 id="live-success" class="text-light fw-bold">99.85%</h2>
                    <p class="text-info mb-0">AI Success Rate</p>
                </div>
            </div>
            <div class="col-lg-3 col-6 mb-4">
                <div class="stat-box text-center p-4 border rounded-3" style="background:rgba(0,255,255,0.05); border-color:rgba(0,255,255,0.2)!important;">
                    <h2 id="live-queries" class="text-light fw-bold">3,240</h2>
                    <p class="text-info mb-0">Live AI Queries</p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
// Live Dashboard Simulation
setInterval(() => {
    // Active Deliveries (Increase slowly)
    let dev = parseInt(document.getElementById('live-deliveries').innerText.replace(/,/g, ''));
    if (Math.random() > 0.5) dev += Math.floor(Math.random() * 5);
    document.getElementById('live-deliveries').innerText = dev.toLocaleString();
    
    // Connected Hubs (Rarely increases)
    let hubs = parseInt(document.getElementById('live-hubs').innerText);
    if(Math.random() > 0.98) hubs += 1;
    document.getElementById('live-hubs').innerText = hubs;
    
    // Success rate (fluctuate slightly between 99.50% and 99.99%)
    let success = 99.50 + (Math.random() * 0.49);
    document.getElementById('live-success').innerText = success.toFixed(2) + '%';
    
    // Live Queries (Fluctuate up and down randomly)
    let queries = parseInt(document.getElementById('live-queries').innerText.replace(/,/g, ''));
    queries += Math.floor(Math.random() * 20) - 10;
    if (queries < 1000) queries = 1000;
    document.getElementById('live-queries').innerText = queries.toLocaleString();
}, 2500);
</script>

<?php include('includes/footer.php'); ?>