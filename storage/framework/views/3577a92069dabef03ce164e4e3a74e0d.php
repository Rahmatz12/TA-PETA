<?php $__env->startSection('title', 'Dashboard Admin - SIG Irigasi Sidoarjo'); ?>
<?php $__env->startSection('page-title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .dashboard-stats { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.25rem; margin-bottom: 2rem; }
    .dstat-card { background: white; border-radius: 14px; padding: 1.5rem; box-shadow: 0 1px 4px rgba(0,0,0,0.06); display: flex; align-items: center; gap: 1rem; }
    .dstat-icon { width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; flex-shrink: 0; }
    .dstat-info h3 { font-size: 1.6rem; font-weight: 700; color: var(--dark); line-height: 1; }
    .dstat-info p { font-size: 0.8rem; color: #94a3b8; margin-top: 0.25rem; }
    .dashboard-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem; }
    .dash-card { background: white; border-radius: 14px; box-shadow: 0 1px 4px rgba(0,0,0,0.06); overflow: hidden; }
    .dash-card-header { padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center; }
    .dash-card-header h3 { font-size: 1rem; font-weight: 700; color: var(--dark); }
    .dash-card-body { padding: 1rem; }
    .kondisi-bar { display: flex; align-items: center; gap: 1rem; margin-bottom: 0.85rem; }
    .kondisi-bar .label { font-size: 0.82rem; font-weight: 600; color: var(--text); min-width: 100px; }
    .kondisi-bar .bar-wrap { flex: 1; height: 10px; background: #f1f5f9; border-radius: 5px; overflow: hidden; }
    .kondisi-bar .bar-fill { height: 100%; border-radius: 5px; transition: width 0.5s; }
    .kondisi-bar .count { font-size: 0.82rem; font-weight: 700; color: var(--dark); min-width: 30px; text-align: right; }
    .jenis-pie { display: flex; align-items: center; gap: 1.5rem; padding: 1rem; }
    .pie-chart { width: 140px; height: 140px; border-radius: 50%; position: relative; flex-shrink: 0; }
    .pie-legend { flex: 1; }
    .pie-item { display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem; font-size: 0.82rem; }
    .pie-dot { width: 10px; height: 10px; border-radius: 3px; flex-shrink: 0; }
    .list-item-sm { display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem 1rem; border-bottom: 1px solid #f8fafc; font-size: 0.85rem; }
    .list-item-sm:last-child { border-bottom: none; }
    .list-avatar-sm { width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; flex-shrink: 0; }
    .list-info-sm h4 { font-weight: 600; color: var(--dark); font-size: 0.85rem; }
    .list-info-sm p { font-size: 0.75rem; color: #94a3b8; }
    .laporan-badge { padding: 0.2rem 0.6rem; border-radius: 9999px; font-size: 0.68rem; font-weight: 600; }
    .lb-menunggu { background: #fef9c3; color: #a16207; }
    .lb-diproses { background: #ede9fe; color: #7c3aed; }
    .lb-selesai { background: #dbeafe; color: #1d4ed8; }
    .lb-ditolak { background: #fee2e2; color: #b91c1c; }
    @media (max-width: 1024px) {
        .dashboard-stats { grid-template-columns: repeat(2, 1fr); }
        .dashboard-grid { grid-template-columns: 1fr; }
    }
    @media (max-width: 768px) {
        .dashboard-stats { grid-template-columns: 1fr; }
    }
</style>

<div class="dashboard-stats">
    <div class="dstat-card">
        <div class="dstat-icon" style="background:#e0f2fe;color:#0369a1"><i class="fas fa-route"></i></div>
        <div class="dstat-info"><h3><?php echo e($stats['total_saluran']); ?></h3><p>Total Saluran</p></div>
    </div>
    <div class="dstat-card">
        <div class="dstat-icon" style="background:#fef3c7;color:#d97706"><i class="fas fa-clipboard-list"></i></div>
        <div class="dstat-info"><h3><?php echo e($stats['total_laporan']); ?></h3><p>Total Laporan</p></div>
    </div>
    <div class="dstat-card">
        <div class="dstat-icon" style="background:#dcfce7;color:#16a34a"><i class="fas fa-users"></i></div>
        <div class="dstat-info"><h3><?php echo e($stats['total_masyarakat']); ?></h3><p>Masyarakat</p></div>
    </div>
    <div class="dstat-card">
        <div class="dstat-icon" style="background:#ede9fe;color:#7c3aed"><i class="fas fa-user-shield"></i></div>
        <div class="dstat-info"><h3><?php echo e($stats['total_admin']); ?></h3><p>Admin/Petugas</p></div>
    </div>
</div>

<div class="dashboard-grid">
    <div>
        <div class="dash-card" style="margin-bottom:1.5rem">
            <div class="dash-card-header"><h3><i class="fas fa-chart-bar" style="margin-right:0.4rem;color:var(--primary-light)"></i>Kondisi Saluran</h3></div>
            <div class="dash-card-body">
                <?php $totalKondisi = array_sum($kondisiStats); ?>
                <div class="kondisi-bar">
                    <div class="label">Baik</div>
                    <div class="bar-wrap"><div class="bar-fill" style="width:<?php echo e($totalKondisi > 0 ? ($kondisiStats['baik']/$totalKondisi)*100 : 0); ?>%;background:#16a34a"></div></div>
                    <div class="count"><?php echo e($kondisiStats['baik']); ?></div>
                </div>
                <div class="kondisi-bar">
                    <div class="label">Perbaikan</div>
                    <div class="bar-wrap"><div class="bar-fill" style="width:<?php echo e($totalKondisi > 0 ? ($kondisiStats['perbaikan']/$totalKondisi)*100 : 0); ?>%;background:#a855f7"></div></div>
                    <div class="count"><?php echo e($kondisiStats['perbaikan']); ?></div>
                </div>
                <div class="kondisi-bar">
                    <div class="label">Rusak Ringan</div>
                    <div class="bar-wrap"><div class="bar-fill" style="width:<?php echo e($totalKondisi > 0 ? ($kondisiStats['rusak_ringan']/$totalKondisi)*100 : 0); ?>%;background:#3b82f6"></div></div>
                    <div class="count"><?php echo e($kondisiStats['rusak_ringan']); ?></div>
                </div>
                <div class="kondisi-bar">
                    <div class="label">Rusak Sedang</div>
                    <div class="bar-wrap"><div class="bar-fill" style="width:<?php echo e($totalKondisi > 0 ? ($kondisiStats['rusak_sedang']/$totalKondisi)*100 : 0); ?>%;background:#eab308"></div></div>
                    <div class="count"><?php echo e($kondisiStats['rusak_sedang']); ?></div>
                </div>
                <div class="kondisi-bar">
                    <div class="label">Rusak Berat</div>
                    <div class="bar-wrap"><div class="bar-fill" style="width:<?php echo e($totalKondisi > 0 ? ($kondisiStats['rusak_ringan']/$totalKondisi)*100 : 0); ?>%;background:#ef4444"></div></div>
                    <div class="count"><?php echo e($kondisiStats['rusak_berat']); ?></div>
                </div>
            </div>
        </div>

        <div class="dash-card">
            <div class="dash-card-header"><h3><i class="fas fa-clipboard-list" style="margin-right:0.4rem;color:var(--primary-light)"></i>Laporan Terbaru</h3></div>
            <div class="dash-card-body">
                <?php $__empty_1 = true; $__currentLoopData = $recentLaporans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $laporan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="list-item-sm">
                    <div class="list-avatar-sm" style="background:#fef3c7;color:#d97706"><i class="fas fa-file-alt"></i></div>
                    <div class="list-info-sm" style="flex:1">
                        <h4><?php echo e(Str::limit($laporan->jenis_kerusakan, 40)); ?></h4>
                        <p><?php echo e($laporan->nama_saluran); ?> - <?php echo e($laporan->created_at->format('d M Y')); ?></p>
                    </div>
                    <?php
                        $lbClass = match($laporan->status) { 'menunggu'=>'lb-menunggu', 'diproses'=>'lb-diproses', 'selesai'=>'lb-selesai', 'ditolak'=>'lb-ditolak', default=>'lb-menunggu' };
                    ?>
                    <span class="laporan-badge <?php echo e($lbClass); ?>"><?php echo e(ucfirst($laporan->status)); ?></span>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div style="text-align:center;padding:2rem;color:#94a3b8"><i class="fas fa-inbox" style="font-size:2rem;display:block;margin-bottom:0.5rem"></i>Belum ada laporan</div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div>
        <div class="dash-card" style="margin-bottom:1.5rem">
            <div class="dash-card-header"><h3><i class="fas fa-chart-pie" style="margin-right:0.4rem;color:var(--primary-light)"></i>Jenis Saluran</h3></div>
            <div class="dash-card-body">
                <div class="jenis-pie">
                    <div class="pie-chart" id="jenisPie"></div>
                    <div class="pie-legend">
                        <?php $__currentLoopData = $jenisStats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jenis => $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="pie-item">
                            <div class="pie-dot" style="background:<?php echo e(['#163832','#235347','#8EB69B','#0B2B26','#DAF1DE'][array_search($jenis, array_keys($jenisStats))]); ?>"></div>
                            <span><?php echo e(ucfirst($jenis)); ?> (<?php echo e($count); ?>)</span>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="dash-card">
            <div class="dash-card-header"><h3><i class="fas fa-user-plus" style="margin-right:0.4rem;color:var(--primary-light)"></i>Pengguna Terbaru</h3></div>
            <div class="dash-card-body">
                <?php $__empty_1 = true; $__currentLoopData = $recentUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="list-item-sm">
                    <div class="list-avatar-sm" style="background:#e0f2fe;color:#0369a1;font-weight:700"><?php echo e(substr($user->name, 0, 1)); ?></div>
                    <div class="list-info-sm">
                        <h4><?php echo e($user->name); ?></h4>
                       
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div style="text-align:center;padding:2rem;color:#94a3b8">Belum ada pengguna</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<style>
    #jenisPie { background: conic-gradient(
        #163832 0deg <?php echo e($jenisStats['primer'] > 0 ? ($jenisStats['primer']/array_sum($jenisStats))*360 : 0); ?>deg,
        #235347 <?php echo e($jenisStats['primer'] > 0 ? ($jenisStats['primer']/array_sum($jenisStats))*360 : 0); ?>deg <?php echo e($jenisStats['primer']+$jenisStats['sekunder'] > 0 ? (($jenisStats['primer']+$jenisStats['sekunder'])/array_sum($jenisStats))*360 : 0); ?>deg,
        #8EB69B <?php echo e($jenisStats['primer']+$jenisStats['sekunder'] > 0 ? (($jenisStats['primer']+$jenisStats['sekunder'])/array_sum($jenisStats))*360 : 0); ?>deg <?php echo e($jenisStats['primer']+$jenisStats['sekunder']+$jenisStats['tersier'] > 0 ? (($jenisStats['primer']+$jenisStats['sekunder']+$jenisStats['tersier'])/array_sum($jenisStats))*360 : 0); ?>deg,
        #0B2B26 <?php echo e($jenisStats['primer']+$jenisStats['sekunder']+$jenisStats['tersier'] > 0 ? (($jenisStats['primer']+$jenisStats['sekunder']+$jenisStats['tersier'])/array_sum($jenisStats))*360 : 0); ?>deg <?php echo e(array_sum($jenisStats)-$jenisStats['bendungan'] > 0 ? ((array_sum($jenisStats)-$jenisStats['bendungan'])/array_sum($jenisStats))*360 : 0); ?>deg,
        #DAF1DE <?php echo e(array_sum($jenisStats)-$jenisStats['bendungan'] > 0 ? ((array_sum($jenisStats)-$jenisStats['bendungan'])/array_sum($jenisStats))*360 : 0); ?>deg 360deg
    ); }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Rahmat Eka\Peta-Interaktif\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>