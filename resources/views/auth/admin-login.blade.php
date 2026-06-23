<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - SIG Irigasi Sidoarjo</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #163832;
            --primary-light: #235347;
            --secondary: #8EB69B;
            --accent: #235347;
            --dark: #051F20;
            --text: #0B2B26;
            --text-light: #235347;
            --bg: #f8fafc;
            --white: #ffffff;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: var(--dark); color: var(--text); line-height: 1.6; min-height: 100vh; display: flex; align-items: center; justify-content: center; }

        .admin-auth-wrapper { display: grid; grid-template-columns: 1fr 440px; max-width: 1100px; width: 95%; background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 25px 80px rgba(0,0,0,0.4); }
        .admin-visual { background: linear-gradient(135deg, #051F20 0%, #163832 50%, #235347 100%); padding: 4rem 3rem; display: flex; flex-direction: column; justify-content: center; color: white; position: relative; overflow: hidden; }
        .admin-visual::before { content: ''; position: absolute; inset: 0; background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E"); opacity: 0.3; }
        .admin-visual-content { position: relative; z-index: 1; }
        .admin-visual .logo-icon-big { width: 60px; height: 60px; border-radius: 16px; background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); display: flex; align-items: center; justify-content: center; font-size: 1.8rem; margin-bottom: 1.5rem; border: 1px solid rgba(255,255,255,0.2); }
        .admin-visual h2 { font-size: 1.8rem; font-weight: 800; margin-bottom: 1rem; }
        .admin-visual h2 span { color: #DAF1DE; }
        .admin-visual p { font-size: 0.9rem; opacity: 0.85; line-height: 1.7; margin-bottom: 2rem; }
        .admin-visual .feature-list { display: flex; flex-direction: column; gap: 0.75rem; }
        .admin-visual .feature-item { display: flex; align-items: center; gap: 0.75rem; font-size: 0.85rem; }
        .admin-visual .feature-item i { width: 28px; height: 28px; border-radius: 8px; background: rgba(255,255,255,0.15); display: flex; align-items: center; justify-content: center; font-size: 0.8rem; flex-shrink: 0; }
        .admin-visual .version { margin-top: 3rem; font-size: 0.75rem; opacity: 0.5; }

        .admin-form { padding: 3rem 2.5rem; display: flex; flex-direction: column; justify-content: center; }
        .admin-badge { display: inline-flex; align-items: center; gap: 0.4rem; background: #fef3c7; color: #92400e; padding: 0.35rem 0.9rem; border-radius: 9999px; font-size: 0.78rem; font-weight: 700; margin-bottom: 1.5rem; width: fit-content; }
        .admin-form h3 { font-size: 1.4rem; font-weight: 800; color: var(--dark); margin-bottom: 0.4rem; }
        .admin-form .subtitle { font-size: 0.85rem; color: #64748b; margin-bottom: 2rem; }
        .form-group { margin-bottom: 1.1rem; }
        .form-group label { display: block; font-size: 0.82rem; font-weight: 600; color: var(--text); margin-bottom: 0.4rem; }
        .form-control { width: 100%; padding: 0.7rem 0.95rem; border: 1.5px solid #e2e8f0; border-radius: 10px; font-family: inherit; font-size: 0.88rem; color: var(--text); outline: none; transition: border-color 0.2s, box-shadow 0.2s; }
        .form-control:focus { border-color: var(--primary-light); box-shadow: 0 0 0 3px rgba(35,83,71,0.1); }
        .form-control.is-invalid { border-color: #ef4444; }
        .invalid-feedback { font-size: 0.78rem; color: #ef4444; margin-top: 0.3rem; }
        .btn-auth-submit { width: 100%; padding: 0.8rem; border-radius: 12px; border: none; background: linear-gradient(135deg, var(--primary), var(--secondary)); color: white; font-size: 0.92rem; font-weight: 700; cursor: pointer; transition: transform 0.2s, box-shadow 0.2s; margin-top: 0.5rem; }
        .btn-auth-submit:hover { transform: translateY(-2px); box-shadow: 0 6px 16px rgba(22,56,50,0.35); }
        .admin-footer { margin-top: 1.5rem; font-size: 0.82rem; color: #64748b; text-align: center; }
        .admin-footer a { color: var(--primary); font-weight: 600; text-decoration: none; }
        .back-link { display: inline-flex; align-items: center; gap: 0.4rem; color: #94a3b8; font-size: 0.82rem; text-decoration: none; margin-bottom: 1.5rem; transition: color 0.2s; }
        .back-link:hover { color: var(--text); }

        /* Flash messages */
        .flash-message { padding: 0.75rem 1rem; border-radius: 8px; font-size: 0.82rem; font-weight: 500; margin-bottom: 1rem; }
        .flash-success { background: #dcfce7; color: #166534; }
        .flash-error { background: #fee2e2; color: #991b1b; }

        @media (max-width: 900px) {
            .admin-auth-wrapper { grid-template-columns: 1fr; }
            .admin-visual { display: none; }
            .admin-form { padding: 2.5rem 2rem; }
        }
    </style>
</head>
<body>
    <div class="admin-auth-wrapper">
        <div class="admin-visual">
            <div class="admin-visual-content">
                <div class="logo-icon-big"><i class="fas fa-shield-alt"></i></div>
                <h2>Panel Admin & <span>Petugas</span></h2>
                <p>Kelola data irigasi, verifikasi laporan masyarakat, dan pantau kondisi saluran secara real-time.</p>
                <div class="feature-list">
                    <div class="feature-item"><i class="fas fa-tachometer-alt"></i> Dashboard monitoring</div>
                    <div class="feature-item"><i class="fas fa-users"></i> Manajemen pengguna</div>
                    <div class="feature-item"><i class="fas fa-clipboard-check"></i> Verifikasi laporan</div>
                    <div class="feature-item"><i class="fas fa-database"></i> Kelola data irigasi</div>
                </div>
                <div class="version">SIG Irigasi Sidoarjo v1.0</div>
            </div>
        </div>
        <div class="admin-form">
            <a href="{{ route('home') }}" class="back-link"><i class="fas fa-arrow-left"></i> Kembali ke beranda</a>
            <div class="admin-badge"><i class="fas fa-lock"></i> Panel Admin & Petugas</div>
            <h3>Selamat Datang Kembali</h3>
            <p class="subtitle">Masuk ke panel admin atau petugas.</p>

            @if(session('success'))
                <div class="flash-message flash-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="flash-message flash-error">{{ session('error') }}</div>
            @endif

            <form method="POST" action="{{ route('admin.login') }}">
                @csrf
                <div class="form-group">
                    <label><i class="fas fa-envelope" style="margin-right: 0.3rem; color: #94a3b8;"></i>Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="admin@sigirigasi.id" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label><i class="fas fa-lock" style="margin-right: 0.3rem; color: #94a3b8;"></i>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                </div>
                <div class="form-group" style="display: flex; align-items: center; justify-content: space-between;">
                    <label style="display: flex; align-items: center; gap: 0.4rem; font-weight: 500; cursor: pointer;">
                        <input type="checkbox" name="remember" style="accent-color: var(--primary);"> Ingat saya
                    </label>
                </div>
                <button type="submit" class="btn-auth-submit"><i class="fas fa-sign-in-alt"></i> Masuk ke Panel</button>
            </form>

            <div class="admin-footer">
                Hanya untuk admin dan petugas terdaftar.
            </div>
        </div>
    </div>
</body>
</html>
