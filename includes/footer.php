<?php
$current_page = basename($_SERVER['PHP_SELF']);
$is_root_page = in_array($current_page, ['index.php', 'login.php', 'register.php']);
$base_url = $is_root_page ? '' : '../';
?>

<!-- MAIN PLATFORM FOOTER -->
<footer class="main-footer">
    <div class="container">
        <div class="row g-4 mb-5">
            <!-- Brand & Mission -->
            <div class="col-lg-4 col-md-6">
                <div class="footer-brand d-flex align-items-center gap-2">
                    <span class="pulse-dot"></span>
                    <span>PARCEL<span style="color: var(--cyan);">PULSE</span></span>
                </div>
                <p class="text-secondary small mb-3 pe-lg-4" style="line-height: 1.8;">
                    Next-generation autonomous logistics ecosystem. Combining predictive AI neural routing, robotic drone delivery, and smart IoT vault lockers for frictionless global commerce.
                </p>
                <div class="d-inline-flex align-items-center gap-2 py-1 px-3 rounded-pill" style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); font-size: 0.8rem; color: #10b981;">
                    <span style="width: 8px; height: 8px; background: #10b981; border-radius: 50%; box-shadow: 0 0 8px #10b981;"></span>
                    <span>Global Network Active • Telemetry Latency 12ms</span>
                </div>
            </div>

            <!-- Solutions Column -->
            <div class="col-lg-2 col-md-6 col-6">
                <h6 class="footer-heading">Capabilities</h6>
                <ul class="footer-links">
                    <li><a href="<?php echo $base_url; ?>pages/drone.php"><i class="fa-solid fa-angle-right text-info" style="font-size: 0.7rem;"></i> Drone Dispatch</a></li>
                    <li><a href="<?php echo $base_url; ?>pages/lockers.php"><i class="fa-solid fa-angle-right text-info" style="font-size: 0.7rem;"></i> Smart Lockers</a></li>
                    <li><a href="<?php echo $base_url; ?>pages/crowd_shipping.php"><i class="fa-solid fa-angle-right text-info" style="font-size: 0.7rem;"></i> Crowd Delivery</a></li>
                    <li><a href="<?php echo $base_url; ?>pages/services.php"><i class="fa-solid fa-angle-right text-info" style="font-size: 0.7rem;"></i> Eco Fleet & EV</a></li>
                    <li><a href="<?php echo $base_url; ?>pages/services.php"><i class="fa-solid fa-angle-right text-info" style="font-size: 0.7rem;"></i> Global Air Cargo</a></li>
                </ul>
            </div>

            <!-- Quick Access Column -->
            <div class="col-lg-3 col-md-6 col-6">
                <h6 class="footer-heading">Ecosystem</h6>
                <ul class="footer-links">
                    <li><a href="<?php echo $base_url; ?>pages/tracking.php"><i class="fa-solid fa-angle-right text-info" style="font-size: 0.7rem;"></i> Live Waybill Radar</a></li>
                    <li><a href="<?php echo $base_url; ?>pages/quotes.php"><i class="fa-solid fa-angle-right text-info" style="font-size: 0.7rem;"></i> Instant Cost Estimator</a></li>
                    <li><a href="<?php echo $base_url; ?>pages/intercome.php"><i class="fa-solid fa-angle-right text-info" style="font-size: 0.7rem;"></i> Incoterms Trade Hub</a></li>
                    <li><a href="<?php echo $base_url; ?>pages/complaint.php"><i class="fa-solid fa-angle-right text-info" style="font-size: 0.7rem;"></i> Support & Tickets</a></li>
                    <li><a href="<?php echo $base_url; ?>pages/about.php"><i class="fa-solid fa-angle-right text-info" style="font-size: 0.7rem;"></i> Company & Facilities</a></li>
                </ul>
            </div>

            <!-- Global Operations -->
            <div class="col-lg-3 col-md-6">
                <h6 class="footer-heading">Operations</h6>
                <p class="small text-secondary mb-2">
                    <i class="fa-solid fa-location-dot text-info me-2"></i> DHA Logistics Node, Phase 6, Karachi, PK
                </p>
                <p class="small text-secondary mb-2">
                    <i class="fa-solid fa-envelope text-info me-2"></i> ops@parcelpulse.io
                </p>
                <p class="small text-secondary mb-3">
                    <i class="fa-solid fa-phone text-info me-2"></i> +92 21 111-PULSE (78573)
                </p>
                <div class="mt-3">
                    <a href="#" class="social-icon-btn" title="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                    <a href="#" class="social-icon-btn" title="Twitter/X"><i class="fa-brands fa-x-twitter"></i></a>
                    <a href="#" class="social-icon-btn" title="GitHub"><i class="fa-brands fa-github"></i></a>
                </div>
            </div>
        </div>

        <hr style="border-color: rgba(255, 255, 255, 0.08); margin-bottom: 25px;">

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
            <p class="mb-0 small text-secondary">
                &copy; <?php echo date('Y'); ?> Parcel Pulse Logistics Technologies. All rights reserved.
            </p>
            <div class="d-flex gap-3 small text-secondary">
                <a href="#" class="text-secondary text-decoration-none hover-cyan">Terms of Service</a>
                <span>&bull;</span>
                <a href="#" class="text-secondary text-decoration-none hover-cyan">Privacy Protocol</a>
                <span>&bull;</span>
                <a href="#" class="text-secondary text-decoration-none hover-cyan">API Telemetry</a>
            </div>
        </div>
    </div>
</footer>

<!-- FLOATING AI ASSISTANT CHATBOT -->
<div class="floating-ai-btn" id="openChatBtn" title="Launch Pulse AI Core">
    <i class="fa-solid fa-brain"></i>
</div>

<div class="ai-chat-window" id="aiChatWindow">
    <div class="chat-header">
        <div class="d-flex align-items-center gap-2">
            <i class="fa-solid fa-satellite-dish text-info"></i>
            <span>Pulse Neural Assistant</span>
            <span class="badge bg-success ms-1" style="font-size: 0.65rem;">Active</span>
        </div>
        <button type="button" class="btn-close btn-close-white" id="closeChatBtn" aria-label="Close" style="font-size: 0.8rem;"></button>
    </div>

    <div class="chat-body" id="chatBody">
        <div class="chat-message bot">
            Greetings! I am the Pulse Neural Core. I can verify waybills, predict fuel & freight estimates, or coordinate smart lockers. How can I assist you?
        </div>
        <div class="chat-chips mt-2">
            <span class="chip" onclick="sendChipMessage('Track my parcel')"><i class="fa-solid fa-radar me-1"></i> Track Parcel</span>
            <span class="chip" onclick="sendChipMessage('Get a quote')"><i class="fa-solid fa-calculator me-1"></i> Instant Rate</span>
            <span class="chip" onclick="sendChipMessage('Tell me about Drone Delivery')"><i class="fa-solid fa-plane-up me-1"></i> Drone Fleet</span>
        </div>
    </div>

    <div class="chat-footer">
        <div class="input-group">
            <button class="btn text-info border-0 px-2" id="chatVoiceBtn" title="Voice Input">
                <i class="fa-solid fa-microphone"></i>
            </button>
            <input type="text" id="chatInput" class="form-control shadow-none bg-transparent text-light border-0" placeholder="Ask AI anything...">
            <button class="btn text-info border-0 px-2" id="sendChatBtn" title="Send Query">
                <i class="fa-solid fa-paper-plane"></i>
            </button>
        </div>
    </div>
</div>

<!-- SCRIPTS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo $base_url; ?>assets/js/script.js"></script>
</body>
</html>
