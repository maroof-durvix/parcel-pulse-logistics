<?php 
include('../includes/header.php'); 
include('../config/db.php'); 

$query_id = isset($_GET['id']) ? trim($_GET['id']) : 'PP-8492-AI';
$parcel = null;
$history = [];
$prediction = null;

if (!empty($query_id)) {
    $clean_id = $conn->real_escape_string($query_id);
    $res = $conn->query("SELECT * FROM parcels WHERE tracking_number = '$clean_id'");
    if ($res && $res->num_rows > 0) {
        $parcel = $res->fetch_assoc();
        $p_id = (int)$parcel['id'];
        
        // Get history
        $h_res = $conn->query("SELECT * FROM tracking_history WHERE parcel_id = $p_id ORDER BY timestamp DESC");
        while ($row = $h_res->fetch_assoc()) {
            $history[] = $row;
        }

        // Get AI prediction
        $pred_res = $conn->query("SELECT * FROM ai_predictions WHERE parcel_id = $p_id LIMIT 1");
        if ($pred_res && $pred_res->num_rows > 0) {
            $prediction = $pred_res->fetch_assoc();
        }
    }
}

// Fallback mock if not in DB so testing any ID works seamlessly
if (!$parcel) {
    $parcel = [
        'tracking_number' => !empty($query_id) ? htmlspecialchars($query_id) : 'PP-8492-AI',
        'sender_name' => 'Dubai Freight Hub #4',
        'receiver_name' => 'Ahmed Durwesh',
        'origin' => 'Dubai International Logistics Hub (DXB)',
        'destination' => 'Lahore Central Fulfillment Node (LHE)',
        'shipping_method' => 'Air',
        'status' => 'In Transit',
        'weight' => '2.50',
        'created_at' => date('Y-m-d H:i:s', strtotime('-1 day'))
    ];
    $prediction = [
        'delay_probability' => 4,
        'weather_impact' => 'Clear Sky - Optimal Jetstream Vector',
        'recommended_route' => 'DXB -> KHI -> LHE Corridor'
    ];
    $history = [
        ['location' => 'LHE Sorting Facility', 'status' => 'Customs Cleared & In Transit', 'timestamp' => date('Y-m-d H:i:s', strtotime('-3 hours'))],
        ['location' => 'DXB Air Cargo Terminal', 'status' => 'Departed from Origin', 'timestamp' => date('Y-m-d H:i:s', strtotime('-18 hours'))],
        ['location' => 'Dubai Logistics Center', 'status' => 'Shipment Manifest Created', 'timestamp' => date('Y-m-d H:i:s', strtotime('-24 hours'))]
    ];
}
?>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<style>
/* Dark Inverted Leaflet Map */
#live-map {
    height: 380px;
    width: 100%;
    border-radius: var(--radius-md);
    border: 1px solid rgba(0, 242, 254, 0.25);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.6);
    z-index: 1;
}
#live-map .leaflet-tile {
    filter: brightness(0.65) invert(1) contrast(2.5) hue-rotate(200deg) saturate(0.25);
}

.voice-btn {
    width: 58px;
    height: 58px;
    background: rgba(0, 242, 254, 0.08);
    border: 1px solid var(--cyan);
    color: var(--cyan);
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 1.4rem;
    cursor: pointer;
    transition: var(--transition);
    box-shadow: 0 0 15px rgba(0, 242, 254, 0.2);
}
.voice-btn:hover, .voice-btn.recording {
    background: var(--cyan);
    color: #000;
    box-shadow: 0 0 30px var(--cyan);
}
.voice-btn.recording {
    animation: micPulse 1.2s infinite;
}
@keyframes micPulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.15); box-shadow: 0 0 35px var(--cyan); }
}

.timeline-step {
    position: relative;
    padding-left: 32px;
    margin-bottom: 24px;
}
.timeline-step::before {
    content: '';
    position: absolute;
    left: 8px;
    top: 24px;
    bottom: -16px;
    width: 2px;
    background: rgba(0, 242, 254, 0.25);
}
.timeline-step:last-child::before {
    display: none;
}
.timeline-dot {
    position: absolute;
    left: 0;
    top: 4px;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    background: #0f172a;
    border: 2px solid var(--cyan);
    box-shadow: 0 0 10px var(--cyan);
}
.timeline-step.completed .timeline-dot {
    background: var(--cyan);
}
</style>

