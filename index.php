<?php include('includes/header.php'); ?>

<!-- HERO SECTION -->
<section class="page-hero hero-home" style="padding-top: 150px; padding-bottom: 90px;">
    <div class="container">
        <div class="row align-items-center g-5">
            <!-- Left Headline & CTA -->
            <div class="col-lg-6">
                <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-3" style="background: rgba(0, 242, 254, 0.1); border: 1px solid rgba(0, 242, 254, 0.3); font-size: 0.85rem; color: var(--cyan);">
                    <i class="fa-solid fa-bolt"></i>
                    <span>Autonomous Logistics Neural Core 3.0</span>
                </div>

                <h1 class="hero-title-gradient mb-3">
                    Intelligent Freight.<br>Zero-Latency Delivery.
                </h1>

                <p class="lead text-secondary mb-4" style="font-size: 1.1rem; line-height: 1.8;">
                    Welcome to the next evolution of global freight. Uniting autonomous aerial drones, contactless smart vault lockers, and peer-to-peer crowd shipping into a single predictive ecosystem.
                </p>

                <div class="d-flex flex-wrap gap-3 mb-4">
                    <a href="pages/quotes.php" class="btn-pulse-primary">
                        <i class="fa-solid fa-calculator"></i> Calculate Instant Rates
                    </a>
                    <a href="pages/services.php" class="btn-pulse-outline">
                        <i class="fa-solid fa-cubes"></i> Explore Capabilities
                    </a>
                </div>

                <!-- Quick Proof Points -->
                <div class="d-flex align-items-center gap-4 pt-2 text-secondary small">
                    <div><i class="fa-solid fa-shield-check text-info me-1"></i> ISO 27001 Certified</div>
                    <div><i class="fa-solid fa-leaf text-success me-1"></i> Zero-Carbon Drone Fleet</div>
                    <div><i class="fa-solid fa-clock text-warning me-1"></i> 99.8% On-Time Precision</div>
                </div>
            </div>

            <!-- Right Interactive Tracking Console -->
            <div class="col-lg-6">
                <div class="glass-box position-relative">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fa-solid fa-radar text-info fa-spin" style="animation-duration: 6s;"></i>
                            <span class="fw-bold text-white">Live Waybill Telemetry</span>
                        </div>
                        <span class="badge-cyan small"><i class="fa-solid fa-satellite me-1"></i> Satellite Link Active</span>
                    </div>

                    <p class="text-secondary small mb-3">
                        Enter your 10-character AI Waybill identifier to inspect real-time coordinates, weather impact, and sub-minute ETA:
                    </p>

                    <form action="pages/tracking.php" method="GET">
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text border-0" style="background: rgba(0, 242, 254, 0.1); color: var(--cyan);">
                                    <i class="fa-solid fa-barcode"></i>
                                </span>
                                <input type="text" name="id" class="form-control pulse-input auto-waybill" placeholder="e.g. PP-8492-AI" value="PP-8492-AI" required style="letter-spacing: 1.5px; font-weight: 600;">
                            </div>
                        </div>

                        <div class="d-flex flex-wrap gap-2 align-items-center mb-4">
                            <span class="text-secondary small">Sample Waybills:</span>
                            <a href="pages/tracking.php?id=PP-8492-AI" class="badge bg-dark text-info text-decoration-none border border-secondary" style="font-size: 0.75rem;">PP-8492-AI (Air)</a>
                            <a href="pages/tracking.php?id=PP-7742-AI" class="badge bg-dark text-info text-decoration-none border border-secondary" style="font-size: 0.75rem;">PP-7742-AI (Drone)</a>
                            <a href="pages/tracking.php?id=PP-3391-RD" class="badge bg-dark text-info text-decoration-none border border-secondary" style="font-size: 0.75rem;">PP-3391-RD (Road)</a>
                        </div>

                        <button type="submit" class="glow-btn">
                            <i class="fa-solid fa-satellite-dish"></i> Initialize Tracking Telemetry
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- LIVE STATS METRICS TICKER -->
<section class="py-4" style="background: rgba(10, 17, 32, 0.9); border-bottom: 1px solid rgba(0, 242, 254, 0.1);">
    <div class="container">
        <div class="row g-4 text-center">
            <div class="col-lg-3 col-6">
                <div class="p-3">
                    <h2 class="fw-bold mb-1" id="tickerDeliveries" style="color: var(--cyan);">1,432</h2>
                    <span class="text-secondary small text-uppercase tracking-wider">Active Shipments</span>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="p-3">
                    <h2 class="fw-bold mb-1 text-white" id="tickerHubs">154</h2>
                    <span class="text-secondary small text-uppercase tracking-wider">Automated Hubs</span>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="p-3">
                    <h2 class="fw-bold mb-1" id="tickerAccuracy" style="color: #10b981;">99.85%</h2>
                    <span class="text-secondary small text-uppercase tracking-wider">AI ETA Precision</span>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="p-3">
                    <h2 class="fw-bold mb-1 text-warning">14.2 Tons</h2>
                    <span class="text-secondary small text-uppercase tracking-wider">Carbon Offset</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CORE CAPABILITIES GRID -->
