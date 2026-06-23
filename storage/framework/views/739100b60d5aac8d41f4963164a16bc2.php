<?php $__env->startSection('title', 'Profil - SIG Irigasi Sidoarjo'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .page-hero { background: linear-gradient(135deg, #051F20 0%, #163832 50%, #235347 100%); color: white; padding: 3rem 2rem; position: relative; overflow: hidden; }
    .page-hero::before { content: ''; position: absolute; inset: 0; background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E"); opacity: 0.3; }
    .page-hero-content { position: relative; max-width: 1280px; margin: 0 auto; display: flex; align-items: center; gap: 2rem; }
    .hero-avatar-wrap { flex-shrink: 0; }
    .hero-avatar-big { width: 90px; height: 90px; border-radius: 50%; background: rgba(255,255,255,0.15); border: 3px solid rgba(255,255,255,0.3); display: flex; align-items: center; justify-content: center; font-size: 2.5rem; font-weight: 800; color: white; backdrop-filter: blur(10px); }
    .hero-text .badge-hero { display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); padding: 0.3rem 0.9rem; border-radius: 9999px; font-size: 0.78rem; font-weight: 500; margin-bottom: 0.5rem; border: 1px solid rgba(255,255,255,0.2); }
    .hero-text h2 { font-size: 2rem; font-weight: 800; }
    .hero-text h2 span { color: #DAF1DE; }
    .hero-text p { font-size: 0.9rem; opacity: 0.8; margin-top: 0.25rem; }

    .main-container { max-width: 1280px; margin: 0 auto; padding: 2.5rem 2rem 4rem; }

    /* PROFILE GRID */
    .profile-grid { display: grid; grid-template-columns: 320px 1fr; gap: 2rem; }

    /* LEFT CARD */
    .profile-left-card { display: flex; flex-direction: column; gap: 1.5rem; }
    .profile-avatar-card { background: white; border-radius: 20px; padding: 2rem; box-shadow: 0 2px 12px rgba(0,0,0,0.06); text-align: center; }
    .profile-avatar-large { width: 100px; height: 100px; border-radius: 50%; background: linear-gradient(135deg, var(--primary), var(--secondary)); display: flex; align-items: center; justify-content: center; font-size: 2.5rem; font-weight: 800; color: white; margin: 0 auto 1rem; border: 4px solid var(--bg); box-shadow: 0 4px 16px rgba(22,56,50,0.25); }
    .profile-name { font-size: 1.2rem; font-weight: 800; color: var(--dark); margin-bottom: 0.3rem; }
    .profile-email { font-size: 0.85rem; color: #64748b; margin-bottom: 1rem; }
    .profile-role-badge { display: inline-flex; align-items: center; gap: 0.4rem; background: var(--bg); color: var(--primary); padding: 0.35rem 0.9rem; border-radius: 9999px; font-size: 0.78rem; font-weight: 700; margin-bottom: 1.25rem; }
    .profile-stats-mini { display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; border-top: 1px solid #f1f5f9; padding-top: 1.25rem; }
    .mini-stat { text-align: center; }
    .mini-stat h4 { font-size: 1.4rem; font-weight: 800; color: var(--dark); }
    .mini-stat p { font-size: 0.75rem; color: #64748b; }

    /* Quick links card */
    .quick-links-card { background: white; border-radius: 20px; padding: 1.5rem; box-shadow: 0 2px 12px rgba(0,0,0,0.06); }
    .quick-links-card h4 { font-size: 0.85rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 1rem; }
    .quick-link-item { display: flex; align-items: center; gap: 0.85rem; padding: 0.75rem; border-radius: 12px; text-decoration: none; color: var(--text); transition: background 0.2s; margin-bottom: 0.25rem; }
    .quick-link-item:hover { background: var(--bg); }
    .quick-link-item:last-child { margin-bottom: 0; }
    .ql-icon { width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 0.9rem; flex-shrink: 0; }
    .ql-icon.green { background: #DAF1DE; color: var(--primary); }
    .ql-icon.blue { background: #dbeafe; color: #1d4ed8; }
    .ql-icon.purple { background: #ede9fe; color: #7c3aed; }
    .ql-icon.orange { background: #fef3c7; color: #d97706; }
    .ql-text { flex: 1; }
    .ql-text span { display: block; font-size: 0.88rem; font-weight: 600; }
    .ql-text small { font-size: 0.75rem; color: #94a3b8; }
    .ql-arrow { color: #94a3b8; font-size: 0.75rem; }

    /* Logout btn */
    .btn-logout { width: 100%; padding: 0.75rem; border-radius: 12px; border: 1.5px solid #fca5a5; background: #fff5f5; color: #dc2626; font-family: inherit; font-size: 0.88rem; font-weight: 700; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 0.5rem; transition: all 0.2s; }
    .btn-logout:hover { background: #fee2e2; border-color: #ef4444; }

    /* RIGHT - main content */
    .profile-right { display: flex; flex-direction: column; gap: 1.5rem; }
    .profile-card { background: white; border-radius: 20px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); overflow: hidden; }
    .profile-card-header { background: linear-gradient(135deg, var(--primary), var(--primary-light)); padding: 1.25rem 1.75rem; display: flex; align-items: center; justify-content: space-between; color: white; }
    .profile-card-header .ch-left { display: flex; align-items: center; gap: 0.75rem; }
    .ch-icon { width: 36px; height: 36px; border-radius: 10px; background: rgba(255,255,255,0.15); display: flex; align-items: center; justify-content: center; font-size: 0.9rem; }
    .profile-card-header h3 { font-size: 1rem; font-weight: 700; }
    .profile-card-header p { font-size: 0.78rem; opacity: 0.8; margin-top: 0.1rem; }
    .btn-edit { background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.3); color: white; padding: 0.4rem 0.9rem; border-radius: 8px; font-size: 0.78rem; font-weight: 600; cursor: pointer; transition: background 0.2s; display: flex; align-items: center; gap: 0.35rem; font-family: inherit; }
    .btn-edit:hover { background: rgba(255,255,255,0.25); }
    .profile-card-body { padding: 1.75rem; }

    /* Info rows */
    .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; }
    .info-label { font-size: 0.75rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.3rem; }
    .info-value { font-size: 0.92rem; font-weight: 600; color: var(--dark); display: flex; align-items: center; gap: 0.5rem; }

    /* Edit form */
    .edit-section { display: none; border-top: 1px solid #f1f5f9; padding-top: 1.5rem; margin-top: 1.5rem; }
    .edit-section.show { display: block; }
    .edit-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
    .edit-field { display: flex; flex-direction: column; gap: 0.35rem; }
    .edit-field label { font-size: 0.8rem; font-weight: 600; color: var(--text); }
    .edit-field input { padding: 0.65rem 0.9rem; border: 1.5px solid #e2e8f0; border-radius: 10px; font-family: inherit; font-size: 0.88rem; outline: none; transition: border-color 0.2s; }
    .edit-field input:focus { border-color: var(--primary-light); box-shadow: 0 0 0 3px rgba(35,83,71,0.1); }
    .edit-field input.is-invalid { border-color: #ef4444; }
    .edit-field .invalid-feedback { font-size: 0.78rem; color: #ef4444; margin-top: 0.3rem; }
    .edit-actions { display: flex; gap: 0.75rem; margin-top: 1.25rem; }
    .btn-save { background: linear-gradient(135deg, var(--primary), var(--secondary)); color: white; padding: 0.65rem 1.5rem; border-radius: 10px; border: none; font-family: inherit; font-size: 0.88rem; font-weight: 700; cursor: pointer; transition: transform 0.2s; display: flex; align-items: center; gap: 0.4rem; }
    .btn-save:hover { transform: translateY(-2px); }
    .btn-cancel { background: white; color: #64748b; padding: 0.65rem 1.5rem; border-radius: 10px; border: 1.5px solid #e2e8f0; font-family: inherit; font-size: 0.88rem; font-weight: 600; cursor: pointer; transition: all 0.2s; }
    .btn-cancel:hover { background: #f8fafc; }

    /* Activity */
    .activity-item { display: flex; align-items: flex-start; gap: 1rem; padding: 1rem 0; border-bottom: 1px solid #f1f5f9; }
    .activity-item:last-child { border-bottom: none; padding-bottom: 0; }
    .activity-icon { width: 40px; height: 40px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 0.9rem; flex-shrink: 0; }
    .act-laporan { background: #fef9c3; color: #d97706; }
    .act-verif { background: #dcfce7; color: #16a34a; }
    .act-peta { background: #dbeafe; color: #1d4ed8; }
    .act-daftar { background: #ede9fe; color: #7c3aed; }
    .activity-text h5 { font-size: 0.88rem; font-weight: 700; color: var(--dark); margin-bottom: 0.15rem; }
    .activity-text p { font-size: 0.8rem; color: #64748b; }
    .activity-time { margin-left: auto; font-size: 0.75rem; color: #94a3b8; white-space: nowrap; }

    /* Security card */
    .security-item { display: flex; align-items: center; gap: 1rem; padding: 1rem; border-radius: 12px; background: #f8fafc; margin-bottom: 0.75rem; }
    .security-item:last-child { margin-bottom: 0; }
    .sec-icon { width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 0.9rem; flex-shrink: 0; }
    .sec-icon.ok { background: #dcfce7; color: #16a34a; }
    .sec-icon.warn { background: #fef3c7; color: #d97706; }
    .sec-text { flex: 1; }
    .sec-text h5 { font-size: 0.88rem; font-weight: 700; color: var(--dark); }
    .sec-text p { font-size: 0.78rem; color: #64748b; }
    .sec-badge { font-size: 0.75rem; font-weight: 600; padding: 0.25rem 0.7rem; border-radius: 9999px; }
    .sec-badge.active { background: #dcfce7; color: #16a34a; }
    .sec-badge.inactive { background: #fef3c7; color: #d97706; }

    /* Password form inside security card */
    .password-form { border-top: 1px solid #f1f5f9; padding-top: 1.25rem; margin-top: 0.5rem; }
    .password-form .edit-grid { grid-template-columns: 1fr 1fr 1fr; }

    /* Responsive */
    @media (max-width: 1024px) {
        .profile-grid { grid-template-columns: 1fr; }
        .profile-left-card { display: grid; grid-template-columns: 1fr 1fr; }
    }
    @media (max-width: 768px) {
        .profile-left-card { grid-template-columns: 1fr; }
        .info-grid, .edit-grid, .password-form .edit-grid { grid-template-columns: 1fr; }
        .page-hero-content { flex-direction: column; gap: 1rem; text-align: center; }
        .hero-text h2 { font-size: 1.5rem; }
    }
</style>

<!-- HERO -->
<section class="page-hero">
    <div class="page-hero-content">
        <div class="hero-avatar-wrap">
            <div class="hero-avatar-big"><?php echo e(substr($user->name, 0, 1)); ?></div>
        </div>
        <div class="hero-text">
            <div class="badge-hero"><i class="fas fa-user-circle"></i> PROFIL SAYA</div>
            <h2>Halo, <span><?php echo e(explode(' ', $user->name)[0]); ?>!</span></h2>
            <p><?php echo e($user->email); ?> &middot; Masyarakat</p>
        </div>
    </div>
</section>

<div class="main-container">
    <?php if(session('success')): ?>
        <div style="background:#dcfce7;border:1px solid #86efac;color:#15803d;border-radius:12px;padding:0.85rem 1.25rem;margin-bottom:1.5rem;font-size:0.88rem;font-weight:600;">
            <i class="fas fa-check-circle"></i> <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <div class="profile-grid">

        <!-- LEFT -->
        <div class="profile-left-card">
            <!-- Avatar card -->
            <div class="profile-avatar-card">
                <div class="profile-avatar-large"><?php echo e(substr($user->name, 0, 1)); ?></div>
                <div class="profile-name"><?php echo e($user->name); ?></div>
                <div class="profile-email"><?php echo e($user->email); ?></div>
                <div class="profile-role-badge">
                    <i class="fas fa-user-tag"></i>
                    <span>Masyarakat</span>
                </div>
                <div class="profile-stats-mini" style="grid-template-columns: 1fr;">
                    <div class="mini-stat">
                        <h4><?php echo e($laporanCount); ?></h4>
                        <p>Laporan Saya</p>
                    </div>
                </div>
            </div>

            <!-- Quick links -->
            <div class="quick-links-card">
                <h4>Menu Cepat</h4>
                <a href="<?php echo e(route('home')); ?>" class="quick-link-item">
                    <div class="ql-icon green"><i class="fas fa-home"></i></div>
                    <div class="ql-text"><span>Beranda</span><small>Lihat ringkasan sistem</small></div>
                    <i class="fas fa-chevron-right ql-arrow"></i>
                </a>
                <a href="<?php echo e(route('peta.index')); ?>" class="quick-link-item">
                    <div class="ql-icon blue"><i class="fas fa-map-marked-alt"></i></div>
                    <div class="ql-text"><span>Peta Interaktif</span><small>Lihat lokasi saluran</small></div>
                    <i class="fas fa-chevron-right ql-arrow"></i>
                </a>
                <a href="<?php echo e(route('laporan.index')); ?>" class="quick-link-item">
                    <div class="ql-icon orange"><i class="fas fa-clipboard-list"></i></div>
                    <div class="ql-text"><span>Laporan Kerusakan</span><small>Pantau status laporan</small></div>
                    <i class="fas fa-chevron-right ql-arrow"></i>
                </a>
                <a href="<?php echo e(route('laporan.create')); ?>" class="quick-link-item">
                    <div class="ql-icon purple"><i class="fas fa-plus-circle"></i></div>
                    <div class="ql-text"><span>Buat Laporan Baru</span><small>Laporkan kerusakan</small></div>
                    <i class="fas fa-chevron-right ql-arrow"></i>
                </a>
                <a href="<?php echo e(route('data-irigasi.index')); ?>" class="quick-link-item">
                    <div class="ql-icon green"><i class="fas fa-database"></i></div>
                    <div class="ql-text"><span>Data Irigasi</span><small>Lihat seluruh data</small></div>
                    <i class="fas fa-chevron-right ql-arrow"></i>
                </a>
            </div>

            <!-- Logout -->
            <div>
                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display:none;"><?php echo csrf_field(); ?></form>
                <button type="button" class="btn-logout" onclick="document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Keluar dari Akun
                </button>
            </div>
        </div>

        <!-- RIGHT -->
        <div class="profile-right">

            <!-- Info pribadi -->
            <div class="profile-card">
                <div class="profile-card-header">
                    <div class="ch-left">
                        <div class="ch-icon"><i class="fas fa-id-card"></i></div>
                        <div>
                            <h3>Informasi Pribadi</h3>
                            <p>Data akun dan kontak Anda</p>
                        </div>
                    </div>
                    <button class="btn-edit" type="button" onclick="toggleEdit()">
                        <i class="fas fa-pen"></i> Edit
                    </button>
                </div>
                <div class="profile-card-body">
                    <!-- View mode -->
                    <div id="infoView">
                        <div class="info-grid">
                            <div class="info-field">
                                <div class="info-label">Nama Lengkap</div>
                                <div class="info-value"><i class="fas fa-user" style="color:var(--secondary)"></i> <span><?php echo e($user->name); ?></span></div>
                            </div>
                            <div class="info-field">
                                <div class="info-label">Email</div>
                                <div class="info-value"><i class="fas fa-envelope" style="color:var(--secondary)"></i> <span><?php echo e($user->email); ?></span></div>
                            </div>
                            <div class="info-field">
                                <div class="info-label">No. Telepon</div>
                                <div class="info-value"><i class="fas fa-phone" style="color:var(--secondary)"></i> <span><?php echo e($user->phone ?? '-'); ?></span></div>
                            </div>
                            <div class="info-field">
                                <div class="info-label">Peran</div>
                                <div class="info-value"><i class="fas fa-shield-alt" style="color:var(--secondary)"></i> <span>Masyarakat</span></div>
                            </div>
                            <div class="info-field">
                                <div class="info-label">Status Akun</div>
                                <div class="info-value"><i class="fas fa-check-circle" style="color:#22c55e"></i> <span style="color:#16a34a;font-weight:700;">Aktif</span></div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit mode -->
                    <div class="edit-section <?php if($errors->hasAny(['name','phone'])): ?> show <?php endif; ?>" id="editSection">
                        <form method="POST" action="<?php echo e(route('profil.update')); ?>">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <div class="edit-grid">
                                <div class="edit-field">
                                    <label>Nama Lengkap</label>
                                    <input type="text" name="name" class="<?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('name', $user->name)); ?>" placeholder="Nama lengkap Anda" required>
                                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="edit-field">
                                    <label>No. Telepon</label>
                                    <input type="tel" name="phone" class="<?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('phone', $user->phone)); ?>" placeholder="08xx-xxxx-xxxx">
                                    <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="edit-field">
                                    <label>Email (tidak dapat diubah)</label>
                                    <input type="email" value="<?php echo e($user->email); ?>" disabled style="opacity:0.6;cursor:not-allowed;">
                                </div>
                            </div>
                            <div class="edit-actions">
                                <button type="submit" class="btn-save"><i class="fas fa-save"></i> Simpan Perubahan</button>
                                <button type="button" class="btn-cancel" onclick="toggleEdit()">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Riwayat Aktivitas -->
            <div class="profile-card">
                <div class="profile-card-header">
                    <div class="ch-left">
                        <div class="ch-icon"><i class="fas fa-history"></i></div>
                        <div>
                            <h3>Riwayat Aktivitas</h3>
                            <p>Aktivitas terbaru akun Anda</p>
                        </div>
                    </div>
                </div>
                <div class="profile-card-body">
                    <?php if(isset($activities) && count($activities) > 0): ?>
                        <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="activity-item">
                                <div class="activity-icon <?php echo e($activity['icon_class'] ?? 'act-daftar'); ?>"><i class="fas <?php echo e($activity['icon'] ?? 'fa-circle'); ?>"></i></div>
                                <div class="activity-text">
                                    <h5><?php echo e($activity['title']); ?></h5>
                                    <p><?php echo e($activity['desc']); ?></p>
                                </div>
                                <div class="activity-time"><?php echo e($activity['time']); ?></div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <div class="activity-item">
                            <div class="activity-icon act-daftar"><i class="fas fa-user-plus"></i></div>
                            <div class="activity-text">
                                <h5>Akun Dibuat</h5>
                                <p>Akun berhasil didaftarkan ke sistem</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Keamanan Akun -->
            <div class="profile-card">
                <div class="profile-card-header">
                    <div class="ch-left">
                        <div class="ch-icon"><i class="fas fa-shield-alt"></i></div>
                        <div>
                            <h3>Keamanan Akun</h3>
                            <p>Status keamanan dan ubah password</p>
                        </div>
                    </div>
                </div>
                <div class="profile-card-body">
                    <div class="security-item">
                        <div class="sec-icon ok"><i class="fas fa-lock"></i></div>
                        <div class="sec-text">
                            <h5>Password</h5>
                            <p>Password akun Anda sudah diatur</p>
                        </div>
                        <span class="sec-badge active">Aktif</span>
                    </div>
                    <div class="security-item">
                        <div class="sec-icon ok"><i class="fas fa-envelope-open-text"></i></div>
                        <div class="sec-text">
                            <h5>Verifikasi Email</h5>
                            <p>Email terdaftar di sistem</p>
                        </div>
                        <span class="sec-badge active">Terdaftar</span>
                    </div>
                    <div class="security-item">
                        <?php if($user->phone): ?>
                            <div class="sec-icon ok"><i class="fas fa-mobile-alt"></i></div>
                            <div class="sec-text">
                                <h5>Verifikasi Telepon</h5>
                                <p>Nomor: <?php echo e($user->phone); ?></p>
                            </div>
                            <span class="sec-badge active">Terdaftar</span>
                        <?php else: ?>
                            <div class="sec-icon warn"><i class="fas fa-mobile-alt"></i></div>
                            <div class="sec-text">
                                <h5>Verifikasi Telepon</h5>
                                <p>Nomor telepon belum ditambahkan</p>
                            </div>
                            <span class="sec-badge inactive">Belum</span>
                        <?php endif; ?>
                    </div>

                    <!-- Form Ubah Password -->
                    <div class="password-form">
                        <form method="POST" action="<?php echo e(route('profil.password')); ?>">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <div class="edit-grid">
                                <div class="edit-field">
                                    <label>Password Saat Ini</label>
                                    <input type="password" name="current_password" class="<?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                    <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="edit-field">
                                    <label>Password Baru</label>
                                    <input type="password" name="password" class="<?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="edit-field">
                                    <label>Konfirmasi Password Baru</label>
                                    <input type="password" name="password_confirmation" required>
                                </div>
                            </div>
                            <div class="edit-actions">
                                <button type="submit" class="btn-save"><i class="fas fa-key"></i> Ubah Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div><!-- end right -->
    </div><!-- end grid -->
</div><!-- end main -->

<script>
    function toggleEdit() {
        document.getElementById('editSection').classList.toggle('show');
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Rahmat Eka\Peta-Interaktif\resources\views/masyarakat/profil.blade.php ENDPATH**/ ?>