<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmer Dashboard - ManalonApp</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        .container-full {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 260px;
            background-color: #1b5e20;
            color: white;
            padding: 20px 0;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            overflow-y: auto;
        }

        .sidebar-header {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 20px;
        }

        .sidebar-header h2 {
            margin: 0;
            font-size: 22px;
        }

        .sidebar-header p {
            margin: 5px 0 0 0;
            font-size: 12px;
            color: #c8e6c9;
        }

        .sidebar-nav {
            padding: 0 10px;
        }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            padding: 15px;
            color: #c8e6c9;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 10px;
            transition: all 0.3s;
        }

        .sidebar-nav a:hover {
            background-color: rgba(255,255,255,0.1);
            color: white;
        }

        .sidebar-nav a.active {
            background-color: rgba(255,255,255,0.15);
            color: white;
            font-weight: bold;
        }

        .sidebar-nav a span:first-child {
            font-size: 20px;
            margin-right: 12px;
        }

        .sidebar-footer {
            position: absolute;
            bottom: 20px;
            left: 10px;
            right: 10px;
            padding-top: 20px;
            border-top: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-footer form {
            width: 100%;
        }

        .sidebar-footer button {
            width: 100%;
            padding: 12px;
            background-color: #c8e6c9;
            color: #1b5e20;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
        }

        .sidebar-footer button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        /* MAIN CONTENT */
        .main-content {
            margin-left: 260px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        /* HEADER */
        .header {
            background-color: white;
            padding: 15px 30px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .search-bar {
            display: flex;
            align-items: center;
            background-color: #f0f0f0;
            padding: 10px 15px;
            border-radius: 8px;
            max-width: 400px;
            flex: 1;
        }

        .search-bar input {
            flex: 1;
            border: none;
            background: transparent;
            outline: none;
            font-size: 14px;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-left: 30px;
        }

        .user-info {
            text-align: right;
        }

        .user-info p {
            margin: 0;
        }

        .user-info .name {
            font-weight: bold;
            color: #333;
        }

        .user-info .role {
            font-size: 12px;
            color: #666;
        }

        .avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #1b5e20, #4caf50);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 16px;
        }

        /* PAGE CONTENT */
        .page-content {
            flex: 1;
            padding: 30px;
        }

        .page-title {
            margin: 0 0 30px 0;
            font-size: 28px;
            color: #1b5e20;
            font-weight: bold;
        }

        /* CARDS */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            border-left: 4px solid #1b5e20;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
        }

        .card-title {
            margin: 0;
            color: #666;
            font-size: 13px;
            text-transform: uppercase;
        }

        .card-value {
            margin: 10px 0 0 0;
            font-size: 32px;
            color: #1b5e20;
            font-weight: bold;
        }

        .card-icon {
            font-size: 40px;
        }

        .card-footer {
            margin: 15px 0 0 0;
            font-size: 12px;
            color: #999;
        }

        /* TABLE */
        .table-section {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .table-title {
            margin: 0;
            color: #333;
            font-size: 18px;
        }

        .btn-primary {
            padding: 10px 20px;
            background-color: #81c784;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table thead {
            background-color: #fafafa;
            border-bottom: 2px solid #f0f0f0;
        }

        table th {
            padding: 12px;
            text-align: left;
            color: #666;
            font-weight: 600;
            font-size: 13px;
        }

        table td {
            padding: 15px 12px;
            border-bottom: 1px solid #f0f0f0;
        }

        table tbody tr:hover {
            background-color: #fafafa;
        }

        .badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .badge-success {
            background-color: #c8e6c9;
            color: #1b5e20;
        }

        .badge-warning {
            background-color: #fff9c4;
            color: #f57f17;
        }

        .badge-danger {
            background-color: #ffcdd2;
            color: #c62828;
        }

        .btn-edit {
            padding: 6px 12px;
            background-color: #f0f0f0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
            color: #1b5e20;
            transition: all 0.3s;
        }

        .btn-edit:hover {
            background-color: #e0e0e0;
        }

        .content-section {
            display: none;
        }

        .content-section.active {
            display: block;
        }

        .announcement-box {
            background: white;
            padding: 20px;
            border-radius: 12px;
            border-left: 4px solid #81c784;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        .announcement-title {
            margin: 0 0 10px 0;
            color: #1b5e20;
            font-weight: bold;
        }

        .announcement-date {
            font-size: 12px;
            color: #999;
            margin-bottom: 10px;
        }

        .announcement-content {
            color: #666;
            line-height: 1.6;
        }

        .guide-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            margin-bottom: 20px;
        }

        .guide-title {
            margin: 0 0 10px 0;
            color: #1b5e20;
            font-weight: bold;
            font-size: 16px;
        }

        .guide-desc {
            color: #666;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .guide-btn {
            padding: 8px 16px;
            background-color: #81c784;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
            transition: all 0.3s;
        }

        .guide-btn:hover {
            background-color: #66bb6a;
        }

        .weather-widget {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            text-align: center;
            margin-bottom: 20px;
        }

        .weather-icon {
            font-size: 48px;
            margin: 10px 0;
        }

        .weather-temp {
            font-size: 32px;
            color: #1b5e20;
            font-weight: bold;
        }

        .weather-desc {
            color: #666;
            margin-top: 10px;
        }

        .price-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .price-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            text-align: center;
        }

        .price-crop {
            font-weight: bold;
            color: #1b5e20;
            margin-bottom: 10px;
        }

        .price-value {
            font-size: 28px;
            color: #4caf50;
            font-weight: bold;
        }

        .price-unit {
            font-size: 12px;
            color: #999;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container-full">
        <!-- SIDEBAR -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>🌾 ManalonApp</h2>
                <p>Farmer Dashboard</p>
            </div>

            <nav class="sidebar-nav">
                <a href="#guides" class="nav-link active" onclick="showSection('guides')">
                    <span>📚</span>
                    <span>Farming Guides</span>
                </a>
                <a href="#video-tutorials" class="nav-link" onclick="showSection('video-tutorials')">
                    <span>🎥</span>
                    <span>Video Tutorials</span>
                </a>
                <a href="#research" class="nav-link" onclick="showSection('research')">
                    <span>📚</span>
                    <span>Research & Studies</span>
                </a>
                <a href="#home" class="nav-link" onclick="showSection('home')">
                    <span>🏠</span>
                    <span>Home</span>
                </a>
                <a href="#announcements" class="nav-link" onclick="showSection('announcements')">
                    <span>📢</span>
                    <span>Announcements</span>
                </a>
                <a href="#weather" class="nav-link" onclick="showSection('weather')">
                    <span>🌤️</span>
                    <span>Weather Info</span>
                </a>
                <a href="#prices" class="nav-link" onclick="showSection('prices')">
                    <span>📈</span>
                    <span>Market Prices</span>
                </a>
                <a href="#about" class="nav-link" onclick="showSection('about')">
                    <span>ℹ️</span>
                    <span>About MannalonApp</span>
                </a>
                <a href="#profile" class="nav-link" onclick="showSection('profile')">
                    <span>👤</span>
                    <span>Profile</span>
                </a>
            </nav>

            <div class="sidebar-footer">
                <form method="POST" action="/logout">
                    <?php echo csrf_field(); ?>
                    <button type="submit">🚪 Logout</button>
                </form>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <div class="main-content">
            <!-- HEADER -->
            <header class="header">
                <div class="search-bar">
                    <span style="font-size: 18px; margin-right: 10px;">🔍</span>
                    <input type="text" placeholder="Search...">
                </div>

                <div class="user-profile">
                    <div class="user-info">
                        <p class="name"><?php echo e(session('user.name') ?? 'Farmer'); ?></p>
                        <p class="role">Farmer</p>
                    </div>
                    <div class="avatar"><?php echo e(substr(session('user.name') ?? 'F', 0, 1)); ?></div>
                </div>
            </header>

            <!-- PAGE CONTENT -->
            <div class="page-content">
                <!-- VIDEO TUTORIALS SECTION (NEW - AT TOP) -->
                <div id="video-tutorials" class="content-section">
                    <h1 class="page-title">🎥 Video Tutorials</h1>
                    <p style="color: #666; margin-bottom: 25px;">Learn modern farming techniques through our comprehensive video library</p>
                    
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
                        <div style="background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.1); border: 2px solid #81c784;">
                            <div style="background: linear-gradient(135deg, #66bb6a, #43a047); height: 180px; display: flex; align-items: center; justify-center;">
                                <div style="font-size: 64px;">▶️</div>
                            </div>
                            <div style="padding: 20px;">
                                <h3 style="margin: 0 0 10px 0; color: #2e7d32; font-size: 18px;">🌱 Rice Planting Techniques</h3>
                                <p style="color: #666; font-size: 14px; margin-bottom: 15px;">Master rice cultivation from seed to transplanting. Duration: 12:45</p>
                                <button style="width: 100%; padding: 10px; background: #66bb6a; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: bold;">Watch Now</button>
                            </div>
                        </div>

                        <div style="background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.1); border: 2px solid #81c784;">
                            <div style="background: linear-gradient(135deg, #66bb6a, #43a047); height: 180px; display: flex; align-items: center; justify-center;">
                                <div style="font-size: 64px;">▶️</div>
                            </div>
                            <div style="padding: 20px;">
                                <h3 style="margin: 0 0 10px 0; color: #2e7d32; font-size: 18px;">💧 Irrigation Systems</h3>
                                <p style="color: #666; font-size: 14px; margin-bottom: 15px;">Install and maintain efficient irrigation systems. Duration: 18:30</p>
                                <button style="width: 100%; padding: 10px; background: #66bb6a; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: bold;">Watch Now</button>
                            </div>
                        </div>

                        <div style="background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.1); border: 2px solid #81c784;">
                            <div style="background: linear-gradient(135deg, #66bb6a, #43a047); height: 180px; display: flex; align-items: center; justify-center;">
                                <div style="font-size: 64px;">▶️</div>
                            </div>
                            <div style="padding: 20px;">
                                <h3 style="margin: 0 0 10px 0; color: #2e7d32; font-size: 18px;">🌾 Organic Pest Control</h3>
                                <p style="color: #666; font-size: 14px; margin-bottom: 15px;">Natural methods to protect crops. Duration: 15:20</p>
                                <button style="width: 100%; padding: 10px; background: #66bb6a; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: bold;">Watch Now</button>
                            </div>
                        </div>

                        <div style="background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.1); border: 2px solid #81c784;">
                            <div style="background: linear-gradient(135deg, #66bb6a, #43a047); height: 180px; display: flex; align-items: center; justify-center;">
                                <div style="font-size: 64px;">▶️</div>
                            </div>
                            <div style="padding: 20px;">
                                <h3 style="margin: 0 0 10px 0; color: #2e7d32; font-size: 18px;">🐄 Livestock Management</h3>
                                <p style="color: #666; font-size: 14px; margin-bottom: 15px;">Complete guide to healthy cattle & poultry. Duration: 22:15</p>
                                <button style="width: 100%; padding: 10px; background: #66bb6a; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: bold;">Watch Now</button>
                            </div>
                        </div>

                        <div style="background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.1); border: 2px solid #81c784;">
                            <div style="background: linear-gradient(135deg, #66bb6a, #43a047); height: 180px; display: flex; align-items: center; justify-center;">
                                <div style="font-size: 64px;">▶️</div>
                            </div>
                            <div style="padding: 20px;">
                                <h3 style="margin: 0 0 10px 0; color: #2e7d32; font-size: 18px;">🌽 Corn Cultivation</h3>
                                <p style="color: #666; font-size: 14px; margin-bottom: 15px;">Planting to harvest - complete corn guide. Duration: 16:40</p>
                                <button style="width: 100%; padding: 10px; background: #66bb6a; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: bold;">Watch Now</button>
                            </div>
                        </div>

                        <div style="background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.1); border: 2px solid #81c784;">
                            <div style="background: linear-gradient(135deg, #66bb6a, #43a047); height: 180px; display: flex; align-items: center; justify-center;">
                                <div style="font-size: 64px;">▶️</div>
                            </div>
                            <div style="padding: 20px;">
                                <h3 style="margin: 0 0 10px 0; color: #2e7d32; font-size: 18px;">📊 Farm Business</h3>
                                <p style="color: #666; font-size: 14px; margin-bottom: 15px;">Manage your farm like a business. Duration: 25:10</p>
                                <button style="width: 100%; padding: 10px; background: #66bb6a; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: bold;">Watch Now</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- HOME SECTION -->
                <div id="home" class="content-section">
                    <h1 class="page-title">Welcome, <?php echo e(session('user.name') ?? 'Farmer'); ?>! 👨‍🌾</h1>
                    
                    <div class="cards-grid">
                        <div class="card">
                            <div class="card-header">
                                <div>
                                    <p class="card-title">Active Crops</p>
                                    <p class="card-value">12</p>
                                </div>
                                <span class="card-icon">🌱</span>
                            </div>
                            <p class="card-footer">3 ready for harvest</p>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <div>
                                    <p class="card-title">Total Livestock</p>
                                    <p class="card-value">45</p>
                                </div>
                                <span class="card-icon">🐄</span>
                            </div>
                            <p class="card-footer">All healthy status</p>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <div>
                                    <p class="card-title">Farm Area</p>
                                    <p class="card-value">24.5</p>
                                </div>
                                <span class="card-icon">📍</span>
                            </div>
                            <p class="card-footer">Total cultivated acres</p>
                        </div>
                    </div>

                    <div class="table-section">
                        <div class="table-header">
                            <h3 class="table-title">Recent Crops Activity</h3>
                            <button class="btn-primary">+ Add Crop</button>
                        </div>

                        <table>
                            <thead>
                                <tr>
                                    <th>Crop Name</th>
                                    <th>Type</th>
                                    <th>Area (acres)</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>🌾 Maize</td>
                                    <td>Cereal</td>
                                    <td>5.5</td>
                                    <td><span class="badge badge-success">Growing</span></td>
                                    <td><button class="btn-edit">Edit</button></td>
                                </tr>
                                <tr>
                                    <td>🫘 Beans</td>
                                    <td>Legume</td>
                                    <td>2.3</td>
                                    <td><span class="badge badge-warning">Ready</span></td>
                                    <td><button class="btn-edit">Edit</button></td>
                                </tr>
                                <tr>
                                    <td>🥕 Carrots</td>
                                    <td>Vegetable</td>
                                    <td>1.2</td>
                                    <td><span class="badge badge-danger">Planning</span></td>
                                    <td><button class="btn-edit">Edit</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- ANNOUNCEMENTS SECTION -->
                <div id="announcements" class="content-section">
                    <h1 class="page-title">📢 Announcements</h1>
                    
                    <div class="announcement-box">
                        <p class="announcement-title">🌾 Harvest Season Starts Next Week</p>
                        <p class="announcement-date">January 26, 2026</p>
                        <p class="announcement-content">The harvest season is starting next week. Please ensure your crops are ready for harvesting. Visit the Farming Guides section for tips on proper harvesting techniques.</p>
                    </div>

                    <div class="announcement-box">
                        <p class="announcement-title">💰 New Subsidy Program Launched</p>
                        <p class="announcement-date">January 20, 2026</p>
                        <p class="announcement-content">A new subsidy program has been launched to help farmers with equipment. Check your email for more details or contact our support team.</p>
                    </div>

                    <div class="announcement-box">
                        <p class="announcement-title">🚜 Farm Equipment Rental Available</p>
                        <p class="announcement-date">January 15, 2026</p>
                        <p class="announcement-content">We now offer farm equipment rental services. Rent tractors, plows, and other tools at affordable rates. Contact us for more information!</p>
                    </div>
                </div>

                <!-- FARMING GUIDES SECTION -->
                <div id="guides" class="content-section active">
                    <h1 class="page-title">📚 Farming Guides & Video Tutorials</h1>
                    <p style="color: #666; margin-bottom: 30px; font-size: 16px;">Master modern farming techniques through comprehensive video tutorials and expert guides</p>
                    
                    <!-- VIDEO TUTORIALS AT TOP -->
                    <h2 style="color: #2e7d32; font-size: 22px; margin-bottom: 20px; border-bottom: 3px solid #66bb6a; padding-bottom: 10px;">🎥 Video Tutorials</h2>
                    
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 25px; margin-bottom: 50px;">
                        <!-- Video 1 -->
                        <div style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 6px 20px rgba(0,0,0,0.12); border: 3px solid #81c784; transition: transform 0.3s;">
                            <div style="background: linear-gradient(135deg, #66bb6a, #43a047); height: 200px; display: flex; align-items: center; justify-content: center; position: relative;">
                                <div style="font-size: 72px; opacity: 0.9;">▶️</div>
                                <div style="position: absolute; top: 10px; right: 10px; background: rgba(0,0,0,0.7); color: white; padding: 5px 10px; border-radius: 5px; font-size: 12px; font-weight: bold;">12:45</div>
                            </div>
                            <div style="padding: 20px;">
                                <h3 style="margin: 0 0 12px 0; color: #2e7d32; font-size: 19px; font-weight: bold;">🌱 Rice Planting Techniques</h3>
                                <p style="color: #666; font-size: 14px; line-height: 1.5; margin-bottom: 15px;">Master rice cultivation from seed selection to transplanting. Learn traditional and modern methods.</p>
                                <button style="width: 100%; padding: 12px; background: #66bb6a; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: bold; font-size: 15px;">▶️ Watch Now</button>
                            </div>
                        </div>

                        <!-- Video 2 -->
                        <div style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 6px 20px rgba(0,0,0,0.12); border: 3px solid #81c784; transition: transform 0.3s;">
                            <div style="background: linear-gradient(135deg, #66bb6a, #43a047); height: 200px; display: flex; align-items: center; justify-content: center; position: relative;">
                                <div style="font-size: 72px; opacity: 0.9;">▶️</div>
                                <div style="position: absolute; top: 10px; right: 10px; background: rgba(0,0,0,0.7); color: white; padding: 5px 10px; border-radius: 5px; font-size: 12px; font-weight: bold;">18:30</div>
                            </div>
                            <div style="padding: 20px;">
                                <h3 style="margin: 0 0 12px 0; color: #2e7d32; font-size: 19px; font-weight: bold;">💧 Irrigation Systems Setup</h3>
                                <p style="color: #666; font-size: 14px; line-height: 1.5; margin-bottom: 15px;">Complete guide to installing drip and sprinkler irrigation systems for maximum efficiency.</p>
                                <button style="width: 100%; padding: 12px; background: #66bb6a; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: bold; font-size: 15px;">▶️ Watch Now</button>
                            </div>
                        </div>

                        <!-- Video 3 -->
                        <div style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 6px 20px rgba(0,0,0,0.12); border: 3px solid #81c784; transition: transform 0.3s;">
                            <div style="background: linear-gradient(135deg, #66bb6a, #43a047); height: 200px; display: flex; align-items: center; justify-content: center; position: relative;">
                                <div style="font-size: 72px; opacity: 0.9;">▶️</div>
                                <div style="position: absolute; top: 10px; right: 10px; background: rgba(0,0,0,0.7); color: white; padding: 5px 10px; border-radius: 5px; font-size: 12px; font-weight: bold;">15:20</div>
                            </div>
                            <div style="padding: 20px;">
                                <h3 style="margin: 0 0 12px 0; color: #2e7d32; font-size: 19px; font-weight: bold;">🌾 Organic Pest Control</h3>
                                <p style="color: #666; font-size: 14px; line-height: 1.5; margin-bottom: 15px;">Natural and eco-friendly methods to protect your crops from pests without harmful chemicals.</p>
                                <button style="width: 100%; padding: 12px; background: #66bb6a; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: bold; font-size: 15px;">▶️ Watch Now</button>
                            </div>
                        </div>

                        <!-- Video 4 -->
                        <div style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 6px 20px rgba(0,0,0,0.12); border: 3px solid #81c784; transition: transform 0.3s;">
                            <div style="background: linear-gradient(135deg, #66bb6a, #43a047); height: 200px; display: flex; align-items: center; justify-content: center; position: relative;">
                                <div style="font-size: 72px; opacity: 0.9;">▶️</div>
                                <div style="position: absolute; top: 10px; right: 10px; background: rgba(0,0,0,0.7); color: white; padding: 5px 10px; border-radius: 5px; font-size: 12px; font-weight: bold;">22:15</div>
                            </div>
                            <div style="padding: 20px;">
                                <h3 style="margin: 0 0 12px 0; color: #2e7d32; font-size: 19px; font-weight: bold;">🐄 Livestock Management</h3>
                                <p style="color: #666; font-size: 14px; line-height: 1.5; margin-bottom: 15px;">Complete guide to raising healthy cattle and poultry. Covers feeding, health, and breeding.</p>
                                <button style="width: 100%; padding: 12px; background: #66bb6a; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: bold; font-size: 15px;">▶️ Watch Now</button>
                            </div>
                        </div>

                        <!-- Video 5 -->
                        <div style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 6px 20px rgba(0,0,0,0.12); border: 3px solid #81c784; transition: transform 0.3s;">
                            <div style="background: linear-gradient(135deg, #66bb6a, #43a047); height: 200px; display: flex; align-items: center; justify-content: center; position: relative;">
                                <div style="font-size: 72px; opacity: 0.9;">▶️</div>
                                <div style="position: absolute; top: 10px; right: 10px; background: rgba(0,0,0,0.7); color: white; padding: 5px 10px; border-radius: 5px; font-size: 12px; font-weight: bold;">16:40</div>
                            </div>
                            <div style="padding: 20px;">
                                <h3 style="margin: 0 0 12px 0; color: #2e7d32; font-size: 19px; font-weight: bold;">🌽 Corn Cultivation Guide</h3>
                                <p style="color: #666; font-size: 14px; line-height: 1.5; margin-bottom: 15px;">From planting to harvest - everything you need to know about successful corn farming.</p>
                                <button style="width: 100%; padding: 12px; background: #66bb6a; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: bold; font-size: 15px;">▶️ Watch Now</button>
                            </div>
                        </div>

                        <!-- Video 6 -->
                        <div style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 6px 20px rgba(0,0,0,0.12); border: 3px solid #81c784; transition: transform 0.3s;">
                            <div style="background: linear-gradient(135deg, #66bb6a, #43a047); height: 200px; display: flex; align-items: center; justify-content: center; position: relative;">
                                <div style="font-size: 72px; opacity: 0.9;">▶️</div>
                                <div style="position: absolute; top: 10px; right: 10px; background: rgba(0,0,0,0.7); color: white; padding: 5px 10px; border-radius: 5px; font-size: 12px; font-weight: bold;">25:10</div>
                            </div>
                            <div style="padding: 20px;">
                                <h3 style="margin: 0 0 12px 0; color: #2e7d32; font-size: 19px; font-weight: bold;">📊 Farm Business Management</h3>
                                <p style="color: #666; font-size: 14px; line-height: 1.5; margin-bottom: 15px;">Turn your farm into a profitable business with smart financial planning and record-keeping.</p>
                                <button style="width: 100%; padding: 12px; background: #66bb6a; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: bold; font-size: 15px;">▶️ Watch Now</button>
                            </div>
                        </div>
                    </div>

                    <!-- WRITTEN GUIDES SECTION -->
                    <h2 style="color: #2e7d32; font-size: 22px; margin-bottom: 20px; border-bottom: 3px solid #66bb6a; padding-bottom: 10px;">📖 Written Guides</h2>
                    
                    <div style="display: grid; gap: 20px;">
                        <div class="guide-card">
                            <p class="guide-title">🌱 How to Plant Maize Properly</p>
                            <p class="guide-desc">Learn the best practices for planting maize to maximize your yield. Includes soil preparation, spacing, and timing.</p>
                            <button class="guide-btn">Read Guide →</button>
                        </div>

                        <div class="guide-card">
                            <p class="guide-title">💧 Irrigation Techniques for Vegetables</p>
                            <p class="guide-desc">Discover efficient irrigation methods for vegetable farming. Save water while improving crop health.</p>
                            <button class="guide-btn">Read Guide →</button>
                        </div>

                        <div class="guide-card">
                            <p class="guide-title">🐄 Livestock Care and Health Management</p>
                            <p class="guide-desc">Comprehensive guide on livestock health, nutrition, and disease prevention to keep your animals healthy.</p>
                            <button class="guide-btn">Read Guide →</button>
                        </div>

                        <div class="guide-card">
                            <p class="guide-title">🌾 Pest Management in Crops</p>
                            <p class="guide-desc">Learn organic and chemical methods to manage pests effectively without harming the environment.</p>
                            <button class="guide-btn">Read Guide →</button>
                        </div>
                    </div>
                </div>

                <!-- RESEARCH & STUDIES SECTION (NEW) -->
                <div id="research" class="content-section">
                    <h1 class="page-title">📚 Research & Studies</h1>
                    <p style="color: #666; margin-bottom: 25px;">Data-driven insights and scientific research to improve your farming practices</p>
                    
                    <div style="display: grid; gap: 20px;">
                        <div style="background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); border-left: 5px solid #66bb6a;">
                            <div style="display: flex; justify-between; align-items: start; margin-bottom: 15px;">
                                <h3 style="color: #2e7d32; margin: 0; font-size: 20px;">🌾 Climate-Resilient Rice Varieties for Cagayan Valley</h3>
                                <span style="background: #e8f5e9; color: #2e7d32; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: bold;">2025</span>
                            </div>
                            <p style="color: #666; line-height: 1.6; margin-bottom: 15px;">This comprehensive study by the Philippine Rice Research Institute examines drought and flood-resistant rice varieties suitable for Cagayan's changing climate. Results show 30% higher yields during irregular weather patterns.</p>
                            <div style="display: flex; gap: 10px; margin-bottom: 15px;">
                                <span style="background: #fff3cd; color: #856404; padding: 5px 10px; border-radius: 15px; font-size: 12px;">Rice</span>
                                <span style="background: #d1ecf1; color: #0c5460; padding: 5px 10px; border-radius: 15px; font-size: 12px;">Climate Change</span>
                                <span style="background: #f8d7da; color: #721c24; padding: 5px 10px; border-radius: 15px; font-size: 12px;">Drought Resistance</span>
                            </div>
                            <button style="padding: 10px 20px; background: #66bb6a; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: bold;">Read Full Study →</button>
                        </div>

                        <div style="background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); border-left: 5px solid #66bb6a;">
                            <div style="display: flex; justify-between; align-items: start; margin-bottom: 15px;">
                                <h3 style="color: #2e7d32; margin: 0; font-size: 20px;">🌽 Organic Fertilizers vs Chemical: Corn Yield Comparison</h3>
                                <span style="background: #e8f5e9; color: #2e7d32; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: bold;">2024</span>
                            </div>
                            <p style="color: #666; line-height: 1.6; margin-bottom: 15px;">A 3-year longitudinal study comparing organic composting methods against chemical fertilizers in corn production. Organic methods showed 15% lower costs with comparable yields and improved soil health.</p>
                            <div style="display: flex; gap: 10px; margin-bottom: 15px;">
                                <span style="background: #fff3cd; color: #856404; padding: 5px 10px; border-radius: 15px; font-size: 12px;">Corn</span>
                                <span style="background: #d1ecf1; color: #0c5460; padding: 5px 10px; border-radius: 15px; font-size: 12px;">Organic Farming</span>
                                <span style="background: #d4edda; color: #155724; padding: 5px 10px; border-radius: 15px; font-size: 12px;">Soil Health</span>
                            </div>
                            <button style="padding: 10px 20px; background: #66bb6a; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: bold;">Read Full Study →</button>
                        </div>

                        <div style="background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); border-left: 5px solid #66bb6a;">
                            <div style="display: flex; justify-between; align-items: start; margin-bottom: 15px;">
                                <h3 style="color: #2e7d32; margin: 0; font-size: 20px;">💧 Water Management: Drip Irrigation Efficiency Study</h3>
                                <span style="background: #e8f5e9; color: #2e7d32; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: bold;">2024</span>
                            </div>
                            <p style="color: #666; line-height: 1.6; margin-bottom: 15px;">Research conducted across 50 farms in Northern Luzon demonstrates that drip irrigation systems reduce water consumption by 40% while increasing vegetable yields by 25% compared to traditional flood irrigation.</p>
                            <div style="display: flex; gap: 10px; margin-bottom: 15px;">
                                <span style="background: #d1ecf1; color: #0c5460; padding: 5px 10px; border-radius: 15px; font-size: 12px;">Irrigation</span>
                                <span style="background: #d4edda; color: #155724; padding: 5px 10px; border-radius: 15px; font-size: 12px;">Water Conservation</span>
                                <span style="background: #fff3cd; color: #856404; padding: 5px 10px; border-radius: 15px; font-size: 12px;">Vegetables</span>
                            </div>
                            <button style="padding: 10px 20px; background: #66bb6a; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: bold;">Read Full Study →</button>
                        </div>

                        <div style="background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); border-left: 5px solid #66bb6a;">
                            <div style="display: flex; justify-between; align-items: start; margin-bottom: 15px;">
                                <h3 style="color: #2e7d32; margin: 0; font-size: 20px;">🐄 Livestock Health: Vaccination Programs Impact</h3>
                                <span style="background: #e8f5e9; color: #2e7d32; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: bold;">2025</span>
                            </div>
                            <p style="color: #666; line-height: 1.6; margin-bottom: 15px;">Analysis of vaccination programs in Cagayan cattle farms shows 85% reduction in disease outbreaks and improved meat/milk production. The study provides recommended vaccination schedules for Philippine conditions.</p>
                            <div style="display: flex; gap: 10px; margin-bottom: 15px;">
                                <span style="background: #fff3cd; color: #856404; padding: 5px 10px; border-radius: 15px; font-size: 12px;">Livestock</span>
                                <span style="background: #f8d7da; color: #721c24; padding: 5px 10px; border-radius: 15px; font-size: 12px;">Animal Health</span>
                                <span style="background: #d4edda; color: #155724; padding: 5px 10px; border-radius: 15px; font-size: 12px;">Disease Prevention</span>
                            </div>
                            <button style="padding: 10px 20px; background: #66bb6a; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: bold;">Read Full Study →</button>
                        </div>

                        <div style="background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); border-left: 5px solid #66bb6a;">
                            <div style="display: flex; justify-between; align-items: start; margin-bottom: 15px;">
                                <h3 style="color: #2e7d32; margin: 0; font-size: 20px;">🌱 Intercropping Systems: Maximizing Land Use</h3>
                                <span style="background: #e8f5e9; color: #2e7d32; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: bold;">2024</span>
                            </div>
                            <p style="color: #666; line-height: 1.6; margin-bottom: 15px;">Study on intercropping rice with legumes shows increased overall productivity by 35% and natural soil nitrogen enrichment. Provides practical guides for crop combinations suitable for Philippine agriculture.</p>
                            <div style="display: flex; gap: 10px; margin-bottom: 15px;">
                                <span style="background: #d1ecf1; color: #0c5460; padding: 5px 10px; border-radius: 15px; font-size: 12px;">Intercropping</span>
                                <span style="background: #d4edda; color: #155724; padding: 5px 10px; border-radius: 15px; font-size: 12px;">Productivity</span>
                                <span style="background: #fff3cd; color: #856404; padding: 5px 10px; border-radius: 15px; font-size: 12px;">Soil Management</span>
                            </div>
                            <button style="padding: 10px 20px; background: #66bb6a; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: bold;">Read Full Study →</button>
                        </div>
                    </div>
                </div>

                <!-- WEATHER SECTION -->
                <div id="weather" class="content-section">
                    <h1 class="page-title">🌤️ Weather Information</h1>
                    <p style="color: #666; margin-bottom: 25px;">Current weather conditions for your farming area</p>
                    
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
                        <div style="background: linear-gradient(135deg, #ffffff, #e8f5e9); padding: 25px; border-radius: 12px; text-align: center; box-shadow: 0 4px 15px rgba(46, 125, 50, 0.15); border: 2px solid #81c784;">
                            <p style="margin: 0 0 10px 0; color: #2e7d32; font-weight: bold;">Today</p>
                            <div style="font-size: 64px; margin: 15px 0;">☀️</div>
                            <p style="font-size: 36px; color: #2e7d32; font-weight: bold; margin: 10px 0;">28°C</p>
                            <p style="color: #66bb6a; font-weight: 600; font-size: 16px;">Sunny & Clear</p>
                            <div style="margin-top: 15px; padding-top: 15px; border-top: 2px solid #c8e6c9;">
                                <p style="font-size: 13px; color: #666; margin: 5px 0;">💧 Humidity: 65%</p>
                                <p style="font-size: 13px; color: #666; margin: 5px 0;">🌬️ Wind: 12 km/h</p>
                            </div>
                        </div>

                        <div style="background: linear-gradient(135deg, #ffffff, #e8f5e9); padding: 25px; border-radius: 12px; text-align: center; box-shadow: 0 4px 15px rgba(46, 125, 50, 0.15); border: 2px solid #81c784;">
                            <p style="margin: 0 0 10px 0; color: #2e7d32; font-weight: bold;">Tomorrow</p>
                            <div style="font-size: 64px; margin: 15px 0;">⛅</div>
                            <p style="font-size: 36px; color: #2e7d32; font-weight: bold; margin: 10px 0;">26°C</p>
                            <p style="color: #66bb6a; font-weight: 600; font-size: 16px;">Partly Cloudy</p>
                            <div style="margin-top: 15px; padding-top: 15px; border-top: 2px solid #c8e6c9;">
                                <p style="font-size: 13px; color: #666; margin: 5px 0;">💧 Humidity: 70%</p>
                                <p style="font-size: 13px; color: #666; margin: 5px 0;">🌬️ Wind: 15 km/h</p>
                            </div>
                        </div>

                        <div style="background: linear-gradient(135deg, #ffffff, #e8f5e9); padding: 25px; border-radius: 12px; text-align: center; box-shadow: 0 4px 15px rgba(46, 125, 50, 0.15); border: 2px solid #81c784;">
                            <p style="margin: 0 0 10px 0; color: #2e7d32; font-weight: bold;">Thursday</p>
                            <div style="font-size: 64px; margin: 15px 0;">🌧️</div>
                            <p style="font-size: 36px; color: #2e7d32; font-weight: bold; margin: 10px 0;">23°C</p>
                            <p style="color: #66bb6a; font-weight: 600; font-size: 16px;">Rainy</p>
                            <div style="margin-top: 15px; padding-top: 15px; border-top: 2px solid #c8e6c9;">
                                <p style="font-size: 13px; color: #666; margin: 5px 0;">💧 Humidity: 85%</p>
                                <p style="font-size: 13px; color: #666; margin: 5px 0;">🌬️ Wind: 20 km/h</p>
                            </div>
                        </div>
                    </div>

                    <!-- Agricultural Weather Advisory -->
                    <div style="background: #e8f5e9; border: 2px solid #66bb6a; border-radius: 12px; padding: 20px; margin-top: 25px;">
                        <h3 style="color: #2e7d32; margin: 0 0 15px 0; font-size: 18px;">🌾 Agricultural Weather Advisory</h3>
                        <p style="color: #666; line-height: 1.6; margin-bottom: 10px;">☀️ <strong>Today:</strong> Perfect conditions for irrigation and field work. Morning hours recommended for planting.</p>
                        <p style="color: #666; line-height: 1.6; margin-bottom: 10px;">⛅ <strong>Tomorrow:</strong> Good day for fertilizer application. Cloud cover will reduce heat stress on crops.</p>
                        <p style="color: #666; line-height: 1.6;">🌧️ <strong>Thursday:</strong> Postpone spraying activities. Rain beneficial for recently planted crops.</p>
                    </div>

                    <div style="background: white; padding: 20px; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); margin-top: 20px;">
                        <h3 style="margin-top: 0; color: #1b5e20;">📋 7-Day Forecast</h3>
                        <p>Check your local weather service for detailed 7-day forecasts and weather alerts specific to your region.</p>
                    </div>
                </div>

                <!-- MARKET PRICES SECTION -->
                <div id="prices" class="content-section">
                    <h1 class="page-title">📈 Market Prices</h1>
                    
                    <div class="price-grid">
                        <div class="price-card">
                            <div class="price-crop">🌾 Maize</div>
                            <div class="price-value">$450</div>
                            <div class="price-unit">Per Ton</div>
                        </div>

                        <div class="price-card">
                            <div class="price-crop">🫘 Beans</div>
                            <div class="price-value">$780</div>
                            <div class="price-unit">Per Ton</div>
                        </div>

                        <div class="price-card">
                            <div class="price-crop">🥕 Carrots</div>
                            <div class="price-value">$320</div>
                            <div class="price-unit">Per Ton</div>
                        </div>

                        <div class="price-card">
                            <div class="price-crop">🥬 Cabbage</div>
                            <div class="price-value">$280</div>
                            <div class="price-unit">Per Ton</div>
                        </div>

                        <div class="price-card">
                            <div class="price-crop">🍅 Tomatoes</div>
                            <div class="price-value">$550</div>
                            <div class="price-unit">Per Ton</div>
                        </div>

                        <div class="price-card">
                            <div class="price-crop">🥔 Potatoes</div>
                            <div class="price-value">$380</div>
                            <div class="price-unit">Per Ton</div>
                        </div>
                    </div>

                    <div style="background: white; padding: 20px; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); margin-top: 20px;">
                        <p style="margin: 0; color: #666;">💡 Prices are updated daily. Sell when prices are high to maximize your profits!</p>
                    </div>
                </div>

                <!-- ABOUT SECTION -->
                <div id="about" class="content-section">
                    <h1 class="page-title">ℹ️ About ManalonApp</h1>
                    
                    <div style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.08);">
                        <h2 style="color: #1b5e20; margin-top: 0;">Welcome to ManalonApp</h2>
                        <p style="color: #666; line-height: 1.8;">ManalonApp is a comprehensive farm management system designed to help farmers like you manage their crops, livestock, and farm operations efficiently.</p>
                        
                        <h3 style="color: #1b5e20;">🎯 Our Mission</h3>
                        <p style="color: #666; line-height: 1.8;">To empower farmers with digital tools and information to increase productivity, reduce costs, and improve decision-making in agriculture.</p>
                        
                        <h3 style="color: #1b5e20;">✨ Key Features</h3>
                        <ul style="color: #666; line-height: 2;">
                            <li>📊 Crop Management - Track your crops from planting to harvest</li>
                            <li>🐄 Livestock Management - Manage your animals' health and productivity</li>
                            <li>🌤️ Weather Information - Get real-time weather updates for your location</li>
                            <li>📈 Market Prices - Stay updated with current market prices</li>
                            <li>📚 Farming Guides - Access expert farming tips and techniques</li>
                            <li>📢 Announcements - Get important updates and news</li>
                        </ul>

                        <h3 style="color: #1b5e20;">📞 Contact Us</h3>
                        <p style="color: #666;">Email: support@manalonapp.com<br>Phone: +1 (555) 123-4567<br>Website: www.manalonapp.com</p>
                    </div>
                </div>

                <!-- PROFILE SECTION -->
                <div id="profile" class="content-section">
                    <h1 class="page-title">👤 My Profile</h1>
                    
                    <div style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.08);">
                        <div style="display: flex; align-items: center; margin-bottom: 30px;">
                            <div class="avatar" style="width: 80px; height: 80px; font-size: 32px; margin-right: 20px;"><?php echo e(substr(session('user.name') ?? 'F', 0, 1)); ?></div>
                            <div>
                                <h2 style="margin: 0; color: #1b5e20;"><?php echo e(session('user.name') ?? 'Farmer'); ?></h2>
                                <p style="margin: 5px 0 0 0; color: #666;"><?php echo e(session('user')->email ?? 'farmer@mannalon.com'); ?></p>
                            </div>
                        </div>

                        <h3 style="color: #1b5e20; margin-top: 30px;">Farm Information</h3>
                        <table style="width: 100%; margin-top: 15px;">
                            <tr>
                                <td style="padding: 10px; color: #666; font-weight: bold;">Farm Name:</td>
                                <td style="padding: 10px; color: #333;">Green Valley Farm</td>
                            </tr>
                            <tr style="background: #f9f9f9;">
                                <td style="padding: 10px; color: #666; font-weight: bold;">Total Area:</td>
                                <td style="padding: 10px; color: #333;">24.5 acres</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px; color: #666; font-weight: bold;">Member Since:</td>
                                <td style="padding: 10px; color: #333;">January 2025</td>
                            </tr>
                            <tr style="background: #f9f9f9;">
                                <td style="padding: 10px; color: #666; font-weight: bold;">Location:</td>
                                <td style="padding: 10px; color: #333;">Rural County, State</td>
                            </tr>
                        </table>

                        <h3 style="color: #1b5e20; margin-top: 30px;">Account Settings</h3>
                        <button class="btn-primary" style="margin-top: 15px;">✏️ Edit Profile</button>
                        <button class="btn-primary" style="margin-top: 15px; background-color: #ff9800;">🔐 Change Password</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showSection(sectionId) {
            // Hide all sections
            const sections = document.querySelectorAll('.content-section');
            sections.forEach(section => {
                section.classList.remove('active');
            });

            // Show selected section
            const selectedSection = document.getElementById(sectionId);
            if (selectedSection) {
                selectedSection.classList.add('active');
            }

            // Update active nav link
            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                link.classList.remove('active');
            });
            event.target.closest('.nav-link').classList.add('active');
        }
    </script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\Mannalon_App\resources\views\dashboard\farmer-dashboard.blade.php ENDPATH**/ ?>