<section class="py-5" style="background: var(--bg-main);">
    <div class="container py-4">
        <div class="text-center max-w-xl mx-auto mb-5">
            <span class="badge-cyan mb-2 d-inline-block">Modular Ecosystem</span>
            <h2 class="fw-bold text-white display-6">Next-Generation Delivery Technologies</h2>
            <p class="text-secondary">Pioneering multi-modal transport with artificial intelligence and autonomous hardware.</p>
        </div>

        <div class="row g-4">
            <!-- Drone System -->
            <div class="col-lg-4 col-md-6">
                <div class="pulse-card h-100 d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="p-3 rounded-3" style="background: rgba(0, 242, 254, 0.1); color: var(--cyan); font-size: 1.8rem;">
                                <i class="fa-solid fa-plane-up"></i>
                            </div>
                            <span class="badge-cyan">Autonomous Flight</span>
                        </div>
                        <h4 class="fw-bold text-white mb-2">Aerial Drone Dispatch</h4>
                        <p class="text-secondary small mb-4">
                            Point-to-point sub-hour parcel delivery designed for urgent medical supplies and fast-commerce, bypassing road congestion completely.
                        </p>
                        <ul class="list-unstyled small text-secondary mb-4" style="line-height: 2;">
                            <li><i class="fa-solid fa-circle-check text-info me-2"></i> 120m cruising altitude with active wind telemetry</li>
                            <li><i class="fa-solid fa-circle-check text-info me-2"></i> Computer-vision smart landing detection</li>
                            <li><i class="fa-solid fa-circle-check text-info me-2"></i> Zero operational emissions</li>
                        </ul>
                    </div>
                    <a href="pages/drone.php" class="btn-pulse-outline w-100">
                        <span>Launch Drone Telemetry Console</span> <i class="fa-solid fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>

            <!-- Smart Lockers -->
            <div class="col-lg-4 col-md-6">
                <div class="pulse-card h-100 d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="p-3 rounded-3" style="background: rgba(16, 185, 129, 0.1); color: #10b981; font-size: 1.8rem;">
                                <i class="fa-solid fa-vault"></i>
                            </div>
                            <span class="badge-green">24/7 Contactless</span>
                        </div>
                        <h4 class="fw-bold text-white mb-2">Smart IoT Lockers</h4>
                        <p class="text-secondary small mb-4">
                            Decentralized neighborhood vault network with biometric security and contactless NFC mobile smartphone authentication.
                        </p>
                        <ul class="list-unstyled small text-secondary mb-4" style="line-height: 2;">
                            <li><i class="fa-solid fa-circle-check text-success me-2"></i> One-tap smartphone NFC door release</li>
                            <li><i class="fa-solid fa-circle-check text-success me-2"></i> One-Time PIN (OTP) backup keypads</li>
                            <li><i class="fa-solid fa-circle-check text-success me-2"></i> Temperature-regulated lockers for perishables</li>
                        </ul>
                    </div>
                    <a href="pages/lockers.php" class="btn-pulse-outline w-100" style="border-color: rgba(16, 185, 129, 0.4); color: #10b981 !important;">
                        <span>Access Terminal Simulator</span> <i class="fa-solid fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>

            <!-- Crowd Shipping -->
            <div class="col-lg-4 col-md-6">
                <div class="pulse-card h-100 d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="p-3 rounded-3" style="background: rgba(245, 158, 11, 0.1); color: #f59e0b; font-size: 1.8rem;">
                                <i class="fa-solid fa-people-arrows"></i>
                            </div>
                            <span class="badge bg-warning text-dark fw-bold">P2P Network</span>
                        </div>
                        <h4 class="fw-bold text-white mb-2">Crowd-Shipping Network</h4>
                        <p class="text-secondary small mb-4">
                            Connect parcel senders with verified travelers and commuters moving along the same route to cut logistics overhead by up to 40%.
                        </p>
                        <ul class="list-unstyled small text-secondary mb-4" style="line-height: 2;">
                            <li><i class="fa-solid fa-circle-check text-warning me-2"></i> Real-time AI commuter route matching</li>
                            <li><i class="fa-solid fa-circle-check text-warning me-2"></i> Escrow-backed delivery milestone payments</li>
                            <li><i class="fa-solid fa-circle-check text-warning me-2"></i> Community driver identity verification</li>
                        </ul>
                    </div>
                    <a href="pages/crowd_shipping.php" class="btn-pulse-outline w-100" style="border-color: rgba(245, 158, 11, 0.4); color: #f59e0b !important;">
                        <span>Explore Crowd Routes</span> <i class="fa-solid fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- AI SHOWCASE CAROUSEL SECTION -->
