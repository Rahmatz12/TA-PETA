<?php $__env->startSection('title', 'Data Irigasi - SIG Irigasi Sidoarjo'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .page-hero { background: linear-gradient(135deg, #051F20 0%, #163832 50%, #235347 100%); color: white; padding: 3rem 2rem; position: relative; overflow: hidden; }
    .page-hero::before { content: ''; position: absolute; inset: 0; background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E"); opacity: 0.3; }
    .page-hero-content { position: relative; max-width: 1280px; margin: 0 auto; }
    .page-hero-content .badge { display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); padding: 0.4rem 1rem; border-radius: 9999px; font-size: 0.8rem; font-weight: 500; margin-bottom: 1rem; border: 1px solid rgba(255,255,255,0.2); }
    .page-hero-content h2 { font-size: 2.2rem; font-weight: 800; margin-bottom: 0.5rem; }
    .page-hero-content h2 span { color: #DAF1DE; }
    .page-hero-content p { font-size: 1rem; opacity: 0.85; max-width: 600px; }
    .main-container { max-width: 1280px; margin: 0 auto; padding: 2rem; }
    .top-stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; margin-bottom: 2rem; }
    .top-stat-card { background: white; border-radius: 16px; padding: 1.75rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08); display: flex; align-items: center; gap: 1.25rem; cursor: pointer; border: 2px solid transparent; transition: all 0.2s; text-decoration: none; color: var(--text); }
    .top-stat-card:hover { transform: translateY(-4px); box-shadow: 0 8px 20px rgba(0,0,0,0.12); border-color: var(--secondary); }
    .top-stat-icon { width: 60px; height: 60px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; flex-shrink: 0; }
    .top-stat-icon.total { background: #e0f2fe; color: #0369a1; }
    .top-stat-icon.baik { background: #dcfce7; color: #16a34a; }
    .top-stat-icon.rusak { background: #fee2e2; color: #b91c1c; }
    .top-stat-info h3 { font-size: 2.2rem; font-weight: 800; color: var(--dark); line-height: 1; margin-bottom: 0.35rem; }
    .top-stat-info p { color: var(--text-light); font-size: 0.95rem; font-weight: 500; margin-bottom: 0.4rem; }
    .top-stat-info .stat-sub { font-size: 0.8rem; color: #94a3b8; }
    .filter-bar { background: white; border-radius: 12px; padding: 1rem 1.5rem; box-shadow: 0 1px 4px rgba(0,0,0,0.06); margin-bottom: 1.5rem; display: flex; gap: 0.75rem; align-items: center; flex-wrap: wrap; }
    .filter-bar label { font-size: 0.85rem; font-weight: 600; color: var(--text-light); }
    .filter-select { padding: 0.45rem 0.85rem; border-radius: 8px; border: 1px solid #e2e8f0; font-family: inherit; font-size: 0.82rem; color: var(--text); background: white; cursor: pointer; outline: none; }
    .filter-select:focus { border-color: var(--primary-light); }
    .filter-input { padding: 0.45rem 0.85rem; border-radius: 8px; border: 1px solid #e2e8f0; font-family: inherit; font-size: 0.82rem; color: var(--text); flex: 1; min-width: 160px; outline: none; }
    .filter-input:focus { border-color: var(--primary-light); }
    .btn-filter { padding: 0.45rem 1rem; background: var(--primary); color: white; border: none; border-radius: 8px; font-size: 0.82rem; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 0.4rem; transition: background 0.2s; text-decoration: none; }
    .btn-filter:hover { background: var(--primary-light); }
    .status-board { background: white; border-radius: 16px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); overflow: hidden; }
    .board-header { padding: 1.5rem 1.75rem 1rem; display: flex; justify-content: space-between; align-items: center; }
    .board-header h3 { font-size: 1.15rem; font-weight: 700; color: var(--dark); }
    .data-table { width: 100%; border-collapse: collapse; }
    .data-table thead tr { border-bottom: 1px solid #f1f5f9; }
    .data-table th { padding: 0.75rem 1.25rem; text-align: left; font-size: 0.78rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.06em; }
    .data-table td { padding: 0.85rem 1.25rem; border-bottom: 1px solid #f8fafc; font-size: 0.88rem; vertical-align: middle; }
    .data-table tbody tr:hover td { background: #fafbfc; }
    .data-table tbody tr:last-child td { border-bottom: none; }
    .saluran-cell { display: flex; align-items: center; gap: 0.6rem; }
    .saluran-avatar { width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 0.85rem; flex-shrink: 0; }
    .jenis-badge { display: inline-block; padding: 0.25rem 0.7rem; border-radius: 6px; font-size: 0.78rem; font-weight: 600; }
    .j-primer { background: #e0f2fe; color: #0369a1; }
    .j-sekunder { background: #dcfce7; color: #16a34a; }
    .j-tersier { background: #fef3c7; color: #d97706; }
    .j-pintu { background: #ede9fe; color: #7c3aed; }
    .j-bendungan { background: #f3e8ff; color: #9333ea; }
    .status-badge { display: inline-flex; align-items: center; gap: 0.35rem; padding: 0.3rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; }
    .s-baik { background: #dcfce7; color: #16a34a; }
    .s-perbaikan { background: #f3e8ff; color: #7c3aed; }
    .s-rusak-berat { background: #fee2e2; color: #b91c1c; }
    .s-rusak-sedang { background: #fef9c3; color: #a16207; }
    .s-rusak-ringan { background: #dbeafe; color: #1d4ed8; }
    .detail-btn { display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.35rem 0.9rem; border-radius: 8px; font-size: 0.78rem; font-weight: 600; color: var(--primary); background: var(--bg); border: 1px solid var(--secondary); cursor: pointer; transition: all 0.2s; text-decoration: none; }
    .detail-btn:hover { background: var(--primary); color: white; transform: scale(1.04); }
    .peta-btn { display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.35rem 0.9rem; border-radius: 8px; font-size: 0.78rem; font-weight: 600; color: white; background: linear-gradient(135deg, #235347, #163832); border: none; cursor: pointer; transition: all 0.2s; text-decoration: none; }
    .peta-btn:hover { transform: scale(1.04); box-shadow: 0 3px 10px rgba(22,56,50,0.3); }
    .board-pagination { padding: 1rem 1.75rem; border-top: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center; }
    .pag-info { font-size: 0.8rem; color: #94a3b8; }
    @media (max-width: 768px) {
        .top-stats { grid-template-columns: 1fr; }
        .header-container { flex-wrap: wrap; gap: 1rem; }
    }
</style>

<section class="page-hero">
    <div class="page-hero-content">
        <div class="badge"><i class="fas fa-database"></i> DATA IRIGASI</div>
        <h2>Statistik <span>Saluran Irigasi</span></h2>
        <p>Pantau kondisi dan status saluran irigasi Kabupaten Sidoarjo secara real-time dan terpadu.</p>
    </div>
</section>

<div class="main-container">
    <div class="top-stats">
        <a href="<?php echo e(route('data-irigasi.index')); ?>" class="top-stat-card">
            <div class="top-stat-icon total"><i class="fas fa-route"></i></div>
            <div class="top-stat-info"><h3><?php echo e($stats['total']); ?></h3><p>Total Saluran</p><span class="stat-sub">Keseluruhan jaringan irigasi</span></div>
        </a>
        <a href="<?php echo e(route('data-irigasi.index')); ?>?kondisi=baik" class="top-stat-card">
            <div class="top-stat-icon baik"><i class="fas fa-check-circle"></i></div>
            <div class="top-stat-info"><h3><?php echo e($stats['baik']); ?></h3><p>Saluran Baik</p><span class="stat-sub"><?php echo e($stats['total'] > 0 ? round(($stats['baik']/$stats['total'])*100) : 0); ?>% dari total saluran</span></div>
        </a>
        <a href="<?php echo e(route('data-irigasi.index')); ?>?kondisi=rusak-berat" class="top-stat-card">
            <div class="top-stat-icon rusak"><i class="fas fa-exclamation-triangle"></i></div>
            <div class="top-stat-info"><h3><?php echo e($stats['rusak_berat'] + $stats['rusak_sedang'] + $stats['rusak_ringan']); ?></h3><p>Saluran Bermasalah</p><span class="stat-sub">Perlu perhatian segera</span></div>
        </a>
    </div>

    <form method="GET" action="<?php echo e(route('data-irigasi.index')); ?>" class="filter-bar">
        <label><i class="fas fa-filter"></i> Filter:</label>
        <select name="kondisi" class="filter-select" onchange="this.form.submit()">
            <option value="all">Semua Kondisi</option>
            <option value="baik" <?php echo e(request('kondisi')=='baik'?'selected':''); ?>>Baik</option>
            <option value="perbaikan" <?php echo e(request('kondisi')=='perbaikan'?'selected':''); ?>>Dalam Perbaikan</option>
            <option value="rusak-berat" <?php echo e(request('kondisi')=='rusak-berat'?'selected':''); ?>>Rusak Berat</option>
            <option value="rusak-sedang" <?php echo e(request('kondisi')=='rusak-sedang'?'selected':''); ?>>Rusak Sedang</option>
            <option value="rusak-ringan" <?php echo e(request('kondisi')=='rusak-ringan'?'selected':''); ?>>Rusak Ringan</option>
        </select>
        <select name="jenis" class="filter-select" onchange="this.form.submit()">
            <option value="all">Semua Jenis</option>
            <option value="primer" <?php echo e(request('jenis')=='primer'?'selected':''); ?>>Primer</option>
            <option value="sekunder" <?php echo e(request('jenis')=='sekunder'?'selected':''); ?>>Sekunder</option>
            <option value="tersier" <?php echo e(request('jenis')=='tersier'?'selected':''); ?>>Tersier</option>
            <option value="pintu" <?php echo e(request('jenis')=='pintu'?'selected':''); ?>>Pintu Air</option>
            <option value="bendungan" <?php echo e(request('jenis')=='bendungan'?'selected':''); ?>>Bendungan</option>
        </select>
        <input type="text" name="search" class="filter-input" placeholder="Cari nama saluran atau kecamatan..." value="<?php echo e(request('search')); ?>">
        <button type="submit" class="btn-filter"><i class="fas fa-search"></i> Cari</button>
        <a href="<?php echo e(route('data-irigasi.index')); ?>" class="btn-filter" style="background:#94a3b8"><i class="fas fa-sync-alt"></i> Reset</a>
    </form>

    <div class="status-board">
        <div class="board-header"><h3>Status Board Saluran</h3></div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Saluran</th>
                    <th>Jenis</th>
                    <th>Kecamatan</th>
                    <th>Kondisi</th>
                    <th>Peta</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $salurans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><span style="font-weight:600;color:var(--dark)"><?php echo e($s->nama); ?></span></td>
                    <td>
                        <div class="saluran-cell">
                            <div class="saluran-avatar" style="background:<?php echo e(match($s->jenis){'primer'=>'#e0f2fe','sekunder'=>'#dcfce7','tersier'=>'#fef3c7','pintu'=>'#ede9fe','bendungan'=>'#f3e8ff',default=>'#e0f2fe'}); ?>;color:<?php echo e(match($s->jenis){'primer'=>'#0369a1','sekunder'=>'#16a34a','tersier'=>'#d97706','pintu'=>'#7c3aed','bendungan'=>'#9333ea',default=>'#0369a1'}); ?>">
                                <i class="fas <?php echo e(match($s->jenis){'primer'=>'fa-water','sekunder'=>'fa-stream','tersier'=>'fa-project-diagram','pintu'=>'fa-dungeon','bendungan'=>'fa-dam',default=>'fa-water'}); ?>"></i>
                            </div>
                            <span style="font-weight:600;color:var(--dark);font-size:0.85rem"><?php echo e($s->nama); ?></span>
                        </div>
                    </td>
                    <td><span class="jenis-badge j-<?php echo e($s->jenis); ?>"><?php echo e(ucfirst($s->jenis)); ?></span></td>
                    <td><span style="color:#64748b"><?php echo e($s->kecamatan); ?></span></td>
                    <td>
                        <?php
                            $sc = match($s->kondisi) {
                                'baik' => 's-baik',
                                'perbaikan' => 's-perbaikan',
                                'rusak-berat' => 's-rusak-berat',
                                'rusak-sedang' => 's-rusak-sedang',
                                'rusak-ringan' => 's-rusak-ringan',
                                default => 's-baik'
                            };
                            $st = match($s->kondisi) {
                                'baik' => 'Baik',
                                'perbaikan' => 'Dalam Perbaikan',
                                'rusak-berat' => 'Rusak Berat',
                                'rusak-sedang' => 'Rusak Sedang',
                                'rusak-ringan' => 'Rusak Ringan',
                                default => ucfirst($s->kondisi)
                            };
                        ?>
                        <span class="status-badge <?php echo e($sc); ?>"><span style="width:7px;height:7px;border-radius:50%;background:currentColor"></span><?php echo e($st); ?></span>
                    </td>
                    <td>
                        <?php if($s->latitude && $s->longitude): ?>
                        <a href="<?php echo e(route('peta.index')); ?>?lat=<?php echo e($s->latitude); ?>&lng=<?php echo e($s->longitude); ?>" class="peta-btn"><i class="fas fa-map-marker-alt"></i> Peta</a>
                        <?php else: ?>
                        -
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="6" style="text-align:center;padding:2rem;color:#94a3b8"><i class="fas fa-inbox" style="font-size:2rem;margin-bottom:0.5rem;display:block"></i>Tidak ada data</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="board-pagination">
            <div class="pag-info">Menampilkan <?php echo e($salurans->firstItem() ?? 0); ?> - <?php echo e($salurans->lastItem() ?? 0); ?> dari <?php echo e($salurans->total()); ?> saluran</div>
            <div><?php echo e($salurans->links()); ?></div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Rahmat Eka\Peta-Interaktif\resources\views/masyarakat/data-irigasi.blade.php ENDPATH**/ ?>