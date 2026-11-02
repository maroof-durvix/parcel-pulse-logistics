<?php include('../includes/header.php'); ?>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<style>
/* Drone Module Glassmorphism */
.drone-hero {
    position: relative;
    padding: 120px 0 60px;
    background: url('../assets/img/tracking_bg.jpg') no-repeat center center/cover;
    border-bottom: 1px solid rgba(0, 255, 255, 0.2);
    min-height: 100vh;
}
.drone-hero::before {
    content: '';
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    background: linear-gradient(135deg, rgba(10,14,23,0.95) 0%, rgba(8,17,32,0.9) 100%);
}
.drone-content {
    position: relative;
    z-index: 2;
}
.glass-panel {
    background: rgba(20, 25, 40, 0.6);
    backdrop-filter: blur(15px);
    border: 1px solid rgba(0, 255, 255, 0.3);
    border-radius: 20px;
    padding: 25px;
    box-shadow: 0 0 30px rgba(0, 255, 255, 0.1);
    height: 100%;
}
.data-box {
    background: rgba(0,0,0,0.5);
    border: 1px solid rgba(0, 255, 255, 0.2);
    border-radius: 15px;
    padding: 15px;
    text-align: center;
    margin-bottom: 15px;
}
.data-value {
    font-size: 1.8rem;
    font-weight: bold;
    color: #00ffff;
    text-shadow: 0 0 10px rgba(0,255,255,0.5);
    margin: 10px 0 0;
}
.data-label {
    font-size: 0.8rem;
    color: #aaa;
    text-transform: uppercase;
    letter-spacing: 1px;
}
.battery-container {
    width: 100%;
    height: 20px;
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(0,255,255,0.3);
    border-radius: 10px;
    margin-top: 10px;
    position: relative;
    overflow: hidden;
}
.battery-bar {
    height: 100%;
    width: 100%;
    background: #00ffff;
    box-shadow: 0 0 10px #00ffff;
    transition: width 1s linear, background 0.5s;
}
.camera-feed {
    width: 100%;
    height: 200px;
    background: repeating-linear-gradient(
      0deg,
      rgba(0, 255, 255, 0.05),
      rgba(0, 255, 255, 0.05) 1px,
      transparent 1px,
      transparent 2px
    ), #081120;
    border: 1px solid rgba(0, 255, 255, 0.3);
    border-radius: 15px;
    position: relative;
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
}
.camera-overlay {
    position: absolute;
    top: 10px; left: 10px;
    color: #00ffff;
    font-family: monospace;
    font-size: 0.8rem;
}
.scan-line {
    position: absolute;
    top: 0; left: 0; right: 0; height: 2px;
    background: rgba(0, 255, 255, 0.5);
    box-shadow: 0 0 10px #00ffff;
    animation: scan 3s linear infinite;
}
@keyframes scan {
    0% { top: 0%; opacity: 0; }
    10% { opacity: 1; }
    90% { opacity: 1; }
    100% { top: 100%; opacity: 0; }
}
#drone-map {
    height: 400px;
    border-radius: 15px;
    border: 1px solid rgba(0, 255, 255, 0.3);
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
</style>

<div class="drone-hero text-light">
    <div class="container drone-content">
        
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold"><i class="fa-solid fa-plane-up text-info"></i> Autonomous Drone System</h1>
            <p class="lead text-muted">Module 4: Real-time telemetry, wind analysis, and smart landing detection.</p>
        </div>

        <div class="row g-4">
            
            <!-- Left Panel: Telemetry -->
            <div class="col-lg-4">
                <div class="glass-panel">
                    <h5 class="text-info mb-4"><i class="fa-solid fa-satellite-dish"></i> Live Telemetry</h5>
                    
                    <div class="data-box">
                        <div class="data-label">Drone ID</div>
                        <div class="data-value" style="font-size:1.2rem;">DRN-X9-ALPHA</div>
                    </div>
                    
                    <div class="data-box">
                        <div class="data-label">Altitude</div>
                        <div class="data-value" id="alt-val">120m</div>
                    </div>
                    
                    <div class="data-box">
                        <div class="data-label">Wind Speed</div>
                        <div class="data-value" id="wind-val">14 km/h</div>
                        <small class="text-success" id="wind-status"><i class="fa-solid fa-check-circle"></i> Optimal</small>
                    </div>

                    <div class="data-box text-start">
                        <div class="data-label text-center">Battery Status <span id="batt-text" class="text-info float-end fw-bold">100%</span></div>
                        <div class="battery-container">
                            <div class="battery-bar" id="batt-bar"></div>
                        </div>
                        <small class="text-muted d-block text-center mt-2" id="eta-val">ETA: 12 mins</small>
                    </div>

                    <button class="glow-btn mt-3" id="launchBtn" onclick="launchDrone()"><i class="fa-solid fa-power-off"></i> Initialize Flight Sequence</button>
                </div>
            </div>

            <!-- Right Panel: Map & Camera -->
            <div class="col-lg-8">
                <div class="glass-panel">
                    <div class="row g-3">
                        <div class="col-12">
                            <h5 class="text-info mb-3"><i class="fa-solid fa-map-location-dot"></i> Live Route Simulation</h5>
                            <div id="drone-map"></div>
                        </div>
                        <div class="col-12 mt-4">
                            <h5 class="text-info mb-3"><i class="fa-solid fa-camera"></i> Downward Landing Camera (AI Vision)</h5>
                            <div class="camera-feed">
                                <div class="camera-overlay">
                                    REC <i class="fa-solid fa-circle text-danger fa-fade"></i><br>
                                    AI_VISION: ACTIVE<br>
                                    TARGET_LOCK: <span id="target-lock" class="text-warning">SEARCHING...</span>
                                </div>
                                <div class="scan-line"></div>
                                <i class="fa-solid fa-crosshairs text-info" style="font-size:4rem; opacity:0.5;"></i>
                                <span id="cam-msg" class="position-absolute" style="color:#00ffff; font-family:monospace; bottom:10px;">AWAITING LAUNCH...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
