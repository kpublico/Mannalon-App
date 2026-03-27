<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Mannalon App</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        .navbar {
            background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);
            color: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .navbar h1 {
            font-size: 1.5rem;
        }

        .nav-right {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
            align-items: center;
        }

        .nav-links a, .nav-links button {
            color: white;
            text-decoration: none;
            transition: opacity 0.3s;
            background: transparent;
            border: none;
            cursor: pointer;
            font-size: 1rem;
        }

        .nav-links a:hover, .nav-links button:hover {
            opacity: 0.8;
        }

        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .main-content {
            display: flex;
            gap: 2rem;
        }

        .sidebar {
            width: 250px;
            background: white;
            padding: 1.5rem;
            border-left: 4px solid #10b981;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            height: fit-content;
        }

        .sidebar h3 {
            color: #10b981;
            margin-bottom: 1rem;
            font-size: 1.1rem;
            font-weight: 600;
        }

        .sidebar ul {
            list-style: none;
        }

        .sidebar li {
            margin: 0.75rem 0;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            color: #1f2937;
            text-decoration: none;
            border-radius: 6px;
            transition: all 0.3s;
            font-size: 0.95rem;
            font-weight: 500;
            white-space: nowrap;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #d1fae5;
            color: #059669;
            border-left: 3px solid #10b981;
            padding-left: calc(1rem - 3px);
        }

        .content {
            flex: 1;
        }

        .card {
            background: white;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 1.5rem;
        }

        .card h2 {
            color: #2ecc71;
            margin-bottom: 1rem;
            border-bottom: 2px solid #2ecc71;
            padding-bottom: 0.5rem;
        }

        .card h3 {
            color: #2ecc71;
            margin-bottom: 0.5rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stat-box {
            background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);
            color: white;
            padding: 1.5rem;
            border-radius: 8px;
            text-align: center;
        }

        .stat-box h3 {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            color: white;
        }

        .stat-box p {
            opacity: 0.9;
            font-size: 0.9rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        table thead {
            background-color: #f0f0f0;
            border-bottom: 2px solid #2ecc71;
        }

        table th, table td {
            padding: 0.75rem;
            text-align: left;
        }

        table tbody tr:hover {
            background-color: #f9f9f9;
        }

        table tbody tr:nth-child(even) {
            background-color: #f5f5f5;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: #555;
            font-weight: 500;
        }

        input, textarea, select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }

        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: #2ecc71;
            box-shadow: 0 0 5px rgba(46, 204, 113, 0.3);
        }

        button {
            background-color: #2ecc71;
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #27ae60;
        }

        .alert {
            padding: 1rem;
            border-radius: 4px;
            margin-bottom: 1rem;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        footer {
            text-align: center;
            padding: 2rem;
            color: #666;
            margin-top: 3rem;
        }

        select {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1>🌾 Mannalon App - Farmer Management System</h1>
        <div class="nav-right">
            <ul class="nav-links">
                <li>
                    @auth
                        <span>{{ auth()->user()->name }} ({{ ucfirst(auth()->user()->role) }})</span>
                    @endauth
                </li>
                @auth
                    <li>
                        <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('dashboard') }}">Dashboard</a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </li>
                @endauth
                @guest
                    <li><a href="{{ route('login') }}">Login</a></li>
                @endguest
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="main-content">
            <aside class="sidebar">
                @auth
                    @if(auth()->user()->isAdmin())
                        <h3>Admin Menu</h3>
                        <ul>
                            <li><a href="{{ route('admin.dashboard') }}">📊 Dashboard</a></li>
                            <li><a href="{{ route('admin.farmers.index') }}">👨‍🌾 Farmers</a></li>
                            <li><a href="{{ route('admin.crops.index') }}">🌾 Crops</a></li>
                            <li><a href="{{ route('admin.livestock.index') }}">🐄 Livestock</a></li>
                            <li><a href="{{ route('admin.analytics') }}">📈 Analytics</a></li>
                            <li><a href="{{ route('admin.settings') }}">⚙️ Settings</a></li>
                        </ul>
                    @else
                        <h3>Farmer Menu</h3>
                        <ul>
                            <li><a href="{{ route('dashboard') }}">📊 Dashboard</a></li>
                            <li><a href="{{ route('crops.index') }}">🌾 My Crops</a></li>
                            <li><a href="{{ route('livestock.index') }}">🐄 My Livestock</a></li>
                            <li><a href="{{ route('weather.index') }}">🌤️ Weather</a></li>
                            <li><a href="{{ route('market-prices.index') }}">📈 Market Prices</a></li>
                            <li><a href="#">📚 Researches</a></li>
                            <li><a href="{{ route('profile') }}">👤 Profile</a></li>
                        </ul>
                    @endif
                @endauth
            </aside>

            <main class="content">
                @yield('content')
            </main>
        </div>
    </div>

    <footer>
        <p>&copy; 2026 Mannalon App - Supporting Farmers with Technology</p>
    </footer>
</body>
</html>
