<?php $__env->startSection('title', 'Profil Admin - SIG Irigasi Sidoarjo'); ?>
<?php $__env->startSection('page-title', 'Profil'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .profile-card { background: white; border-radius: 16px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); overflow: hidden; }
    .profile-cover { height: 140px; background: linear-gradient(135deg, #051F20, #163832, #235347); position: relative; }
    .profile-body { padding: 0 2rem 2rem; position: relative; }
    .profile-avatar { width: 90px; height: 90px; border-radius: 50%; background: linear-gradient(135deg, var(--primary), var(--secondary)); display: flex; align-items: center; justify-content: center; color: white; font-size: 2rem; font-weight: 800; border: 4px solid white; box-shadow: 0 4px 15px rgba(0,0,0,0.15); margin-top: -45px; margin-bottom: 1rem; }
    .profile-name h2 { font-size: 1.4rem; font-weight: 800; color: var(--dark); }
    .profile-name p { font-size: 0.85rem; color: #94a3b8; margin-top: 0.2rem; }
    .role-badge { display: inline-flex; align-items: center; gap: 0.35rem; padding: 0.25rem 0.85rem; border-radius: 9999px; font-size: 0.72rem; font-weight: 700; text-transform: uppercase; background: #ede9fe; color: #7c3aed; margin-top: 0.5rem; }
    .profile-tabs { display: flex; border-bottom: 2px solid #f1f5f9; margin: 1.5rem 0 1.25rem; }
    .profile-tab { padding: 0.75rem 1.25rem; font-size: 0.88rem; font-weight: 600; color: #94a3b8; cursor: pointer; border: none; background: none; border-bottom: 2px solid transparent; margin-bottom: -2px; transition: all 0.2s; }
    .profile-tab:hover { color: var(--primary); }
    .profile-tab.active { color: var(--primary); border-bottom-color: var(--primary); }
    .tab-content { display: none; }
    .tab-content.active { display: block; }
    .form-group { margin-bottom: 1rem; }
    .form-group label { display: block; font-size: 0.82rem; font-weight: 600; color: var(--text); margin-bottom: 0.35rem; }
    .form-control { width: 100%; padding: 0.6rem 0.85rem; border: 1.5px solid #e2e8f0; border-radius: 8px; font-family: inherit; font-size: 0.85rem; outline: none; }
    .form-control:focus { border-color: var(--primary-light); }
    .form-control:read-only { background: #f8fafc; color: #94a3b8; }
    .form-control.is-invalid { border-color: #ef4444; }
    .invalid-feedback { font-size: 0.78rem; color: #ef4444; margin-top: 0.25rem; }
    .btn-save { display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.65rem 1.5rem; border-radius: 10px; background: linear-gradient(135deg, var(--primary), var(--secondary)); color: white; font-family: inherit; font-size: 0.88rem; font-weight: 700; cursor: pointer; border: none; transition: transform 0.2s; }
    .btn-save:hover { transform: translateY(-2px); }
    .btn-pass { display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.65rem 1.5rem; border-radius: 10px; background: #DAF1DE; color: var(--primary); font-family: inherit; font-size: 0.88rem; font-weight: 700; cursor: pointer; border: 1.5px solid var(--secondary); transition: all 0.2s; }
    .btn-pass:hover { background: var(--primary); color: white; }
    .btn-logout { display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.65rem 1.5rem; border-radius: 10px; background: #fee2e2; color: #b91c1c; font-family: inherit; font-size: 0.88rem; font-weight: 700; cursor: pointer; border: 1.5px solid #fecaca; transition: all 0.2s; text-decoration: none; }
    .btn-logout:hover { background: #b91c1c; color: white; }
    .info-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem; }
</style>

<div class="profile-card">
    <div class="profile-cover"></div>
    <div class="profile-body">
        <div class="profile-avatar"><?php echo e(substr($admin->name, 0, 1)); ?></div>
        <div class="profile-name">
            <h2><?php echo e($admin->name); ?></h2>
            <p><?php echo e($admin->email); ?></p>
            <span class="role-badge"><i class="fas fa-<?php echo e($admin->role=='admin'?'shield-alt':'user-cog'); ?>"></i> <?php echo e(ucfirst($admin->role)); ?></span>
        </div>

        <div class="profile-tabs">
            <button class="profile-tab active" onclick="switchTab('profil', this)">Profil</button>
            <button class="profile-tab" onclick="switchTab('password', this)">Password</button>
        </div>

        <!-- Tab Profil -->
        <div id="tab-profil" class="tab-content active">
            <form method="POST" action="<?php echo e(route('admin.profil.update')); ?>">
                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                <div class="info-row">
                    <div class="form-group"><label>Nama Lengkap</label><input type="text" name="name" class="form-control" value="<?php echo e($admin->name); ?>" required></div>
                    <div class="form-group"><label>Email</label><input type="email" class="form-control" value="<?php echo e($admin->email); ?>" readonly></div>
                </div>
                <div class="info-row">
                    <div class="form-group"><label>No. Telepon</label><input type="tel" name="phone" class="form-control" value="<?php echo e($admin->phone); ?>"></div>
                    <div class="form-group"><label>Peran</label><input type="text" class="form-control" value="<?php echo e(ucfirst($admin->role)); ?>" readonly></div>
                </div>
                <div style="display:flex;gap:1rem;">
                    <button type="submit" class="btn-save"><i class="fas fa-save"></i> Simpan Perubahan</button>
                    <a href="<?php echo e(route('admin.logout')); ?>" class="btn-logout" onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();"><i class="fas fa-sign-out-alt"></i> Keluar</a>
                </div>
            </form>
        </div>

        <!-- Tab Password -->
        <div id="tab-password" class="tab-content">
            <form method="POST" action="<?php echo e(route('admin.profil.password')); ?>">
                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                <div class="form-group">
                    <label>Password Saat Ini</label>
                    <input type="password" name="current_password" class="form-control <?php $__errorArgs = ['current_password'];
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
                <div class="form-group">
                    <label>Password Baru</label>
                    <input type="password" name="password" class="form-control <?php $__errorArgs = ['password'];
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
                <div class="form-group">
                    <label>Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>
                <button type="submit" class="btn-pass"><i class="fas fa-key"></i> Ubah Password</button>
            </form>
        </div>
    </div>
</div>

<script>
    function switchTab(tab, el) {
        document.querySelectorAll('.tab-content').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.profile-tab').forEach(t => t.classList.remove('active'));
        document.getElementById('tab-' + tab).classList.add('active');
        el.classList.add('active');
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Rahmat Eka\Peta-Interaktif\resources\views/admin/profil.blade.php ENDPATH**/ ?>