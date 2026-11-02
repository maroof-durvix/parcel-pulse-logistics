<?php include('../includes/header.php'); ?>
<?php include('../config/db.php'); ?>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<style>
/* AI Tracking Page Styles */
.tracking-hero {
    position: relative;
    padding: 120px 0 60px;
    background: url('../assets/img/tracking_bg.jpg') no-repeat center center/cover;
    border-bottom: 1px solid rgba(0, 255, 255, 0.2);
}
.tracking-hero::before {
    content: '';
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    background: linear-gradient(180deg, rgba(10,14,23,0.85) 0%, rgba(10,14,23,1) 100%);
}
.content-wrapper {
    position: relative;
    z-index: 2;
}
.tracking-glass-box {
    background: rgba(20, 25, 40, 0.6);
    backdrop-filter: blur(15px);
    border: 1px solid rgba(0, 255, 255, 0.3);
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 0 30px rgba(0, 255, 255, 0.1);
}
.voice-btn {
    background: rgba(0, 255, 255, 0.1);
    border: 1px solid #00ffff;
    color: #00ffff;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 1.5rem;
    cursor: pointer;
    transition: all 0.3s ease;
    margin: 0 auto 20px;
}
.voice-btn:hover, .voice-btn.recording {
    background: #00ffff;
    color: #000;
    box-shadow: 0 0 20px #00ffff;
}
.voice-btn.recording {
    animation: pulseMic 1.5s infinite;
}
@keyframes pulseMic {
    0% { transform: scale(1); box-shadow: 0 0 10px #00ffff; }
    50% { transform: scale(1.1); box-shadow: 0 0 25px #00ffff; }
    100% { transform: scale(1); box-shadow: 0 0 10px #00ffff; }
}
.tracking-input {
    background: rgba(0,0,0,0.5);
    border: 1px solid rgba(0, 255, 255, 0.3);
    color: #fff;
    border-radius: 50px;
    padding: 15px 25px;
    text-align: center;
    font-size: 1.2rem;
    letter-spacing: 2px;
}
.tracking-input:focus {
    background: rgba(0,0,0,0.7);
    border-color: #00ffff;
    color: #fff;
    box-shadow: 0 0 15px rgba(0, 255, 255, 0.5);
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

/* AI Status Display */
.ai-status-panel {
    background: rgba(0,0,0,0.4);
    border: 1px solid rgba(0,255,255,0.2);
    border-radius: 15px;
    padding: 25px;
    margin-top: 30px;
    display: none;
}
.ai-prediction-box {
    background: rgba(0, 255, 255, 0.05);
    border-left: 4px solid #00ffff;
    padding: 15px;
    border-radius: 5px;
    margin-bottom: 20px;
}
.route-progress {
    position: relative;
    height: 4px;
    background: rgba(255,255,255,0.1);
    margin: 40px 0 20px;
    border-radius: 2px;
}
.route-progress-bar {
    position: absolute;
    top: 0; left: 0; height: 100%;
    background: #00ffff;
    box-shadow: 0 0 10px #00ffff;
    width: 0%;
    transition: width 2s ease-in-out;
}
.route-node {
    position: absolute;
    top: -8px;
    width: 20px; height: 20px;
    background: #081120;
    border: 3px solid rgba(255,255,255,0.2);
    border-radius: 50%;
    transition: all 0.5s;
}
.route-node.active {
    border-color: #00ffff;
    box-shadow: 0 0 10px #00ffff;
    background: #00ffff;
}
.route-label {
    position: absolute;
    top: 20px;
    transform: translateX(-50%);
    font-size: 0.8rem;
    color: #ccc;
    white-space: nowrap;
}

/* Map Styling */
#live-map {
    height: 350px;
    border-radius: 10px;
    margin-top: 25px;
    border: 1px solid rgba(0, 255, 255, 0.3);
    box-shadow: 0 0 20px rgba(0, 255, 255, 0.1);
    z-index: 1; /* Keep map behind modals but visible */
}
</style>

<div class="tracking-hero text-light">
    <div class="container content-wrapper">
        
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold"><i class="fa-solid fa-satellite text-info"></i> AI Parcel Tracker</h1>
            <p class="lead text-muted">Real-time predictive tracking & live map simulation</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="tracking-glass-box text-center">
                    
                    <p class="text-info mb-4">Click the mic and say <strong>"Track my parcel"</strong> or type your Waybill ID</p>
                    
                    <div class="voice-btn" id="voiceBtn" title="Voice Tracking">
                        <i class="fa-solid fa-microphone"></i>
                    </div>
                    
                    <p id="voice-status" class="text-muted small" style="height: 20px;"></p>

                    <form id="ai-track-form">
                        <div class="row gx-2">
                            <div class="col-md-8 mb-3 mb-md-0">
                                <input type="text" id="trackingNumber" class="form-control tracking-input w-100" placeholder="e.g. PP-8492-AI" required>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="glow-btn m-0 w-100" style="padding: 15px;">
                                    <i class="fa-solid fa-radar"></i> Track
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- AI Processing & Results -->
                    <div id="ai-processing" class="mt-4" style="display:none;">
                        <i class="fa-solid fa-circle-notch fa-spin text-info" style="font-size: 2rem;"></i>
                        <p class="mt-2 text-info">AI Querying Global Database...</p>
                    </div>

                    <div class="ai-status-panel text-start" id="ai-result-panel">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="ai-prediction-box h-100 mb-md-0">
                                    <h5 class="text-info mb-1"><i class="fa-solid fa-brain"></i> AI Insights</h5>
                                    <p class="mb-0 small" id="ai-prediction-text"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-column justify-content-center h-100 text-md-end mt-3 mt-md-0">
                                    <div>
                                        <small class="text-muted">Waybill ID:</small> <span id="res-id" class="text-light fw-bold ms-2"></span>
                                    </div>
                                    <div class="mt-2">
                                        <small class="text-muted">Status:</small> <span id="res-status" class="badge bg-info ms-2"></span>
                                    </div>
                                    <div class="mt-2">
                                        <small class="text-muted">Method:</small> <span class="badge bg-secondary ms-2" id="res-method"><i class="fa-solid fa-truck-fast"></i> Autonomous EV</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Animated Route Bar -->
                        <div class="route-progress">
                            <div class="route-progress-bar" id="routeBar"></div>
                            
                            <div class="route-node active" style="left: 0%;">
                                <div class="route-label">Dispatched</div>
                            </div>
                            <div class="route-node" id="node-transit" style="left: 50%;">
                                <div class="route-label">In Transit</div>
                            </div>
                            <div class="route-node" id="node-delivered" style="left: 100%;">
                                <div class="route-label">Delivered</div>
                            </div>
                        </div>
                        
                        <!-- Leaflet Map Container -->
                        <div id="live-map"></div>

                        <div class="mt-4 text-center">
                            <p class="text-muted small mb-0"><i class="fa-solid fa-shield-halved"></i> Secured by Pulse AI Blockchain</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
let map;
let marker;
let routeLine;
let animationTimeout;

function initMap() {
    // Check if map is already initialized
    if (map) return;
    
    // Initialize the map with dark theme
    map = L.map('live-map').setView([31.5204, 74.3587], 6); // Default view (Lahore, PK)

    L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; <a href="https://carto.com/attributions">CARTO</a>'
    }).addTo(map);
}

function animateMarker(startPoint, endPoint, progressPercent) {
    if (marker) map.removeLayer(marker);
    if (routeLine) map.removeLayer(routeLine);
    clearTimeout(animationTimeout);

    // Draw route
    const latlngs = [startPoint, endPoint];
    routeLine = L.polyline(latlngs, {color: '#00ffff', weight: 3, dashArray: '10, 10'}).addTo(map);
    map.fitBounds(routeLine.getBounds(), {padding: [50, 50]});

    // Custom glowing icon
    const icon = L.divIcon({
        className: 'custom-div-icon',
        html: "<div style='background-color:#00ffff;width:15px;height:15px;border-radius:50%;box-shadow:0 0 15px #00ffff, 0 0 30px #00ffff;'></div>",
        iconSize: [15, 15],
        iconAnchor: [7.5, 7.5]
    });

    // If 100% delivered, just put marker at end
    if (progressPercent >= 100) {
        marker = L.marker(endPoint, {icon: icon}).addTo(map);
        return;
    }

    // Calculate current position based on progress
    const latDiff = endPoint[0] - startPoint[0];
    const lngDiff = endPoint[1] - startPoint[1];
    
    const currentLat = startPoint[0] + (latDiff * (progressPercent / 100));
    const currentLng = startPoint[1] + (lngDiff * (progressPercent / 100));
    
    marker = L.marker([startPoint[0], startPoint[1]], {icon: icon}).addTo(map);

    // Animate marker from start to current position
    let step = 0;
    const totalSteps = 60; // Smoothness
    
    function move() {
        step++;
        const targetProgress = (progressPercent / 100) * (step / totalSteps);
        const nextLat = startPoint[0] + (latDiff * targetProgress);
        const nextLng = startPoint[1] + (lngDiff * targetProgress);
        
        marker.setLatLng([nextLat, nextLng]);

        if (step < totalSteps) {
            animationTimeout = setTimeout(move, 50); // Speed
        }
    }
    move();
}

// Voice Tracking Implementation
const voiceBtn = document.getElementById('voiceBtn');
const voiceStatus = document.getElementById('voice-status');
const trackingInput = document.getElementById('trackingNumber');
const trackForm = document.getElementById('ai-track-form');

const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;

if (SpeechRecognition) {
    const recognition = new SpeechRecognition();
    recognition.continuous = false;
    recognition.lang = 'en-US';

    voiceBtn.addEventListener('click', () => {
        voiceBtn.classList.add('recording');
        voiceStatus.innerText = "Listening... say 'Track my parcel'";
        recognition.start();
    });

    recognition.onresult = function(event) {
        const transcript = event.results[0][0].transcript.toLowerCase();
        voiceBtn.classList.remove('recording');
        voiceStatus.innerText = `Heard: "${transcript}"`;
        
        if (transcript.includes('track')) {
            trackingInput.value = 'PP-7742-AI';
            setTimeout(() => {
                trackForm.dispatchEvent(new Event('submit'));
            }, 1000);
        } else {
            voiceStatus.innerText = "Command not recognized. Try again.";
        }
    };

    recognition.onerror = function(event) {
        voiceBtn.classList.remove('recording');
        voiceStatus.innerText = "Error recognizing voice.";
    };
} else {
    voiceBtn.style.display = 'none';
    voiceStatus.innerText = "Voice Tracking not supported.";
}

// Form Submission & AI Animation
trackForm.addEventListener('submit', function(e) {
    e.preventDefault();
    
    document.getElementById('ai-result-panel').style.display = 'none';
    document.getElementById('ai-processing').style.display = 'block';
    
    document.getElementById('routeBar').style.width = '0%';
    document.getElementById('node-transit').classList.remove('active');
    document.getElementById('node-delivered').classList.remove('active');

    setTimeout(() => {
        document.getElementById('ai-processing').style.display = 'none';
        document.getElementById('ai-result-panel').style.display = 'block';
        
        initMap(); // Ensure map is initialized

        const trackId = trackingInput.value;
        document.getElementById('res-id').innerText = trackId;
        
        let statusText = "In Transit";
        let prediction = "Your parcel is currently passing through the Islamabad AI Hub. Expected delivery is tomorrow by 14:00. Weather conditions are optimal.";
        let progressVal = 60; // 60%
        let method = '<i class="fa-solid fa-truck-fast"></i> Autonomous EV';
        
        // Define coordinates: [Start(Karachi), End(Islamabad)]
        let startCoord = [24.8607, 67.0011];
        let endCoord = [33.6844, 73.0479];

        if (trackId.endsWith('8')) {
            statusText = "Delivered";
            prediction = "Parcel was successfully delivered via AI Drone at 09:30 AM.";
            progressVal = 100;
            method = '<i class="fa-solid fa-plane-up"></i> AI Drone';
            document.getElementById('node-transit').classList.add('active');
            document.getElementById('node-delivered').classList.add('active');
            document.getElementById('res-status').className = 'badge bg-success ms-2';
        } else if (trackId.endsWith('9')) {
            statusText = "Delayed";
            prediction = "AI predicts a delay due to storm clouds. Drone grounded. Rerouting via Ground Transport.";
            progressVal = 30;
            method = '<i class="fa-solid fa-ship"></i> Sea Freight';
            document.getElementById('res-status').className = 'badge bg-warning text-dark ms-2';
            startCoord = [24.8607, 67.0011];
            endCoord = [25.3960, 68.3578]; // Hyderabad
        } else {
            document.getElementById('node-transit').classList.add('active');
            document.getElementById('res-status').className = 'badge bg-info ms-2';
        }
        
        document.getElementById('res-status').innerText = statusText;
        document.getElementById('res-method').innerHTML = method;
        document.getElementById('ai-prediction-text').innerText = prediction;
        
        // Animate Bar and Map
        setTimeout(() => {
            document.getElementById('routeBar').style.width = progressVal + '%';
            map.invalidateSize(); // Fix leafet container sizing issue
            animateMarker(startCoord, endCoord, progressVal);
        }, 100);
        
    }, 1500); 
});
</script>

<?php include('../includes/footer.php'); ?>