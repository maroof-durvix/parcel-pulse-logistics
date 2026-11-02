<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$is_root_page = in_array(basename($_SERVER['PHP_SELF']), ['index.php', 'login.php', 'register.php']);
?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Parcel Pulse Logistics</title>

<!-- GOOGLE FONT -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<!-- BOOTSTRAP -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- FONT AWESOME -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<!-- CSS -->
<link rel="stylesheet"
href="<?php echo $is_root_page ? 'assets/css/style.css' : '../assets/css/style.css'; ?>">

</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top custom-navbar">

<div class="container">

<a class="navbar-brand fw-bold"
href="<?php echo $is_root_page ? 'index.php' : '../index.php'; ?>">

Parcel Pulse

</a>

<button class="navbar-toggler"
type="button"
data-bs-toggle="collapse"
data-bs-target="#nav">

<span class="navbar-toggler-icon"></span>

</button>

<div class="collapse navbar-collapse" id="nav">

<ul class="navbar-nav ms-auto">

<li class="nav-item">
<a class="nav-link"
href="<?php echo $is_root_page ? 'index.php' : '../index.php'; ?>">

Home

</a>
</li>

<li class="nav-item">
<a class="nav-link" href="<?php echo $is_root_page ? 'pages/services.php' : 'services.php'; ?>">

Services

</a>
</li>

<li class="nav-item">
<a class="nav-link" href="<?php echo $is_root_page ? 'pages/tracking.php' : 'tracking.php'; ?>">

Tracking

</a>
</li>

<li class="nav-item">
<a class="nav-link" href="<?php echo $is_root_page ? 'pages/drone.php' : 'drone.php'; ?>">

Drone <span class="badge bg-info text-dark" style="font-size: 0.6em; vertical-align: top;">AI</span>

</a>
</li>

<li class="nav-item">
<a class="nav-link" href="<?php echo $is_root_page ? 'pages/lockers.php' : 'lockers.php'; ?>">

Lockers

</a>
</li>

<li class="nav-item">
<a class="nav-link" href="<?php echo $is_root_page ? 'pages/crowd_shipping.php' : 'crowd_shipping.php'; ?>">

Crowd <span class="badge bg-success" style="font-size: 0.6em; vertical-align: top;">New</span>

</a>
</li>

<li class="nav-item">
<a class="nav-link" href="<?php echo $is_root_page ? 'pages/about.php' : 'about.php'; ?>">

About Us

</a>
</li>

<li class="nav-item">
<a class="nav-link" href="<?php echo $is_root_page ? 'pages/intercome.php' : 'intercome.php'; ?>">

Intercome

</a>
</li>

<li class="nav-item">
<a class="nav-link" href="<?php echo $is_root_page ? 'pages/quotes.php' : 'quotes.php'; ?>">

Quotes

</a>
</li>

<li class="nav-item">
<a class="nav-link" href="<?php echo $is_root_page ? 'pages/contact.php' : 'contact.php'; ?>">

Contact

</a>
</li>

<?php if(isset($_SESSION['user_id'])): ?>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-user-circle text-info"></i> <?php echo htmlspecialchars($_SESSION['user_name']); ?>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
            <?php if($_SESSION['user_role'] === 'admin'): ?>
                <li><a class="dropdown-item" href="<?php echo $is_root_page ? 'admin/dashboard.php' : '../admin/dashboard.php'; ?>">AI Dashboard</a></li>
            <?php endif; ?>
            <li><a class="dropdown-item" href="#">Profile Settings</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item text-danger" href="<?php echo $is_root_page ? 'logout.php' : '../logout.php'; ?>">Logout Session</a></li>
        </ul>
    </li>
<?php else: ?>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo $is_root_page ? 'login.php' : '../login.php'; ?>">
            <i class="fa-solid fa-right-to-bracket text-info"></i> Login
        </a>
    </li>
<?php endif; ?>

</ul>

</div>

</div>

</nav>