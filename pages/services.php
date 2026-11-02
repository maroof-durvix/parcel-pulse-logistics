<?php include('../includes/header.php'); ?>

<style>
/* Specific Dark Glassmorphism Styles for Services Page */
.page-hero {
    position: relative;
    padding: 120px 0 60px;
    background: url('../assets/img/services_hero.png') no-repeat center center/cover;
    border-bottom: 1px solid rgba(0, 255, 255, 0.2);
}
.page-hero::before {
    content: '';
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    background: linear-gradient(180deg, rgba(10,14,23,0.8) 0%, rgba(10,14,23,1) 100%);
}
.hero-content {
    position: relative;
    z-index: 2;
}
.ai-recommender-card {
    background: rgba(20, 25, 40, 0.6);
    backdrop-filter: blur(15px);
    border: 1px solid rgba(0, 255, 255, 0.3);
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 0 30px rgba(0, 255, 255, 0.1);
    transition: all 0.3s ease;
}
.ai-input {
    background: rgba(0,0,0,0.5);
    border: 1px solid rgba(0, 255, 255, 0.3);
    color: #fff;
}
.ai-input:focus {
    background: rgba(0,0,0,0.7);
    border-color: #00ffff;
    color: #fff;
    box-shadow: 0 0 10px rgba(0, 255, 255, 0.5);
}
.glow-button {
    background: linear-gradient(45deg, #00d2ff, #3a7bd5);
    border: none;
    color: white;
    font-weight: bold;
    border-radius: 50px;
    padding: 10px 30px;
    box-shadow: 0 0 15px rgba(0, 210, 255, 0.6);
    transition: all 0.3s ease;
}
.glow-button:hover {
    box-shadow: 0 0 25px rgba(0, 210, 255, 0.9);
    transform: scale(1.05);
}
.service-card {
    background: rgba(20, 25, 40, 0.5);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 15px;
    padding: 25px;
    text-align: center;
    position: relative;
    overflow: hidden;
    transition: all 0.4s ease;
}
.service-card.recommended-glow {
    border-color: #00ffff;
    box-shadow: 0 0 40px rgba(0, 255, 255, 0.4);
    transform: translateY(-10px);
}
.ai-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    background: rgba(0, 255, 255, 0.2);
    color: #00ffff;
    font-size: 12px;
    padding: 5px 10px;
    border-radius: 20px;
    border: 1px solid #00ffff;
    font-weight: 600;
}
.loader {
    display: none;
    color: #00ffff;
    font-size: 14px;
    margin-top: 15px;
}
</style>

<div class="page-hero">
    <div class="container hero-content text-center text-light">
        <h1 class="display-4 fw-bold mb-3"><i class="fa-solid fa-robot text-info"></i> AI Logistics Services</h1>
        <p class="lead text-info">Experience our smart, predictive, and dynamically optimized delivery options.</p>
    </div>
</div>

