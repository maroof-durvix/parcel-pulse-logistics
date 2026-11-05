# 📦 ParcelPulse - Autonomous & AI-Powered Logistics Ecosystem

<div align="center">

![ParcelPulse Banner](assets/images/ai_slider_1.png)

[![PHP Version](https://img.shields.io/badge/PHP-8.2%20%7C%208.3%2B-777bb4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-8.0%2B-4479a1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3.3-7952b3?style=for-the-badge&logo=bootstrap&logoColor=white)](https://getbootstrap.com/)
[![Leaflet](https://img.shields.io/badge/Leaflet-1.9.4-199900?style=for-the-badge&logo=leaflet&logoColor=white)](https://leafletjs.com/)
[![Chart.js](https://img.shields.io/badge/Chart.js-4.x-ff6384?style=for-the-badge&logo=chartdotjs&logoColor=white)](https://www.chartjs.org/)
[![License](https://img.shields.io/badge/License-MIT-blue?style=for-the-badge)](LICENSE)

**Intelligent Freight. Zero-Latency Delivery. Next-Generation Supply Chain Intelligence.**

[Explore Features](#-core-features) • [Quick Start](#-quick-start--installation) • [Admin Console](#-executive-operations-console) • [Default Credentials](#-default-test-accounts)

</div>

---

## 🚀 Overview

**ParcelPulse** is an enterprise-grade, futuristic logistics and supply chain management platform designed for the next century of global trade. Uniting autonomous aerial drones, contactless smart IoT vault lockers, and peer-to-peer crowd shipping into a single predictive ecosystem, ParcelPulse delivers sub-minute orbital telemetry, meteorological delay predictions, and automated incident triage.

Designed with a high-contrast dark cyberpunk UI, interactive Leaflet geo-tracking maps, real-time Chart.js telemetry forecasts, and an integrated floating AI voice assistant.

---

## ✨ Core Features

### 🛰️ 1. Multi-Constellation AI Waybill Radar
- **Live GPS & Orbital Mapping**: Interactive dark-themed Leaflet map rendering real-time transit routes, origin/destination hubs, and waypoint milestones.
- **Voice-Enabled Lookup**: Speech recognition integrated directly into the tracking console ("Track my parcel").
- **Predictive Delay Intelligence**: Machine learning weather impact assessment, route rerouting indicators, and automated sub-minute ETA predictions.

### 🚁 2. Autonomous Drone Fleet Console
- **Sub-Hour Aerial Delivery**: Real-time telemetry monitoring altitude, flight speed, rotor RPM, atmospheric wind shear, and GPS lock.
- **Automated Computer-Vision Landing**: Dynamic landing hazard detection and live battery telemetry with automatic return-to-base (RTB) protocols.

### 🔐 3. Smart IoT Vault Lockers
- **24/7 Decentralized Pick-up & Drop-off**: Interactive locker terminal simulation with PIN code entry or QR pass validation.
- **Automated Compartment Allocation**: Physical locker door visual trigger upon successful authentication.

### 🚗 4. Peer-to-Peer AI Crowd-Shipping
- **Commuter Route Matching**: Algorithmic pairing of shipments with daily travelers heading along the same transit corridors.
- **Earn While Traveling**: Real-time package claiming portal with instant payout calculators and up to 40% cost reduction for shippers.

### 📊 5. Instant Multi-Carrier Freight Estimator
- **Dynamic Rate Engine**: Live quotation taking into account cargo dimensions, gross weight, Incoterms 2020 rules, aviation fuel surcharges, and green carbon offsets.
- **Multi-Modal Selectors**: Air Express, Autonomous Drone, Overland EV Freight, and Ocean Freight options.

### 🌐 6. Incoterms 2020 Global Trade Hub
- **Interactive ICC Explainer**: Clear visual breakdown of seller vs. buyer liabilities, export/import duties, and risk transfer points across all standard Incoterms (EXW, FCA, CPT, CIP, DAP, DPU, DDP, FAS, FOB, CFR, CIF).

### 🎫 7. 24/7 Client Support Ticket Management
- **Instant Dispute Triage**: Full issue logging for transit delays, customs holds, or package damage.
- **Live Ticket Status**: Transparent updates tracking ticket progression from *In Progress* to *Resolved*.

### 🎙️ 8. Floating Neural Voice & Chat Assistant
- **Global In-App Assistant**: Accessible on every page with quick-prompt answers, real-time tracking lookup, speech recognition, and instant customer triage.

---

## 🖥️ Executive Operations Console (Admin)

The administrative terminal (`admin/dashboard.php`) provides operations directors with comprehensive mission control:

- **AI Fleet & Freight Metrics**: Real-time tracking of active consignments, autonomous drone readiness, registered shippers, and pending support tickets.
- **Predictive Analytics Visuals**: Interactive Chart.js charts projecting monthly freight volume vs. revenue index and modal share distribution.
- **Shipment Hub (`admin/shipment.php`)**: Full CRUD lifecycle for parcels, live waybill generation, status transitions (*Pending*, *In Transit*, *Out for Delivery*, *Delivered*), and freight mode assignment.
- **Ticket Resolution Desk (`admin/complaints.php`)**: Centralized complaint triage with one-click resolution dispatch.
- **Access Control & User Management (`admin/users.php`)**: User directory with permission flags and account security audits.

---

## 📁 Project Architecture

```
parcel-pulse-logistics/
├── admin/                     # Executive Admin Portal
│   ├── complaints.php         # Support ticket resolution desk
│   ├── dashboard.php          # Telemetry analytics & Chart.js console
│   ├── login.php              # Administrative gateway authentication
│   ├── preview_dashboard.php  # Local preview runner
│   ├── shipment.php           # Shipment CRUD & waybill dispatcher
│   └── users.php              # Shipper & client access control
├── assets/                    # Static Assets & Styling
│   ├── css/
│   │   └── style.css          # Futuristic high-contrast dark theme (CSS 3.1)
│   ├── images/                # High-res atmospheric system slider graphics
│   ├── img/                   # Page-specific local hero visual assets
│   └── js/
│       └── script.js          # Interactive UI, Speech API & AI chat assistant
├── config/                    # System & Database Configuration
│   ├── database.sql           # Schema DDL (9 production tables + seed data)
│   ├── db.php                 # Environment-aware MySQLi database connection
│   └── init_db.php            # Automated CLI/browser database initializer
├── includes/                  # Global Reusable Components
│   ├── ai_slider.php          # Visual hero capabilities slider
│   ├── footer.php             # Modern corporate footer & neural AI chatbot
│   └── header.php             # Glassmorphic top navigation & cache-busting
├── pages/                     # Public & Client Feature Modules
│   ├── about.php              # Infrastructure & technology overview
│   ├── complaint.php          # Client support ticket filing & history
│   ├── contact.php            # Global operations hubs & inquiry form
│   ├── crowd_shipping.php     # Peer-to-peer commute shipping portal
│   ├── drone.php              # Sub-hour drone telemetry simulator
│   ├── intercome.php          # Incoterms 2020 trade guidelines
│   ├── lockers.php            # Contactless IoT smart vault terminal
│   ├── quote.php              # Alias endpoint for instant quote
│   ├── quotes.php             # Dynamic multi-carrier freight calculator
│   ├── services.php           # Capabilities directory & AI recommender
│   └── tracking.php           # Live multi-constellation GPS radar
├── .gitignore                 # Version control ignore rules
├── index.php                  # Primary landing page & instant waybill lookup
├── login.php                  # Client authentication gateway
├── logout.php                 # Session termination handler
├── register.php               # Shipper account registration
└── README.md                  # Comprehensive system documentation
```

---

## ⚡ Quick Start & Installation

### 1. Prerequisites
- **PHP**: 8.2 or 8.3+ (CLI or Web Server)
- **MySQL**: 8.0+ or MariaDB 10.5+
- **Apache / Nginx** or PHP Built-in Server

### 2. Clone the Repository
```bash
git clone https://github.com/maroof-durvix/parcel-pulse-logistics.git
cd parcel-pulse-logistics
```

### 3. Database Setup
1. Create a MySQL database named `parcel_pulse`:
   ```sql
   CREATE DATABASE parcel_pulse CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```
2. Import the schema and seed data located at `config/database.sql`:
   ```bash
   mysql -u root -p parcel_pulse < config/database.sql
   ```
   *(Alternatively, use phpMyAdmin or run `http://localhost:8000/config/init_db.php` in your browser).*

3. Update your database credentials in `config/db.php` if different from defaults:
   ```php
   $host = getenv('DB_HOST') ?: 'localhost';
   $user = getenv('DB_USER') ?: 'root';
   $pass = getenv('DB_PASS') ?: '';
   $dbname = getenv('DB_NAME') ?: 'parcel_pulse';
   ```

### 4. Run Locally
You can use PHP's built-in development server:
```bash
php -S localhost:8000
```
Open your browser and navigate to:
**`http://localhost:8000`**

---

## 🔑 Default Test Accounts

| Role | Email / Identifier | Password | Access Area |
| :--- | :--- | :--- | :--- |
| **System Admin** | `admin@parcelpulse.com` *(or `admin`)* | `12345` | [`/admin/login.php`](http://localhost:8000/admin/login.php) |
| **Enterprise Client** | `user@parcelpulse.com` | `user123` | [`/login.php`](http://localhost:8000/login.php) |

---

## 🏷️ Sample Waybill References

Use these pre-seeded tracking identifiers to immediately test the telemetry radar:

- ✈️ **`PP-8492-AI`**: Air Express cargo (Dubai Logistics Hub ➔ London Heathrow Gateway) — *In Transit*
- 🚁 **`PP-7742-AI`**: Autonomous Drone courier (Hub North-Alpha ➔ High-Rise Locker Vault #4) — *Out for Delivery*
- 🚛 **`PP-3391-RD`**: Overland EV Container (Singapore Port ➔ Regional Distribution Center) — *In Transit*

---

## ☁️ Production Deployment (InfinityFree / cPanel / Cloud)

This application supports automatic detection for cloud hosts like InfinityFree and standard cPanel environments:
- **Environment Variables**: Can be defined via `.htaccess` or server environment (`DB_HOST`, `DB_USER`, `DB_PASS`, `DB_NAME`).
- **Dynamic Port & Protocol**: Base URL detection adapts automatically whether hosted at root or sub-directories.
- **Assets Cache-Busting**: Stylesheets and scripts include dynamic timestamp query strings to prevent browser cache stickiness after code updates.

---

## 👨‍💻 Author & Maintainer

Developed and maintained by **Maroof Ahmed Durwesh** ([@maroof-durvix](https://github.com/maroof-durvix)).

---

## 📄 License

This project is licensed under the MIT License — see the [LICENSE](LICENSE) file for details.
