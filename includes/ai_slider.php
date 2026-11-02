<?php 
$asset_path = (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'assets/' : '../assets/'; 
?>
<!-- AI FEATURES SLIDER (Common for all pages) -->
<section class="ai-slider-section">
    <div id="aiFeaturesCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="4000">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#aiFeaturesCarousel" data-bs-slide-to="0" class="active" aria-current="true"></button>
            <button type="button" data-bs-target="#aiFeaturesCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#aiFeaturesCarousel" data-bs-slide-to="2"></button>
        </div>
        
        <div class="carousel-inner">
            <!-- Slide 1 -->
            <div class="carousel-item active">
                <div class="slider-image-wrapper">
                    <img src="<?php echo $asset_path; ?>images/ai_slider_1.png" class="d-block w-100" alt="Global Network">
                    <div class="slider-overlay"></div>
                </div>
                <div class="carousel-caption d-none d-md-block ai-caption">
                    <h3 class="fw-bold" style="color: #00bfff;">AI Predictive Analytics</h3>
                    <p class="fs-5">Anticipate delivery times with our advanced machine learning models and dynamic rerouting algorithms, ensuring your package arrives safely and efficiently.</p>
                </div>
            </div>
            
            <!-- Slide 2 -->
            <div class="carousel-item">
                <div class="slider-image-wrapper">
                    <img src="<?php echo $asset_path; ?>images/ai_slider_2.png" class="d-block w-100" alt="Drone Delivery">
                    <div class="slider-overlay"></div>
                </div>
                <div class="carousel-caption d-none d-md-block ai-caption">
                    <h3 class="fw-bold" style="color: #00bfff;">Autonomous Fleet Network</h3>
                    <p class="fs-5">Experience the future of logistics with our smart drone and autonomous truck fleet operating 24/7 across cities with zero downtime.</p>
                </div>
            </div>
            
            <!-- Slide 3 -->
            <div class="carousel-item">
                <div class="slider-image-wrapper">
                    <img src="<?php echo $asset_path; ?>images/ai_slider_3.png" class="d-block w-100" alt="Robotics Warehouse">
                    <div class="slider-overlay"></div>
                </div>
                <div class="carousel-caption d-none d-md-block ai-caption">
                    <h3 class="fw-bold" style="color: #00bfff;">Smart Warehouse Robotics</h3>
                    <p class="fs-5">Our AI-driven warehouse systems automatically sort, pack, and process parcels with pinpoint accuracy and unprecedented speed.</p>
                </div>
            </div>
        </div>
        
        <button class="carousel-control-prev" type="button" data-bs-target="#aiFeaturesCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#aiFeaturesCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>
