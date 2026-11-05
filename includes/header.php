<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$current_page = basename($_SERVER['PHP_SELF']);
$is_root_page = in_array($current_page, ['index.php', 'login.php', 'register.php']);
$base_url = $is_root_page ? '' : '../';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parcel Pulse - Autonomous & AI-Powered Logistics</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome 6.5.2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- Custom Modern Stylesheet -->
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/style.css?v=<?php echo filemtime(__DIR__ . '/../assets/css/style.css'); ?>">
</head>
<body>

<!-- TOP NAVIGATION -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top custom-navbar">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="<?php echo $base_url; ?>index.php">
            <span class="pulse-dot"></span>
            <span class="fw-bold tracking-tight">PARCEL<span style="color: var(--cyan);">PULSE</span></span>
        </a>

        <!-- Mobile Toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#pulseNav" aria-controls="pulseNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Nav Links -->
        <div class="collapse navbar-collapse" id="pulseNav">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0 align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>" href="<?php echo $base_url; ?>index.php">
                        <i class="fa-solid fa-house"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($current_page == 'tracking.php') ? 'active' : ''; ?>" href="<?php echo $base_url; ?>pages/tracking.php">
                        <i class="fa-solid fa-satellite text-info"></i> Tracking
                    </a>
                </li>

                <!-- Services Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?php echo in_array($current_page, ['services.php', 'drone.php', 'lockers.php', 'crowd_shipping.php']) ? 'active' : ''; ?>" href="#" id="servicesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-boxes-stacked"></i> Services
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="servicesDropdown">
                        <li><a class="dropdown-item" href="<?php echo $base_url; ?>pages/services.php"><i class="fa-solid fa-cubes me-2 text-info"></i> All Services Overview</a></li>
                        <li><hr class="dropdown-divider border-secondary opacity-25"></li>
                        <li><a class="dropdown-item" href="<?php echo $base_url; ?>pages/drone.php"><i class="fa-solid fa-plane-up me-2 text-primary"></i> Autonomous Drone Delivery <span class="badge bg-info text-dark ms-1">AI</span></a></li>
                        <li><a class="dropdown-item" href="<?php echo $base_url; ?>pages/lockers.php"><i class="fa-solid fa-vault me-2 text-success"></i> 24/7 Smart Lockers</a></li>
                        <li><a class="dropdown-item" href="<?php echo $base_url; ?>pages/crowd_shipping.php"><i class="fa-solid fa-people-arrows me-2 text-warning"></i> Crowd-Shipping Network <span class="badge bg-success ms-1">New</span></a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php echo in_array($current_page, ['quotes.php', 'quote.php']) ? 'active' : ''; ?>" href="<?php echo $base_url; ?>pages/quotes.php">
                        <i class="fa-solid fa-calculator"></i> Instant Quote
                    </a>
                </li>

                <!-- Company Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?php echo in_array($current_page, ['about.php', 'contact.php', 'intercome.php', 'complaint.php']) ? 'active' : ''; ?>" href="#" id="companyDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-building"></i> Company
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="companyDropdown">
                        <li><a class="dropdown-item" href="<?php echo $base_url; ?>pages/about.php"><i class="fa-solid fa-circle-info me-2 text-info"></i> About Us & Infrastructure</a></li>
                        <li><a class="dropdown-item" href="<?php echo $base_url; ?>pages/contact.php"><i class="fa-solid fa-headset me-2 text-warning"></i> Contact & Hub Network</a></li>
                        <li><a class="dropdown-item" href="<?php echo $base_url; ?>pages/intercome.php"><i class="fa-solid fa-graduation-cap me-2 text-success"></i> Incoterms & Global Trade</a></li>
                        <li><hr class="dropdown-divider border-secondary opacity-25"></li>
                        <li><a class="dropdown-item" href="<?php echo $base_url; ?>pages/complaint.php"><i class="fa-solid fa-shield-halved me-2 text-danger"></i> Customer Support & Tickets</a></li>
                    </ul>
                </li>
            </ul>

            <!-- Right Actions (Auth / User) -->
            <div class="d-flex align-items-center gap-2 mt-3 mt-lg-0">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <div class="dropdown">
                        <button class="btn btn-pulse-outline dropdown-toggle py-2 px-3" type="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-user-astronaut text-info me-1"></i>
                            <span><?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="userMenu">
                            <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                                <li>
                                    <a class="dropdown-item text-info fw-bold" href="<?php echo $base_url; ?>admin/dashboard.php">
                                        <i class="fa-solid fa-chart-line me-2"></i> Admin AI Console
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider border-secondary opacity-25"></li>
                            <?php endif; ?>
                            <li><a class="dropdown-item" href="<?php echo $base_url; ?>pages/complaint.php"><i class="fa-solid fa-ticket me-2"></i> My Support Tickets</a></li>
                            <li><a class="dropdown-item" href="<?php echo $base_url; ?>pages/tracking.php"><i class="fa-solid fa-satellite me-2"></i> Track Parcels</a></li>
                            <li><hr class="dropdown-divider border-secondary opacity-25"></li>
                            <li><a class="dropdown-item text-danger" href="<?php echo $base_url; ?>logout.php"><i class="fa-solid fa-power-off me-2"></i> End Session (Logout)</a></li>
                        </ul>
                    </div>
                <?php else: ?>
                    <a href="<?php echo $base_url; ?>login.php" class="btn btn-pulse-primary">
                        <i class="fa-solid fa-fingerprint me-1"></i> Client Portal
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>
