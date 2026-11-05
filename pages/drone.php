<?php include('../includes/header.php'); ?>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<style>
/* Dark Inverted Leaflet Map for Drone Console */
#drone-map {
    height: 380px;
    width: 100%;
    border-radius: var(--radius-md);
    border: 1px solid rgba(0, 242, 254, 0.25);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.6);
}
#drone-map .leaflet-tile {
    filter: brightness(0.65) invert(1) contrast(2.5) hue-rotate(200deg) saturate(0.25);
}

.hud-tile {
    background: rgba(6, 11, 20, 0.85);
    border: 1px solid rgba(0, 242, 254, 0.2);
    border-radius: var(--radius-md);
    padding: 16px;
    text-align: center;
    transition: var(--transition);
}
.hud-tile:hover {
    border-color: var(--cyan);
    box-shadow: 0 0 15px rgba(0, 242, 254, 0.2);
}

.camera-feed {
    height: 220px;
    background: repeating-linear-gradient(
      0deg,
      rgba(0, 242, 254, 0.04),
      rgba(0, 242, 254, 0.04) 1px,
      transparent 1px,
      transparent 3px
    ), #050a14;
    border: 1px solid rgba(0, 242, 254, 0.25);
    border-radius: var(--radius-md);
    position: relative;
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
}

.scan-line {
    position: absolute;
    top: 0; left: 0; right: 0; height: 2px;
    background: rgba(0, 242, 254, 0.7);
    box-shadow: 0 0 10px var(--cyan);
    animation: cameraScan 3s linear infinite;
}
@keyframes cameraScan {
    0% { top: 0%; opacity: 0.8; }
    50% { opacity: 1; }
    100% { top: 100%; opacity: 0.8; }
}

.reticle-box {
    width: 90px;
    height: 90px;
    border: 2px dashed rgba(0, 242, 254, 0.6);
    border-radius: 50%;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    animation: rotateReticle 10s linear infinite;
}
@keyframes rotateReticle {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}
</style>

<!-- DRONE HERO -->
<section class="page-hero hero-drone">
    <div class="container text-center">
        <span class="badge-cyan mb-2 d-inline-block"><i class="fa-solid fa-plane-up me-1"></i> Sub-Hour Autonomous Aerial Fleet</span>
        <h1 class="hero-title-gradient">Autonomous Drone Console</h1>
        <p class="text-secondary max-w-lg mx-auto" style="max-width: 650px;">
            Real-time telemetry, atmospheric wind shear computation, and automated computer-vision landing detection.
        </p>
    </div>
</section>

<!-- MAIN CONSOLE -->
<section class="py-5" style="background: var(--bg-main);">
    <div class="container">
        <div class="row g-4">
            <!-- Left: Telemetry & Controls -->
            <div class="col-lg-5">
                <div class="pulse-card mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold text-white mb-0">
                            <i class="fa-solid fa-satellite-dish text-info me-2"></i> Live Telemetry
                        </h5>
                        <span class="badge bg-success px-3 py-1 rounded-pill small font-monospace">ONLINE</span>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <div class="hud-tile">
                                <span class="text-secondary small text-uppercase">Drone ID</span>
                                <h5 class="text-white fw-bold mb-0 mt-1" style="color: var(--cyan) !important;">DRN-X9-ALPHA</h5>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="hud-tile">
                                <span class="text-secondary small text-uppercase">Altitude</span>
                                <h4 class="text-white fw-bold mb-0 mt-1" id="alt-val">120m</h4>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="hud-tile">
                                <span class="text-secondary small text-uppercase">Wind Speed</span>
                                <h4 class="text-white fw-bold mb-0 mt-1" id="wind-val">14 km/h</h4>
                                <small class="text-success" id="wind-status"><i class="fa-solid fa-circle-check"></i> Optimal</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="hud-tile">
                                <span class="text-secondary small text-uppercase">Payload Status</span>
                                <h5 class="text-white fw-bold mb-0 mt-1 text-info">Secured (1.2 kg)</h5>
                                <small class="text-secondary" id="eta-val">ETA: 12 mins</small>
                            </div>
                        </div>
                    </div>

                    <!-- Battery Status -->
                    <div class="p-3 rounded-3 mb-4" style="background: rgba(6, 11, 20, 0.85); border: 1px solid rgba(0, 242, 254, 0.2);">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="small text-secondary"><i class="fa-solid fa-battery-three-quarters text-info me-1"></i> High-Density Battery:</span>
                            <span class="fw-bold font-monospace" id="batt-text" style="color: var(--cyan);">100%</span>
                        </div>
                        <div class="progress" style="height: 8px; background: rgba(255,255,255,0.1); border-radius: 4px;">
                            <div class="progress-bar" id="batt-bar" style="width: 100%; background: var(--cyan); box-shadow: 0 0 10px var(--cyan);"></div>
                        </div>
                    </div>

                    <!-- Action Button -->
                    <button class="glow-btn" id="launchBtn" onclick="launchDrone()">
                        <i class="fa-solid fa-power-off"></i> Initialize Flight Sequence
                    </button>
                </div>

                <!-- Downward Camera View -->
                <div class="pulse-card">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="text-white fw-bold mb-0">
                            <i class="fa-solid fa-camera text-info me-2"></i> Downward Optical Vision Feed
                        </h6>
                        <span class="text-danger small font-monospace"><i class="fa-solid fa-circle fa-fade"></i> REC</span>
                    </div>

                    <div class="camera-feed position-relative">
                        <div class="scan-line"></div>
                        <div class="reticle-box">
                            <i class="fa-solid fa-crosshairs text-info" style="font-size: 1.5rem;"></i>
                        </div>
                        <div class="position-absolute top-0 start-0 p-2 font-monospace small" style="color: var(--cyan); font-size: 0.75rem;">
                            AI_VISION: ACTIVE<br>
                            TARGET_LOCK: <span id="target-lock">SEARCHING...</span>
                        </div>
                        <div class="position-absolute bottom-0 start-0 p-2 font-monospace small text-secondary" id="cam-msg" style="font-size: 0.75rem;">
                            AWAITING TAKEOFF SEQUENCE...
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Interactive Flight Map -->
            <div class="col-lg-7">
                <div class="pulse-card h-100 d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h5 class="fw-bold text-white mb-0">
                                <i class="fa-solid fa-map-location-dot text-info me-2"></i> Live Aerial Corridor Simulation
                            </h5>
                            <small class="text-secondary">Karachi Hub &bull; Altitude 120m &bull; Direct Route</small>
                        </div>
                        <span class="badge-cyan small">GPS Geofenced</span>
                    </div>

                    <!-- Clean Dark Map -->
                    <div id="drone-map" class="flex-grow-1" style="min-height: 440px;"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
