-- Parcel Pulse Logistics - Production Database Schema & Seed Data
-- Compatible with MySQL 5.7, 8.0+ & MariaDB (InfinityFree / cPanel / Localhost)

SET FOREIGN_KEY_CHECKS = 0;

-- 1. USERS TABLE
CREATE TABLE IF NOT EXISTS `users` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(100) NOT NULL,
    `email` varchar(100) NOT NULL UNIQUE,
    `password` varchar(255) NOT NULL,
    `role` enum('user', 'admin') DEFAULT 'user',
    `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. PARCELS TABLE
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
    KEY `idx_user_id` (`user_id`),
    CONSTRAINT `fk_parcels_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. TRACKING HISTORY
CREATE TABLE IF NOT EXISTS `tracking_history` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `parcel_id` int(11) NOT NULL,
    `location` varchar(255) NOT NULL,
    `status` varchar(50) NOT NULL,
    `timestamp` timestamp DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_parcel_id` (`parcel_id`),
    CONSTRAINT `fk_tracking_parcel` FOREIGN KEY (`parcel_id`) REFERENCES `parcels`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. AI PREDICTIONS
CREATE TABLE IF NOT EXISTS `ai_predictions` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `parcel_id` int(11) NOT NULL,
    `estimated_delivery` datetime DEFAULT NULL,
    `delay_probability` int(3) DEFAULT 0,
    `weather_impact` varchar(100) DEFAULT NULL,
    `recommended_route` text DEFAULT NULL,
    `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_pred_parcel` (`parcel_id`),
    CONSTRAINT `fk_pred_parcel` FOREIGN KEY (`parcel_id`) REFERENCES `parcels`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 5. DRONE DELIVERIES
CREATE TABLE IF NOT EXISTS `drone_deliveries` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `parcel_id` int(11) NOT NULL,
    `drone_id` varchar(50) NOT NULL,
    `battery_status` int(3) DEFAULT 100,
    `wind_analysis` varchar(100) DEFAULT NULL,
    `status` varchar(50) DEFAULT 'In Transit',
    PRIMARY KEY (`id`),
    KEY `idx_drone_parcel` (`parcel_id`),
    CONSTRAINT `fk_drone_parcel` FOREIGN KEY (`parcel_id`) REFERENCES `parcels`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 6. ECO REPORTS
CREATE TABLE IF NOT EXISTS `eco_reports` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `parcel_id` int(11) NOT NULL,
    `carbon_emission` decimal(10,2) DEFAULT NULL,
    `fuel_saved` decimal(10,2) DEFAULT NULL,
    `eco_score` int(3) DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `idx_eco_parcel` (`parcel_id`),
    CONSTRAINT `fk_eco_parcel` FOREIGN KEY (`parcel_id`) REFERENCES `parcels`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 7. CHAT MESSAGES
CREATE TABLE IF NOT EXISTS `chat_messages` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `user_id` int(11) DEFAULT NULL,
    `message` text NOT NULL,
    `is_bot` boolean DEFAULT FALSE,
    `timestamp` timestamp DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 8. FRAUD ALERTS
CREATE TABLE IF NOT EXISTS `fraud_alerts` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `user_id` int(11) DEFAULT NULL,
    `activity_type` varchar(100) NOT NULL,
    `description` text NOT NULL,
    `timestamp` timestamp DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 9. COMPLAINTS TABLE
CREATE TABLE IF NOT EXISTS `complaints` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `user_id` int(11) NOT NULL,
    `tracking_number` varchar(50) NOT NULL,
    `category` enum('Delay', 'Damage', 'Lost parcel', 'Other') NOT NULL,
    `description` text NOT NULL,
    `status` enum('Pending', 'In Progress', 'Resolved') DEFAULT 'Pending',
    `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_complaint_user` (`user_id`),
    CONSTRAINT `fk_complaint_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =========================================================================
