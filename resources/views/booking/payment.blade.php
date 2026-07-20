<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran DANA - Gading Rental</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Anton&family=Inter:wght@400;500;600;700&display=swap');
        
        :root {
            --ink: #15140f;
            --ink-soft: #4a483c;
            --paper: #faf7f0;
            --paper-soft: #f2efe6;
            --accent: #ff472e;
            --accent-dark: #e03720;
            --line: #dedac8;
            --brand-font: 'Anton', sans-serif;
            --text-font: 'Inter', sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--text-font);
            background-color: var(--paper);
            color: var(--ink);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 24px;
        }

        .payment-card {
            background: #fff;
            max-width: 440px;
            width: 100%;
            border-radius: 16px;
            padding: 36px 28px;
            box-shadow: 0 12px 40px rgba(0,0,0,0.06);
            text-align: center;
        }

        .payment-card h1 {
            font-family: var(--brand-font);
            font-size: 2.2rem;
            text-transform: lowercase;
            margin-bottom: 8px;
        }
        
        .payment-card h1 span {
            color: var(--accent);
        }

        .payment-card p.subtitle {
            color: var(--ink-soft);
            font-size: 0.95rem;
            margin-bottom: 24px;
        }

        .order-summary {
            background: var(--paper-soft);
            padding: 16px;
            border-radius: 12px;
            margin-bottom: 24px;
            text-align: left;
            font-size: 0.9rem;
            line-height: 1.5;
        }

        .order-summary p {
            margin-bottom: 6px;
            color: var(--ink-soft);
        }

        .order-summary p strong {
            color: var(--ink);
        }

        .total-price {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--accent);
            text-align: center;
            margin-top: 16px;
            font-family: var(--brand-font);
            letter-spacing: 0.05em;
        }

        .qr-container {
            margin: 24px 0;
            padding: 20px;
            border: 2px dashed var(--line);
            border-radius: 16px;
            background: #fff;
        }

        .qr-container img {
            max-width: 250px;
            width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .qr-container p {
            margin-top: 16px;
            font-size: 0.85rem;
            color: var(--ink-soft);
        }

        .btn {
            display: inline-block;
            width: 100%;
            padding: 14px 24px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.95rem;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            border: none;
            transition: all .2s ease;
            margin-top: 12px;
        }

        .btn-primary {
            background: var(--accent);
            color: #fff;
        }

        .btn-primary:hover {
            background: var(--accent-dark);
            transform: translateY(-2px);
        }

        .btn-ghost {
            background: transparent;
            color: var(--ink-soft);
            border: 1px solid var(--line);
        }

        .btn-ghost:hover {
            background: var(--paper-soft);
            color: var(--ink);
        }
    </style>
</head>
<body>
    <div class="payment-card">
        <h1>gading<span>rental</span></h1>
        <p class="subtitle">Selesaikan Pembayaran Anda</p>

        <div class="order-summary">
            <p><strong>ID Pesanan:</strong> {{ session('payment_ref') }}</p>
            <p><strong>Daftar Alat:</strong> {{ session('payment_items') }}</p>
            <div class="total-price">
                Rp {{ session('payment_total') ? number_format(session('payment_total'), 0, ',', '.') : 0 }}
            </div>
        </div>

        <div class="qr-container">
            <img src="{{ asset('img/qrcode.jpeg') }}" alt="QR Code DANA">
            <p>Scan QR Code di atas menggunakan aplikasi DANA untuk melakukan pembayaran secara instan.</p>
        </div>

        <form action="{{ route('booking.confirm') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Saya Sudah Transfer</button>
        </form>
        
        <a href="{{ route('katalog') }}" class="btn btn-ghost">Kembali ke Katalog</a>
    </div>
</body>
</html>