<!-- TRACKING PAGE HERO -->
<section class="page-hero hero-tracking">
    <div class="container text-center">
        <span class="badge-cyan mb-2 d-inline-block"><i class="fa-solid fa-satellite text-info me-1"></i> Multi-Constellation GPS Telemetry</span>
        <h1 class="hero-title-gradient">AI Waybill Radar</h1>
        <p class="text-secondary max-w-lg mx-auto" style="max-width: 600px;">
            Real-time orbital tracking, meteorological delay predictions, and live coordinate mapping.
        </p>

        <!-- Search Bar -->
        <div class="row justify-content-center mt-4">
            <div class="col-lg-7 col-md-9">
                <div class="glass-box text-center p-4">
                    <p class="text-secondary small mb-3">
                        Tap the mic and speak <strong class="text-info">"Track my parcel"</strong> or enter your Waybill number:
                    </p>

                    <div class="mb-3">
                        <div class="voice-btn" id="voiceBtn" title="Voice Recognition">
                            <i class="fa-solid fa-microphone"></i>
                        </div>
                        <p id="voice-status" class="text-muted small mt-2 mb-0" style="min-height: 20px;"></p>
                    </div>

                    <form action="tracking.php" method="GET" id="trackingForm">
                        <div class="row g-2">
                            <div class="col-md-8">
                                <input type="text" name="id" id="trackingInput" class="form-control pulse-input auto-waybill text-center fw-bold" placeholder="e.g. PP-8492-AI" value="<?php echo htmlspecialchars($parcel['tracking_number']); ?>" required style="letter-spacing: 2px; font-size: 1.15rem;">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="glow-btn py-3">
                                    <i class="fa-solid fa-crosshairs me-1"></i> Scan Radar
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="d-flex justify-content-center gap-2 mt-3 small">
                        <span class="text-secondary">Quick Lookups:</span>
                        <a href="tracking.php?id=PP-8492-AI" class="text-info text-decoration-none">PP-8492-AI</a> &bull;
                        <a href="tracking.php?id=PP-7742-AI" class="text-info text-decoration-none">PP-7742-AI</a> &bull;
                        <a href="tracking.php?id=PP-3391-RD" class="text-info text-decoration-none">PP-3391-RD</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- TRACKING DETAILS & MAP -->
<section class="py-5" style="background: var(--bg-main);">
    <div class="container">
        <div class="row g-4">
            <!-- Left Telemetry & Status Cards -->
            <div class="col-lg-5">
                <div class="pulse-card mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <span class="text-secondary small text-uppercase">Tracking Manifest</span>
                            <h4 class="fw-bold text-white mb-0" style="letter-spacing: 1px; color: var(--cyan) !important;">
                                <?php echo htmlspecialchars($parcel['tracking_number']); ?>
                            </h4>
                        </div>
                        <span class="badge bg-success px-3 py-2 rounded-pill font-monospace" style="font-size: 0.85rem;">
                            <i class="fa-solid fa-circle-dot fa-fade me-1"></i> <?php echo htmlspecialchars($parcel['status']); ?>
                        </span>
                    </div>

                    <hr class="border-secondary opacity-25 my-3">

                    <div class="row g-3 small">
                        <div class="col-6">
                            <span class="text-secondary">Carrier Mode:</span>
                            <div class="fw-semibold text-white mt-1">
                                <i class="fa-solid fa-plane text-info me-1"></i> <?php echo htmlspecialchars($parcel['shipping_method']); ?> Freight
                            </div>
                        </div>
                        <div class="col-6">
                            <span class="text-secondary">Gross Weight:</span>
                            <div class="fw-semibold text-white mt-1">
                                <i class="fa-solid fa-weight-hanging text-info me-1"></i> <?php echo htmlspecialchars($parcel['weight']); ?> kg
                            </div>
                        </div>
                        <div class="col-12">
                            <span class="text-secondary">Origin Hub:</span>
                            <div class="fw-semibold text-white mt-1">
                                <i class="fa-solid fa-location-arrow text-info me-1"></i> <?php echo htmlspecialchars($parcel['origin']); ?>
                            </div>
                        </div>
                        <div class="col-12">
                            <span class="text-secondary">Destination Hub:</span>
                            <div class="fw-semibold text-white mt-1">
                                <i class="fa-solid fa-location-dot text-danger me-1"></i> <?php echo htmlspecialchars($parcel['destination']); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- AI Neural Prediction Box -->
                <div class="pulse-card">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <i class="fa-solid fa-brain text-info fs-5"></i>
                        <h6 class="text-white fw-bold mb-0">AI Delay & Route Prediction</h6>
                    </div>

                    <div class="p-3 rounded-3 mb-3" style="background: rgba(0, 242, 254, 0.05); border: 1px solid rgba(0, 242, 254, 0.2);">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="small text-secondary">Delay Probability:</span>
                            <span class="badge bg-success"><?php echo $prediction ? $prediction['delay_probability'] : 4; ?>% (Ultra Low Risk)</span>
                        </div>
                        <div class="progress" style="height: 6px; background: rgba(255,255,255,0.1);">
                            <div class="progress-bar bg-info" style="width: <?php echo $prediction ? $prediction['delay_probability'] : 4; ?>%;"></div>
                        </div>
                    </div>

                    <p class="small text-secondary mb-2">
                        <i class="fa-solid fa-cloud-sun text-warning me-1"></i> <strong>Atmospheric Conditions:</strong> <?php echo $prediction ? htmlspecialchars($prediction['weather_impact']) : 'Clear Skies'; ?>
                    </p>
                    <p class="small text-secondary mb-0">
                        <i class="fa-solid fa-route text-success me-1"></i> <strong>AI Recommended Corridor:</strong> <?php echo $prediction ? htmlspecialchars($prediction['recommended_route']) : 'Optimal Direct Flight Corridor'; ?>
                    </p>
                </div>
            </div>

            <!-- Right: Interactive Leaflet Map & Timeline -->
            <div class="col-lg-7">
                <div class="pulse-card mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fa-solid fa-earth-asia text-info"></i>
                            <h5 class="text-white fw-bold mb-0">Orbital GPS Map Simulation</h5>
                        </div>
                        <span class="small text-secondary font-monospace"><i class="fa-solid fa-circle text-success me-1" style="font-size:0.6rem;"></i> Live Signal</span>
                    </div>

                    <!-- Live Dark Map Container -->
                    <div id="live-map"></div>
                </div>

                <!-- Live Waybill Timeline -->
                <div class="pulse-card">
                    <h5 class="text-white fw-bold mb-4">
                        <i class="fa-solid fa-clock-rotate-left text-info me-2"></i> Real-Time Waybill History
                    </h5>

                    <div class="timeline">
                        <?php foreach ($history as $index => $item): ?>
                            <div class="timeline-step <?php echo $index === 0 ? 'completed' : ''; ?>">
                                <div class="timeline-dot"></div>
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <h6 class="text-white fw-semibold mb-1"><?php echo htmlspecialchars($item['status']); ?></h6>
                                    <span class="text-secondary small font-monospace"><?php echo date('M d, H:i', strtotime($item['timestamp'])); ?></span>
                                </div>
                                <p class="text-secondary small mb-0"><i class="fa-solid fa-map-pin text-info me-1"></i> <?php echo htmlspecialchars($item['location']); ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
