<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Admin Panel - SIG Irigasi Sidoarjo'); ?></title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
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
            --bg: #f1f5f9;
            --white: #ffffff;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: var(--bg); color: var(--text); line-height: 1.6; }

        .admin-wrapper { display: flex; min-height: 100vh; }

        /* Sidebar */
        .sidebar-admin { width: 260px; background: var(--dark); color: white; display: flex; flex-direction: column; position: fixed; top: 0; left: 0; bottom: 0; z-index: 1000; overflow-y: auto; }
        .sidebar-brand { padding: 1.5rem; border-bottom: 1px solid rgba(255,255,255,0.1); display: flex; align-items: center; gap: 0.75rem; }
        .sidebar-brand .logo-icon { width: 36px; height: 36px; background: linear-gradient(135deg, var(--primary), var(--secondary)); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1rem; }
        .sidebar-brand h3 { font-size: 0.95rem; font-weight: 700; }
        .sidebar-brand p { font-size: 0.7rem; color: #8EB69B; }
        .sidebar-nav { flex: 1; padding: 1rem 0.75rem; }
        .nav-section { margin-bottom: 1.25rem; }
        .nav-section-title { font-size: 0.65rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.08em; color: #8EB69B; padding: 0 1rem; margin-bottom: 0.5rem; }
        .nav-item { display: flex; align-items: center; gap: 0.75rem; padding: 0.65rem 1rem; border-radius: 10px; color: #e2e8f0; text-decoration: none; font-size: 0.85rem; font-weight: 500; transition: all 0.2s; margin-bottom: 0.2rem; }
        .nav-item:hover, .nav-item.active { background: rgba(255,255,255,0.1); color: white; }
        .nav-item i { width: 20px; text-align: center; }
        .sidebar-footer { padding: 1rem; border-top: 1px solid rgba(255,255,255,0.1); }
        .admin-user { display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem; border-radius: 10px; background: rgba(255,255,255,0.05); }
        .admin-avatar { width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg, var(--primary), var(--secondary)); display: flex; align-items: center; justify-content: center; font-size: 0.85rem; font-weight: 700; flex-shrink: 0; }
        .admin-user-info { flex: 1; min-width: 0; }
        .admin-user-info h4 { font-size: 0.8rem; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .admin-user-info p { font-size: 0.68rem; color: #8EB69B; }

        /* Main */
        .main-admin { flex: 1; margin-left: 260px; display: flex; flex-direction: column; min-height: 100vh; }
        .topbar { background: white; padding: 0.75rem 2rem; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 1px 3px rgba(0,0,0,0.08); position: sticky; top: 0; z-index: 100; }
        .topbar-left h2 { font-size: 1.25rem; font-weight: 700; color: var(--dark); }
        .topbar-left p { font-size: 0.78rem; color: #94a3b8; }
        .topbar-right { display: flex; align-items: center; gap: 1rem; }
        .topbar-action { width: 38px; height: 38px; border-radius: 10px; background: #f1f5f9; display: flex; align-items: center; justify-content: center; color: #64748b; cursor: pointer; border: none; font-size: 1rem; transition: all 0.2s; text-decoration: none; }
        .topbar-action:hover { background: #e2e8f0; color: var(--text); }
        .content-admin { flex: 1; padding: 2rem; }

        /* Flash messages */
        .flash-message { position: fixed; top: 1rem; right: 1.5rem; z-index: 9999; padding: 0.75rem 1.25rem; border-radius: 12px; font-size: 0.84rem; font-weight: 500; display: flex; align-items: center; gap: 0.5rem; box-shadow: 0 8px 24px rgba(0,0,0,0.2); transform: translateX(120%); transition: transform 0.3s; }
        .flash-message.show { transform: translateX(0); }
        .flash-success { background: var(--dark); color: white; }
        .flash-error { background: #ef4444; color: white; }

        /* Badges */
        .badge-type { display: inline-flex; align-items: center; gap: 0.3rem; padding: 0.25rem 0.7rem; border-radius: 6px; font-size: 0.75rem; font-weight: 600; }
        .badge-status { display: inline-flex; align-items: center; gap: 0.35rem; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; }

        /* Table */
        .data-table { width: 100%; border-collapse: collapse; }
        .data-table thead { background: linear-gradient(135deg, var(--primary), var(--secondary)); color: white; }
        .data-table th { padding: 0.75rem 1.25rem; text-align: left; font-size: 0.78rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; }
        .data-table td { padding: 0.85rem 1.25rem; border-bottom: 1px solid #f1f5f9; font-size: 0.88rem; }
        .data-table tbody tr:hover td { background: #f8fafc; }

        @media (max-width: 1024px) {
            .sidebar-admin { transform: translateX(-100%); transition: transform 0.3s; }
            .sidebar-admin.show { transform: translateX(0); }
            .main-admin { margin-left: 0; }
        }
    </style>
    <?php echo $__env->yieldContent('head'); ?>
</head>
<body>
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <aside class="sidebar-admin" id="adminSidebar">
            <div class="sidebar-brand">
                <div class="logo-icon"><i class="fas fa-water"></i></div>
                <div>
                    <h3>SIG Irigasi Sidoarjo</h3>
                    <p>Panel Admin & Petugas</p>
                </div>
            </div>
            <nav class="sidebar-nav">
                <div class="nav-section">
                    <div class="nav-section-title">Menu Utama</div>
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-item <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                    <a href="<?php echo e(route('admin.users.index')); ?>" class="nav-item <?php echo e(request()->routeIs('admin.users.*') ? 'active' : ''); ?>"><i class="fas fa-users-cog"></i> Kelola Pengguna</a>
                    <a href="<?php echo e(route('admin.laporan.index')); ?>" class="nav-item <?php echo e(request()->routeIs('admin.laporan.*') ? 'active' : ''); ?>"><i class="fas fa-clipboard-list"></i> Laporan Masyarakat</a>
                </div>
                <div class="nav-section">
                    <div class="nav-section-title">Data</div>
                    <a href="<?php echo e(route('admin.data-irigasi.index')); ?>" class="nav-item <?php echo e(request()->routeIs('admin.data-irigasi.*') ? 'active' : ''); ?>"><i class="fas fa-database"></i> Data Irigasi</a>
                    <a href="<?php echo e(route('admin.peta.index')); ?>" class="nav-item <?php echo e(request()->routeIs('admin.peta.*') ? 'active' : ''); ?>"><i class="fas fa-map"></i> Peta Interaktif</a>
                </div>
            </nav>
            <div class="sidebar-footer">
                <a href="<?php echo e(route('admin.profil')); ?>" class="admin-user" style="text-decoration:none;color:inherit">
                    <div class="admin-avatar"><?php echo e(substr(Auth::guard('admin')->user()->name, 0, 1)); ?></div>
                    <div class="admin-user-info">
                        <h4><?php echo e(Auth::guard('admin')->user()->name); ?></h4>
                        <p><?php echo e(ucfirst(Auth::guard('admin')->user()->role)); ?></p>
                    </div>
                </a>
            </div>
        </aside>

        <!-- Main -->
        <div class="main-admin">
            <div class="topbar">
                <div class="topbar-left">
                    <h2><?php echo $__env->yieldContent('page-title', 'Dashboard'); ?></h2>
                    <p><?php echo e(now()->format('l, d F Y')); ?></p>
                </div>
                <div class="topbar-right">
                    <a href="<?php echo e(route('home')); ?>" class="topbar-action" title="Lihat Website"><i class="fas fa-globe"></i></a>
                    <a href="<?php echo e(route('admin.profil')); ?>" class="topbar-action" title="Profil"><i class="fas fa-user"></i></a>
                    <a href="<?php echo e(route('admin.logout')); ?>" class="topbar-action" title="Keluar" onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();"><i class="fas fa-sign-out-alt"></i></a>
                </div>
            </div>

            <?php if(session('success')): ?>
                <div class="flash-message flash-success show" id="flashMsg" style="position:static;transform:none;margin:1rem 2rem 0;max-width:none;">
                    <i class="fas fa-check-circle"></i> <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>
            <?php if(session('error')): ?>
                <div class="flash-message flash-error show" id="flashMsg" style="position:static;transform:none;margin:1rem 2rem 0;max-width:none;">
                    <i class="fas fa-exclamation-circle"></i> <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?>

            <div class="content-admin">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </div>
    </div>

    <form id="admin-logout-form" action="<?php echo e(route('admin.logout')); ?>" method="POST" style="display:none;"><?php echo csrf_field(); ?></form>

    <script>
        setTimeout(() => {
            const flash = document.getElementById('flashMsg');
            if (flash) { flash.classList.remove('show'); setTimeout(() => flash.remove(), 300); }
        }, 4000);
    </script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\Users\Rahmat Eka\Peta-Interaktif\resources\views/layouts/admin.blade.php ENDPATH**/ ?>