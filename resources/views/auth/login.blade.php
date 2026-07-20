<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Gading Rental</title>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --ink: #15140f;
            --ink-soft: #4a473e;
            --paper: #faf7f0;
            --paper-soft: #f0ebdf;
            --line: rgba(21, 20, 15, 0.12);
            --accent: #ff4d2e;
            --accent-dark: #c43417;
            --radius: 14px;
            --shadow: 0 14px 40px -16px rgba(21, 20, 15, 0.25);
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            background: var(--paper);
            color: var(--ink);
            font-family: 'Inter', system-ui, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .auth-card {
            background: #fff;
            padding: 40px;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            width: 100%;
            max-width: 400px;
            border: 1px solid var(--line);
        }
        .auth-card h1 {
            font-family: 'Anton', sans-serif;
            font-size: 2rem;
            margin: 0 0 10px 0;
            text-transform: lowercase;
            letter-spacing: 0.01em;
            text-align: center;
        }
        .auth-card h1 span { color: var(--accent); }
        .auth-card p {
            text-align: center;
            color: var(--ink-soft);
            margin: 0 0 30px 0;
            font-size: 0.9rem;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 0.85rem;
            font-weight: 600;
        }
        .form-group input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--line);
            border-radius: 8px;
            font-family: inherit;
            font-size: 0.9rem;
            transition: border-color .2s;
        }
        .form-group input:focus {
            outline: none;
            border-color: var(--accent);
        }
        .error {
            color: var(--accent);
            font-size: 0.8rem;
            margin-top: 5px;
            display: block;
        }
        .btn-primary {
            display: block;
            width: 100%;
            background: var(--accent);
            color: #fff;
            padding: 14px;
            border: none;
            border-radius: 999px;
            font-weight: 700;
            font-size: 0.9rem;
            cursor: pointer;
            transition: transform .2s, background .2s;
            margin-top: 10px;
        }
        .btn-primary:hover {
            background: var(--accent-dark);
            transform: translateY(-2px);
        }
        .footer-link {
            text-align: center;
            margin-top: 24px;
            font-size: 0.85rem;
            color: var(--ink-soft);
        }
        .footer-link a {
            color: var(--ink);
            font-weight: 600;
            text-decoration: none;
        }
        .footer-link a:hover {
            text-decoration: underline;
        }
        .alert-success {
            background: #e6f4ea;
            color: #1e8e3e;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 0.85rem;
            font-weight: 500;
            text-align: center;
            border: 1px solid #cce8d6;
        }
    </style>
</head>
<body>
    <div class="auth-card">
        <h1>gading<span>rental</span></h1>
        <p>Masuk ke akun Anda untuk menyewa alat.</p>
        
        @if(session('success'))
            <div class="alert-success">
                ✓ {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Alamat Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus placeholder="email@contoh.com">
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required placeholder="••••••••">
                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn-primary">Masuk</button>
        </form>

        <div class="footer-link">
            Belum punya akun? <a href="{{ route('register') }}">Daftar Sekarang</a>
        </div>
    </div>
</body>
</html>
