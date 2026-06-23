<?php $__env->startSection('title', 'Data Irigasi - SIG Irigasi Sidoarjo'); ?>
<?php $__env->startSection('page-title', 'Data Irigasi'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .stats-row { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.25rem; margin-bottom: 1.5rem; }
    .sr-card { background: white; border-radius: 14px; padding: 1.5rem; box-shadow: 0 1px 4px rgba(0,0,0,0.06); display: flex; align-items: center; gap: 1rem; }
    .sr-icon { width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; flex-shrink: 0; }
    .sr-info h4 { font-size: 1.6rem; font-weight: 700; color: var(--dark); line-height: 1; }
    .sr-info p { font-size: 0.8rem; color: #94a3b8; margin-top: 0.2rem; }
    .filter-bar { background: white; border-radius: 12px; padding: 1rem 1.25rem; box-shadow: 0 1px 3px rgba(0,0,0,0.06); margin-bottom: 1.25rem; display: flex; gap: 0.75rem; align-items: center; flex-wrap: wrap; }
    .filter-select { padding: 0.45rem 0.75rem; border-radius: 8px; border: 1px solid #e2e8f0; font-family: inherit; font-size: 0.8rem; outline: none; }
    .filter-input { padding: 0.45rem 0.85rem; border-radius: 8px; border: 1px solid #e2e8f0; font-family: inherit; font-size: 0.8rem; flex: 1; min-width: 160px; outline: none; }
    .btn-filter { padding: 0.45rem 1rem; background: var(--primary); color: white; border: none; border-radius: 8px; font-size: 0.8rem; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 0.3rem; }
    .btn-add { padding: 0.55rem 1.1rem; background: linear-gradient(135deg, var(--primary), var(--secondary)); color: white; border: none; border-radius: 10px; font-size: 0.82rem; font-weight: 700; cursor: pointer; display: inline-flex; align-items: center; gap: 0.4rem; transition: transform 0.2s; }
    .btn-add:hover { transform: translateY(-2px); }
    .card-white { background: white; border-radius: 14px; box-shadow: 0 1px 4px rgba(0,0,0,0.06); overflow: hidden; }
    .card-header { padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center; }
    .card-header h3 { font-size: 1rem; font-weight: 700; color: var(--dark); }
    .data-table { width: 100%; border-collapse: collapse; }
    .data-table th { padding: 0.75rem 1.25rem; text-align: left; font-size: 0.78rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid #f1f5f9; }
    .data-table td { padding: 0.85rem 1.25rem; border-bottom: 1px solid #f8fafc; font-size: 0.85rem; }
    .data-table tbody tr:hover td { background: #f8fafc; }
    .j-badge { display: inline-block; padding: 0.2rem 0.6rem; border-radius: 6px; font-size: 0.72rem; font-weight: 600; }
    .j-primer { background: #e0f2fe; color: #0369a1; }
    .j-sekunder { background: #dcfce7; color: #16a34a; }
    .j-tersier { background: #fef3c7; color: #d97706; }
    .j-pintu { background: #ede9fe; color: #7c3aed; }
    .j-bendungan { background: #f3e8ff; color: #9333ea; }
    .s-badge { display: inline-flex; align-items: center; gap: 0.25rem; padding: 0.2rem 0.6rem; border-radius: 9999px; font-size: 0.68rem; font-weight: 600; }
    .s-baik { background: #dcfce7; color: #16a34a; }
    .s-perbaikan { background: #f3e8ff; color: #7c3aed; }
    .s-rusak-berat { background: #fee2e2; color: #b91c1c; }
    .s-rusak-sedang { background: #fef9c3; color: #a16207; }
    .s-rusak-ringan { background: #dbeafe; color: #1d4ed8; }
    .btn-sm { padding: 0.3rem 0.6rem; border-radius: 6px; font-size: 0.72rem; font-weight: 600; cursor: pointer; border: none; display: inline-flex; align-items: center; gap: 0.2rem; }
    .btn-edit { background: #dbeafe; color: #1d4ed8; }
    .btn-edit:hover { background: #1d4ed8; color: white; }
    .btn-delete { background: #fee2e2; color: #b91c1c; }
    .btn-delete:hover { background: #b91c1c; color: white; }
    .modal-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 2000; display: none; align-items: center; justify-content: center; backdrop-filter: blur(4px); }
    .modal-overlay.show { display: flex; }
    .modal-box { background: white; border-radius: 16px; width: 100%; max-width: 520px; max-height: 90vh; overflow-y: auto; padding: 1.5rem; box-shadow: 0 20px 60px rgba(0,0,0,0.3); }
    .modal-box h3 { font-size: 1rem; font-weight: 700; color: var(--dark); margin-bottom: 1rem; }
    .form-group { margin-bottom: 0.85rem; }
    .form-group label { display: block; font-size: 0.78rem; font-weight: 600; margin-bottom: 0.3rem; }
    .form-control { width: 100%; padding: 0.55rem 0.75rem; border: 1.5px solid #e2e8f0; border-radius: 8px; font-family: inherit; font-size: 0.82rem; outline: none; }
    .form-control:focus { border-color: var(--primary-light); }
    textarea.form-control { min-height: 80px; }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 0.85rem; }
    .modal-actions { display: flex; gap: 0.6rem; justify-content: flex-end; margin-top: 1rem; padding-top: 1rem; border-top: 1px solid #f1f5f9; }
    .btn-cancel-modal { padding: 0.5rem 1rem; background: #f1f5f9; color: #64748b; border: none; border-radius: 8px; font-size: 0.78rem; font-weight: 600; cursor: pointer; }
    .btn-save-modal { padding: 0.5rem 1.1rem; background: linear-gradient(135deg, var(--primary), var(--secondary)); color: white; border: none; border-radius: 8px; font-size: 0.78rem; font-weight: 700; cursor: pointer; }
    @media (max-width: 768px) { .stats-row { grid-template-columns: 1fr; } .form-row { grid-template-columns: 1fr; } }
</style>

<div class="stats-row">
    <div class="sr-card">
        <div class="sr-icon" style="background:#e0f2fe;color:#0369a1"><i class="fas fa-route"></i></div>
        <div class="sr-info"><h4><?php echo e($stats['total']); ?></h4><p>Total Saluran</p></div>
    </div>
    <div class="sr-card">
        <div class="sr-icon" style="background:#dcfce7;color:#16a34a"><i class="fas fa-check-circle"></i></div>
        <div class="sr-info"><h4><?php echo e($stats['baik']); ?></h4><p>Saluran Baik</p></div>
    </div>
    <div class="sr-card">
        <div class="sr-icon" style="background:#fee2e2;color:#b91c1c"><i class="fas fa-exclamation-triangle"></i></div>
        <div class="sr-info"><h4><?php echo e($stats['rusak_berat'] + $stats['rusak_sedang'] + $stats['rusak_ringan']); ?></h4><p>Bermasalah</p></div>
    </div>
</div>

<form method="GET" action="<?php echo e(route('admin.data-irigasi.index')); ?>" class="filter-bar">
    <select name="kondisi" class="filter-select" onchange="this.form.submit()">
        <option value="all">Semua Kondisi</option>
        <option value="baik" <?php echo e(request('kondisi')=='baik'?'selected':''); ?>>Baik</option>
        <option value="perbaikan" <?php echo e(request('kondisi')=='perbaikan'?'selected':''); ?>>Perbaikan</option>
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
    <input type="text" name="search" class="filter-input" placeholder="Cari nama atau kecamatan..." value="<?php echo e(request('search')); ?>">
    <button type="submit" class="btn-filter"><i class="fas fa-search"></i> Cari</button>
    <a href="<?php echo e(route('admin.data-irigasi.index')); ?>" class="btn-filter" style="background:#94a3b8;text-decoration:none"><i class="fas fa-sync-alt"></i> Reset</a>
    <button type="button" class="btn-add" onclick="openAddModal()"><i class="fas fa-plus"></i> Tambah Saluran</button>
</form>

<div class="card-white">
    <div class="card-header"><h3><i class="fas fa-database" style="margin-right:0.4rem;color:var(--primary-light)"></i>Daftar Saluran</h3></div>
    <div style="overflow-x:auto">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Jenis</th>
                    <th>Kecamatan</th>
                    <th>Kondisi</th>
                    <th>Status</th>
                    <th>Level Air</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $salurans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><strong><?php echo e($s->nama); ?></strong></td>
                    <td><span class="j-badge j-<?php echo e($s->jenis); ?>"><?php echo e(ucfirst($s->jenis)); ?></span></td>
                    <td><?php echo e($s->kecamatan); ?></td>
                    <td>
                        <?php $sc = match($s->kondisi){'baik'=>'s-baik','perbaikan'=>'s-perbaikan','rusak-berat'=>'s-rusak-berat','rusak-sedang'=>'s-rusak-sedang','rusak-ringan'=>'s-rusak-ringan',default=>'s-baik'}; ?>
                        <span class="s-badge <?php echo e($sc); ?>"><span style="width:6px;height:6px;border-radius:50%;background:currentColor"></span> <?php echo e(ucfirst(str_replace('-', ' ', $s->kondisi))); ?></span>
                    </td>
                    <td><span style="color:<?php echo e($s->status=='aktif'?'#16a34a':'#ef4444'); ?>;font-weight:600;font-size:0.8rem"><i class="fas fa-circle" style="font-size:0.5rem"></i> <?php echo e(ucfirst($s->status)); ?></span></td>
                    <td><?php echo e($s->level_air ?? '-'); ?></td>
                    <td>
                        <div style="display:flex;gap:0.3rem">
                            <button class="btn-sm btn-edit" onclick="openEditModal(<?php echo e($s->id); ?>)"><i class="fas fa-edit"></i> Edit</button>
                            <form method="POST" action="<?php echo e(route('admin.data-irigasi.destroy', $s->id)); ?>" style="display:inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn-sm btn-delete"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="7" style="text-align:center;padding:2rem;color:#94a3b8"><i class="fas fa-inbox" style="font-size:2rem;display:block;margin-bottom:0.5rem"></i>Belum ada data</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div style="padding:1rem 1.5rem;border-top:1px solid #f1f5f9"><?php echo e($salurans->links()); ?></div>
</div>

<!-- Modal Tambah -->
<div class="modal-overlay" id="modalTambah">
    <div class="modal-box">
        <h3><i class="fas fa-plus-circle" style="margin-right:0.4rem;color:var(--primary-light)"></i>Tambah Saluran Baru</h3>
        <form method="POST" action="<?php echo e(route('admin.data-irigasi.store')); ?>">
            <?php echo csrf_field(); ?>
            <div class="form-row">
                <div class="form-group"><label>Nama Saluran</label><input type="text" name="nama" class="form-control" required></div>
                <div class="form-group"><label>Jenis</label><select name="jenis" class="form-control" required><option value="primer">Primer</option><option value="sekunder">Sekunder</option><option value="tersier">Tersier</option><option value="pintu">Pintu Air</option><option value="bendungan">Bendungan</option></select></div>
            </div>
            <div class="form-row">
                <div class="form-group"><label>Kecamatan</label><input type="text" name="kecamatan" class="form-control" required></div>
                <div class="form-group"><label>Desa</label><input type="text" name="desa" class="form-control"></div>
            </div>
            <div class="form-group"><label>Alamat</label><input type="text" name="alamat" class="form-control"></div>
            <div class="form-row">
                <div class="form-group"><label>Latitude</label><input type="text" name="latitude" class="form-control" placeholder="-7.4500"></div>
                <div class="form-group"><label>Longitude</label><input type="text" name="longitude" class="form-control" placeholder="112.7200"></div>
            </div>
            <div class="form-group"><label>Level Air</label><input type="text" name="level_air" class="form-control" placeholder="2.1 m3/s"></div>
            <div class="form-row">
                <div class="form-group"><label>Kondisi</label><select name="kondisi" class="form-control"><option value="baik">Baik</option><option value="perbaikan">Perbaikan</option><option value="rusak-ringan">Rusak Ringan</option><option value="rusak-sedang">Rusak Sedang</option><option value="rusak-berat">Rusak Berat</option></select></div>
                <div class="form-group"><label>Status</label><select name="status" class="form-control"><option value="aktif">Aktif</option><option value="nonaktif">Nonaktif</option></select></div>
            </div>
            <div class="form-group"><label>Deskripsi</label><textarea name="deskripsi" class="form-control"></textarea></div>
            <div class="modal-actions">
                <button type="button" class="btn-cancel-modal" onclick="closeModals()">Batal</button>
                <button type="submit" class="btn-save-modal">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal-overlay" id="modalEdit">
    <div class="modal-box">
        <h3><i class="fas fa-edit" style="margin-right:0.4rem;color:var(--primary-light)"></i>Edit Saluran</h3>
        <form id="formEdit" method="POST">
            <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
            <div class="form-row">
                <div class="form-group"><label>Nama Saluran</label><input type="text" name="nama" id="editNama" class="form-control" required></div>
                <div class="form-group"><label>Jenis</label><select name="jenis" id="editJenis" class="form-control" required><option value="primer">Primer</option><option value="sekunder">Sekunder</option><option value="tersier">Tersier</option><option value="pintu">Pintu Air</option><option value="bendungan">Bendungan</option></select></div>
            </div>
            <div class="form-row">
                <div class="form-group"><label>Kecamatan</label><input type="text" name="kecamatan" id="editKecamatan" class="form-control" required></div>
                <div class="form-group"><label>Desa</label><input type="text" name="desa" id="editDesa" class="form-control"></div>
            </div>
            <div class="form-group"><label>Alamat</label><input type="text" name="alamat" id="editAlamat" class="form-control"></div>
            <div class="form-row">
                <div class="form-group"><label>Latitude</label><input type="text" name="latitude" id="editLat" class="form-control"></div>
                <div class="form-group"><label>Longitude</label><input type="text" name="longitude" id="editLng" class="form-control"></div>
            </div>
            <div class="form-group"><label>Level Air</label><input type="text" name="level_air" id="editLevel" class="form-control"></div>
            <div class="form-row">
                <div class="form-group"><label>Kondisi</label><select name="kondisi" id="editKondisi" class="form-control"><option value="baik">Baik</option><option value="perbaikan">Perbaikan</option><option value="rusak-ringan">Rusak Ringan</option><option value="rusak-sedang">Rusak Sedang</option><option value="rusak-berat">Rusak Berat</option></select></div>
                <div class="form-group"><label>Status</label><select name="status" id="editStatus" class="form-control"><option value="aktif">Aktif</option><option value="nonaktif">Nonaktif</option></select></div>
            </div>
            <div class="form-group"><label>Deskripsi</label><textarea name="deskripsi" id="editDeskripsi" class="form-control"></textarea></div>
            <div class="modal-actions">
                <button type="button" class="btn-cancel-modal" onclick="closeModals()">Batal</button>
                <button type="submit" class="btn-save-modal">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
    const saluranData = <?php echo json_encode($salurans->items(), 15, 512) ?>;
    function openAddModal() { closeModals(); document.getElementById('modalTambah').classList.add('show'); }
    function openEditModal(id) {
        closeModals();
        const s = saluranData.find(x => x.id === id);
        if (!s) return;
        document.getElementById('formEdit').action = '<?php echo e(url('admin/data-irigasi')); ?>/' + id;
        document.getElementById('editNama').value = s.nama;
        document.getElementById('editJenis').value = s.jenis;
        document.getElementById('editKecamatan').value = s.kecamatan;
        document.getElementById('editDesa').value = s.desa || '';
        document.getElementById('editAlamat').value = s.alamat || '';
        document.getElementById('editLat').value = s.latitude || '';
        document.getElementById('editLng').value = s.longitude || '';
        document.getElementById('editLevel').value = s.level_air || '';
        document.getElementById('editKondisi').value = s.kondisi;
        document.getElementById('editStatus').value = s.status;
        document.getElementById('editDeskripsi').value = s.deskripsi || '';
        document.getElementById('modalEdit').classList.add('show');
    }
    function closeModals() { document.querySelectorAll('.modal-overlay').forEach(m => m.classList.remove('show')); }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Rahmat Eka\Peta-Interaktif\resources\views/admin/data-irigasi.blade.php ENDPATH**/ ?>