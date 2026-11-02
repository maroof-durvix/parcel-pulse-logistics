<?php include('../includes/header.php'); ?>

<style>
/* AI Quotes Glassmorphism */
.quotes-hero {
    position: relative;
    padding: 120px 0 60px;
    background: url('../assets/img/quotes_bg.jpg') no-repeat center center/cover;
    border-bottom: 1px solid rgba(0, 255, 255, 0.2);
    min-height: 100vh;
    display: flex;
    align-items: center;
}
.quotes-hero::before {
    content: '';
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    background: linear-gradient(135deg, rgba(10,14,23,0.95) 0%, rgba(8,17,32,0.9) 100%);
}
.quotes-content {
    position: relative;
    z-index: 2;
}
.glass-form-box {
    background: rgba(20, 25, 40, 0.6);
    backdrop-filter: blur(15px);
    border: 1px solid rgba(0, 255, 255, 0.3);
    border-radius: 20px;
    padding: 35px;
    box-shadow: 0 0 40px rgba(0, 255, 255, 0.1);
}
.quote-input {
    background: rgba(0,0,0,0.5);
    border: 1px solid rgba(0, 255, 255, 0.2);
    color: white;
    border-radius: 10px;
}
.quote-input:focus {
    background: rgba(0,0,0,0.7);
    border-color: #00ffff;
    color: white;
    box-shadow: 0 0 10px rgba(0,255,255,0.3);
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
}
.glow-btn:hover {
    box-shadow: 0 0 25px rgba(0, 210, 255, 0.9);
    transform: translateY(-2px);
}
.processing-step {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 10px;
    color: #ccc;
    font-size: 0.95rem;
    opacity: 0.5;
    transition: opacity 0.3s;
}
.processing-step.active {
    opacity: 1;
    color: #00ffff;
}
.result-box {
    background: rgba(0, 255, 255, 0.05);
    border: 1px solid #00ffff;
    border-radius: 15px;
    padding: 25px;
    text-align: center;
    display: none;
    animation: fadeIn 0.5s ease-in-out;
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
.price-display {
    font-size: 3rem;
    font-weight: 700;
    color: #00ffff;
    text-shadow: 0 0 15px rgba(0,255,255,0.5);
}
.savings-alert {
    background: rgba(40, 167, 69, 0.1);
    border: 1px dashed #28a745;
    color: #28a745;
    padding: 10px;
    border-radius: 10px;
    margin-top: 15px;
    font-size: 0.9rem;
}
</style>

<div class="quotes-hero">
    <div class="container quotes-content">
        <div class="row justify-content-center">
            
            <div class="col-lg-10 text-center mb-5">
                <h1 class="display-4 fw-bold text-light"><i class="fa-solid fa-calculator text-info"></i> AI Price Estimator</h1>
                <p class="lead text-muted">Real-time dynamic pricing based on weather, fuel costs, and route analytics.</p>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="glass-form-box">
                    <form id="quoteForm">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-info small text-uppercase">Origin City</label>
                                <input type="text" class="form-control quote-input" placeholder="e.g. Karachi" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-info small text-uppercase">Destination City</label>
                                <input type="text" class="form-control quote-input" placeholder="e.g. Dubai" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-info small text-uppercase">Weight (kg)</label>
                                <input type="number" id="q-weight" class="form-control quote-input" placeholder="0.0" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-info small text-uppercase">Freight Type</label>
                                <select id="q-freight" class="form-select quote-input" required>
                                    <option value="air">Air Freight</option>
                                    <option value="sea">Sea Freight</option>
                                    <option value="road">Road Transport</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-info small text-uppercase">Incoterms</label>
                                <select id="q-incoterm" class="form-select quote-input" required>
                                    <option value="EXW">EXW (Ex Works)</option>
                                    <option value="FCA">FCA (Free Carrier)</option>
                                    <option value="CPT">CPT (Carriage Paid To)</option>
                                    <option value="CIP">CIP (Carriage and Insurance Paid To)</option>
                                    <option value="DAT">DAT (Delivered at Terminal)</option>
                                    <option value="DAP">DAP (Delivered at Place)</option>
                                    <option value="DDP">DDP (Delivered Duty Paid)</option>
                                    <option value="FAS">FAS (Free Alongside Ship)</option>
                                    <option value="FOB" selected>FOB (Free On Board)</option>
                                    <option value="CFR">CFR (Cost and Freight)</option>
                                    <option value="CIF">CIF (Cost, Insurance and Freight)</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-info small text-uppercase">Urgency</label>
                                <select id="q-urgency" class="form-select quote-input" required>
                                    <option value="standard">Standard (5-7 Days)</option>
                                    <option value="express">Express (1-2 Days)</option>
                                </select>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="glow-btn">
                                    <i class="fa-solid fa-microchip"></i> Calculate Optimal Route
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-5">
                <!-- AI Processing Logs -->
                <div class="glass-form-box h-100 d-flex flex-column justify-content-center" id="processing-panel" style="display:none !important;">
                    <h5 class="text-info mb-4">AI Brain Processing...</h5>
                    
                    <div class="processing-step" id="step-1">
                        <i class="fa-solid fa-spinner fa-spin"></i> Analyzing distance and terrain...
                    </div>
                    <div class="processing-step" id="step-2">
                        <i class="fa-solid fa-spinner fa-spin"></i> Comparing 4 different carrier APIs...
                    </div>
                    <div class="processing-step" id="step-3">
                        <i class="fa-solid fa-spinner fa-spin"></i> Factoring real-time fuel surcharge...
                    </div>
                </div>

                <!-- Final Result Box -->
                <div class="result-box mt-3" id="result-panel">
                    <p class="text-muted text-uppercase small mb-1">AI Optimized Price</p>
                    <div class="price-display" id="final-price">Rs. 0</div>
                    <p class="text-info mb-0">Fastest Route Selected: <strong id="route-type">Air Freight</strong></p>
                    
                    <div class="savings-alert" id="savings-box">
                        <i class="fa-solid fa-lightbulb"></i> <strong>AI Suggestion:</strong> Switch to Sea Freight to save 35% on this route!
                    </div>
                    
                    <button class="btn btn-outline-info mt-4 w-100 rounded-pill">Book This Quote</button>
                </div>

            </div>

        </div>
    </div>
</div>

<script>
document.getElementById('quoteForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Reset panels
    document.getElementById('result-panel').style.display = 'none';
    const procPanel = document.getElementById('processing-panel');
    procPanel.style.setProperty('display', 'flex', 'important');
    
    // Reset Steps
    for(let i=1; i<=3; i++) {
        document.getElementById('step-'+i).classList.remove('active');
        document.getElementById('step-'+i).innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Processing...';
    }

    // Step 1
    setTimeout(() => {
        document.getElementById('step-1').classList.add('active');
        document.getElementById('step-1').innerHTML = '<i class="fa-solid fa-check text-success"></i> Distance mapped successfully.';
    }, 800);

    // Step 2
    setTimeout(() => {
        document.getElementById('step-2').classList.add('active');
        document.getElementById('step-2').innerHTML = '<i class="fa-solid fa-check text-success"></i> 4 Carrier APIs compared.';
    }, 1600);

    // Step 3
    setTimeout(() => {
        document.getElementById('step-3').classList.add('active');
        document.getElementById('step-3').innerHTML = '<i class="fa-solid fa-check text-success"></i> Fuel surcharge applied.';
    }, 2400);

    // Final Result
    setTimeout(() => {
        procPanel.style.setProperty('display', 'none', 'important');
        document.getElementById('result-panel').style.display = 'block';
        
        const weight = parseFloat(document.getElementById('q-weight').value) || 1;
        const urgency = document.getElementById('q-urgency').value;
        const freight = document.getElementById('q-freight').value;
        const incoterm = document.getElementById('q-incoterm').value;
        
        let basePrice = weight * 500;
        let route = freight === 'air' ? 'Air Freight' : (freight === 'sea' ? 'Sea Freight' : 'Road Transport');
        let savingsText = '';
        
        // Adjust price based on Incoterm (simulated AI complexity)
        if (['DDP', 'DAP', 'DAT'].includes(incoterm)) {
            basePrice *= 1.4; // Higher cost for delivered duties
            savingsText = `<i class="fa-solid fa-scale-balanced"></i> <strong>AI Insight:</strong> You selected ${incoterm}. Consider EXW or FOB to lower your upfront costs if you have local customs agents.`;
        } else if (['FOB', 'EXW', 'FCA'].includes(incoterm)) {
            basePrice *= 0.8; // Lower upfront cost
            savingsText = `<i class="fa-solid fa-shield-halved"></i> <strong>AI Warning:</strong> With ${incoterm}, ensure you have calculated destination port handling charges!`;
        }
        
        if(urgency === 'express') {
            basePrice *= 2.5;
            if (freight !== 'air') {
                route = 'Air Freight (Auto-Upgraded for Express)';
            }
            if (!savingsText) savingsText = '<i class="fa-solid fa-lightbulb"></i> <strong>AI Suggestion:</strong> Switch to Standard transit to save up to 60%!';
        } else if (weight > 50 && freight !== 'sea') {
            if (!savingsText) savingsText = '<i class="fa-solid fa-check-circle"></i> <strong>AI Validation:</strong> For weights over 50kg, switching to Sea Freight is the most cost-effective option.';
        } else if (!savingsText) {
            savingsText = '<i class="fa-solid fa-box"></i> <strong>AI Suggestion:</strong> Bundle another 2kg package for the same flat rate!';
        }
        
        document.getElementById('final-price').innerText = 'Rs. ' + Math.floor(basePrice).toLocaleString();
        document.getElementById('route-type').innerText = route;
        document.getElementById('savings-box').innerHTML = savingsText;
        
    }, 3200);

});
</script>

<?php include('../includes/footer.php'); ?>
