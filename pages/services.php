<?php include('../includes/header.php'); ?>

<!-- SERVICES HERO -->
<section class="page-hero hero-services">
    <div class="container text-center">
        <span class="badge-cyan mb-2 d-inline-block"><i class="fa-solid fa-cubes me-1"></i> Multi-Modal Autonomous Transit</span>
        <h1 class="hero-title-gradient">Global Freight & Autonomous Solutions</h1>
        <p class="text-secondary max-w-lg mx-auto" style="max-width: 650px;">
            Harnessing predictive AI rerouting, automated drone dispatches, and smart IoT lockboxes for frictionless global delivery.
        </p>
    </div>
</section>

<!-- SERVICES & AI RECOMMENDER -->
<section class="py-5" style="background: var(--bg-main);">
    <div class="container">
        <!-- AI SERVICE RECOMMENDER ENGINE -->
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8">
                <div class="glass-box">
                    <div class="text-center mb-4">
                        <span class="badge-cyan mb-2 d-inline-block"><i class="fa-solid fa-wand-magic-sparkles me-1"></i> Interactive Neural Engine</span>
                        <h3 class="fw-bold text-white mb-2">AI Service Recommender</h3>
                        <p class="text-secondary small mb-0">Select your cargo requirements, and our AI will compute the optimal balance of speed, cost, and carbon footprint.</p>
                    </div>

                    <form id="ai-recommend-form">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label text-secondary small">Cargo Classification</label>
                                <select class="form-select pulse-select" id="parcelType">
                                    <option value="document">Legal / Medical Documents</option>
                                    <option value="electronics">High-Value Electronics</option>
                                    <option value="heavy">Industrial Freight (> 50kg)</option>
                                    <option value="perishable">Cold-Chain Perishables</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label text-secondary small">Estimated Weight (kg)</label>
                                <input type="number" class="form-control pulse-input" id="parcelWeight" placeholder="e.g. 5" value="5" min="0.1" step="0.1">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label text-secondary small">Transit Urgency</label>
                                <select class="form-select pulse-select" id="urgency">
                                    <option value="instant">Sub-Hour Instant (Local)</option>
                                    <option value="high">High Priority (1-2 Days)</option>
                                    <option value="medium">Standard Freight (3-5 Days)</option>
                                    <option value="eco">Eco-Saver (1-2 Weeks)</option>
                                </select>
                            </div>
                            <div class="col-12 text-center mt-4">
                                <button type="submit" class="glow-btn" style="max-width: 320px; margin: 0 auto;">
                                    <i class="fa-solid fa-microchip"></i> Compute AI Recommendation
                                </button>
                                <div id="ai-loader" class="text-info mt-3 small" style="display: none;">
                                    <i class="fa-solid fa-circle-notch fa-spin me-2"></i> Analyzing global route conditions & fuel indices...
                                </div>
                            </div>
                        </div>
                    </form>

                    <div id="ai-result" class="mt-4 p-3 rounded-3 text-center" style="display: none; background: rgba(0, 242, 254, 0.08); border: 1px solid var(--cyan);">
                        <h5 class="text-white fw-bold mb-1" id="ai-message"></h5>
                        <p class="text-secondary small mb-0" id="ai-submessage"></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- FULL SERVICES GRID -->
        <div class="row g-4" id="service-cards-container">
            <!-- Drone Delivery -->
            <div class="col-lg-4 col-md-6">
                <div class="pulse-card h-100" id="card-drone">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="p-3 rounded-3" style="background: rgba(0, 242, 254, 0.1); color: var(--cyan); font-size: 1.8rem;">
                            <i class="fa-solid fa-plane-up"></i>
                        </div>
                        <span class="badge-cyan">Sub-Hour</span>
                    </div>
                    <h4 class="fw-bold text-white mb-2">Aerial Drone Delivery</h4>
                    <p class="text-secondary small mb-3">
                        Autonomous point-to-point urban delivery with computer-vision target lock, avoiding street bottlenecks entirely.
                    </p>
                    <div class="p-2 rounded-2 small text-secondary mb-3" style="background: rgba(6, 11, 20, 0.6); border: 1px solid rgba(255,255,255,0.05);">
                        <span class="text-info"><i class="fa-solid fa-bolt me-1"></i> Best for:</span> Medical, documents, packages < 3kg.
                    </div>
                    <a href="drone.php" class="text-info text-decoration-none small fw-semibold">Launch Telemetry Console &rarr;</a>
                </div>
            </div>

            <!-- Air Freight -->
            <div class="col-lg-4 col-md-6">
                <div class="pulse-card h-100" id="card-air">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="p-3 rounded-3" style="background: rgba(79, 172, 254, 0.1); color: #4facfe; font-size: 1.8rem;">
                            <i class="fa-solid fa-plane-departure"></i>
                        </div>
                        <span class="badge-cyan">Express Global</span>
                    </div>
                    <h4 class="fw-bold text-white mb-2">Global Air Cargo</h4>
                    <p class="text-secondary small mb-3">
                        Dedicated air freight network connecting 150+ international hubs with automated customs pre-clearance manifests.
                    </p>
                    <div class="p-2 rounded-2 small text-secondary mb-3" style="background: rgba(6, 11, 20, 0.6); border: 1px solid rgba(255,255,255,0.05);">
                        <span class="text-info"><i class="fa-solid fa-bolt me-1"></i> Best for:</span> High-priority international parcels & cross-border trade.
                    </div>
                    <a href="quotes.php" class="text-info text-decoration-none small fw-semibold">Get Air Quote &rarr;</a>
                </div>
            </div>

            <!-- Smart Lockers -->
            <div class="col-lg-4 col-md-6">
                <div class="pulse-card h-100" id="card-lockers">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="p-3 rounded-3" style="background: rgba(16, 185, 129, 0.1); color: #10b981; font-size: 1.8rem;">
                            <i class="fa-solid fa-vault"></i>
                        </div>
                        <span class="badge-green">24/7 Access</span>
                    </div>
                    <h4 class="fw-bold text-white mb-2">Smart IoT Lockers</h4>
                    <p class="text-secondary small mb-3">
                        Decentralized neighborhood locker network with smartphone NFC tap unlock and dynamic OTP verification.
                    </p>
                    <div class="p-2 rounded-2 small text-secondary mb-3" style="background: rgba(6, 11, 20, 0.6); border: 1px solid rgba(255,255,255,0.05);">
                        <span class="text-success"><i class="fa-solid fa-shield-halved me-1"></i> Security:</span> Surveillance monitored, 100% contactless.
                    </div>
                    <a href="lockers.php" class="text-success text-decoration-none small fw-semibold">Open Terminal Simulator &rarr;</a>
                </div>
            </div>

            <!-- Sea Freight -->
            <div class="col-lg-4 col-md-6">
                <div class="pulse-card h-100" id="card-sea">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="p-3 rounded-3" style="background: rgba(139, 92, 246, 0.1); color: #8b5cf6; font-size: 1.8rem;">
                            <i class="fa-solid fa-ship"></i>
                        </div>
                        <span class="badge bg-purple text-light" style="background: rgba(139, 92, 246, 0.2); border: 1px solid rgba(139, 92, 246, 0.4);">Eco Bulk</span>
                    </div>
                    <h4 class="fw-bold text-white mb-2">Ocean Freight Container</h4>
                    <p class="text-secondary small mb-3">
                        Full Container Load (FCL) and Less than Container Load (LCL) sea logistics with real-time AIS satellite vessel tracking.
                    </p>
                    <div class="p-2 rounded-2 small text-secondary mb-3" style="background: rgba(6, 11, 20, 0.6); border: 1px solid rgba(255,255,255,0.05);">
                        <span class="text-info"><i class="fa-solid fa-piggy-bank me-1"></i> Economy:</span> 60% lower cost on volume loads > 100kg.
                    </div>
                    <a href="quotes.php" class="text-info text-decoration-none small fw-semibold">Calculate Container Rate &rarr;</a>
                </div>
            </div>

            <!-- Crowd Shipping -->
            <div class="col-lg-4 col-md-6">
                <div class="pulse-card h-100" id="card-crowd">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="p-3 rounded-3" style="background: rgba(245, 158, 11, 0.1); color: #f59e0b; font-size: 1.8rem;">
                            <i class="fa-solid fa-people-arrows"></i>
                        </div>
                        <span class="badge bg-warning text-dark fw-bold">P2P Commute</span>
                    </div>
                    <h4 class="fw-bold text-white mb-2">Crowd-Shipping Network</h4>
                    <p class="text-secondary small mb-3">
                        Pair your package with verified commuters travelling along the exact route for economical, same-day delivery.
                    </p>
                    <div class="p-2 rounded-2 small text-secondary mb-3" style="background: rgba(6, 11, 20, 0.6); border: 1px solid rgba(255,255,255,0.05);">
                        <span class="text-warning"><i class="fa-solid fa-wallet me-1"></i> Savings:</span> Up to 40% cheaper than traditional couriers.
                    </div>
                    <a href="crowd_shipping.php" class="text-warning text-decoration-none small fw-semibold">View Active Commutes &rarr;</a>
                </div>
            </div>

            <!-- Road Transport & EV -->
            <div class="col-lg-4 col-md-6">
                <div class="pulse-card h-100" id="card-road">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="p-3 rounded-3" style="background: rgba(56, 189, 248, 0.1); color: #38bdf8; font-size: 1.8rem;">
                            <i class="fa-solid fa-truck-fast"></i>
                        </div>
                        <span class="badge-cyan">Electric Fleet</span>
                    </div>
                    <h4 class="fw-bold text-white mb-2">Inter-City Highway & EV</h4>
                    <p class="text-secondary small mb-3">
                        AI-optimized nationwide trucking fleet utilizing dynamic highway traffic bypass algorithms and telemetry logging.
                    </p>
                    <div class="p-2 rounded-2 small text-secondary mb-3" style="background: rgba(6, 11, 20, 0.6); border: 1px solid rgba(255,255,255,0.05);">
                        <span class="text-info"><i class="fa-solid fa-leaf me-1"></i> Green Fleet:</span> Over 60% electric/hybrid logistics vehicles.
                    </div>
                    <a href="quotes.php" class="text-info text-decoration-none small fw-semibold">Book Road Freight &rarr;</a>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.getElementById('ai-recommend-form').addEventListener('submit', function(e) {
    e.preventDefault();

    document.querySelectorAll('.pulse-card').forEach(card => card.style.borderColor = '');
    document.getElementById('ai-result').style.display = 'none';

    const loader = document.getElementById('ai-loader');
    loader.style.display = 'block';

    setTimeout(() => {
        loader.style.display = 'none';

        const type = document.getElementById('parcelType').value;
        const weight = parseFloat(document.getElementById('parcelWeight').value) || 1;
        const urgency = document.getElementById('urgency').value;

        let cardId = 'card-road';
        let title = '';
        let desc = '';

        if (urgency === 'instant' && weight <= 4) {
            cardId = 'card-drone';
            title = 'Recommended: Autonomous Drone Delivery';
            desc = 'Sub-hour point-to-point drop-off is the absolute fastest and zero-carbon method for your lightweight parcel.';
        } else if (urgency === 'high') {
            cardId = 'card-air';
            title = 'Recommended: Global Air Cargo';
            desc = 'Priority air corridors guarantee 24-48 hour arrival with predictive customs manifest pre-clearance.';
        } else if (weight >= 50 || urgency === 'eco') {
            cardId = 'card-sea';
            title = 'Recommended: Ocean Freight Container';
            desc = 'For heavy freight (> 50kg), ocean shipping delivers maximum economy and lowest carbon emissions per ton.';
        } else if (type === 'document' || weight <= 5) {
            cardId = 'card-lockers';
            title = 'Recommended: 24/7 Smart Vault Lockers';
            desc = 'Secure contactless locker drop ensures zero missed attempts and NFC tap collection at your convenience.';
        } else {
            cardId = 'card-road';
            title = 'Recommended: Inter-City Highway Trucking';
            desc = 'Optimal balance of cost, capacity, and dependable inter-city overland transit.';
        }

        const card = document.getElementById(cardId);
        if (card) {
            card.style.borderColor = '#00f2fe';
            card.style.boxShadow = '0 0 35px rgba(0, 242, 254, 0.45)';
            card.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }

        const resDiv = document.getElementById('ai-result');
        document.getElementById('ai-message').innerText = title;
        document.getElementById('ai-submessage').innerText = desc;
        resDiv.style.display = 'block';
    }, 600);
});
</script>

<?php include('../includes/footer.php'); ?>