-- SEED DATA (Default Accounts & Production Sample Telemetry)
-- =========================================================

-- Insert Default Accounts
INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'System Administrator', 'admin@parcelpulse.com', '12345', 'admin'),
(2, 'John Doe', 'user@parcelpulse.com', 'user123', 'user')
ON DUPLICATE KEY UPDATE `name`=VALUES(`name`);

-- Insert Sample Parcels
INSERT INTO `parcels` (`id`, `user_id`, `tracking_number`, `sender_name`, `receiver_name`, `origin`, `destination`, `shipping_method`, `status`, `weight`, `dimensions`) VALUES
(1, 2, 'PP-8492-AI', 'Tech Corp Hub', 'John Doe', 'Dubai Logistics Hub', 'Lahore Central Depot', 'Air', 'In Transit', 2.50, '30x20x15'),
(2, 2, 'PP-7742-AI', 'BioMed Supply', 'Dr. Smith', 'Berlin Autonomous Base', 'Paris Eco Hub', 'Drone', 'Out for Delivery', 1.20, '20x15x10'),
(3, 2, 'PP-3391-RD', 'Global Retail Ltd', 'Ahmed Khan', 'Karachi Port Terminal', 'Islamabad Freight Center', 'Road', 'Delivered', 15.00, '60x40x30')
ON DUPLICATE KEY UPDATE `status`=VALUES(`status`);

-- Insert Tracking History
INSERT INTO `tracking_history` (`id`, `parcel_id`, `location`, `status`, `timestamp`) VALUES
(1, 1, 'Dubai Hub 01', 'Shipment Manifest Created', '2026-11-05 10:00:00'),
(2, 1, 'DXB Airport Cargo Zone', 'Departed from Origin', '2026-11-05 11:30:00'),
(3, 1, 'LHE Cargo Sorting Terminal', 'Customs Cleared & In Transit', '2026-11-05 12:15:00'),
(4, 2, 'Berlin Drone Port #4', 'Autonomous Drone Dispatched', '2026-11-05 12:00:00')
ON DUPLICATE KEY UPDATE `location`=VALUES(`location`);

-- Insert AI Delay & Weather Predictions
INSERT INTO `ai_predictions` (`id`, `parcel_id`, `estimated_delivery`, `delay_probability`, `weather_impact`, `recommended_route`) VALUES
(1, 1, '2026-11-06 14:00:00', 5, 'Clear Sky - Optimal Flight Vector', 'DXB -> KHI -> LHE Corridor'),
(2, 2, '2026-11-05 15:30:00', 2, 'Wind 8 knots - Drone Stable', 'Direct Low-Altitude Air Corridor B')
ON DUPLICATE KEY UPDATE `weather_impact`=VALUES(`weather_impact`);

-- Insert Drone Telemetry
INSERT INTO `drone_deliveries` (`id`, `parcel_id`, `drone_id`, `battery_status`, `wind_analysis`, `status`) VALUES
(1, 2, 'PULSE-DRONE-X9', 88, 'Tailwind +4km/h', 'In Transit')
ON DUPLICATE KEY UPDATE `battery_status`=VALUES(`battery_status`);

-- Insert Eco Reports
INSERT INTO `eco_reports` (`id`, `parcel_id`, `carbon_emission`, `fuel_saved`, `eco_score`) VALUES
(1, 1, 4.20, 1.80, 92),
(2, 2, 0.00, 3.40, 99)
ON DUPLICATE KEY UPDATE `eco_score`=VALUES(`eco_score`);

-- Insert Sample Complaints
INSERT INTO `complaints` (`id`, `user_id`, `tracking_number`, `category`, `description`, `status`) VALUES
(1, 2, 'PP-8492-AI', 'Delay', 'Requesting updated delivery window confirmation.', 'In Progress')
ON DUPLICATE KEY UPDATE `description`=VALUES(`description`);

SET FOREIGN_KEY_CHECKS = 1;