<section class="py-5" style="background: #090e1a; border-top: 1px solid rgba(0, 242, 254, 0.1); border-bottom: 1px solid rgba(0, 242, 254, 0.1);">
    <div class="container py-4">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <span class="badge-cyan mb-2 d-inline-block">Neural Infrastructure</span>
                <h2 class="fw-bold text-white display-6 mb-3">Live Telemetry & Global Operations</h2>
                <p class="text-secondary mb-4">
                    Parcel Pulse monitors every transit leg in real time. Our AI continuously scans meteorological data, air traffic advisories, customs bottlenecks, and traffic congestions to proactively re-route shipments before delays occur.
                </p>

                <div class="d-flex flex-column gap-3">
                    <div class="d-flex align-items-start gap-3 p-3 rounded-3" style="background: rgba(14, 23, 42, 0.6); border: 1px solid rgba(0, 242, 254, 0.15);">
                        <i class="fa-solid fa-cloud-bolt text-info mt-1 fs-5"></i>
                        <div>
                            <h6 class="text-white mb-1">Predictive Weather Rerouting</h6>
                            <p class="text-secondary small mb-0">Monitors storm fronts and shifts cargo across air, high-speed rail, or highway corridors automatically.</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-start gap-3 p-3 rounded-3" style="background: rgba(14, 23, 42, 0.6); border: 1px solid rgba(0, 242, 254, 0.15);">
                        <i class="fa-solid fa-microchip text-info mt-1 fs-5"></i>
                        <div>
                            <h6 class="text-white mb-1">Automated Customs Compliance</h6>
                            <p class="text-secondary small mb-0">Generates instant digital customs manifests compatible with international Incoterms standard frameworks.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <!-- AI Carousel -->
                <div id="homeTechCarousel" class="carousel slide carousel-fade rounded-4 overflow-hidden shadow-lg border border-secondary border-opacity-25" data-bs-ride="carousel" data-bs-interval="4000">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="assets/images/ai_slider_1.png" class="d-block w-100" alt="Global Network" style="height: 380px; object-fit: cover;">
                            <div class="carousel-caption p-3 rounded-3 text-start" style="background: rgba(6, 11, 20, 0.85); backdrop-filter: blur(10px); left: 20px; right: 20px; bottom: 20px;">
                                <h5 class="text-white fw-bold mb-1"><i class="fa-solid fa-globe text-info me-2"></i> Global Multi-Modal Hubs</h5>
                                <p class="small text-secondary mb-0">Over 150 automated fulfillment hubs connecting Dubai, Karachi, Frankfurt, and Singapore.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="assets/images/ai_slider_2.png" class="d-block w-100" alt="Drone Fleet" style="height: 380px; object-fit: cover;">
                            <div class="carousel-caption p-3 rounded-3 text-start" style="background: rgba(6, 11, 20, 0.85); backdrop-filter: blur(10px); left: 20px; right: 20px; bottom: 20px;">
                                <h5 class="text-white fw-bold mb-1"><i class="fa-solid fa-plane-up text-info me-2"></i> Robotic Aerial Fleet</h5>
                                <p class="small text-secondary mb-0">High-capacity drones with fail-safe return-to-base protocols and active lidar collision avoidance.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="assets/images/ai_slider_3.png" class="d-block w-100" alt="Smart Sortation" style="height: 380px; object-fit: cover;">
                            <div class="carousel-caption p-3 rounded-3 text-start" style="background: rgba(6, 11, 20, 0.85); backdrop-filter: blur(10px); left: 20px; right: 20px; bottom: 20px;">
                                <h5 class="text-white fw-bold mb-1"><i class="fa-solid fa-robot text-info me-2"></i> Automated Robotic Sortation</h5>
                                <p class="small text-secondary mb-0">High-speed optical parcel scanners sort up to 10,000 packages per hour with zero human error.</p>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#homeTechCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#homeTechCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CALL TO ACTION BANNER -->
<section class="py-5" style="background: linear-gradient(135deg, rgba(0, 242, 254, 0.08) 0%, rgba(79, 172, 254, 0.03) 100%);">
    <div class="container text-center py-4">
        <h2 class="fw-bold text-white display-6 mb-3">Ready to Accelerate Your Global Supply Chain?</h2>
        <p class="text-secondary max-w-lg mx-auto mb-4" style="max-width: 650px;">
            Join thousands of businesses that rely on Parcel Pulse for precision dispatching, automated customs documentation, and 24/7 transparent tracking.
        </p>
        <div class="d-flex justify-content-center gap-3">
            <a href="register.php" class="btn-pulse-primary">
                <i class="fa-solid fa-user-plus"></i> Open Client Account
            </a>
            <a href="pages/contact.php" class="btn-pulse-outline">
                <i class="fa-solid fa-headset"></i> Contact Enterprise Sales
            </a>
        </div>
    </div>
</section>

<script>
// Real-time metric ticker simulation
setInterval(() => {
    const el = document.getElementById('tickerDeliveries');
    if (el) {
        let val = parseInt(el.innerText.replace(/,/g, ''));
        if (Math.random() > 0.4) val += Math.floor(Math.random() * 3) + 1;
        el.innerText = val.toLocaleString();
    }
}, 3500);
</script>

<?php include('includes/footer.php'); ?>
