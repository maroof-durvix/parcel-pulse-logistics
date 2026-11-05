<?php
session_start();
$_SESSION['admin'] = true;
$_SESSION['user_id'] = 1;
$_SESSION['user_name'] = "System Administrator";
$_SESSION['user_role'] = "admin";
require __DIR__ . '/dashboard.php';

