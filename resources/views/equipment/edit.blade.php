<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Alat - Admin</title>
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
            padding: 40px 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .header h1 {
            font-family: 'Anton', sans-serif;
            font-size: 2rem;
            margin: 0;
            letter-spacing: 0.01em;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            padding: 10px 20px;
            border-radius: 999px;
            font-size: 0.85rem;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            transition: all .2s;
            border: none;
        }
        .btn-primary { background: var(--accent); color: #fff; }
        .btn-primary:hover { background: var(--accent-dark); transform: translateY(-2px); }
        .btn-ghost { background: transparent; border: 1px solid var(--line); color: var(--ink); }
        .btn-ghost:hover { background: #fff; }
        .card {
            background: #fff;
            padding: 30px;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border: 1px solid var(--line);
        }
        .form-group { margin-bottom: 20px; }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 0.85rem;
            font-weight: 600;
        }
        .form-group input, .form-group select, .form-group textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--line);
            border-radius: 8px;
            font-family: inherit;
            font-size: 0.9rem;
            transition: border-color .2s;
        }
        .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
            outline: none;
            border-color: var(--accent);
        }
        .error { color: var(--accent); font-size: 0.8rem; margin-top: 5px; display: block; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Edit Alat</h1>
            <a href="{{ route('equipment.index') }}" class="btn btn-ghost">Kembali</a>
        </div>

        <div class="card">
            <form action="{{ route('equipment.update', $equipment->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Nama Alat</label>
                    <input type="text" name="nama_alat" value="{{ old('nama_alat', $equipment->nama_alat) }}" required>
                    @error('nama_alat') <span class="error">{{ $message }}</span> @enderror
                </div>
                
                <div class="form-group">
                    <label>Kategori</label>
                    <input type="text" name="kategori" value="{{ old('kategori', $equipment->kategori) }}" required>
                    @error('kategori') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label>Harga Sewa Per Hari (Rp)</label>
                    <input type="number" name="harga_sewa_perhari" value="{{ old('harga_sewa_perhari', $equipment->harga_sewa_perhari) }}" required>
                    @error('harga_sewa_perhari') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label>Status Ketersediaan</label>
                    <select name="status_ketersediaan" required>
                        <option value="tersedia" {{ old('status_ketersediaan', $equipment->status_ketersediaan) == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="disewa" {{ old('status_ketersediaan', $equipment->status_ketersediaan) == 'disewa' ? 'selected' : '' }}>Disewa</option>
                        <option value="diperbaik" {{ old('status_ketersediaan', $equipment->status_ketersediaan) == 'diperbaik' ? 'selected' : '' }}>Diperbaiki</option>
                    </select>
                    @error('status_ketersediaan') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label>Deskripsi Alat</label>
                    <textarea name="deskripsi_alat" rows="4">{{ old('deskripsi_alat', $equipment->deskripsi_alat) }}</textarea>
                    @error('deskripsi_alat') <span class="error">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 10px;">Update Alat</button>
            </form>
        </div>
    </div>
</body>
</html>