// Initialize Leaflet Map with Dark styling
document.addEventListener('DOMContentLoaded', function() {
    const map = L.map('live-map').setView([25.2048, 55.2708], 5);

    // Free OpenStreetMap tiles with custom CSS dark invert (NO WATERMARK, NO API KEY)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Coordinates: Dubai (Origin) to Lahore (Destination)
    const origin = [25.2048, 55.2708]; // Dubai
    const transit = [24.8607, 67.0011]; // Karachi
    const destination = [31.5204, 74.3587]; // Lahore

    // Route polyline
    const routeCoords = [origin, transit, destination];
    const polyline = L.polyline(routeCoords, {
        color: '#00f2fe',
        weight: 3,
        opacity: 0.8,
        dashArray: '6, 8'
    }).addTo(map);

    // Pulse Origin & Dest markers
    const originMarker = L.circleMarker(origin, {
        radius: 7,
        fillColor: '#00f2fe',
        color: '#fff',
        weight: 2,
        opacity: 1,
        fillOpacity: 0.8
    }).addTo(map).bindPopup("<b>Origin:</b> Dubai Logistics Center");

    const destMarker = L.circleMarker(destination, {
        radius: 7,
        fillColor: '#ef4444',
        color: '#fff',
        weight: 2,
        opacity: 1,
        fillOpacity: 0.8
    }).addTo(map).bindPopup("<b>Destination:</b> Lahore Central Node");

    // Live In-Transit Marker
    const transitMarker = L.circleMarker(transit, {
        radius: 9,
        fillColor: '#10b981',
        color: '#ffffff',
        weight: 3,
        opacity: 1,
        fillOpacity: 0.9
    }).addTo(map).bindPopup("<b>Live Position:</b> In Transit (Cleared Customs)");

    map.fitBounds(polyline.getBounds(), { padding: [40, 40] });

    // Voice recognition for Track my parcel
    const voiceBtn = document.getElementById('voiceBtn');
    const voiceStatus = document.getElementById('voice-status');
    const trackingInput = document.getElementById('trackingInput');
    const trackingForm = document.getElementById('trackingForm');

    const SpeechRec = window.SpeechRecognition || window.webkitSpeechRecognition;
    if (SpeechRec && voiceBtn) {
        const recognition = new SpeechRec();
        recognition.continuous = false;
        recognition.lang = 'en-US';

        voiceBtn.addEventListener('click', () => {
            voiceBtn.classList.add('recording');
            voiceStatus.innerText = "Listening... say 'Track my parcel'";
            recognition.start();
        });

        recognition.onresult = (event) => {
            voiceBtn.classList.remove('recording');
            const transcript = event.results[0][0].transcript.toLowerCase();
            voiceStatus.innerText = `Heard: "${transcript}"`;
            
            if (transcript.includes('track') || transcript.includes('parcel')) {
                trackingInput.value = 'PP-8492-AI';
                setTimeout(() => trackingForm.submit(), 600);
            }
        };

        recognition.onerror = () => {
            voiceBtn.classList.remove('recording');
            voiceStatus.innerText = "Voice not captured. Please type manually.";
        };
    } else if (voiceBtn) {
        voiceBtn.style.display = 'none';
    }
});
</script>

<?php include('../includes/footer.php'); ?>
