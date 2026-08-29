<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Admin Dashboard') — Divyansh Portfolio</title>
  <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=DM+Mono:wght@400;500&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    :root {
      --bg: #0f1016;
      --sidebar: #171822;
      --card: #1f202e;
      --card-border: rgba(255, 255, 255, 0.1);
      --text: #f0f0f5;
      --text-muted: #9596a8;
      --cobalt: #4558ff;
      --lime: #d8ff45;
      --orange: #ff6b35;
      --pink: #ff8fbc;
      --sky: #8ddcff;
      --danger: #ef4444;
      --success: #10b981;
    }
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      background: var(--bg);
      color: var(--text);
      font-family: 'Manrope', sans-serif;
      min-height: 100vh;
      display: flex;
    }
    a { color: inherit; text-decoration: none; }
    .mono { font-family: 'DM Mono', monospace; }

    /* Layout */
    .sidebar {
      width: 260px;
      background: var(--sidebar);
      border-right: 1px solid var(--card-border);
      display: flex;
      flex-direction: column;
      position: fixed;
      top: 0;
      bottom: 0;
      left: 0;
      z-index: 100;
    }
    .main-content {
      margin-left: 260px;
      flex: 1;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
    .brand {
      padding: 24px;
      font-family: 'Bricolage Grotesque', sans-serif;
      font-size: 20px;
      font-weight: 800;
      display: flex;
      align-items: center;
      gap: 10px;
      border-bottom: 1px solid var(--card-border);
    }
    .brand i {
      width: 12px;
      height: 12px;
      background: var(--orange);
      border-radius: 50%;
      box-shadow: 6px 0 0 var(--lime);
    }
    .nav-menu {
      padding: 20px 12px;
      flex: 1;
      display: flex;
      flex-direction: column;
      gap: 6px;
    }
    .nav-item {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 11px 16px;
      border-radius: 6px;
      font-size: 14px;
      font-weight: 600;
      color: var(--text-muted);
      transition: all 0.2s;
    }
    .nav-item:hover, .nav-item.active {
      background: var(--card);
      color: var(--text);
    }
    .nav-item.active {
      border-left: 3px solid var(--lime);
      color: #fff;
    }
    .badge {
      background: var(--orange);
      color: #fff;
      font-size: 11px;
      padding: 2px 7px;
      border-radius: 99px;
      font-family: 'DM Mono', monospace;
      font-weight: bold;
    }
    .user-footer {
      padding: 16px 20px;
      border-top: 1px solid var(--card-border);
      display: flex;
      align-items: center;
      justify-content: space-between;
      font-size: 13px;
    }
    .topbar {
      height: 70px;
      background: var(--sidebar);
      border-bottom: 1px solid var(--card-border);
      padding: 0 32px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .topbar h1 {
      font-size: 20px;
      font-family: 'Bricolage Grotesque', sans-serif;
      letter-spacing: -0.03em;
    }
    .content-body {
      padding: 32px;
      flex: 1;
    }

    /* UI Components */
    .btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 9px 16px;
      font-size: 13px;
      font-weight: 600;
      font-family: 'DM Mono', monospace;
      border-radius: 4px;
      border: 1px solid transparent;
      cursor: pointer;
      transition: all 0.2s;
      text-transform: uppercase;
      letter-spacing: 0.04em;
    }
    .btn-primary { background: var(--cobalt); color: #fff; }
    .btn-primary:hover { background: #3446eb; }
    .btn-lime { background: var(--lime); color: #111; }
    .btn-lime:hover { background: #c6ee38; }
    .btn-danger { background: var(--danger); color: #fff; }
    .btn-danger:hover { background: #dc2626; }
    .btn-secondary { background: var(--card); color: var(--text); border-color: var(--card-border); }
    .btn-secondary:hover { background: #27283b; }

    .card-box {
      background: var(--card);
      border: 1px solid var(--card-border);
      border-radius: 8px;
      padding: 24px;
      margin-bottom: 24px;
    }
    .card-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }
    .card-title {
      font-family: 'Bricolage Grotesque', sans-serif;
      font-size: 18px;
      font-weight: 700;
    }

    .grid-stats {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 20px;
      margin-bottom: 28px;
    }
    .stat-card {
      background: var(--card);
      border: 1px solid var(--card-border);
      padding: 20px;
      border-radius: 8px;
      position: relative;
      overflow: hidden;
    }
    .stat-card:before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 3px;
      background: var(--cobalt);
    }
    .stat-card.lime:before { background: var(--lime); }
    .stat-card.orange:before { background: var(--orange); }
    .stat-card.pink:before { background: var(--pink); }
    .stat-num {
      font-size: 32px;
      font-weight: 800;
      font-family: 'Bricolage Grotesque', sans-serif;
      margin-top: 8px;
    }
    .stat-label {
      color: var(--text-muted);
      font-size: 13px;
      text-transform: uppercase;
      font-family: 'DM Mono', monospace;
    }

    /* Tables */
    .table-responsive {
      overflow-x: auto;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      text-align: left;
      font-size: 14px;
    }
    th {
      padding: 12px 16px;
      border-bottom: 1px solid var(--card-border);
      color: var(--text-muted);
      font-family: 'DM Mono', monospace;
      font-size: 11px;
      text-transform: uppercase;
      letter-spacing: 0.05em;
    }
    td {
      padding: 16px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }
    tr:hover td {
      background: rgba(255, 255, 255, 0.02);
    }
    .action-links {
      display: flex;
      gap: 8px;
    }

    /* Forms */
    .form-group {
      margin-bottom: 20px;
    }
    .form-label {
      display: block;
      margin-bottom: 8px;
      font-size: 12px;
      text-transform: uppercase;
      font-family: 'DM Mono', monospace;
      color: var(--text-muted);
    }
    .form-control {
      width: 100%;
      padding: 11px 14px;
      background: #151620;
      border: 1px solid var(--card-border);
      color: #fff;
      border-radius: 4px;
      font-size: 14px;
      font-family: inherit;
      outline: none;
    }
    .form-control:focus {
      border-color: var(--cobalt);
      box-shadow: 0 0 0 2px rgba(69, 88, 255, 0.2);
    }
    textarea.form-control {
      min-height: 110px;
      resize: vertical;
    }
    .form-check {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    /* Alerts */
    .alert {
      padding: 14px 18px;
      border-radius: 6px;
      font-size: 14px;
      margin-bottom: 20px;
      font-weight: 500;
    }
    .alert-success { background: rgba(16, 185, 129, 0.15); border: 1px solid #10b981; color: #a7f3d0; }
    .alert-danger { background: rgba(239, 68, 68, 0.15); border: 1px solid #ef4444; color: #fca5a5; }

    @media (max-width: 900px) {
      .sidebar { display: none; }
      .main-content { margin-left: 0; }
    }
  </style>
  @stack('styles')
</head>
<body>
  <!-- Sidebar -->
  <aside class="sidebar">
    <a href="{{ route('admin.dashboard') }}" class="brand">
      <i></i> divyansh. <span class="mono" style="font-size: 11px; color: var(--lime);">CMS</span>
    </a>

    <nav class="nav-menu">
      <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <span>Dashboard</span>
      </a>
      <a href="{{ route('admin.projects.index') }}" class="nav-item {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
        <span>Projects</span>
      </a>
      <a href="{{ route('admin.experiences.index') }}" class="nav-item {{ request()->routeIs('admin.experiences.*') ? 'active' : '' }}">
        <span>Experience</span>
      </a>
      <a href="{{ route('admin.skills.index') }}" class="nav-item {{ request()->routeIs('admin.skills.*') ? 'active' : '' }}">
        <span>Toolkit / Skills</span>
      </a>
      <a href="{{ route('admin.messages.index') }}" class="nav-item {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
        <span>Messages</span>
        @php
          $unreadCount = \App\Models\ContactMessage::where('is_read', false)->count();
        @endphp
        @if($unreadCount > 0)
          <span class="badge">{{ $unreadCount }}</span>
        @endif
      </a>
      <a href="{{ route('admin.settings.index') }}" class="nav-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
        <span>Settings & Bio</span>
      </a>
    </nav>

    <div class="user-footer">
      <div>
        <div style="font-weight: 700; color: #fff;">{{ Auth::user()->name }}</div>
        <div class="mono" style="font-size: 11px; color: var(--text-muted);">{{ Auth::user()->email }}</div>
      </div>
      <form action="{{ route('admin.logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-secondary" style="padding: 6px 10px; font-size: 11px;">Logout</button>
      </form>
    </div>
  </aside>

  <!-- Main Content Wrapper -->
  <div class="main-content">
    <header class="topbar">
      <h1>@yield('title', 'Admin Panel')</h1>
      <div style="display: flex; gap: 12px; align-items: center;">
        <a href="{{ route('portfolio.home') }}" target="_blank" class="btn btn-secondary">
          View Website ↗
        </a>
      </div>
    </header>

    <main class="content-body">
      @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
      @endif

      @if(session('status'))
        <div class="alert alert-success">
          {{ session('status') }}
        </div>
      @endif

      @if(session('error'))
        <div class="alert alert-danger">
          {{ session('error') }}
        </div>
      @endif

      @if($errors->any())
        <div class="alert alert-danger">
          <ul style="margin: 0; padding-left: 20px;">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      @yield('content')
    </main>
  </div>
  @stack('scripts')
</body>
</html>

