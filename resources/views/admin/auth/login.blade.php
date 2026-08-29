<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login — Divyansh Portfolio</title>
  <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:wght@700;800&family=DM+Mono:wght@500&family=Manrope:wght@400;600&display=swap" rel="stylesheet">
  <style>
    :root {
      --bg: #0f1016;
      --card: #171822;
      --border: rgba(255, 255, 255, 0.1);
      --cobalt: #4558ff;
      --lime: #d8ff45;
      --orange: #ff6b35;
      --text: #f0f0f5;
      --muted: #9596a8;
    }
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      background: var(--bg);
      background-image: radial-gradient(rgba(69, 88, 255, 0.12) 1px, transparent 1px);
      background-size: 32px 32px;
      color: var(--text);
      font-family: 'Manrope', sans-serif;
      min-height: 100vh;
      display: grid;
      place-items: center;
      padding: 20px;
    }
    .mono { font-family: 'DM Mono', monospace; }
    .login-box {
      width: 100%;
      max-width: 440px;
      background: var(--card);
      border: 1.5px solid var(--border);
      border-radius: 12px;
      padding: 40px;
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.6);
      position: relative;
    }
    .login-box:before {
      content: "";
      position: absolute;
      top: -2px; left: 20%; right: 20%;
      height: 3px;
      background: linear-gradient(90deg, var(--orange), var(--lime), var(--cobalt));
    }
    .logo {
      font-family: 'Bricolage Grotesque', sans-serif;
      font-size: 24px;
      font-weight: 800;
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 24px;
    }
    .logo i {
      width: 14px;
      height: 14px;
      background: var(--orange);
      border-radius: 50%;
      box-shadow: 6px 0 0 var(--lime);
    }
    h2 {
      font-family: 'Bricolage Grotesque', sans-serif;
      font-size: 22px;
      margin-bottom: 8px;
    }
    p.subtitle {
      color: var(--muted);
      font-size: 14px;
      margin-bottom: 28px;
    }
    .form-group {
      margin-bottom: 20px;
    }
    label {
      display: block;
      margin-bottom: 8px;
      font-size: 12px;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      color: var(--muted);
    }
    input[type="email"], input[type="password"] {
      width: 100%;
      padding: 12px 16px;
      background: #11121a;
      border: 1px solid var(--border);
      border-radius: 6px;
      color: #fff;
      font-size: 15px;
      outline: none;
    }
    input[type="email"]:focus, input[type="password"]:focus {
      border-color: var(--cobalt);
      box-shadow: 0 0 0 3px rgba(69, 88, 255, 0.25);
    }
    .remember-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 13px;
      margin-bottom: 24px;
      color: var(--muted);
    }
    .btn-login {
      width: 100%;
      padding: 13px;
      background: var(--lime);
      color: #111;
      border: none;
      border-radius: 6px;
      font-family: 'DM Mono', monospace;
      font-weight: 700;
      font-size: 14px;
      text-transform: uppercase;
      letter-spacing: 0.06em;
      cursor: pointer;
      transition: 0.2s;
    }
    .btn-login:hover {
      background: #c7f235;
      box-shadow: 0 4px 15px rgba(216, 255, 69, 0.3);
    }
    .alert {
      padding: 12px 16px;
      border-radius: 6px;
      font-size: 13px;
      margin-bottom: 20px;
    }
    .alert-danger {
      background: rgba(239, 68, 68, 0.15);
      border: 1px solid #ef4444;
      color: #fca5a5;
    }
    .alert-success {
      background: rgba(16, 185, 129, 0.15);
      border: 1px solid #10b981;
      color: #a7f3d0;
    }
    .back-link {
      display: block;
      text-align: center;
      margin-top: 24px;
      font-size: 13px;
      color: var(--muted);
      text-decoration: none;
    }
    .back-link:hover { color: #fff; }
  </style>
</head>
<body>
  <div class="login-box">
    <div class="logo">
      <i></i> divyansh. <span class="mono" style="font-size: 11px; color: var(--lime);">CMS</span>
    </div>

    <h2>Admin Sign In</h2>
    <p class="subtitle">Enter your credentials to access the portfolio dashboard.</p>

    @if(session('status'))
      <div class="alert alert-success">
        {{ session('status') }}
      </div>
    @endif

    @if($errors->any())
      <div class="alert alert-danger">
        <ul style="margin: 0; padding-left: 18px;">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('admin.login.submit') }}" method="POST">
      @csrf
      <div class="form-group">
        <label for="email" class="mono">Email Address</label>
        <input type="email" name="email" id="email" value="{{ old('email', 'admin@divyansh.dev') }}" required autofocus />
      </div>

      <div class="form-group">
        <label for="password" class="mono">Password</label>
        <input type="password" name="password" id="password" required />
      </div>

      <div class="remember-row">
        <label style="display: flex; align-items: center; gap: 8px; margin: 0; cursor: pointer; text-transform: none;">
          <input type="checkbox" name="remember" value="1"> Remember me
        </label>
      </div>

      <button type="submit" class="btn-login">Sign In ↗</button>
    </form>

    <a href="{{ route('portfolio.home') }}" class="back-link">← Return to public portfolio</a>
  </div>
</body>
</html>

