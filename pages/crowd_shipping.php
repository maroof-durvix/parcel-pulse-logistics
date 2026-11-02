<?php include('../includes/header.php'); ?>

<!-- Leaflet CSS for Map -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<style>
/* Crowd Shipping Glassmorphism Styles */
.crowd-hero {
    position: relative;
    padding: 120px 0 60px;
    background: url('../assets/img/lockers_bg.jpg') no-repeat center center/cover;
    background-color: #081120;
    border-bottom: 1px solid rgba(0, 255, 255, 0.2);
    min-height: 100vh;
}
.crowd-hero::before {
    content: '';
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    background: linear-gradient(135deg, rgba(10,14,23,0.95) 0%, rgba(8,17,32,0.9) 100%);
}
.crowd-content {
    position: relative;
    z-index: 2;
}
.glass-panel {
    background: rgba(20, 25, 40, 0.6);
    backdrop-filter: blur(15px);
    border: 1px solid rgba(0, 255, 255, 0.3);
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 0 30px rgba(0, 255, 255, 0.1);
    height: 100%;
    transition: transform 0.3s;
}
.glass-panel:hover {
    transform: translateY(-5px);
    box-shadow: 0 0 40px rgba(0, 255, 255, 0.2);
}
.glow-input {
    background: rgba(0,0,0,0.5);
    border: 1px solid rgba(0, 255, 255, 0.3);
    color: white;
    border-radius: 10px;
    padding: 12px;
}
.glow-input:focus {
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
    border-radius: 50px;
    padding: 12px 30px;
    width: 100%;
    box-shadow: 0 0 15px rgba(0, 210, 255, 0.6);
    transition: all 0.3s ease;
}
.glow-btn:hover {
    box-shadow: 0 0 25px rgba(0, 210, 255, 0.9);
}
.driver-card {
    background: rgba(0, 255, 255, 0.05);
    border: 1px solid rgba(0, 255, 255, 0.2);
    border-radius: 15px;
    padding: 15px;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 15px;
}
.driver-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: #00ffff;
    color: #000;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 1.5rem;
    font-weight: bold;
}
#crowd-map {
    height: 350px;
    border-radius: 15px;
    border: 1px solid rgba(0, 255, 255, 0.3);
}
.pulse-circle {
    width: 15px;
    height: 15px;
    background-color: #00ffff;
    border-radius: 50%;
    animation: pulseGlow 1.5s infinite;
}
@keyframes pulseGlow {
    0% { box-shadow: 0 0 0 0 rgba(0, 255, 255, 0.7); }
    70% { box-shadow: 0 0 0 15px rgba(0, 255, 255, 0); }
    100% { box-shadow: 0 0 0 0 rgba(0, 255, 255, 0); }
}
</style>

