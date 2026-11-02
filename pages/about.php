<?php include('../includes/header.php'); ?>

<style>
/* AI About Us Glassmorphism Styles */
.about-hero {
    position: relative;
    padding: 140px 0 80px;
    background: url('../assets/img/about_bg.jpg') no-repeat center center/cover;
    border-bottom: 1px solid rgba(0, 255, 255, 0.2);
}
.about-hero::before {
    content: '';
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    background: linear-gradient(180deg, rgba(10,14,23,0.85) 0%, rgba(8,17,32,1) 100%);
}
.about-content {
    position: relative;
    z-index: 2;
}
.glass-panel {
    background: rgba(20, 25, 40, 0.5);
    backdrop-filter: blur(15px);
    border: 1px solid rgba(0, 255, 255, 0.2);
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 0 30px rgba(0, 255, 255, 0.05);
    margin-bottom: 30px;
    transition: all 0.3s ease;
}
.glass-panel:hover {
    border-color: rgba(0, 255, 255, 0.5);
    box-shadow: 0 0 30px rgba(0, 255, 255, 0.15);
    transform: translateY(-5px);
}
.ai-brain-icon {
    font-size: 4rem;
    background: linear-gradient(45deg, #00d2ff, #3a7bd5);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    margin-bottom: 20px;
}
.stat-glass-box {
    background: rgba(0,0,0,0.4);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 15px;
    padding: 20px;
    text-align: center;
    transition: all 0.3s ease;
}
.stat-glass-box:hover {
    border-color: #00ffff;
    background: rgba(0,255,255,0.05);
}
.stat-number {
    font-size: 2.5rem;
    font-weight: 700;
    color: #00ffff;
    text-shadow: 0 0 10px rgba(0,255,255,0.5);
}
.timeline-item {
    position: relative;
    padding-left: 30px;
    margin-bottom: 20px;
    border-left: 2px solid rgba(0,255,255,0.3);
}
.timeline-item::before {
    content: '';
    position: absolute;
    left: -7px;
    top: 5px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: #00ffff;
    box-shadow: 0 0 10px #00ffff;
}
</style>

<div class="about-hero">
    <div class="container about-content">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <h1 class="display-4 fw-bold text-light mb-4">
                    <span style="color: #00ffff;">AI-Driven</span> Logistics<br>Intelligence
                </h1>
                <p class="lead text-muted mb-4">
                    Parcel Pulse isn't just a courier company. We are a data science and logistics hybrid, utilizing predictive neural networks to ensure your shipments are faster, safer, and smarter.
                </p>
                <div class="d-flex gap-3">
                    <div class="stat-glass-box flex-fill">
                        <div class="stat-number counter" data-target="99.8">0</div>
                        <div class="text-muted small">AI Prediction Accuracy %</div>
                    </div>
                    <div class="stat-glass-box flex-fill">
                        <div class="stat-number counter" data-target="150">0</div>
                        <div class="text-muted small">Global AI Hubs</div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="glass-panel text-center">
                    <i class="fa-solid fa-network-wired ai-brain-icon"></i>
                    <h3 class="text-light mb-3">The Neural Core</h3>
                    <p class="text-muted">
                        Our proprietary AI, "The Neural Core," analyzes global weather patterns, traffic APIs, and geopolitical events in real-time to reroute your packages dynamically, avoiding delays before they happen.
                    </p>
                    <div class="mt-4 text-start">
                        <div class="timeline-item">
                            <h5 class="text-info mb-1">Pattern Recognition</h5>
                            <p class="text-muted small">Analyzing millions of past routes.</p>
                        </div>
                        <div class="timeline-item">
                            <h5 class="text-info mb-1">Dynamic Rerouting</h5>
                            <p class="text-muted small">Micro-second adjustments to logistics paths.</p>
                        </div>
                        <div class="timeline-item">
                            <h5 class="text-info mb-1">Predictive ETA</h5>
                            <p class="text-muted small">Delivery times accurate to the minute.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="py-5" style="background: #081120;">
    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <h2 class="fw-bold"><i class="fa-solid fa-microchip text-info"></i> Intelligent Fleet</h2>
                <p class="text-muted">Powered by autonomous tech and smart sensors.</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="glass-panel h-100 text-center">
                    <i class="fa-solid fa-plane-up text-info mb-3" style="font-size: 3rem;"></i>
                    <h4>Autonomous Drones</h4>
                    <p class="text-muted small">Last-mile automated drone drops for urgent local parcels.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="glass-panel h-100 text-center">
                    <i class="fa-solid fa-truck-fast text-info mb-3" style="font-size: 3rem;"></i>
                    <h4>Smart Trucks</h4>
                    <p class="text-muted small">IoT integrated vehicles tracking temperature, humidity, and shock.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="glass-panel h-100 text-center">
                    <i class="fa-solid fa-robot text-info mb-3" style="font-size: 3rem;"></i>
                    <h4>Robotic Sorting</h4>
                    <p class="text-muted small">AI vision-guided robots sort 10,000 packages per hour with zero error.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
// Simple counter animation for stats
const counters = document.querySelectorAll('.counter');
counters.forEach(counter => {
    counter.innerText = '0';
    const updateCounter = () => {
        const target = +counter.getAttribute('data-target');
        const c = +counter.innerText;
        const increment = target / 50;
        if (c < target) {
            counter.innerText = `${Math.ceil(c + increment)}`;
            setTimeout(updateCounter, 30);
        } else {
            counter.innerText = target + (target % 1 !== 0 ? '%' : '+');
        }
    };
    // trigger animation when visible
    setTimeout(updateCounter, 500); 
});
</script>

<?php include('../includes/footer.php'); ?>