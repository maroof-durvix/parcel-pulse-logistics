<?php include('../includes/header.php'); ?>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<style>
#crowd-map {
    height: 380px;
    width: 100%;
    border-radius: var(--radius-md);
    border: 1px solid rgba(0, 242, 254, 0.25);
}
#crowd-map .leaflet-tile {
    filter: brightness(0.65) invert(1) contrast(2.5) hue-rotate(200deg) saturate(0.25);
}

.driver-card {
    background: rgba(6, 11, 20, 0.85);
    border: 1px solid rgba(0, 242, 254, 0.2);
    border-radius: var(--radius-md);
    padding: 16px;
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 15px;
    transition: var(--transition);
}
.driver-card:hover {
    border-color: var(--cyan);
    box-shadow: 0 0 15px rgba(0, 242, 254, 0.2);
}
.driver-avatar {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: rgba(0, 242, 254, 0.15);
    border: 1px solid var(--cyan);
    color: var(--cyan);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.3rem;
}
</style>

<!-- HERO -->
<section class="page-hero hero-crowd">
    <div class="container text-center">
        <span class="badge bg-warning text-dark mb-2 d-inline-block fw-bold"><i class="fa-solid fa-people-arrows me-1"></i> Peer-to-Peer Commute Network</span>
        <h1 class="hero-title-gradient">AI Crowd-Shipping</h1>
        <p class="text-secondary max-w-lg mx-auto" style="max-width: 650px;">
            Match packages with everyday commuters heading in the same direction. Cut parcel delivery costs by up to 40% or monetize your routine daily travel.
        </p>
    </div>
</section>

<!-- CROWD PORTAL -->
<section class="py-5" style="background: var(--bg-main);">
    <div class="container">
        <div class="row g-4 mb-5">
            <!-- Send Parcel -->
            <div class="col-lg-6">
                <div class="pulse-card h-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fa-solid fa-box-open text-info fs-5"></i>
                            <h4 class="fw-bold text-white mb-0">Dispatch via Commuter</h4>
                        </div>
                        <span class="badge-cyan small">Save ~40%</span>
                    </div>
                    <p class="text-secondary small mb-4">Input your pickup and drop-off points to find trusted drivers travelling right now.</p>

                    <form onsubmit="findDrivers(event)">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-secondary small">Origin Location</label>
                                <input type="text" id="crowdOrigin" class="form-control pulse-input" placeholder="e.g. DHA Phase 6" value="DHA Phase 6" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-secondary small">Destination Location</label>
                                <input type="text" id="crowdDest" class="form-control pulse-input" placeholder="e.g. Saddar / I.I Chundrigar" value="I.I Chundrigar Road" required>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="glow-btn" id="findBtn">
                                    <i class="fa-solid fa-satellite-dish me-1"></i> Scan Nearby Verified Commuters
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Results List -->
                    <div id="driver-results" class="mt-4" style="display: none;">
                        <h6 class="text-success fw-bold mb-3"><i class="fa-solid fa-circle-check me-1"></i> AI Discovered 2 Matched Commuters:</h6>

                        <div class="driver-card">
                            <div class="driver-avatar"><i class="fa-solid fa-car"></i></div>
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center gap-2">
                                    <h6 class="text-white mb-0 fw-bold">Ali Raza</h6>
                                    <span class="badge bg-success" style="font-size: 0.65rem;">ID Verified</span>
                                </div>
                                <small class="text-secondary">Departs in 35 mins &bull; Sedan (Trunk Space Avail.)</small>
                            </div>
                            <div class="text-end">
                                <h5 class="text-info fw-bold mb-0">Rs. 450</h5>
                                <button class="btn btn-sm btn-outline-info rounded-pill mt-1" onclick="alert('Booking request dispatched to Ali Raza via Escrow!')">Request Drop</button>
                            </div>
                        </div>

                        <div class="driver-card">
                            <div class="driver-avatar"><i class="fa-solid fa-motorcycle"></i></div>
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center gap-2">
                                    <h6 class="text-white mb-0 fw-bold">Zain Baig</h6>
                                    <span class="badge bg-success" style="font-size: 0.65rem;">ID Verified</span>
                                </div>
                                <small class="text-secondary">Departs in 1.5 hrs &bull; Express Courier Bike</small>
                            </div>
                            <div class="text-end">
                                <h5 class="text-info fw-bold mb-0">Rs. 250</h5>
                                <button class="btn btn-sm btn-outline-info rounded-pill mt-1" onclick="alert('Booking request dispatched to Zain Baig via Escrow!')">Request Drop</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Become a Commute Driver -->
            <div class="col-lg-6">
                <div class="pulse-card h-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fa-solid fa-steering-wheel text-warning fs-5"></i>
                            <h4 class="fw-bold text-white mb-0">Earn on Your Commute</h4>
                        </div>
                        <span class="badge bg-warning text-dark fw-bold small">Passive Income</span>
                    </div>
                    <p class="text-secondary small mb-4">Commuting to work or inter-city? Take verified packages along your journey and offset fuel costs.</p>

                    <div class="p-3 mb-4 rounded-3" style="background: rgba(16, 185, 129, 0.1); border: 1px dashed #10b981;">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="text-secondary small">Average Commuter Earnings:</span>
                                <h4 class="fw-bold text-success mb-0">Rs. 12,000 <small class="text-secondary" style="font-size: 0.8rem;">/mo</small></h4>
                            </div>
                            <i class="fa-solid fa-coins text-success fs-2 opacity-50"></i>
                        </div>
                    </div>

                    <form onsubmit="registerRoute(event)">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-secondary small">Transport Mode</label>
                                <select class="form-select pulse-select" required>
                                    <option value="car">Car / Sedan</option>
                                    <option value="bike">Motorcycle / Scooter</option>
                                    <option value="van">Van / SUV</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-secondary small">Daily Regular Route</label>
                                <input type="text" class="form-control pulse-input" placeholder="e.g. Clifton to Gulshan" required>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn-pulse-primary w-100" id="regBtn">
                                    <i class="fa-solid fa-shield-check me-1"></i> Register as Verified Carrier
                                </button>
                            </div>
                        </div>
                    </form>

                    <div id="reg-success" class="mt-3 p-3 rounded-3 text-center d-none text-success" style="background: rgba(16, 185, 129, 0.1); border: 1px solid #10b981;">
                        <i class="fa-solid fa-circle-check me-1"></i> Commute profile registered! Our AI will alert you when a parcel matches your travel corridor.
                    </div>
                </div>
            </div>
        </div>

        <!-- Live Network Map -->
        <div class="row">
            <div class="col-12">
                <div class="pulse-card">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fa-solid fa-users text-info"></i>
                            <h5 class="fw-bold text-white mb-0">Active Urban Commuter Mesh</h5>
                        </div>
                        <span class="badge-cyan small"><i class="fa-solid fa-signal me-1"></i> 84 Active Drivers in Karachi Region</span>
                    </div>
                    <div id="crowd-map"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
