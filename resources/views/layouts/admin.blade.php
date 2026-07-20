<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <style>
        :root {
            --primary: #ff4d2e;
            --primary-hover: #c43417;
            --bg-color: #faf7f0;
            --sidebar-bg: #f0ebdf;
            --text-main: #15140f;
            --text-muted: #4a473e;
            --line: rgba(21, 20, 15, 0.12);
            --radius: 14px;
            --shadow: 0 14px 40px -16px rgba(21, 20, 15, 0.25);
            --danger: #ff4444;
            --success: #1e8e3e;
        }
        
        * { box-sizing: border-box; }
        
        body {
            margin: 0;
            background: var(--bg-color);
            color: var(--text-main);
            font-family: 'Inter', system-ui, sans-serif;
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 250px;
            background: var(--sidebar-bg);
            border-right: 1px solid var(--line);
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
            z-index: 100;
        }
        
        .brand {
            height: 80px;
            display: flex;
            align-items: center;
            padding: 0 30px;
            font-family: 'Anton', sans-serif;
            font-size: 1.8rem;
            color: var(--text-main);
            letter-spacing: 1px;
        }
        
        .brand span {
            color: var(--primary);
        }

        .menu-title {
            font-size: 0.75rem;
            text-transform: uppercase;
            font-weight: 700;
            color: var(--text-muted);
            margin: 20px 30px 10px;
            letter-spacing: 1px;
        }

        .nav-list {
            list-style: none;
            padding: 0 15px;
            margin: 0;
        }

        .nav-item {
            margin-bottom: 5px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: var(--text-muted);
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.2s;
            gap: 12px;
        }

        .nav-link:hover {
            color: var(--primary);
            background: rgba(0, 86, 255, 0.05);
        }

        .nav-link.active {
            background: var(--primary);
            color: #fff;
            box-shadow: 0 4px 12px rgba(255, 77, 46, 0.3);
        }

        .nav-link .material-symbols-outlined {
            font-size: 1.3rem;
        }

        .nav-logout {
            margin-top: auto;
            padding: 20px;
            border-top: 1px solid var(--line);
        }
        .nav-logout .nav-link {
            color: var(--danger);
        }
        .nav-logout .nav-link:hover {
            background: rgba(255,68,68,0.1);
        }

        /* MAIN CONTENT */
        .main-content {
            margin-left: 250px;
            flex: 1;
            display: flex;
            flex-direction: column;
            width: calc(100% - 250px);
        }

        /* TOPBAR */
        .topbar {
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            background: var(--bg-color); /* Match background */
            position: sticky;
            top: 0;
            z-index: 90;
        }

        .topbar h1 {
            font-size: 1.8rem;
            margin: 0;
            font-weight: 700;
            color: var(--text-main);
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .search-box {
            background: #fff;
            border-radius: 999px;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: var(--shadow);
            width: 300px;
        }

        .search-box input {
            border: none;
            outline: none;
            background: transparent;
            width: 100%;
            font-family: inherit;
            font-size: 0.9rem;
            color: var(--text-main);
        }
        
        .search-box input::placeholder {
            color: var(--text-muted);
        }

        .search-box .material-symbols-outlined {
            color: var(--text-muted);
            font-size: 1.2rem;
        }

        .icon-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            text-decoration: none;
            box-shadow: var(--shadow);
            transition: all 0.2s;
        }

        .icon-btn:hover {
            color: var(--primary);
        }

        .profile-info {
            display: flex;
            align-items: center;
            gap: 12px;
            background: #fff;
            padding: 6px 12px 6px 6px;
            border-radius: 999px;
            box-shadow: var(--shadow);
        }

        .profile-info img {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            object-fit: cover;
        }

        .profile-text {
            display: flex;
            flex-direction: column;
            margin-right: 10px;
        }

        .profile-name {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--text-main);
        }
        
        .profile-role {
            font-size: 0.7rem;
            color: var(--text-muted);
        }

        /* PAGE CONTENT WRAPPER */
        .page-content {
            padding: 0 30px 30px;
            flex: 1;
        }
        
        /* UTILITIES for internal pages */
        .card {
            background: #fff;
            border-radius: var(--radius);
            padding: 24px;
            box-shadow: var(--shadow);
        }
        
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-main);
            margin: 0;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all .2s;
            border: none;
            gap: 8px;
        }
        .btn-primary {
            background: var(--primary);
            color: #fff;
        }
        .btn-primary:hover {
            background: var(--primary-hover);
        }
        .btn-success {
            background: var(--success);
            color: #fff;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 16px;
            text-align: left;
            border-bottom: 1px solid var(--line);
            font-size: 0.9rem;
        }
        th {
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
        }
        tr:last-child td { border-bottom: none; }
        
        .badge {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 700;
        }
        .badge-success { background: rgba(5,205,153,0.1); color: var(--success); }
        .badge-warning { background: rgba(255,167,38,0.1); color: #ffa726; }
        .badge-danger { background: rgba(255,68,68,0.1); color: var(--danger); }

    </style>
    @stack('styles')
</head>
<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="brand">
            Gading<span>Admin</span>
        </div>
        
        <div class="menu-title">Menu Utama</div>
        <ul class="nav-list">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <span class="material-symbols-outlined">dashboard</span>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('equipment.index') }}" class="nav-link {{ request()->routeIs('equipment.*') ? 'active' : '' }}">
                    <span class="material-symbols-outlined">inventory_2</span>
                    Manajemen Alat
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.bookings') }}" class="nav-link {{ request()->routeIs('admin.bookings') ? 'active' : '' }}">
                    <span class="material-symbols-outlined">receipt_long</span>
                    Riwayat Pesanan
                </a>
            </li>
        </ul>

        <div class="menu-title">Sistem</div>
        <ul class="nav-list">
            <li class="nav-item">
                <a href="{{ url('/') }}" target="_blank" class="nav-link">
                    <span class="material-symbols-outlined">open_in_new</span>
                    Lihat Web Depan
                </a>
            </li>
        </ul>

        <div class="nav-logout">
            <form action="{{ route('logout') }}" method="POST" id="logoutForm">
                @csrf
                <a href="#" onclick="document.getElementById('logoutForm').submit()" class="nav-link">
                    <span class="material-symbols-outlined">logout</span>
                    Log Out
                </a>
            </form>
        </div>
    </aside>

    <!-- MAIN -->
    <main class="main-content">
        <!-- TOPBAR -->
        <header class="topbar">
            <h1>@yield('page_title', 'Dashboard')</h1>
            
            <div class="topbar-right">
                <div class="search-box">
                    <span class="material-symbols-outlined">search</span>
                    <input type="text" placeholder="Cari sesuatu...">
                </div>
                
                <a href="#" class="icon-btn">
                    <span class="material-symbols-outlined">notifications</span>
                </a>

                <div class="profile-info">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'Admin') }}&background=ff4d2e&color=fff" alt="Profile">
                    <div class="profile-text">
                        <span class="profile-name">{{ Auth::user()->name ?? 'Administrator' }}</span>
                        <span class="profile-role">Admin</span>
                    </div>
                </div>
            </div>
        </header>

        <!-- PAGE CONTENT -->
        <div class="page-content">
            @if(session('success'))
                <div style="background: rgba(5,205,153,0.1); color: var(--success); padding: 15px 20px; border-radius: var(--radius); margin-bottom: 20px; font-weight: 600; font-size: 0.9rem;">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div style="background: rgba(255,68,68,0.1); color: var(--danger); padding: 15px 20px; border-radius: var(--radius); margin-bottom: 20px; font-weight: 600; font-size: 0.9rem;">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    @stack('scripts')
</body>
</html>
