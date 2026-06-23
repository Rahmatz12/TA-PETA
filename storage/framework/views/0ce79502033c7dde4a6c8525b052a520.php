<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'SIG Irigasi Sidoarjo'); ?></title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <?php echo $__env->yieldPushContent('styles'); ?>
    <style>
        :root {
            --primary: #163832;
            --primary-light: #235347;
            --secondary: #8EB69B;
            --accent: #235347;
            --dark: #051F20;
            --text: #0B2B26;
            --text-light: #235347;
            --bg: #DAF1DE;
            --white: #ffffff;
            --warning: #8EB69B;
            --danger: #163832;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: var(--bg); color: var(--text); line-height: 1.6; }

        /* Header */
        header { background: var(--white); box-shadow: 0 1px 3px rgba(0,0,0,0.1); position: sticky; top: 0; z-index: 1000; }
        .header-container { max-width: 1280px; margin: 0 auto; padding: 1rem 2rem; display: flex; align-items: center; justify-content: space-between; }
        .logo { display: flex; align-items: center; gap: 0.75rem; }
        .logo-icon { width: 40px; height: 40px; background: linear-gradient(135deg, var(--primary), var(--secondary)); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.2rem; }
        .logo-text h1 { font-size: 1.1rem; font-weight: 700; color: var(--dark); line-height: 1.2; }
        .logo-text p { font-size: 0.75rem; color: var(--text-light); }

        nav { display: flex; align-items: center; gap: 2rem; }
        nav a { text-decoration: none; color: var(--text); font-weight: 500; font-size: 0.9rem; transition: color 0.2s; position: relative; }
        nav a:hover, nav a.active { color: var(--primary); }
        nav a.active::after { content: ''; position: absolute; bottom: -4px; left: 0; width: 100%; height: 2px; background: var(--primary); border-radius: 2px; }

        .nav-auth-area { display: flex; align-items: center; gap: 0.75rem; }
        .btn-login { background: linear-gradient(135deg, var(--primary), var(--secondary)); color: white; padding: 0.5rem 1.1rem; border-radius: 9999px; text-decoration: none; font-weight: 600; font-size: 0.82rem; display: flex; align-items: center; gap: 0.4rem; border: none; cursor: pointer; transition: transform 0.2s, box-shadow 0.2s; }
        .btn-login:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(22,56,50,0.3); }
        .user-avatar-btn { display: flex; align-items: center; gap: 0.6rem; background: #f0faf3; border: 1.5px solid #8EB69B; border-radius: 9999px; padding: 0.35rem 1rem 0.35rem 0.35rem; cursor: pointer; transition: all 0.2s; position: relative; text-decoration: none; color: var(--text); }
        .user-avatar-btn:hover { background: #DAF1DE; border-color: var(--primary); }
        .user-avatar { width: 30px; height: 30px; border-radius: 50%; background: linear-gradient(135deg, var(--primary), var(--secondary)); display: flex; align-items: center; justify-content: center; color: white; font-size: 0.75rem; font-weight: 700; flex-shrink: 0; }
        .user-name-short { font-size: 0.82rem; font-weight: 600; color: var(--dark); max-width: 100px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }

        /* Mobile menu */
        .mobile-menu-btn { display: none; background: none; border: none; font-size: 1.3rem; color: var(--primary); cursor: pointer; }

        /* Footer */
        footer { background: var(--dark); color: white; padding: 4rem 2rem 2rem; margin-top: 4rem; }
        .footer-container { max-width: 1280px; margin: 0 auto; display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 3rem; }
        .footer-brand .logo { margin-bottom: 1rem; }
        .footer-brand .logo-icon { background: linear-gradient(135deg, var(--primary), var(--secondary)); }
        .footer-brand .logo-text h1 { color: white; }
        .footer-brand .logo-text p { color: #8EB69B; }
        .footer-brand p { color: #8EB69B; font-size: 0.9rem; line-height: 1.7; max-width: 300px; }
        .footer-section h4 { font-size: 0.9rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 1.25rem; color: #DAF1DE; }
        .footer-section a { display: block; color: #8EB69B; text-decoration: none; margin-bottom: 0.75rem; font-size: 0.9rem; transition: color 0.2s; }
        .footer-section a:hover { color: white; }
        .footer-bottom { max-width: 1280px; margin: 3rem auto 0; padding-top: 2rem; border-top: 1px solid #163832; display: flex; justify-content: space-between; align-items: center; color: #8EB69B; font-size: 0.85rem; flex-wrap: wrap; gap: 1rem; }
        .footer-bottom a { color: #DAF1DE; text-decoration: none; font-weight: 600; }

        /* Flash messages */
        .flash-message { position: fixed; top: 5rem; right: 1.5rem; z-index: 9999; padding: 0.75rem 1.25rem; border-radius: 12px; font-size: 0.84rem; font-weight: 500; display: flex; align-items: center; gap: 0.5rem; box-shadow: 0 8px 24px rgba(0,0,0,0.2); transform: translateX(120%); transition: transform 0.3s; max-width: 300px; }
        .flash-message.show { transform: translateX(0); }
        .flash-success { background: var(--dark); color: white; }
        .flash-error { background: #ef4444; color: white; }

        /* Responsive */
        @media (max-width: 1024px) {
            nav { display: none; position: absolute; top: 100%; left: 0; right: 0; background: white; flex-direction: column; padding: 1rem 2rem; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
            nav.show { display: flex; }
            .mobile-menu-btn { display: block; }
        }
        @media (max-width: 768px) {
            .header-container { flex-wrap: wrap; gap: 1rem; }
            .footer-container { grid-template-columns: 1fr; gap: 2rem; }
            .footer-bottom { flex-direction: column; text-align: center; }
        }
    </style>
    <?php echo $__env->yieldContent('head'); ?>
</head>
<body>

    <!-- Header -->
    <header>
        <div class="header-container">
            <div class="logo">
                <div class="logo-icon"><i class="fas fa-water"></i></div>
                <div class="logo-text">
                    <h1>SIG Irigasi Sidoarjo</h1>
                    <p>Kabupaten Sidoarjo, Jawa Timur</p>
                </div>
            </div>
            <button class="mobile-menu-btn" onclick="document.querySelector('nav').classList.toggle('show')"><i class="fas fa-bars"></i></button>
            <nav>
                <a href="<?php echo e(route('home')); ?>" class="<?php echo e(request()->routeIs('home') ? 'active' : ''); ?>">Beranda</a>
                <a href="<?php echo e(route('peta.index')); ?>" class="<?php echo e(request()->routeIs('peta.*') ? 'active' : ''); ?>">Peta Interaktif</a>
                <a href="<?php echo e(route('data-irigasi.index')); ?>" class="<?php echo e(request()->routeIs('data-irigasi.*') ? 'active' : ''); ?>">Data Irigasi</a>
                <a href="<?php echo e(route('laporan.index')); ?>" class="<?php echo e(request()->routeIs('laporan.*') ? 'active' : ''); ?>">Laporan</a>
                <a href="<?php echo e(route('profil.index')); ?>" class="<?php echo e(request()->routeIs('profil.*') ? 'active' : ''); ?>">Profil</a>
            </nav>
            <div class="nav-auth-area">
                <?php if(auth()->guard('web')->guest()): ?>
                    <a href="<?php echo e(route('login')); ?>" class="btn-login"><i class="fas fa-sign-in-alt"></i> Masuk</a>
                <?php else: ?>
                    <a href="<?php echo e(route('profil.index')); ?>" class="user-avatar-btn">
                        <div class="user-avatar"><?php echo e(substr(Auth::guard('web')->user()->name, 0, 1)); ?></div>
                        <span class="user-name-short"><?php echo e(explode(' ', Auth::guard('web')->user()->name)[0]); ?></span>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <!-- Flash Messages -->
    <?php if(session('success')): ?>
        <div class="flash-message flash-success show" id="flashMsg">
            <i class="fas fa-check-circle"></i> <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <div class="flash-message flash-error show" id="flashMsg">
            <i class="fas fa-exclamation-circle"></i> <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <!-- Main Content -->
    <?php echo $__env->yieldContent('content'); ?>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <div class="footer-brand">
                <div class="logo">
                    <div class="logo-icon"><i class="fas fa-water"></i></div>
                    <div class="logo-text">
                        <h1>SIG Irigasi Sidoarjo</h1>
                        <p>Kabupaten Sidoarjo, Jawa Timur</p>
                    </div>
                </div>
                <p>Sistem Informasi Geografis Pemantauan dan Pelaporan Kondisi Saluran Irigasi Kabupaten Sidoarjo.</p>
            </div>
            <div class="footer-section">
                <h4>Navigasi</h4>
                <a href="<?php echo e(route('home')); ?>">Beranda</a>
                <a href="<?php echo e(route('peta.index')); ?>">Peta Interaktif</a>
                <a href="<?php echo e(route('data-irigasi.index')); ?>">Data Irigasi</a>
                <a href="<?php echo e(route('laporan.index')); ?>">Laporan Kerusakan</a>
            </div>
            <div class="footer-section">
                <h4>Kelola</h4>
                <a href="<?php echo e(route('laporan.create')); ?>">Tambah Laporan</a>
                <a href="<?php echo e(route('data-irigasi.index')); ?>">Saluran Aktif</a>
                <a href="<?php echo e(route('laporan.index')); ?>">Laporan Masuk</a>
            </div>
        </div>
        <div class="footer-bottom">
            <div>&copy; <?php echo e(date('Y')); ?> Sistem Informasi Irigasi - Kabupaten Sidoarjo</div>
            <div>Dibuat oleh <a href="#">Rahmat Eka Saputra</a> - Tugas Akhir S1 RPL</div>
        </div>
    </footer>

    <script>
        // Auto hide flash messages
        setTimeout(() => {
            const flash = document.getElementById('flashMsg');
            if (flash) {
                flash.classList.remove('show');
                setTimeout(() => flash.remove(), 300);
            }
        }, 4000);
    </script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\Users\Rahmat Eka\Peta-Interaktif\resources\views/layouts/app.blade.php ENDPATH**/ ?>