<div class="crowd-hero text-light">
    <div class="container crowd-content">
        
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold"><i class="fa-solid fa-users text-info"></i> AI Crowd Shipping</h1>
            <p class="lead text-muted">Module 10: Peer-to-peer delivery network. Earn on your commute.</p>
        </div>

        <div class="row g-4 mb-5">
            
            <!-- Send Parcel via Crowd -->
            <div class="col-lg-6">
                <div class="glass-panel">
                    <h4 class="text-info mb-3"><i class="fa-solid fa-box-open"></i> Send a Parcel</h4>
                    <p class="text-muted mb-4">Find someone traveling to your destination and save up to 40% on shipping costs.</p>
                    
                    <form onsubmit="findDrivers(event)">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-info small text-uppercase">From</label>
                                <input type="text" class="form-control glow-input" placeholder="Origin Address" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-info small text-uppercase">To</label>
                                <input type="text" class="form-control glow-input" placeholder="Destination Address" required>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="glow-btn" id="findBtn"><i class="fa-solid fa-search"></i> Match with Drivers</button>
                            </div>
                        </div>
                    </form>

                    <div id="driver-results" class="mt-4" style="display: none;">
                        <h6 class="text-success mb-3"><i class="fa-solid fa-check-circle"></i> AI Found 2 Matches on this Route</h6>
                        
                        <div class="driver-card">
                            <div class="driver-avatar"><i class="fa-solid fa-user"></i></div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0 fw-bold">Ali R. <span class="badge bg-success ms-2">Verified</span></h6>
                                <small class="text-muted">Traveling in 2 hours via Car.</small>
                            </div>
                            <div>
                                <h5 class="text-info mb-0">Rs. 450</h5>
                            </div>
                        </div>
                        
                        <div class="driver-card">
                            <div class="driver-avatar"><i class="fa-solid fa-motorcycle"></i></div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0 fw-bold">Zain B. <span class="badge bg-success ms-2">Verified</span></h6>
                                <small class="text-muted">Traveling Tomorrow via Bike.</small>
                            </div>
                            <div>
                                <h5 class="text-info mb-0">Rs. 200</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Become a Driver -->
            <div class="col-lg-6">
                <div class="glass-panel">
                    <h4 class="text-info mb-3"><i class="fa-solid fa-car-side"></i> Earn on your Route</h4>
                    <p class="text-muted mb-4">Going somewhere? Add your route and our AI will assign you packages to deliver.</p>
                    
                    <div class="p-3 mb-4 rounded" style="background: rgba(40, 167, 69, 0.1); border: 1px dashed #28a745;">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="text-success m-0">AI Estimated Earnings:</h6>
                            <h4 class="fw-bold text-success m-0">Rs. 8,500 <small style="font-size: 0.8rem;">/mo</small></h4>
                        </div>
                    </div>

                    <form onsubmit="registerRoute(event)">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-info small text-uppercase">Vehicle Type</label>
                                <select class="form-select glow-input" required>
                                    <option value="bike">Motorcycle</option>
                                    <option value="car">Car / Sedan</option>
                                    <option value="van">Van / Truck</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-info small text-uppercase">Daily Route</label>
                                <input type="text" class="form-control glow-input" placeholder="e.g. DHA to Saddar" required>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="glow-btn" style="background: linear-gradient(45deg, #28a745, #20c997);" id="regBtn">
                                    <i class="fa-solid fa-steering-wheel"></i> Register as Freelancer
                                </button>
                            </div>
                        </div>
                    </form>
                    
                    <div id="reg-success" class="mt-3 text-center d-none text-success">
                        <i class="fa-solid fa-shield-check"></i> Registration submitted. Awaiting AI Verification.
                    </div>
                </div>
            </div>
        </div>

        <!-- Live Network Map -->
        <div class="row">
            <div class="col-12">
                <div class="glass-panel text-center">
                    <h4 class="text-info mb-4">Live Freelance Network</h4>
                    <div class="d-flex justify-content-center align-items-center gap-2 mb-3">
                        <div class="pulse-circle"></div> <span class="text-muted small">84 Active Drivers in your city</span>
                    </div>
                    <div id="crowd-map"></div>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
// Mock functions for UI Interaction
function findDrivers(e) {
    e.preventDefault();
    const btn = document.getElementById('findBtn');
    btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Analyzing Routes...';
    
    setTimeout(() => {
        btn.innerHTML = '<i class="fa-solid fa-search"></i> Match with Drivers';
        document.getElementById('driver-results').style.display = 'block';
    }, 1500);
}

function registerRoute(e) {
    e.preventDefault();
    const btn = document.getElementById('regBtn');
    btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Processing...';
    
    setTimeout(() => {
        btn.innerHTML = '<i class="fa-solid fa-check"></i> Success';
        document.getElementById('reg-success').classList.remove('d-none');
    }, 1500);
}

// Leaflet Map Initialization
const map = L.map('crowd-map', { zoomControl: false }).setView([24.8607, 67.0011], 12); // Centered on Karachi
L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png').addTo(map);

// Add mock drivers moving slightly
const driverLocations = [
    [24.85, 67.02],
    [24.88, 67.05],
    [24.82, 67.08],
    [24.89, 66.99]
];

const carIcon = L.divIcon({
    className: 'custom-icon',
    html: '<i class="fa-solid fa-car text-info"></i>',
    iconSize: [20, 20]
});
const bikeIcon = L.divIcon({
    className: 'custom-icon',
    html: '<i class="fa-solid fa-motorcycle text-success"></i>',
    iconSize: [20, 20]
});

driverLocations.forEach((loc, index) => {
    L.marker(loc, {icon: index % 2 === 0 ? carIcon : bikeIcon}).addTo(map);
});
</script>

<?php include('../includes/footer.php'); ?>