let map;
let droneMarker;
let flightPath;
let animationTimer;
let isFlying = false;
let battery = 100;

// Coordinates for simulation
const startPoint = [24.8607, 67.0011]; // Karachi Hub
const endPoint = [24.8920, 67.0822];   // Delivery Point

// Init Map
function initDroneMap() {
    map = L.map('drone-map', { zoomControl: false }).setView(startPoint, 13);
    L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png').addTo(map);

    // Draw planned route
    L.polyline([startPoint, endPoint], {color: 'rgba(255,255,255,0.2)', dashArray: '5, 5'}).addTo(map);
    
    // Hub Marker
    L.circleMarker(startPoint, {color: '#00ffff', radius: 8, fillOpacity: 1}).addTo(map).bindPopup("AI Drone Hub");
    // Destination Marker
    L.circleMarker(endPoint, {color: '#28a745', radius: 8, fillOpacity: 1}).addTo(map).bindPopup("Delivery Point");

    // Drone Icon
    const droneIcon = L.divIcon({
        className: 'drone-icon',
        html: '<i class="fa-solid fa-plane-up text-info fa-beat" style="font-size:20px; text-shadow:0 0 10px #00ffff;"></i>',
        iconSize: [20, 20],
        iconAnchor: [10, 10]
    });

    droneMarker = L.marker(startPoint, {icon: droneIcon}).addTo(map);
    map.fitBounds(L.polyline([startPoint, endPoint]).getBounds(), {padding: [50, 50]});
}
initDroneMap();

// Flight Simulation
function launchDrone() {
    if(isFlying) return;
    isFlying = true;
    
    document.getElementById('launchBtn').innerHTML = '<i class="fa-solid fa-satellite fa-spin"></i> Drone is Airborne';
    document.getElementById('launchBtn').classList.add('disabled');
    document.getElementById('cam-msg').innerText = "CRUISING ALTITUDE REACHED";
    document.getElementById('target-lock').innerText = "IN TRANSIT";

    const latDiff = endPoint[0] - startPoint[0];
    const lngDiff = endPoint[1] - startPoint[1];
    
    let step = 0;
    const totalSteps = 400; // Time of flight simulation
    
    function fly() {
        if(step >= totalSteps) {
            landingSequence();
            return;
        }
        
        step++;
        const progress = step / totalSteps;
        const currentLat = startPoint[0] + (latDiff * progress);
        const currentLng = startPoint[1] + (lngDiff * progress);
        
        // Move Marker
        droneMarker.setLatLng([currentLat, currentLng]);
        
        // Update Telemetry
        if(step % 10 === 0) updateTelemetry(progress);
        
        animationTimer = setTimeout(fly, 50); // Speed
    }
    fly();
}

function updateTelemetry(progress) {
    // Altitude fluctuation
    let alt = 120 + Math.floor(Math.random() * 5 - 2);
    document.getElementById('alt-val').innerText = alt + 'm';
    
    // Wind Analysis fluctuation
    let wind = 14 + Math.floor(Math.random() * 10 - 5);
    document.getElementById('wind-val').innerText = wind + ' km/h';
    if(wind > 20) {
        document.getElementById('wind-status').innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i> High Wind Alert';
        document.getElementById('wind-status').className = 'text-warning';
    } else {
        document.getElementById('wind-status').innerHTML = '<i class="fa-solid fa-check-circle"></i> Optimal';
        document.getElementById('wind-status').className = 'text-success';
    }
    
    // Battery Drain simulation
    battery = 100 - (progress * 15); // uses 15% battery for trip
    document.getElementById('batt-text').innerText = Math.floor(battery) + '%';
    document.getElementById('batt-bar').style.width = battery + '%';
    
    // ETA update
    let eta = Math.ceil(12 - (progress * 12));
    document.getElementById('eta-val').innerText = 'ETA: ' + eta + ' mins';
}

function landingSequence() {
    document.getElementById('alt-val').innerText = '0m';
    document.getElementById('wind-val').innerText = '0 km/h';
    document.getElementById('eta-val').innerText = 'Delivered';
    document.getElementById('launchBtn').innerHTML = '<i class="fa-solid fa-check"></i> Package Delivered';
    document.getElementById('launchBtn').classList.replace('glow-btn', 'btn-success');
    
    // Camera Smart Landing Detection
    document.getElementById('target-lock').innerText = "LOCKED";
    document.getElementById('target-lock').className = "text-success";
    document.getElementById('cam-msg').innerText = "SMART LANDING PAD DETECTED. DESCENDING... PACKAGE DROPPED.";
    document.getElementById('cam-msg').className = "text-success position-absolute";
    
    // Map Marker change
    const boxIcon = L.divIcon({
        className: 'box-icon',
        html: '<i class="fa-solid fa-box text-success" style="font-size:20px; text-shadow:0 0 10px #28a745;"></i>',
        iconSize: [20, 20],
        iconAnchor: [10, 10]
    });
    droneMarker.setIcon(boxIcon);
}

</script>

<?php include('../includes/footer.php'); ?>