let map;
let droneMarker;
let animationTimer;
let isFlying = false;
let battery = 100;

// Coordinates for simulation
const startPoint = [24.8607, 67.0011]; // Karachi Port Hub
const endPoint = [24.8920, 67.0822];   // DHA Phase 6 Delivery Pad

function initDroneMap() {
    map = L.map('drone-map').setView(startPoint, 13);

    // Standard OpenStreetMap with CSS dark invert filter - NO WATERMARK!
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Route Polyline
    L.polyline([startPoint, endPoint], {
        color: '#00f2fe',
        weight: 3,
        opacity: 0.8,
        dashArray: '6, 8'
    }).addTo(map);

    // Hub marker
    L.circleMarker(startPoint, {
        color: '#00f2fe',
        fillColor: '#00f2fe',
        radius: 8,
        fillOpacity: 1
    }).addTo(map).bindPopup("<b>AI Drone Hub #1</b>");

    // Destination Marker
    L.circleMarker(endPoint, {
        color: '#10b981',
        fillColor: '#10b981',
        radius: 8,
        fillOpacity: 1
    }).addTo(map).bindPopup("<b>Target Delivery Pad</b>");

    // Drone Marker
    const droneIcon = L.divIcon({
        className: 'drone-icon',
        html: '<div style="background: rgba(0, 242, 254, 0.2); border: 2px solid #00f2fe; border-radius: 50%; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; box-shadow: 0 0 15px #00f2fe;"><i class="fa-solid fa-plane-up text-white" style="font-size: 15px;"></i></div>',
        iconSize: [36, 36],
        iconAnchor: [18, 18]
    });

    droneMarker = L.marker(startPoint, { icon: droneIcon }).addTo(map);
    map.fitBounds(L.polyline([startPoint, endPoint]).getBounds(), { padding: [50, 50] });
}
initDroneMap();

function launchDrone() {
    if (isFlying) return;
    isFlying = true;

    const launchBtn = document.getElementById('launchBtn');
    launchBtn.innerHTML = '<i class="fa-solid fa-plane-departure fa-fade"></i> Drone Airborne • In Flight';
    launchBtn.style.opacity = '0.8';
    document.getElementById('cam-msg').innerText = "CRUISING ALTITUDE: 120M • OPTICAL NAVIGATION ACTIVE";
    document.getElementById('target-lock').innerText = "TRACKING FLIGHT PATH";

    const latDiff = endPoint[0] - startPoint[0];
    const lngDiff = endPoint[1] - startPoint[1];

    let step = 0;
    const totalSteps = 250;

    function fly() {
        if (step >= totalSteps) {
            landingSequence();
            return;
        }

        step++;
        const progress = step / totalSteps;
        const currentLat = startPoint[0] + (latDiff * progress);
        const currentLng = startPoint[1] + (lngDiff * progress);

        droneMarker.setLatLng([currentLat, currentLng]);

        if (step % 5 === 0) updateTelemetry(progress);

        animationTimer = setTimeout(fly, 50);
    }
    fly();
}

function updateTelemetry(progress) {
    let alt = 120 + Math.floor(Math.random() * 4 - 2);
    document.getElementById('alt-val').innerText = alt + 'm';

    let wind = 14 + Math.floor(Math.random() * 8 - 4);
    document.getElementById('wind-val').innerText = wind + ' km/h';

    battery = 100 - (progress * 12);
    document.getElementById('batt-text').innerText = Math.floor(battery) + '%';
    document.getElementById('batt-bar').style.width = battery + '%';

    let eta = Math.ceil(12 - (progress * 12));
    document.getElementById('eta-val').innerText = 'ETA: ' + eta + ' mins';
}

function landingSequence() {
    document.getElementById('alt-val').innerText = '0m';
    document.getElementById('wind-val').innerText = '2 km/h';
    document.getElementById('eta-val').innerText = 'Arrived';
    
    const launchBtn = document.getElementById('launchBtn');
    launchBtn.innerHTML = '<i class="fa-solid fa-circle-check text-success"></i> Delivery Complete & Safe Drop';
    launchBtn.style.background = '#10b981';

    document.getElementById('target-lock').innerText = "LOCKED";
    document.getElementById('target-lock').className = "text-success";
    document.getElementById('cam-msg').innerText = "LANDING PAD DETECTED • TOUCHDOWN COMPLETE • PARCEL RELEASED";
    document.getElementById('cam-msg').className = "position-absolute bottom-0 start-0 p-2 font-monospace small text-success";
}
</script>

<?php include('../includes/footer.php'); ?>