function findDrivers(e) {
    e.preventDefault();
    const btn = document.getElementById('findBtn');
    btn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin me-1"></i> Querying Route Waypoints...';

    setTimeout(() => {
        btn.innerHTML = '<i class="fa-solid fa-satellite-dish me-1"></i> Scan Nearby Verified Commuters';
        document.getElementById('driver-results').style.display = 'block';
    }, 700);
}

function registerRoute(e) {
    e.preventDefault();
    const btn = document.getElementById('regBtn');
    btn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin me-1"></i> Submitting Profile...';

    setTimeout(() => {
        btn.innerHTML = '<i class="fa-solid fa-check me-1"></i> Profile Registered';
        document.getElementById('reg-success').classList.remove('d-none');
    }, 800);
}

// Leaflet Map Initialization with clean Dark Tiles (NO WATERMARK)
const map = L.map('crowd-map').setView([24.8607, 67.0011], 12);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 18,
    attribution: '&copy; OpenStreetMap contributors'
}).addTo(map);

const driverLocations = [
    { coords: [24.85, 67.02], name: "Ali R. (Car)", price: "Rs. 450" },
    { coords: [24.88, 67.05], name: "Zain B. (Bike)", price: "Rs. 250" },
    { coords: [24.82, 67.08], name: "Hamza K. (Sedan)", price: "Rs. 400" },
    { coords: [24.89, 66.99], name: "Tariq M. (Van)", price: "Rs. 600" }
];

driverLocations.forEach(d => {
    L.circleMarker(d.coords, {
        radius: 8,
        fillColor: '#00f2fe',
        color: '#fff',
        weight: 2,
        opacity: 1,
        fillOpacity: 0.9
    }).addTo(map).bindPopup(`<b>${d.name}</b><br>Rate: ${d.price}`);
});
</script>

<?php include('../includes/footer.php'); ?>
