<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gading Rental — Creative without Limit.</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Anton&family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap"
        rel="stylesheet">


    <style>
        /*untuk menyimpan warna dan nanti bisa di panggil di code lain */
        :root {
            --ink: #15140f;
            --ink-soft: #4a473e;
            --paper: #faf7f0;
            --paper-soft: #f0ebdf;
            --line: rgba(21, 20, 15, 0.12);
            --accent: #ff4d2e;
            --accent-dark: #c43417;
            --accent-soft: #ffe2d6;
            --violet: #6b5bd6;
            --amber: #d99a1f;
            --teal: #1f8a7a;
            --dark: #100f0c;
            --dark-2: #1a1812;
            --on-dark: #f3efe4;
            --on-dark-soft: #a7a294;
            --radius: 14px;
            --radius-lg: 26px;
            --maxw: 1240px;
            --shadow: 0 14px 40px -16px rgba(21, 20, 15, 0.25);
        }

        /* Aturan wajib agar ukuran semua elemen (asli maupun hiasan) tidak bengkak saat diberi padding/border */
        *,
        /*selector universal(untuk semua tag contoh <h1> <a> <span> <p> dll)*/
        *::before,
        *::after {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
            /*untuk membuat halaman scroll smooth*/
        }

        /* 
         Berfungsi sebagai tampilan utama (Front-End) untuk pengguna.
         File ini dapat menerima data dari Controller (seperti variabel $products)
         dan menampilkannya menggunakan sintaks Blade (@{{ $variabel }}).
         
         Catatan: Bagian HTML statis di bawah ini bisa diubah menjadi dinamis
         menggunakan perulangan seperti @@foreach jika datanya sudah tersedia dari database.
        */

        body {
            margin: 0;
            background: var(--paper);
            color: var(--ink);
            font-family: 'Inter', system-ui, sans-serif;
            -webkit-font-smoothing: antialiased;
            /*Untuk menghaluskan pinggiran teks (font) agar terlihat lebih tajam dan bersih */
            overflow-x: hidden;
        }

        img,
        svg {
            display: block;
            max-width: 100%;
        }

        a {
            color: inherit;
            /*Untuk membuat warna link mengikuti/mewarisi warna teks pembungkusnya (agar tidak otomatis biru) */
            text-decoration: none;
        }

        ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        h1,
        h2,
        h3,
        h4 {
            margin: 0;
        }

        p {
            margin: 0;
        }

        button {
            font: inherit;
            /*Untuk mengambil gaya font dari tag induknya (Supaya ukurannya seragam) */
            cursor: pointer;
        }

        .display {
            font-family: 'Anton', sans-serif;
            font-weight: 400;
            text-transform: uppercase;
            /*Untuk mengubah semua huruf menjadi besar (UPPERCASE) */
            letter-spacing: 0.01em;
            line-height: 0.98;
        }

        .mono {
            font-family: 'JetBrains Mono', monospace;
        }

        .eyebrow {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.72rem;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--accent-dark);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .eyebrow.on-dark {
            color: var(--accent);
        }

        .eyebrow::before {
            content: "";
            width: 18px;
            height: 1px;
            background: currentColor;
        }

        .wrap {
            max-width: var(--maxw);
            margin: 0 auto;
            padding: 0 28px;
        }

        :focus-visible {
            outline: 2px solid var(--accent-dark);
            outline-offset: 3px;
        }

        /* ---------- signature aperture icon ---------- */
        .aperture {
            fill: currentColor;
        }

        .spin-slow {
            animation: spin 30s linear infinite;
        }

        @media (prefers-reduced-motion: reduce) {
            .spin-slow {
                animation: none;
            }

            html {
                scroll-behavior: auto;
            }
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* ---------- ticker ---------- */
        .ticker {
            background: var(--dark);
            color: var(--on-dark);
            overflow: hidden;
            white-space: nowrap;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .ticker__track {
            display: inline-flex;
            align-items: center;
            gap: 48px;
            padding: 9px 0;
            animation: ticker 26s linear infinite;
        }

        .ticker__item {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.72rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--on-dark-soft);
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .ticker__item b {
            color: var(--on-dark);
            font-weight: 600;
        }

        .ticker__dot {
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background: var(--accent);
        }

        @keyframes ticker {
            from {
                transform: translateX(0);
            }

            to {
                transform: translateX(-50%);
            }
        }

        /* ---------- header ---------- */
        header.site {
            position: sticky;
            top: 0;
            z-index: 50;
            background: rgba(250, 247, 240, 0.85);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid transparent;
            transition: border-color .25s ease, box-shadow .25s ease;
        }

        header.site.scrolled {
            border-color: var(--line);
            box-shadow: 0 8px 24px -18px rgba(21, 20, 15, 0.4);
        }

        .nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 0;
        }

        .logo {
            font-family: 'Anton', sans-serif;
            font-size: 1.5rem;
            text-transform: lowercase;
            letter-spacing: 0.01em;
        }

        .logo span {
            color: var(--accent);
        }

        .nav__links {
            display: flex;
            gap: 34px;
            font-size: 0.88rem;
            font-weight: 600;
        }

        .nav__links a {
            position: relative;
            padding: 4px 0;
            color: var(--ink-soft);
            transition: color .2s ease;
        }

        .nav__links a:hover {
            color: var(--ink);
        }

        .nav__links a::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            height: 2px;
            width: 0;
            background: var(--accent);
            transition: width .25s ease;
        }

        .nav__links a:hover::after {
            width: 100%;
        }

        .nav__right {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .icon-btn {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--line);
            background: transparent;
            transition: background .2s ease, transform .2s ease;
        }

        .icon-btn:hover {
            background: var(--paper-soft);
            transform: translateY(-1px);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 22px;
            border-radius: 999px;
            font-size: 0.84rem;
            font-weight: 700;
            letter-spacing: 0.01em;
            border: 1px solid transparent;
            transition: transform .2s ease, box-shadow .2s ease, background .2s ease, color .2s ease;
        }

        .btn-primary {
            background: var(--accent);
            color: #fff;
            box-shadow: 0 10px 24px -10px rgba(255, 77, 46, 0.6);
        }

        .btn-primary:hover {
            background: var(--accent-dark);
            transform: translateY(-2px);
        }

        .btn-ghost {
            border-color: var(--line);
            color: var(--ink);
        }

        .btn-ghost:hover {
            border-color: var(--ink);
        }

        .btn-dark {
            background: var(--on-dark);
            color: var(--dark);
        }

        .btn-dark:hover {
            background: #fff;
            transform: translateY(-2px);
        }

        .hamburger {
            display: none;
            width: 38px;
            height: 38px;
            border: 1px solid var(--line);
            border-radius: 50%;
            background: transparent;
            align-items: center;
            justify-content: center;
        }

        .hamburger span,
        .hamburger span::before,
        .hamburger span::after {
            content: "";
            display: block;
            width: 16px;
            height: 2px;
            background: var(--ink);
            position: relative;
            transition: transform .2s ease, opacity .2s ease;
        }

        .hamburger span::before {
            position: absolute;
            top: -5px;
        }

        .hamburger span::after {
            position: absolute;
            top: 5px;
        }

        .mobile-nav {
            position: fixed;
            inset: 0;
            z-index: 60;
            background: var(--dark);
            color: var(--on-dark);
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 26px;
            padding: 40px;
            transform: translateY(-100%);
            transition: transform .35s ease;
        }

        .mobile-nav.open {
            transform: translateY(0);
        }

        .mobile-nav a {
            font-family: 'Anton', sans-serif;
            font-size: 2.1rem;
            text-transform: uppercase;
        }

        .mobile-nav__close {
            position: absolute;
            top: 24px;
            right: 24px;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, 0.25);
            background: transparent;
            color: var(--on-dark);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* ---------- hero ---------- */
        .hero {
            position: relative;
            min-height: 86vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background:
                radial-gradient(60% 60% at 78% 18%, rgba(255, 170, 60, 0.55), transparent 60%),
                radial-gradient(70% 60% at 14% 92%, rgba(255, 77, 46, 0.35), transparent 65%),
                linear-gradient(160deg, #1c1a2b 0%, #2c2238 32%, #5a3a3a 58%, #aa5a3a 78%, #ffb15a 100%);
            color: var(--on-dark);
            overflow: hidden;
            padding-top: 60px;
        }

        .hero::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(16, 15, 12, 0) 40%, rgba(16, 15, 12, 0.55) 100%);
            pointer-events: none;
        }

        .hero__aperture {
            position: absolute;
            right: -120px;
            top: -120px;
            width: 520px;
            height: 520px;
            color: rgba(255, 255, 255, 0.06);
        }

        .hero__aperture--two {
            position: absolute;
            left: -160px;
            bottom: -180px;
            width: 420px;
            height: 420px;
            color: rgba(255, 77, 46, 0.12);
        }

        .hero__inner {
            position: relative;
            z-index: 2;
            padding: 60px 0 80px;
        }

        .hero__title {
            font-size: clamp(2.8rem, 8vw, 6.6rem);
            max-width: 880px;
        }

        .hero__title em {
            font-style: normal;
            color: var(--accent);
        }

        .hero__sub {
            margin-top: 22px;
            max-width: 480px;
            font-size: 1.02rem;
            line-height: 1.6;
            color: var(--on-dark-soft);
        }

        .hero__cta {
            display: flex;
            align-items: center;
            gap: 18px;
            margin-top: 34px;
            flex-wrap: wrap;
        }

        .hero__rating {
            display: flex;
            align-items: center;
            gap: 10px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.78rem;
            color: var(--on-dark-soft);
        }

        .hero__rating b {
            color: var(--on-dark);
        }

        .hero__bottombar {
            position: relative;
            z-index: 2;
            border-top: 1px solid rgba(255, 255, 255, 0.15);
            background: rgba(16, 15, 12, 0.35);
            backdrop-filter: blur(6px);
        }

        .hero__stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            max-width: var(--maxw);
            margin: 0 auto;
        }

        .hero__stat {
            padding: 18px 28px;
            border-left: 1px solid rgba(255, 255, 255, 0.12);
        }

        .hero__stat:first-child {
            border-left: none;
        }

        .hero__stat b {
            display: block;
            font-family: 'Anton', sans-serif;
            font-size: 1.5rem;
        }

        .hero__stat span {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.68rem;
            letter-spacing: 0.06em;
            color: var(--on-dark-soft);
            text-transform: uppercase;
        }

        /* ---------- generic section ---------- */
        section {
            padding: 96px 0;
        }

        .section-head {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 24px;
            margin-bottom: 48px;
            flex-wrap: wrap;
        }

        .section-head h2 {
            font-size: clamp(2rem, 4vw, 3rem);
            max-width: 560px;
        }

        .section-head p {
            max-width: 380px;
            color: var(--ink-soft);
            font-size: 0.95rem;
            line-height: 1.6;
        }

        /* ---------- featured equipment ---------- */
        .catalog-group {
            margin-bottom: 56px;
        }

        .catalog-group:last-child {
            margin-bottom: 0;
        }

        .group-label {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 7px 16px 7px 12px;
            border-radius: 999px;
            margin-bottom: 22px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: #fff;
        }

        .group-label svg {
            width: 14px;
            height: 14px;
        }

        .group-label.c-trend {
            background: var(--accent);
        }

        .group-label.c-hype {
            background: var(--violet);
        }

        .group-label.c-hot {
            background: var(--amber);
        }

        .group-label.c-star {
            background: var(--teal);
        }

        .grid-products {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 16px;
        }

        .card {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: var(--radius);
            padding: 18px;
            display: flex;
            flex-direction: column;
            gap: 14px;
            transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow);
            border-color: transparent;
        }

        .card.is-selected {
            border-color: transparent;
            background: var(--ink);
            color: #fff;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.25);
        }

        .card.is-selected .card__price {
            color: #fff;
        }

        .card.is-selected .card__price span {
            color: rgba(255, 255, 255, 0.6);
        }

        .card.is-selected .card__add,
        .card.is-selected .card__remove {
            border-color: rgba(255, 255, 255, 0.2);
            color: #fff;
        }

        .card.is-selected .card__add:hover,
        .card.is-selected .card__remove:hover {
            background: #fff;
            color: var(--ink);
        }

        .card__plate {
            aspect-ratio: 1/1;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--tint, var(--paper-soft));
        }

        .card__plate svg {
            width: 38%;
            height: 38%;
            color: var(--tint-ink, var(--accent));
            opacity: 0.85;
        }

        .card__name {
            font-size: 0.86rem;
            font-weight: 700;
            line-height: 1.3;
            min-height: 2.6em;
        }

        .card__meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: auto;
        }

        .card__price {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.84rem;
            font-weight: 600;
            color: var(--accent-dark);
        }

        .card__price span {
            display: block;
            font-size: 0.6rem;
            color: var(--ink-soft);
            font-weight: 400;
            letter-spacing: 0.04em;
        }

        .card__add {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            border: 1px solid var(--line);
            display: flex;
            align-items: center;
            justify-content: center;
            background: transparent;
            transition: background .2s ease, border-color .2s ease, color .2s ease, transform .2s ease;
        }

        .card:hover .card__add {
            background: var(--ink);
            border-color: var(--ink);
            color: #fff;
            transform: rotate(90deg);
        }

        .card__add svg {
            width: 14px;
            height: 14px;
        }

        .day__add,
        .day__remove {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            background: transparent;
            color: #fff;
            transition: background .2s ease, color .2s ease;
        }

        .day__add:hover,
        .day__remove:hover {
            background: #fff;
            color: var(--ink);
        }

        .day__add svg,
        .day__remove svg {
            width: 14px;
            height: 14px;
        }

        .catalog-foot {
            display: flex;
            justify-content: center;
            margin-top: 50px;
        }

        /* ---------- promo banner ---------- */
        .promo {
            position: relative;
            border-radius: var(--radius-lg);
            overflow: hidden;
            background: linear-gradient(120deg, #0c1322 0%, #182b46 45%, #2c1d3e 100%);
            color: var(--on-dark);
            padding: 64px 48px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 32px;
            flex-wrap: wrap;
        }

        .promo::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image: radial-gradient(rgba(255, 255, 255, 0.5) 1px, transparent 1px);
            background-size: 26px 26px;
            opacity: 0.06;
        }

        .promo__aperture {
            position: absolute;
            right: -60px;
            bottom: -100px;
            width: 320px;
            height: 320px;
            color: rgba(255, 77, 46, 0.18);
        }

        .promo__copy {
            position: relative;
            z-index: 1;
            max-width: 520px;
        }

        .promo__tag {
            display: inline-block;
            background: var(--accent);
            color: #fff;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.7rem;
            letter-spacing: 0.1em;
            padding: 5px 12px;
            border-radius: 999px;
            text-transform: uppercase;
            margin-bottom: 14px;
        }

        .promo h3 {
            font-size: clamp(1.9rem, 4vw, 2.8rem);
        }

        .promo p {
            color: var(--on-dark-soft);
            margin-top: 12px;
            max-width: 420px;
            line-height: 1.6;
        }

        .promo__cta {
            position: relative;
            z-index: 1;
        }

        /* ---------- benefits ---------- */
        .benefits-top {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 48px;
            align-items: end;
            margin-bottom: 52px;
        }

        .benefits-top h2 {
            font-size: clamp(1.8rem, 3.4vw, 2.6rem);
            max-width: 480px;
        }

        .benefits-top p {
            color: var(--ink-soft);
            line-height: 1.7;
            font-size: 0.98rem;
        }

        .benefit-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .benefit-card {
            border: 1px solid var(--line);
            border-radius: var(--radius);
            padding: 32px 26px;
            background: #fff;
            transition: transform .25s ease, box-shadow .25s ease;
        }

        .benefit-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow);
        }

        .benefit-icon {
            width: 54px;
            height: 54px;
            border-radius: 14px;
            background: var(--ink);
            color: var(--on-dark);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 22px;
        }

        .benefit-icon svg {
            width: 26px;
            height: 26px;
        }

        .benefit-card h4 {
            font-size: 1.15rem;
            margin-bottom: 10px;
        }

        .benefit-card p {
            color: var(--ink-soft);
            font-size: 0.92rem;
            line-height: 1.65;
        }

        /* ---------- testimonials (dark, starfield) ---------- */
        .testimonials {
            background: var(--dark);
            color: var(--on-dark);
            position: relative;
            overflow: hidden;
        }

        .starfield {
            position: absolute;
            inset: 0;
            pointer-events: none;
        }

        .star {
            position: absolute;
            border-radius: 50%;
            background: #fff;
            opacity: 0.6;
            animation: twinkle 4s ease-in-out infinite;
        }

        @keyframes twinkle {

            0%,
            100% {
                opacity: 0.15;
            }

            50% {
                opacity: 0.85;
            }
        }

        .testimonials .wrap {
            position: relative;
            z-index: 1;
        }

        .testi-head {
            text-align: center;
            max-width: 560px;
            margin: 0 auto 56px;
        }

        .testi-head .eyebrow {
            justify-content: center;
            margin-bottom: 14px;
        }

        .testi-head h2 {
            font-size: clamp(2.2rem, 5vw, 3.4rem);
        }

        .testi-head p {
            color: var(--on-dark-soft);
            margin-top: 14px;
            font-size: 0.98rem;
        }

        .testi-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
        }

        .testi-card {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: var(--radius);
            padding: 26px;
            display: flex;
            flex-direction: column;
            gap: 16px;
            backdrop-filter: blur(6px);
        }

        .testi-quote {
            font-size: 0.88rem;
            line-height: 1.65;
            color: var(--on-dark-soft);
        }

        .testi-person {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: auto;
        }

        .testi-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Anton', sans-serif;
            font-size: 1rem;
            color: #fff;
            flex-shrink: 0;
        }

        .testi-person b {
            display: block;
            font-size: 0.88rem;
        }

        .testi-person span {
            display: block;
            font-size: 0.74rem;
            color: var(--on-dark-soft);
        }

        .rating-bar {
            margin-top: 56px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 14px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.85rem;
            color: var(--on-dark-soft);
        }

        .rating-bar b {
            color: var(--on-dark);
            font-size: 1.1rem;
        }

        .stars {
            display: flex;
            gap: 3px;
            color: var(--amber);
        }

        .stars svg {
            width: 15px;
            height: 15px;
        }

        /* ---------- brands ---------- */
        .brands {
            padding-top: 0;
        }

        .brands .section-head {
            margin-bottom: 36px;
        }

        .brand-marquee {
            border-top: 1px solid var(--line);
            border-bottom: 1px solid var(--line);
            overflow: hidden;
            padding: 28px 0;
        }

        .brand-track {
            display: inline-flex;
            gap: 64px;
            animation: ticker 32s linear infinite;
        }

        .brand-logo {
            height: 120px;
            max-width: 250px;
            object-fit: contain;
            filter: grayscale(100%) opacity(65%);
            transition: filter 0.3s ease, transform 0.3s ease;
        }

        .brand-logo:hover {
            filter: grayscale(0%) opacity(100%);
            transform: scale(1.08);
        }

        /* ---------- about / CTA ---------- */
        .about {
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 60px;
            align-items: center;
        }

        .about h2 {
            font-size: clamp(2rem, 4.6vw, 3.2rem);
        }

        .about p {
            margin-top: 18px;
            color: var(--ink-soft);
            line-height: 1.75;
            font-size: 1rem;
            max-width: 480px;
        }

        .about__cta {
            margin-top: 28px;
            display: flex;
            gap: 14px;
            align-items: center;
            flex-wrap: wrap;
        }

        .about__panel {
            border-radius: var(--radius-lg);
            background: var(--ink);
            color: var(--on-dark);
            padding: 40px;
            display: flex;
            flex-direction: column;
            gap: 22px;
            position: relative;
            overflow: hidden;
        }

        .about__panel svg {
            position: absolute;
            right: -50px;
            bottom: -60px;
            width: 200px;
            height: 200px;
            color: rgba(255, 77, 46, 0.16);
        }

        .about__stat {
            position: relative;
            z-index: 1;
        }

        .about__stat b {
            font-family: 'Anton', sans-serif;
            font-size: 2.4rem;
            display: block;
        }

        .about__stat span {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.72rem;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: var(--on-dark-soft);
        }

        /* ---------- footer ---------- */
        footer {
            background: var(--dark);
            color: var(--on-dark);
            padding: 80px 0 0;
        }

        .footer-top {
            display: grid;
            grid-template-columns: 1.4fr 1fr 1fr 1.2fr;
            gap: 40px;
            padding-bottom: 60px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .footer-brand .logo {
            color: var(--on-dark);
        }

        .footer-brand .logo span {
            color: var(--accent);
        }

        .footer-brand p {
            margin-top: 16px;
            color: var(--on-dark-soft);
            font-size: 0.88rem;
            line-height: 1.6;
            max-width: 260px;
        }

        .footer-social {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .footer-social a {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, 0.18);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background .2s ease;
        }

        .footer-social a:hover {
            background: var(--accent);
            border-color: var(--accent);
        }

        .footer-social svg {
            width: 15px;
            height: 15px;
        }

        .footer-col h5 {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.7rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--on-dark-soft);
            margin-bottom: 18px;
        }

        .footer-col ul {
            display: flex;
            flex-direction: column;
            gap: 11px;
        }

        .footer-col a {
            font-size: 0.92rem;
            color: var(--on-dark);
            opacity: 0.85;
            transition: opacity .2s ease;
        }

        .footer-col a:hover {
            opacity: 1;
            color: var(--accent);
        }

        .footer-contact li {
            display: flex;
            gap: 10px;
            font-size: 0.88rem;
            color: var(--on-dark-soft);
            align-items: flex-start;
        }

        .footer-contact svg {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
            margin-top: 2px;
            color: var(--accent);
        }

        .footer-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 24px 0;
            flex-wrap: wrap;
            gap: 10px;
            font-size: 0.78rem;
            color: var(--on-dark-soft);
        }

        /* ---------- reveal ---------- */
        .reveal {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity .7s ease, transform .7s ease;
        }

        .reveal.in {
            opacity: 1;
            transform: translateY(0);
        }

        /* ---------- responsive ---------- */
        @media (max-width:1080px) {
            .grid-products {
                grid-template-columns: repeat(3, 1fr);
            }

            .testi-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .hero__stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .hero__stat:nth-child(3) {
                border-left: none;
            }

            .about {
                grid-template-columns: 1fr;
            }

            .benefits-top {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }

        @media (max-width:760px) {

            .nav__links,
            .nav__right .btn-ghost {
                display: none;
            }

            .hamburger {
                display: flex;
            }

            section {
                padding: 64px 0;
            }

            .grid-products {
                grid-template-columns: repeat(2, 1fr);
            }

            .footer-top {
                grid-template-columns: repeat(2, 1fr);
                gap: 36px;
            }

            .benefit-grid {
                grid-template-columns: 1fr;
            }

            .promo {
                padding: 44px 26px;
                flex-direction: column;
                align-items: flex-start;
            }

            .hero__stats {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width:480px) {
            .grid-products {
                grid-template-columns: repeat(2, 1fr);
            }

            .testi-grid {
                grid-template-columns: 1fr;
            }

            .footer-top {
                grid-template-columns: 1fr;
            }

            .wrap {
                padding: 0 18px;
            }
        }

        /* ---------- card quantity ---------- */
        .card__actions {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .card__remove {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            border: 1px solid var(--line);
            display: flex;
            align-items: center;
            justify-content: center;
            background: transparent;
            transition: background .2s ease, border-color .2s ease, color .2s ease, transform .2s ease;
        }

        .card:hover .card__remove {
            background: var(--ink);
            border-color: var(--ink);
            color: #fff;
        }

        .card__remove svg {
            width: 14px;
            height: 14px;
        }

        .card__qty {
            font-size: 0.85rem;
            font-weight: 600;
            width: 20px;
            text-align: center;
        }

        /* ---------- floating cart ---------- */
        .floating-cart {
            position: fixed;
            bottom: 24px;
            left: 50%;
            transform: translateX(-50%) translateY(100px);
            background: var(--accent);
            color: #fff;
            padding: 16px 24px;
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            gap: 24px;
            box-shadow: 0 20px 40px rgba(255, 77, 46, 0.4);
            z-index: 100;
            opacity: 0;
            pointer-events: none;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            width: max-content;
            max-width: 90vw;
        }

        .floating-cart.active {
            transform: translateX(-50%) translateY(0);
            opacity: 1;
            pointer-events: auto;
        }

        .cart-info {
            display: flex;
            flex-direction: column;
        }

        .cart-info span {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.8);
        }

        .cart-info b {
            font-size: 1.1rem;
            color: #fff;
        }

        .btn-wa {
            background: #fff;
            color: var(--accent);
            border: none;
            padding: 10px 20px;
            border-radius: 99px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-wa:hover {
            background: #f0f0f0;
        }

        @media (max-width: 760px) {
            .floating-cart {
                width: calc(100vw - 32px);
                bottom: 16px;
                padding: 16px;
                justify-content: space-between;
                gap: 12px;
            }

            .cart-info b {
                font-size: 1rem;
            }

            .btn-wa {
                padding: 10px 16px;
                font-size: 0.9rem;
            }
        }

        /* ---------- shake vertical animation ---------- */
        .shake-vertical.in {
            -webkit-animation: shake-vertical 2.8s cubic-bezier(0.455, 0.030, 0.515, 0.955) infinite;
            animation: shake-vertical 2.8s cubic-bezier(0.455, 0.030, 0.515, 0.955) infinite;
        }

        @-webkit-keyframes shake-vertical {

            0%,
            28%,
            100% {
                -webkit-transform: translateY(0);
                transform: translateY(0);
            }

            3%,
            9%,
            14%,
            20% {
                -webkit-transform: translateY(-8px);
                transform: translateY(-8px);
            }

            6%,
            11%,
            17% {
                -webkit-transform: translateY(8px);
                transform: translateY(8px);
            }

            23% {
                -webkit-transform: translateY(6.4px);
                transform: translateY(6.4px);
            }

            26% {
                -webkit-transform: translateY(-6.4px);
                transform: translateY(-6.4px);
            }
        }

        @keyframes shake-vertical {

            0%,
            28%,
            100% {
                -webkit-transform: translateY(0);
                transform: translateY(0);
            }

            3%,
            9%,
            14%,
            20% {
                -webkit-transform: translateY(-8px);
                transform: translateY(-8px);
            }

            6%,
            11%,
            17% {
                -webkit-transform: translateY(8px);
                transform: translateY(8px);
            }

            23% {
                -webkit-transform: translateY(6.4px);
                transform: translateY(6.4px);
            }

            26% {
                -webkit-transform: translateY(-6.4px);
                transform: translateY(-6.4px);
            }
        }
    </style>
</head>

<body>

    <!-- sprite -->
    <svg width="0" height="0" style="position:absolute">
        <symbol id="aperture" viewBox="0 0 100 100">
            <path d="M50 50 C63 38 82 38 90 50 C82 62 63 62 50 50 Z" transform="rotate(0 50 50)" />
            <path d="M50 50 C63 38 82 38 90 50 C82 62 63 62 50 50 Z" transform="rotate(60 50 50)" />
            <path d="M50 50 C63 38 82 38 90 50 C82 62 63 62 50 50 Z" transform="rotate(120 50 50)" />
            <path d="M50 50 C63 38 82 38 90 50 C82 62 63 62 50 50 Z" transform="rotate(180 50 50)" />
            <path d="M50 50 C63 38 82 38 90 50 C82 62 63 62 50 50 Z" transform="rotate(240 50 50)" />
            <path d="M50 50 C63 38 82 38 90 50 C82 62 63 62 50 50 Z" transform="rotate(300 50 50)" />
        </symbol>
        <symbol id="icon-id" viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="6"
            stroke-linecap="round" stroke-linejoin="round">
            <rect x="10" y="26" width="80" height="48" rx="9" />
            <circle cx="32" cy="50" r="9" />
            <line x1="52" y1="40" x2="80" y2="40" />
            <line x1="52" y1="56" x2="74" y2="56" />
            <line x1="14" y1="14" x2="86" y2="86" />
        </symbol>
        <symbol id="icon-bolt" viewBox="0 0 100 100" fill="currentColor">
            <path d="M55 6 L24 56 L46 56 L40 94 L80 40 L54 40 Z" />
        </symbol>
        <symbol id="icon-shield" viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="6"
            stroke-linecap="round" stroke-linejoin="round">
            <path d="M50 8 L86 22 V48 C86 70 70 86 50 94 C30 86 14 70 14 48 V22 Z" />
            <path d="M33 50 L46 63 L70 35" />
        </symbol>
        <symbol id="icon-plus" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round">
            <line x1="12" y1="5" x2="12" y2="19" />
            <line x1="5" y1="12" x2="19" y2="12" />
        </symbol>
        <symbol id="icon-minus" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round">
            <line x1="5" y1="12" x2="19" y2="12" />
        </symbol>
        <symbol id="icon-search" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round">
            <circle cx="11" cy="11" r="7" />
            <line x1="21" y1="21" x2="16.5" y2="16.5" />
        </symbol>
        <symbol id="icon-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <line x1="5" y1="12" x2="19" y2="12" />
            <polyline points="13 6 19 12 13 18" />
        </symbol>
        <symbol id="icon-star" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 2 L14.6 9 L22 9.5 L16.3 14.2 L18.2 21.5 L12 17.6 L5.8 21.5 L7.7 14.2 L2 9.5 L9.4 9 Z" />
        </symbol>
        <symbol id="icon-ig" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <rect x="3" y="3" width="18" height="18" rx="5" />
            <circle cx="12" cy="12" r="4" />
            <circle cx="17.3" cy="6.7" r="1" />
        </symbol>
        <symbol id="icon-yt" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <rect x="2.5" y="6" width="19" height="12" rx="3.5" />
            <polygon points="10.5 9.5 15.5 12 10.5 14.5" fill="currentColor" stroke="none" />
        </symbol>
        <symbol id="icon-tt" viewBox="0 0 24 24" fill="currentColor">
            <path d="M14 3c.5 2 2 3.6 4 4v3a7 7 0 0 1-4-1.2V14a5 5 0 1 1-5-5c.3 0 .7 0 1 .1v3a2 2 0 1 0 1.5 1.9V3Z" />
        </symbol>
        <symbol id="icon-pin" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
            stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 21s7-7.2 7-12a7 7 0 1 0-14 0c0 4.8 7 12 7 12Z" />
            <circle cx="12" cy="9" r="2.4" />
        </symbol>
        <symbol id="icon-wa" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
            stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 20l1.4-4.1A8 8 0 1 1 8.7 19L4 20Z" />
            <path d="M9 9.5c0 3 2.5 5.5 5.5 5.5" />
        </symbol>
        <symbol id="icon-mail" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
            stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="5" width="18" height="14" rx="2.5" />
            <path d="M4 7l8 6 8-6" />
        </symbol>
    </svg>

    <!-- ticker -->
    <div class="ticker">
        <div class="ticker__track" id="tickerTrack">
            <span class="ticker__item"><b>Tidak ada denda</b> &amp; yang punya sans<span
                    class="ticker__dot"></span></span>
            <span class="ticker__item">Antar-jemput alat <b>gratis</b><span class="ticker__dot"></span></span>
            <span class="ticker__item">Sewa tanpa jaminan, tanpa ribet<span class="ticker__dot"></span></span>
            <span class="ticker__item"><b>Tidak ada denda</b> &amp; yang punya sans<span
                    class="ticker__dot"></span></span>
            <span class="ticker__item">Antar-jemput alat <b>gratis</b><span class="ticker__dot"></span></span>
            <span class="ticker__item">Sewa tanpa jaminan, tanpa ribet<span class="ticker__dot"></span></span>
        </div>
    </div>

    <!-- header -->
    <header class="site" id="siteHeader">
        <div class="wrap nav">
            <a href="#top" class="logo">Gading<span>.</span></a>
            <nav class="nav__links">
                <a href="#equipment">Equipment</a>
                <a href="#promo">Promo</a>
                <a href="#benefits">Keuntungan</a>
                <a href="#kontak">Kontak</a>
            </nav>
            <div class="nav__right">
                @auth
                    <span
                        style="font-size:0.85rem; font-weight:600; color:var(--ink-soft); margin-right:10px; display:none;">Halo,
                        {{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" style="margin:0; display:inline-block;">
                        @csrf
                        <button type="submit" class="btn btn-ghost"
                            style="padding: 6px 16px; font-size: 0.8rem; border-color:var(--accent); color:var(--accent);">Logout</button>
                    </form>
                @endauth
                <button class="hamburger" id="menuToggle" aria-label="Buka menu"><span></span></button>
            </div>
        </div>
    </header>

    <div class="mobile-nav" id="mobileNav">
        <button class="mobile-nav__close" id="menuClose" aria-label="Tutup menu">X</button>
        <a href="#equipment">Equipment</a>
        <a href="#promo">Promo</a>
        <a href="#benefits">Keuntungan</a>
        <a href="#kontak">Kontak</a>
        @auth
            <form action="{{ route('logout') }}" method="POST" style="margin-top:20px;">
                @csrf
                <button type="submit"
                    style="background:transparent; border:none; color:var(--accent); font-family:'Anton', sans-serif; font-size:2.1rem; text-transform:uppercase; padding:0; text-align:left; cursor:pointer;">LOGOUT</button>
            </form>
        @endauth
    </div>

    <main id="top">

        <!-- hero -->
        <section class="hero" style="padding-bottom:0;">
            <svg class="hero__aperture spin-slow" viewBox="0 0 100 100">
                <use href="#aperture" />
            </svg>
            <svg class="hero__aperture--two spin-slow" viewBox="0 0 100 100" style="animation-direction:reverse;">
                <use href="#aperture" />
            </svg>
            <div class="wrap hero__inner">
                <span class="eyebrow on-dark">Gading Rental · sejak 2026</span>
                <h1 class="display hero__title" style="margin-top:18px;">Creative Without,<br><em>Limit.</em></h1>
                <p class="hero__sub"><b>jangan batasi kreativitas mu</b><br>Sewa kamera, lensa, dan peralatan
                    kreator di
                    Karawang &amp;. Booking cepat, alat siap pakai, tanpa drama.</p>
                <div class="hero__cta">
                    <a href="#equipment" class="btn btn-primary">Explore Gear <svg width="14" height="14">
                            <use href="#icon-arrow" />
                        </svg></a>
                    <div class="hero__rating">
                        <div class="stars">
                            <svg>
                                <use href="#icon-star" />
                            </svg><svg>
                                <use href="#icon-star" />
                            </svg><svg>
                                <use href="#icon-star" />
                            </svg>
                        </div>
                        <span><b>3,9</b> </span>
                    </div>
                </div>
            </div>
            <div class="hero__bottombar">
                <div class="hero__stats">
                    <div class="hero__stat"><b>2+</b><span>Tahun Pengalaman</span></div>
                    <div class="hero__stat"><b>2</b><span>Brand Kamera &amp; Lensa</span></div>
                    <div class="hero__stat"><b>12/7</b><span>Buka setiap hari</span></div>
                    <div class="hero__stat"><b>2</b><span>Kota Operasional</span></div>
                </div>
            </div>
        </section>

        <!-- KOTAK ASISTEN AI -->
        <div
            style="background: white; padding: 24px; border-radius: 12px; margin-bottom: 40px; border: 1px solid var(--line);">
            <h3 style="margin-top:0; margin-bottom: 16px; font-weight: 600; font-size: 18px; color: var(--text);">
                Tanya Asisten AI
            </h3>

            <div style="display:flex; gap:12px;">
                <input type="text" id="ai-input"
                    placeholder="Ketik pertanyaanmu..."
                    style="flex:1; padding: 12px 16px; border-radius: 6px; border: 1px solid var(--line); font-size: 15px; outline: none;">
                <button onclick="tanyaAI()" class="btn btn-primary" style="padding: 12px 24px; border-radius: 6px; font-weight: 500;">Tanya Sekarang</button>
            </div>

            <div id="ai-loading" style="display:none; color: #666; margin-top:20px; font-size: 14px;">
                Asisten sedang mengetik jawaban...
            </div>

            <!-- Tempat jawaban muncul -->
            <div id="ai-response"
                style="margin-top: 20px; padding: 20px; background: #f9fafb; border-radius: 8px; border: 1px solid #e5e7eb; display: none; line-height: 1.7; font-size: 15px; color: #374151;">
            </div>
        </div>

        <!-- SCRIPT UNTUK MEMANGGIL API TANPA REFRESH HALAMAN -->
        <script>
            function tanyaAI() {
                const input = document.getElementById('ai-input').value;
                const responseBox = document.getElementById('ai-response');
                const loadingBox = document.getElementById('ai-loading');

                if (!input) return alert('Ketik pertanyaan dulu!');

                // Tampilkan loading, sembunyikan kotak jawaban
                loadingBox.style.display = 'block';
                responseBox.style.display = 'none';

                // Panggil URL /ai-ask (Controller) menggunakan Javascript Fetch (AJAX)
                fetch("{{ route('ai.ask') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Token keamanan bawaan Laravel
                    },
                    body: JSON.stringify({ pertanyaan: input })
                })
                .then(async res => {
                    // Cek apakah server mengembalikan HTML (Error Laravel) alih-alih JSON
                    const text = await res.text();
                    try {
                        return JSON.parse(text);
                    } catch (err) {
                        throw new Error("Sistem sibuk. Silakan refresh (F5) halaman Anda.");
                    }
                })
                .then(data => {
                    // Matikan loading
                    loadingBox.style.display = 'none';
                    
                    // Tampilkan jawaban
                    responseBox.style.display = 'block';
                    
                    if(data.status === 'success'){
                        // Menampilkan jawaban dengan rapi
                        responseBox.innerHTML = data.jawaban.replace(/\n/g, "<br>");
                    } else {
                        responseBox.innerHTML = '<span style="color:#ef4444">Gagal: ' + data.jawaban + '</span>';
                    }
                }).catch(err => {
                    document.getElementById('ai-loading').style.display = 'none';
                    document.getElementById('ai-response').style.display = 'block';
                    document.getElementById('ai-response').innerHTML = '<span style="color:#ef4444">Error: ' + err.message + '</span>';
                });
            }
        </script>


        <!-- featured equipment -->
        <section id="equipment">
            <div class="wrap">
                <div class="section-head reveal">
                    <h2>Featured Equipment</h2>
                </div>

                <div class="catalog-group reveal">
                    <span class="group-label c-trend"><svg>
                            <use href="#icon-bolt" />
                        </svg>Kamera</span>
                    <div class="grid-products">
                        @if(isset($products['Kamera']) && count($products['Kamera']) > 0)
                            @foreach($products['Kamera'] as $product)
                                <article class="card" data-id="{{ $product->id }}" data-stock="{{ $product->stock }}">
                                    <div class="card__plate" style="background: transparent; padding: 0;">
                                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                                            style="width: 100%; height: 100%; object-fit: cover; border-radius: 12px;">
                                    </div>
                                    <div class="card__name">{{ $product->name }}</div>
                                    <div class="card__meta">
                                        <div class="card__price">Rp {{ number_format($product->price, 0, ',', '.') }}<span>/
                                                hari</span></div><button class="card__add" aria-label="Tambah"><svg>
                                                <use href="#icon-plus" />
                                            </svg></button>
                                    </div>
                                </article>
                            @endforeach
                        @else
                            <div style="padding: 1rem 0; color: #888; font-style: italic;">Belum ada data produk kamera.
                            </div>
                        @endif
                    </div>
                </div>

                <div class="catalog-group reveal">
                    <span class="group-label c-hype"><svg>
                            <use href="#icon-bolt" />
                        </svg>Lensa</span>
                    <div class="grid-products">
                        @if(isset($products['Lensa']) && count($products['Lensa']) > 0)
                            @foreach($products['Lensa'] as $product)
                                <article class="card" data-id="{{ $product->id }}" data-stock="{{ $product->stock }}">
                                    <div class="card__plate" style="background: transparent; padding: 0;">
                                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                                            style="width: 100%; height: 100%; object-fit: cover; border-radius: 12px;">
                                    </div>
                                    <div class="card__name">{{ $product->name }}</div>
                                    <div class="card__meta">
                                        <div class="card__price">Rp {{ number_format($product->price, 0, ',', '.') }}<span>/
                                                hari</span></div><button class="card__add" aria-label="Tambah"><svg>
                                                <use href="#icon-plus" />
                                            </svg></button>
                                    </div>
                                </article>
                            @endforeach
                        @else
                            <div style="padding: 1rem 0; color: #888; font-style: italic;">Belum ada data produk lensa.
                            </div>
                        @endif
                    </div>
                </div>

                <div class="catalog-group reveal">
                    <span class="group-label c-hot"><svg>
                            <use href="#icon-bolt" />
                        </svg>Accessories</span>
                    <div class="grid-products">
                        @if(isset($products['Aksesoris']) && count($products['Aksesoris']) > 0)
                            @foreach($products['Aksesoris'] as $product)
                                <article class="card" data-id="{{ $product->id }}" data-stock="{{ $product->stock }}">
                                    <div class="card__plate" style="background: transparent; padding: 0;">
                                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                                            style="width: 100%; height: 100%; object-fit: cover; border-radius: 12px;">
                                    </div>
                                    <div class="card__name">{{ $product->name }}</div>
                                    <div class="card__meta">
                                        <div class="card__price">Rp {{ number_format($product->price, 0, ',', '.') }}<span>/
                                                hari</span></div><button class="card__add" aria-label="Tambah"><svg>
                                                <use href="#icon-plus" />
                                            </svg></button>
                                    </div>
                                </article>
                            @endforeach
                        @else
                            <div style="padding: 1rem 0; color: #888; font-style: italic;">Belum ada data produk aksesoris.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <!-- promo banner -->
        <section id="promo" style="padding-top:0;">
            <div class="wrap">
                <div class="promo reveal shake-vertical">
                    <svg class="promo__aperture spin-slow" viewBox="0 0 100 100">
                        <use href="#aperture" />
                    </svg>
                    <div class="promo__copy">
                        <span class="promo__tag">Gratis Alert!</span>
                        <h3 class="display">Sewa 2 hari, gratis 1 hari.</h3>
                        <p>Berlaku untuk semua kategori alat selama periode promo
                            berlangsung. Booking sekarang
                            sebelum
                            slot penuh.</p>
                    </div>
        </section>

        <!-- benefits -->
        <section id="benefits">
            <div class="wrap">
                <div class="benefits-top reveal">
                    <h2>Sewa Cepat,Tanpa Jaminan Ribet.</h2>
                    <p>Cukup siapkan identitas yang kamu punya, datang, dan langsung bawa
                        alatnya. <br>Nggak
                        perlu proses berbelit-belit, karena kami percaya sama pelanggan.
                        <br>Fokus aja bikin
                        karya yang keren, urusan alat serahkan ke kami..
                    </p>
                </div>
                <div class="benefit-grid">
                    <div class="benefit-card reveal">
                        <div class="benefit-icon"><svg>
                                <use href="#icon-id" />
                            </svg></div>
                        <h4>easy rent </h4>
                        <p>Sewa dengan mudah kapan pun, gak perlu nunggu jam kerja. Booking, ambil, dan
                            balikin alat bebas tanpa denda terlambatan.</p>
                    </div>
                    <div class="benefit-card reveal">
                        <div class="benefit-icon"><svg>
                                <use href="#icon-bolt" />
                            </svg></div>
                        <h4>All Speed</h4>
                        <p>Bayar tinggal klik dan diarahkan ke whatsapp.
                            Super
                            cepat, selalu siap.</p>
                    </div>
                    <div class="benefit-card reveal">
                        <div class="benefit-icon"><svg>
                                <use href="#icon-shield" />
                            </svg></div>
                        <h4>Full Trust</h4>
                        <p>sudah dipercaya sejak 2026.</p>
                    </div>
                </div>
            </div>
        </section>


        <!-- brands -->
        <section class="brands" style="padding-bottom: 60px;">
            <div class="wrap">
                <div class="section-head reveal" style="margin-bottom:36px; display:flex; justify-content:center;">
                    <h2 style="font-size:1.4rem;">Brand yang tersedia</h2>
                </div>
                <div class="reveal"
                    style="display: flex; justify-content: center; align-items: center; gap: 80px; flex-wrap: wrap;">
                    <img src="{{ asset('img/canon%20logo.png') }}" alt="Canon" class="brand-logo">
                    <img src="{{ asset('img/sony-logo.png') }}" alt="Sony" class="brand-logo">
                </div>
            </div>
        </section>
    </main>

    <!-- footer -->
    <footer id="kontak">
        <div class="wrap">
            <div class="footer-top">
                <div class="footer-brand">
                    <a href="#top" class="logo">Gading<span>.</span></a>
                    <p>kreativitas adalah tanpa batas. saya ada untuk membantu karyamu bersinar — sejak 2026.</p>
                    <div class="footer-social">
                        <a href="#" aria-label="Instagram"><svg>
                                <use href="#icon-ig" />
                            </svg></a>
                        <a href="#" aria-label="YouTube"><svg>
                                <use href="#icon-yt" />
                            </svg></a>
                        <a href="#" aria-label="TikTok"><svg>
                                <use href="#icon-tt" />
                            </svg></a>
                    </div>
                </div>
                <div class="footer-col">
                    <h5>Kontak</h5>
                    <ul class="footer-contact">
                        <li><svg>
                                <use href="#icon-wa" />
                            </svg>WA 24 Jam: 0812-8576-0835</li>
                        <li><svg>
                                <use href="#icon-mail" />
                            </svg>sajiwaraga28@gmail.com</li>
                        <li><svg>
                                <use href="#icon-pin" />
                            </svg>Karawang, kosambi</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <span>Infinity in Creativity.</span>
            </div>
        </div>
    </footer>

    <!-- floating cart -->
    <div class="floating-cart" id="floatingCart">
        <div class="cart-info">
            <span id="cartCount">0 Alat Terpilih</span>
            <b id="cartTotal">Rp 0</b>
        </div>

        <form action="{{ route('booking.store') }}" method="POST" id="checkoutForm"
            style="display:flex; gap:12px; align-items:center;">
            @csrf
            <input type="hidden" name="cart" id="cartData">
            <input type="date" name="start_date" required
                style="padding: 8px; border: 1px solid var(--line); border-radius: 6px; font-family: var(--text-font); font-size:0.85rem;"
                min="{{ date('Y-m-d') }}" title="Tanggal Pengambilan">
            <button type="submit" class="btn-wa" style="border:none; cursor:pointer; font-family: inherit;">
                <svg width="18" height="18">
                    <use href="#icon-wa" />
                </svg> Sewa Sekarang
            </button>
        </form>
    </div>

    <script>
        // header scroll shadow
        const header = document.getElementById('siteHeader');
        window.addEventListener('scroll', () => {
            header.classList.toggle('scrolled', window.scrollY > 12);
        }, { passive: true });

        // mobile nav
        const mobileNav = document.getElementById('mobileNav');
        document.getElementById('menuToggle').addEventListener('click', () => mobileNav.classList.add('open'));
        document.getElementById('menuClose').addEventListener('click', () => mobileNav.classList.remove('open'));
        mobileNav.querySelectorAll('a').forEach(a => a.addEventListener('click', () => mobileNav.classList.remove('open')));

        // reveal on scroll
        const revealEls = document.querySelectorAll('.reveal');
        const io = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); }
            });
        }, { threshold: 0.12 });
        revealEls.forEach(el => io.observe(el));

        // starfield
        const starfield = document.getElementById('starfield');
        if (starfield) {
            const STAR_COUNT = 60;
            for (let i = 0; i < STAR_COUNT; i++) {
                const s = document.createElement('div');
                s.className = 'star';
                const size = Math.random() * 2 + 1;
                s.style.width = size + 'px';
                s.style.height = size + 'px';
                s.style.left = Math.random() * 100 + '%';
                s.style.top = Math.random() * 100 + '%';
                s.style.animationDelay = (Math.random() * 4) + 's';
                starfield.appendChild(s);
            }
        }

        // cart logic
        const cart = [];
        const floatingCart = document.getElementById('floatingCart');
        const cartCount = document.getElementById('cartCount');
        const cartTotal = document.getElementById('cartTotal');
        const btnCheckoutWa = document.getElementById('btnCheckoutWa');

        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(angka);
        }

        function updateCartUI() {
            let totalQty = cart.reduce((sum, item) => sum + item.qty, 0);
            if (totalQty > 0) {
                floatingCart.classList.add('active');
                cartCount.innerText = `${totalQty} Alat Terpilih`;

                const total = cart.reduce((sum, item) => {
                    const paidDays = item.days - Math.floor(item.days / 3);
                    return sum + (item.price * item.qty * paidDays);
                }, 0);
                cartTotal.innerText = formatRupiah(total);

                // Update hidden input form
                document.getElementById('cartData').value = JSON.stringify(cart);
            } else {
                floatingCart.classList.remove('active');
            }
        }

        function updateItemUI(card, item) {
            const btnRemove = card.querySelector('.card__remove');
            const qtyText = card.querySelector('.card__qty');
            const daysWrapper = card.querySelector('.card__days-actions');
            const dayText = card.querySelector('.day__qty');

            if (item && item.qty > 0) {
                btnRemove.style.display = 'flex';
                qtyText.style.display = 'block';
                qtyText.innerText = item.qty;
                card.classList.add('is-selected');

                if (daysWrapper) {
                    daysWrapper.style.display = 'flex';
                    dayText.innerText = item.days + ' Hari';
                }
            } else {
                btnRemove.style.display = 'none';
                qtyText.style.display = 'none';
                card.classList.remove('is-selected');

                if (daysWrapper) {
                    daysWrapper.style.display = 'none';
                }
            }
        }

        document.querySelectorAll('.card__add').forEach(btnAdd => {
            try {
                const card = btnAdd.closest('.card');
                if (!card) return;

                const maxStock = parseInt(card.getAttribute('data-stock')) || 1;

                const nameEl = card.querySelector('.card__name');
                if (nameEl) {
                    const stockNote = document.createElement('div');
                    stockNote.style.fontSize = '0.7rem';
                    stockNote.style.color = 'var(--ink-soft)';
                    stockNote.style.marginTop = '-12px'; // mendekatkan ke judul
                    stockNote.style.fontWeight = '600';
                    stockNote.innerText = 'Stok: ' + maxStock;
                    nameEl.parentNode.insertBefore(stockNote, nameEl.nextSibling);
                }

                const wrapper = document.createElement('div');
                wrapper.className = 'card__actions';

                const btnRemove = document.createElement('button');
                btnRemove.className = 'card__remove';
                btnRemove.innerHTML = '<svg><use href="#icon-minus" /></svg>';
                btnRemove.style.display = 'none';
                btnRemove.setAttribute('aria-label', 'Kurangi');

                const qtyText = document.createElement('span');
                qtyText.className = 'card__qty';
                qtyText.innerText = '0';
                qtyText.style.display = 'none';

                btnAdd.parentNode.insertBefore(wrapper, btnAdd);
                wrapper.appendChild(btnRemove);
                wrapper.appendChild(qtyText);
                wrapper.appendChild(btnAdd);

                // Add Days Controls Wrapper
                const daysWrapper = document.createElement('div');
                daysWrapper.className = 'card__days-actions';
                daysWrapper.style.display = 'none';
                daysWrapper.style.justifyContent = 'space-between';
                daysWrapper.style.alignItems = 'center';
                daysWrapper.style.marginTop = '12px';
                daysWrapper.style.paddingTop = '12px';
                daysWrapper.style.borderTop = '1px dashed rgba(255,255,255,0.15)';
                daysWrapper.innerHTML = `
                    <span style="font-size:0.75rem; color:inherit; opacity:0.8; font-weight:600; white-space:nowrap;">Lama Sewa:</span>
                    <div class="card__actions">
                        <button class="day__remove" aria-label="Kurangi Hari" style="display:flex;"><svg><use href="#icon-minus" /></svg></button>
                        <span class="day__qty" style="font-size:0.85rem; font-weight:600; width:45px; text-align:center; display:block;">1 Hari</span>
                        <button class="day__add" aria-label="Tambah Hari"><svg><use href="#icon-plus" /></svg></button>
                    </div>
                `;
                card.appendChild(daysWrapper);

                const btnDayAdd = daysWrapper.querySelector('.day__add');
                const btnDayRemove = daysWrapper.querySelector('.day__remove');

                const priceEl = card.querySelector('.card__price');
                if (!nameEl || !priceEl) return;

                const name = nameEl.textContent.trim();
                const priceText = priceEl.textContent.trim();
                const price = parseInt(priceText.replace(/[^0-9]/g, '')) || 0;
                const id = card.getAttribute('data-id');

                btnAdd.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.stopPropagation();

                    let item = cart.find(i => i.id === id);
                    if (item) {
                        if (item.qty >= maxStock) {
                            return;
                        }
                        item.qty++;
                    } else {
                        item = { id, name, price, qty: 1, days: 1, maxStock };
                        cart.push(item);
                    }

                    const originalHtml = btnAdd.innerHTML;
                    btnAdd.innerHTML = '✓';
                    btnAdd.style.background = '#25D366';
                    btnAdd.style.color = '#fff';
                    btnAdd.style.borderColor = '#25D366';
                    setTimeout(() => {
                        btnAdd.innerHTML = originalHtml;
                        btnAdd.style.background = '';
                        btnAdd.style.color = '';
                        btnAdd.style.borderColor = '';
                    }, 400);

                    updateItemUI(card, item);
                    updateCartUI();
                });

                btnRemove.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.stopPropagation();

                    let itemIndex = cart.findIndex(i => i.name === name);
                    if (itemIndex > -1) {
                        cart[itemIndex].qty--;
                        const itemRef = cart[itemIndex];
                        if (cart[itemIndex].qty === 0) {
                            cart.splice(itemIndex, 1);
                        }
                        updateItemUI(card, itemRef);
                        updateCartUI();
                    }
                });

                btnDayAdd.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    let item = cart.find(i => i.name === name);
                    if (item) {
                        item.days++;
                        updateItemUI(card, item);
                        updateCartUI();
                    }
                });

                btnDayRemove.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    let item = cart.find(i => i.name === name);
                    if (item && item.days > 1) {
                        item.days--;
                        updateItemUI(card, item);
                        updateCartUI();
                    }
                });

            } catch (err) {
                console.error("Cart init error on a card", err);
            }
        });
    </script>



</body>

</html>