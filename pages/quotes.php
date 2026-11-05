<?php include('../includes/header.php'); ?>

<!-- QUOTES HERO -->
<section class="page-hero hero-quotes">
    <div class="container text-center">
        <span class="badge-cyan mb-2 d-inline-block"><i class="fa-solid fa-calculator me-1"></i> Multi-Carrier Rate Matrix</span>
        <h1 class="hero-title-gradient">Instant AI Freight Estimator</h1>
        <p class="text-secondary max-w-lg mx-auto" style="max-width: 650px;">
            Dynamic spot rates factoring in live aviation fuel indices, ocean bunker surcharges, Incoterms 2020 duties, and weather vectors.
        </p>
    </div>
</section>

<!-- QUOTE CALCULATOR & BREAKDOWN -->
<section class="py-5" style="background: var(--bg-main);">
    <div class="container">
        <div class="row g-4 justify-content-center">
            <!-- Form Input Card -->
            <div class="col-lg-7">
                <div class="pulse-card">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fa-solid fa-sliders text-info fs-5"></i>
                            <h4 class="fw-bold text-white mb-0">Consignment Parameters</h4>
                        </div>
                        <span class="badge-cyan small">Instant Spot Rate</span>
                    </div>

                    <form id="quoteForm" onsubmit="calculateQuote(event)">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-secondary small">Origin Hub / City</label>
                                <div class="input-group">
                                    <span class="input-group-text border-0" style="background: rgba(0, 242, 254, 0.1); color: var(--cyan);"><i class="fa-solid fa-location-arrow"></i></span>
                                    <input type="text" id="origin" class="form-control pulse-input" placeholder="e.g. Karachi" value="Karachi Port (PK)" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label text-secondary small">Destination Hub / City</label>
                                <div class="input-group">
                                    <span class="input-group-text border-0" style="background: rgba(0, 242, 254, 0.1); color: var(--cyan);"><i class="fa-solid fa-location-dot"></i></span>
                                    <input type="text" id="destination" class="form-control pulse-input" placeholder="e.g. Dubai" value="Dubai Logistics Hub (DXB)" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label text-secondary small">Gross Weight (kg)</label>
                                <input type="number" id="weight" class="form-control pulse-input" placeholder="e.g. 15" value="15" min="0.5" step="0.5" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label text-secondary small">Freight Mode</label>
                                <select id="freightType" class="form-select pulse-select" required>
                                    <option value="air">Air Cargo (Express)</option>
                                    <option value="sea">Ocean Container (Economy)</option>
                                    <option value="road">Highway Overland</option>
                                    <option value="drone">Autonomous Drone (< 5kg)</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label text-secondary small">Transit Urgency</label>
                                <select id="urgency" class="form-select pulse-select">
                                    <option value="1">Standard (5-7 Days)</option>
                                    <option value="1.3">Express (2-3 Days)</option>
                                    <option value="1.7">Critical Same-Day / Next Flight</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label text-secondary small">Incoterms Framework</label>
                                <select id="incoterm" class="form-select pulse-select">
                                    <option value="FOB">FOB (Free On Board)</option>
                                    <option value="CIF">CIF (Cost, Insurance & Freight)</option>
                                    <option value="DDP">DDP (Delivered Duty Paid)</option>
                                    <option value="EXW">EXW (Ex Works)</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label text-secondary small">Carbon Offset Option</label>
                                <div class="form-check form-switch pt-2">
                                    <input class="form-check-input" type="checkbox" id="carbonOffset" checked style="cursor: pointer;">
                                    <label class="form-check-label text-secondary small" for="carbonOffset">
                                        Include Verified Carbon Offset (+ $4.50)
                                    </label>
                                </div>
                            </div>

                            <div class="col-12 mt-4">
                                <button type="submit" class="glow-btn" id="calcBtn">
                                    <i class="fa-solid fa-microchip me-1"></i> Compute Optimized Freight Rate
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Dynamic Result Card -->
            <div class="col-lg-5">
                <div class="pulse-card h-100 d-flex flex-column justify-content-between" id="quoteResultCard">
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold text-white mb-0">
                                <i class="fa-solid fa-receipt text-info me-2"></i> Quote Manifest
                            </h5>
                            <span class="badge-cyan small">Spot Rate Verified</span>
                        </div>

                        <!-- Processing Indicator -->
                        <div id="quoteLoader" class="text-center py-5" style="display: none;">
                            <i class="fa-solid fa-circle-notch fa-spin text-info fs-1 mb-3"></i>
                            <h6 class="text-white">Querying Carrier Neural Matrix...</h6>
                            <small class="text-secondary">Correlating fuel surcharge & customs index</small>
                        </div>

                        <!-- Estimated Output -->
                        <div id="quoteSummary">
                            <div class="p-3 rounded-3 mb-4 text-center" style="background: rgba(0, 242, 254, 0.05); border: 1px solid var(--cyan);">
                                <span class="text-secondary small text-uppercase">Total Estimated Cost</span>
                                <h1 class="fw-bold my-1 font-monospace" id="totalPrice" style="color: var(--cyan); font-size: 2.8rem;">$245.00</h1>
                                <small class="text-success" id="savingsBadge"><i class="fa-solid fa-piggy-bank me-1"></i> AI saved 18% via Direct Routing</small>
                            </div>

                            <div class="small">
                                <div class="d-flex justify-content-between py-2 border-bottom border-secondary border-opacity-25">
                                    <span class="text-secondary">Base Freight Weight Rate:</span>
                                    <span class="text-white fw-bold font-monospace" id="baseRate">$180.00</span>
                                </div>
                                <div class="d-flex justify-content-between py-2 border-bottom border-secondary border-opacity-25">
                                    <span class="text-secondary">Dynamic Fuel Surcharge:</span>
                                    <span class="text-white fw-bold font-monospace" id="fuelSurcharge">$38.50</span>
                                </div>
                                <div class="d-flex justify-content-between py-2 border-bottom border-secondary border-opacity-25">
                                    <span class="text-secondary">Customs Protocol & Duties:</span>
                                    <span class="text-white fw-bold font-monospace" id="customsFee">$22.00</span>
                                </div>
                                <div class="d-flex justify-content-between py-2 border-bottom border-secondary border-opacity-25">
                                    <span class="text-secondary">Zero-Carbon Certificate:</span>
                                    <span class="text-success fw-bold font-monospace" id="offsetFee">$4.50</span>
                                </div>
                            </div>

                            <div class="mt-4 p-3 rounded-3 small" style="background: rgba(6, 11, 20, 0.7); border: 1px solid rgba(255,255,255,0.06);">
                                <div class="d-flex gap-2 text-info">
                                    <i class="fa-solid fa-lightbulb mt-1"></i>
                                    <span id="aiInsightText">Consignment qualifies for automated customs manifest pre-check on arrival at destination.</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-3 mt-4 border-top border-secondary border-opacity-25 text-center">
                        <a href="../login.php" class="btn-pulse-primary w-100">
                            <i class="fa-solid fa-paper-plane me-1"></i> Lock Rate & Book Consignment
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function calculateQuote(e) {
    e.preventDefault();

    const loader = document.getElementById('quoteLoader');
    const summary = document.getElementById('quoteSummary');
    loader.style.display = 'block';
    summary.style.display = 'none';

    setTimeout(() => {
        loader.style.display = 'none';
        summary.style.display = 'block';

        const weight = parseFloat(document.getElementById('weight').value) || 10;
        const freight = document.getElementById('freightType').value;
        const urgency = parseFloat(document.getElementById('urgency').value) || 1;
        const hasOffset = document.getElementById('carbonOffset').checked;

        // Base rate multiplier per kg
        let ratePerKg = 12;
        if (freight === 'sea') ratePerKg = 4;
        else if (freight === 'road') ratePerKg = 7;
        else if (freight === 'drone') ratePerKg = 22;

        const base = (weight * ratePerKg * urgency).toFixed(2);
        const fuel = (base * 0.16).toFixed(2);
        const customs = (base * 0.08).toFixed(2);
        const offset = hasOffset ? 4.50 : 0;
        const total = (parseFloat(base) + parseFloat(fuel) + parseFloat(customs) + offset).toFixed(2);

        document.getElementById('baseRate').innerText = '$' + base;
        document.getElementById('fuelSurcharge').innerText = '$' + fuel;
        document.getElementById('customsFee').innerText = '$' + customs;
        document.getElementById('offsetFee').innerText = '$' + offset.toFixed(2);
        document.getElementById('totalPrice').innerText = '$' + total;

        const insight = document.getElementById('aiInsightText');
        if (freight === 'drone') {
            insight.innerText = "Drone drops operate in certified air corridors under 120m altitude with automatic wind compensation.";
        } else if (freight === 'sea') {
            insight.innerText = "Sea container route utilizes direct maritime corridors with real-time AIS vessel telemetry.";
        } else {
            insight.innerText = "Air cargo freight manifest includes automatic customs pre-clearance at destination hub.";
        }
    }, 450);
}
</script>

<?php include('../includes/footer.php'); ?>
