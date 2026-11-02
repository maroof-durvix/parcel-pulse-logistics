-- Parcel Pulse Database Schema

CREATE TABLE IF NOT EXISTS `users` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(100) NOT NULL,
    `email` varchar(100) NOT NULL UNIQUE,
    `password` varchar(255) NOT NULL,
    `role` enum('user', 'admin') DEFAULT 'user',
    `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `parcels` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `user_id` int(11) DEFAULT NULL,
    `tracking_number` varchar(50) NOT NULL UNIQUE,
    `sender_name` varchar(100) NOT NULL,
    `receiver_name` varchar(100) NOT NULL,
    `origin` varchar(255) NOT NULL,
    `destination` varchar(255) NOT NULL,
    `shipping_method` enum('Air', 'Sea', 'Road', 'Drone', 'EV Delivery', 'Crowd Shipping') DEFAULT 'Road',
    `status` varchar(50) DEFAULT 'Pending',
    `weight` decimal(10,2) DEFAULT NULL,
    `dimensions` varchar(50) DEFAULT NULL,
    `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS `tracking_history` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `parcel_id` int(11) NOT NULL,
    `location` varchar(255) NOT NULL,
    `status` varchar(50) NOT NULL,
    `timestamp` timestamp DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`parcel_id`) REFERENCES `parcels`(`id`) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS `ai_predictions` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `parcel_id` int(11) NOT NULL,
    `estimated_delivery` datetime DEFAULT NULL,
    `delay_probability` int(3) DEFAULT 0,
    `weather_impact` varchar(100) DEFAULT NULL,
    `recommended_route` text DEFAULT NULL,
    `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`parcel_id`) REFERENCES `parcels`(`id`) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS `drone_deliveries` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `parcel_id` int(11) NOT NULL,
    `drone_id` varchar(50) NOT NULL,
    `battery_status` int(3) DEFAULT 100,
    `wind_analysis` varchar(100) DEFAULT NULL,
    `status` varchar(50) DEFAULT 'In Transit',
    PRIMARY KEY (`id`),
    FOREIGN KEY (`parcel_id`) REFERENCES `parcels`(`id`) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS `eco_reports` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `parcel_id` int(11) NOT NULL,
    `carbon_emission` decimal(10,2) DEFAULT NULL,
    `fuel_saved` decimal(10,2) DEFAULT NULL,
    `eco_score` int(3) DEFAULT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`parcel_id`) REFERENCES `parcels`(`id`) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS `chat_messages` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `user_id` int(11) DEFAULT NULL,
    `message` text NOT NULL,
    `is_bot` boolean DEFAULT FALSE,
    `timestamp` timestamp DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `fraud_alerts` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `user_id` int(11) DEFAULT NULL,
    `activity_type` varchar(100) NOT NULL,
    `description` text NOT NULL,
    `timestamp` timestamp DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `complaints` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `user_id` int(11) NOT NULL,
    `tracking_number` varchar(50) NOT NULL,
    `category` enum('Delay', 'Damage', 'Lost parcel', 'Other') NOT NULL,
    `description` text NOT NULL,
    `status` enum('Pending', 'In Progress', 'Resolved') DEFAULT 'Pending',
    `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
);