<section class="services-section py-5 bg-dark text-light">
    <div class="container">
        
        <!-- AI RECOMMENDER ENGINE -->
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8">
                <div class="ai-recommender-card">
                    <h3 class="text-center mb-4"><i class="fa-solid fa-wand-magic-sparkles text-info"></i> AI Service Recommender</h3>
                    <p class="text-center text-muted mb-4">Tell our AI Brain what you need to ship, and we will highlight the best service instantly.</p>
                    
                    <form id="ai-recommend-form">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Parcel Type</label>
                                <select class="form-select ai-input" id="parcelType">
                                    <option value="document">Documents</option>
                                    <option value="electronics">Electronics</option>
                                    <option value="heavy">Heavy Machinery</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Weight (kg)</label>
                                <input type="number" class="form-control ai-input" id="parcelWeight" placeholder="e.g. 5">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Urgency</label>
                                <select class="form-select ai-input" id="urgency">
                                    <option value="high">High (1-2 Days)</option>
                                    <option value="medium">Medium (3-5 Days)</option>
                                    <option value="low">Low (1-2 Weeks)</option>
                                </select>
                            </div>
                            <div class="col-12 text-center mt-4">
                                <button type="submit" class="glow-button">
                                    <i class="fa-solid fa-brain"></i> Ask AI Brain
                                </button>
                                <div class="loader" id="ai-loader">
                                    <i class="fa-solid fa-circle-notch fa-spin"></i> Analyzing data & predicting optimal routes...
                                </div>
                            </div>
                        </div>
                    </form>
                    
                    <div id="ai-result" class="mt-4 text-center" style="display:none;">
                        <h5 class="text-info" id="ai-message"></h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- SMART SERVICE CARDS -->
        <div class="row g-4" id="service-cards-container">
            <!-- Air Freight -->
            <div class="col-lg-3 col-md-6">
                <div class="service-card" id="card-air" data-service="air">
                    <span class="ai-badge">AI Optimized</span>
                    <i class="fa-solid fa-plane-departure text-info mb-3 mt-4" style="font-size: 3rem;"></i>
                    <h4>Air Freight</h4>
                    <p class="text-muted" style="font-size: 0.9rem;">Ultra-fast international cargo with predictive rerouting.</p>
                    <div class="mt-3 py-2 px-3" style="background: rgba(0,0,0,0.4); border-radius: 10px; font-size: 0.85rem;">
                        <span class="text-info"><i class="fa-solid fa-chart-line"></i> Cost Insight:</span><br>
                        Most used for Karachi → Dubai
                    </div>
                </div>
            </div>

            <!-- Sea Freight -->
            <div class="col-lg-3 col-md-6">
                <div class="service-card" id="card-sea" data-service="sea">
                    <span class="ai-badge">Eco-Friendly</span>
                    <i class="fa-solid fa-ship text-success mb-3 mt-4" style="font-size: 3rem;"></i>
                    <h4>Sea Freight</h4>
                    <p class="text-muted" style="font-size: 0.9rem;">Cost-effective global transit with dynamic container tracking.</p>
                    <div class="mt-3 py-2 px-3" style="background: rgba(0,0,0,0.4); border-radius: 10px; font-size: 0.85rem;">
                        <span class="text-success"><i class="fa-solid fa-piggy-bank"></i> Cost Insight:</span><br>
                        Best value for heavy loads > 50kg
                    </div>
                </div>
            </div>

            <!-- Road Transport -->
            <div class="col-lg-3 col-md-6">
                <div class="service-card" id="card-road" data-service="road">
                    <span class="ai-badge">Live API</span>
                    <i class="fa-solid fa-truck text-warning mb-3 mt-4" style="font-size: 3rem;"></i>
                    <h4>Road Transport</h4>
                    <p class="text-muted" style="font-size: 0.9rem;">Secure nationwide transport with AI traffic avoidance.</p>
                    <div class="mt-3 py-2 px-3" style="background: rgba(0,0,0,0.4); border-radius: 10px; font-size: 0.85rem;">
                        <span class="text-warning"><i class="fa-solid fa-clock"></i> Cost Insight:</span><br>
                        Cheapest for inter-city delivery
                    </div>
                </div>
            </div>

            <!-- Warehousing -->
            <div class="col-lg-3 col-md-6">
                <div class="service-card" id="card-warehouse" data-service="warehouse">
                    <span class="ai-badge">Smart Vault</span>
                    <i class="fa-solid fa-warehouse text-danger mb-3 mt-4" style="font-size: 3rem;"></i>
                    <h4>Warehousing</h4>
                    <p class="text-muted" style="font-size: 0.9rem;">Automated storage facilities with AI demand forecasting.</p>
                    <div class="mt-3 py-2 px-3" style="background: rgba(0,0,0,0.4); border-radius: 10px; font-size: 0.85rem;">
                        <span class="text-danger"><i class="fa-solid fa-boxes-stacked"></i> Cost Insight:</span><br>
                        Free 7-days for returning clients
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<script>
document.getElementById('ai-recommend-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Reset previous states
    document.querySelectorAll('.service-card').forEach(card => card.classList.remove('recommended-glow'));
    document.getElementById('ai-result').style.display = 'none';
    
    const loader = document.getElementById('ai-loader');
    loader.style.display = 'block';
    
    // Simulate AI processing delay
    setTimeout(() => {
        loader.style.display = 'none';
        
        const type = document.getElementById('parcelType').value;
        const weight = document.getElementById('parcelWeight').value || 1;
        const urgency = document.getElementById('urgency').value;
        
        let recommendedService = '';
        let message = '';

        // Simulated AI Logic Engine
        if (urgency === 'high') {
            recommendedService = 'air';
            message = "AI Brain suggests: Air Freight (Fastest for urgent deliveries)";
        } else if (weight >= 50 && urgency !== 'high') {
            recommendedService = 'sea';
            message = "AI Brain suggests: Sea Freight (Most cost-effective for heavy loads)";
        } else if (type === 'electronics' && urgency === 'medium') {
            recommendedService = 'road';
            message = "AI Brain suggests: Road Transport (Safest balance of cost & speed for electronics)";
        } else {
            recommendedService = 'road';
            message = "AI Brain suggests: Road Transport (Best for standard inter-city parcels)";
        }
        
        // Highlight the recommended card
        const recommendedCard = document.getElementById('card-' + recommendedService);
        if(recommendedCard) {
            recommendedCard.classList.add('recommended-glow');
        }
        
        // Show message
        const resultDiv = document.getElementById('ai-result');
        const msgElement = document.getElementById('ai-message');
        msgElement.innerText = message;
        resultDiv.style.display = 'block';
        
        // Scroll to cards
        document.getElementById('service-cards-container').scrollIntoView({ behavior: 'smooth', block: 'center' });
        
    }, 2000); // 2 second fake AI thinking time
});
</script>

<?php include('../includes/footer.php'); ?>