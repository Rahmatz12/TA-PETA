<?php $__env->startSection('title', 'Masuk - SIG Irigasi Sidoarjo'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .auth-page { min-height: 80vh; display: flex; align-items: center; justify-content: center; padding: 2rem; }
    .auth-wrapper { display: grid; grid-template-columns: 1fr 1fr; max-width: 1000px; width: 100%; background: white; border-radius: 24px; overflow: hidden; box-shadow: 0 20px 60px rgba(0,0,0,0.15); }
    .auth-visual { background: linear-gradient(135deg, #051F20 0%, #163832 50%, #235347 100%); color: white; padding: 3rem; display: flex; flex-direction: column; justify-content: center; position: relative; overflow: hidden; }
    .auth-visual::before { content: ''; position: absolute; inset: 0; background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E"); opacity: 0.3; }
    .auth-visual-content { position: relative; z-index: 1; }
    .auth-visual .logo-icon-big { width: 60px; height: 60px; border-radius: 16px; background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); display: flex; align-items: center; justify-content: center; font-size: 1.8rem; margin-bottom: 1.5rem; border: 1px solid rgba(255,255,255,0.2); }
    .auth-visual h2 { font-size: 1.8rem; font-weight: 800; margin-bottom: 1rem; }
    .auth-visual h2 span { color: #DAF1DE; }
    .auth-visual p { font-size: 0.9rem; opacity: 0.85; line-height: 1.7; }
    .auth-visual .feature-list { margin-top: 2rem; }
    .auth-visual .feature-item { display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem; font-size: 0.85rem; }
    .auth-visual .feature-item i { width: 28px; height: 28px; border-radius: 8px; background: rgba(255,255,255,0.15); display: flex; align-items: center; justify-content: center; font-size: 0.8rem; flex-shrink: 0; }
    .auth-form { padding: 3rem; display: flex; flex-direction: column; justify-content: center; }
    .auth-form h3 { font-size: 1.5rem; font-weight: 800; color: var(--dark); margin-bottom: 0.5rem; }
    .auth-form .subtitle { font-size: 0.85rem; color: #64748b; margin-bottom: 2rem; }
    .form-group { margin-bottom: 1.25rem; }
    .form-group label { display: block; font-size: 0.82rem; font-weight: 600; color: var(--text); margin-bottom: 0.4rem; }
    .form-control { width: 100%; padding: 0.7rem 0.95rem; border: 1.5px solid #e2e8f0; border-radius: 10px; font-family: inherit; font-size: 0.88rem; color: var(--text); outline: none; transition: border-color 0.2s, box-shadow 0.2s; }
    .form-control:focus { border-color: var(--primary-light); box-shadow: 0 0 0 3px rgba(35,83,71,0.1); }
    .form-control.is-invalid { border-color: #ef4444; }
    .invalid-feedback { font-size: 0.78rem; color: #ef4444; margin-top: 0.3rem; }
    .btn-auth-submit { width: 100%; padding: 0.8rem; border-radius: 12px; border: none; background: linear-gradient(135deg, var(--primary), var(--secondary)); color: white; font-size: 0.92rem; font-weight: 700; cursor: pointer; transition: transform 0.2s, box-shadow 0.2s; margin-top: 0.5rem; }
    .btn-auth-submit:hover { transform: translateY(-2px); box-shadow: 0 6px 16px rgba(22,56,50,0.35); }
    .auth-divider { text-align: center; font-size: 0.8rem; color: #94a3b8; margin: 1.5rem 0; position: relative; }
    .auth-divider::before { content: ''; position: absolute; top: 50%; left: 0; right: 0; height: 1px; background: #e2e8f0; }
    .auth-divider span { background: white; padding: 0 1rem; position: relative; }
    .auth-footer { text-align: center; font-size: 0.85rem; color: #64748b; margin-top: 1.5rem; }
    .auth-footer a { color: var(--primary); font-weight: 600; text-decoration: none; }
    .role-badge { display: inline-flex; align-items: center; gap: 0.4rem; background: var(--bg); color: var(--primary); padding: 0.35rem 0.9rem; border-radius: 9999px; font-size: 0.78rem; font-weight: 700; margin-bottom: 1.5rem; width: fit-content; }

    @media (max-width: 768px) {
        .auth-wrapper { grid-template-columns: 1fr; }
        .auth-visual { display: none; }
        .auth-form { padding: 2rem; }
    }
</style>

<div class="auth-page">
    <div class="auth-wrapper">
        <div class="auth-visual">
            <div class="auth-visual-content">
                <div class="logo-icon-big"><i class="fas fa-water"></i></div>
                <h2>SIG Irigasi <span>Sidoarjo</span></h2>
                <p>Sistem Informasi Geografis Pemantauan dan Pelaporan Kondisi Saluran Irigasi Kabupaten Sidoarjo.</p>
                <div class="feature-list">
                    <div class="feature-item"><i class="fas fa-map-marked-alt"></i> Peta interaktif saluran irigasi</div>
                    <div class="feature-item"><i class="fas fa-clipboard-list"></i> Lapor kerusakan saluran</div>
                    <div class="feature-item"><i class="fas fa-chart-line"></i> Pantau status perbaikan</div>
                    <div class="feature-item"><i class="fas fa-shield-alt"></i> Data akurat dan terpercaya</div>
                </div>
            </div>
        </div>
        <div class="auth-form">
            <div class="role-badge"><i class="fas fa-user"></i> Panel Masyarakat</div>
            <h3>Masuk ke Akun</h3>
            <p class="subtitle">Silakan masuk untuk melaporkan kerusakan saluran irigasi.</p>

            <form method="POST" action="<?php echo e(route('login')); ?>">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="email@contoh.com" value="<?php echo e(old('email')); ?>" required>
                    <?php $__errorArgs = ['email'];
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
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Masukkan password" required>
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
                <div class="form-group" style="display: flex; align-items: center; gap: 0.5rem;">
                    <input type="checkbox" name="remember" id="remember" style="accent-color: var(--primary);">
                    <label for="remember" style="margin: 0; font-weight: 500; cursor: pointer;">Ingat saya</label>
                </div>
                <button type="submit" class="btn-auth-submit"><i class="fas fa-sign-in-alt"></i> Masuk</button>
            </form>

            <div class="auth-divider"><span>atau</span></div>

            <div class="auth-footer">
                Belum punya akun? <a href="<?php echo e(route('register')); ?>">Daftar sekarang</a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Rahmat Eka\Peta-Interaktif\resources\views/auth/masyarakat-login.blade.php ENDPATH**/ ?>