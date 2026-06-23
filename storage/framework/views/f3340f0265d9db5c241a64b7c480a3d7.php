<?php $__env->startSection('title', 'Form Laporan Kerusakan - SIG Irigasi Sidoarjo'); ?>

<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    .page-hero { background: linear-gradient(135deg, #051F20 0%, #163832 50%, #235347 100%); color: white; padding: 3rem 2rem; position: relative; overflow: hidden; }
    .page-hero::before { content: ''; position: absolute; inset: 0; background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E"); opacity: 0.3; }
    .page-hero-content { position: relative; max-width: 1280px; margin: 0 auto; }
    .page-hero-content .badge { display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); padding: 0.4rem 1rem; border-radius: 9999px; font-size: 0.8rem; font-weight: 500; margin-bottom: 1rem; border: 1px solid rgba(255,255,255,0.2); }
    .page-hero-content h2 { font-size: 2.2rem; font-weight: 800; margin-bottom: 0.5rem; }
    .page-hero-content h2 span { color: #DAF1DE; }
    .page-hero-content p { font-size: 1rem; opacity: 0.85; max-width: 600px; }
    .main-container { max-width: 960px; margin: 0 auto; padding: 2.5rem 2rem 4rem; }
    .info-banner { background: white; border-radius: 14px; padding: 1.1rem 1.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.06); display: flex; align-items: flex-start; gap: 1rem; margin-bottom: 2rem; border-left: 4px solid var(--secondary); }
    .info-banner i { color: var(--primary-light); font-size: 1.2rem; margin-top: 0.15rem; flex-shrink: 0; }
    .info-banner p { font-size: 0.88rem; color: #374151; line-height: 1.6; }
    .info-banner strong { color: var(--primary); }
    .form-card { background: white; border-radius: 18px; box-shadow: 0 4px 20px rgba(0,0,0,0.07); overflow: hidden; margin-bottom: 1.5rem; }
    .form-card-header { background: linear-gradient(135deg, var(--primary), var(--primary-light)); padding: 1.25rem 1.75rem; display: flex; align-items: center; gap: 0.85rem; color: white; }
    .form-card-header .header-icon { width: 38px; height: 38px; border-radius: 10px; background: rgba(255,255,255,0.15); display: flex; align-items: center; justify-content: center; font-size: 1rem; flex-shrink: 0; }
    .form-card-header h3 { font-size: 1rem; font-weight: 700; }
    .form-card-header p { font-size: 0.78rem; opacity: 0.85; margin-top: 0.1rem; }
    .form-card-body { padding: 1.75rem; }
    .form-row { display: grid; gap: 1.25rem; margin-bottom: 1.25rem; }
    .form-row.cols-2 { grid-template-columns: 1fr 1fr; }
    .form-row.cols-3 { grid-template-columns: 1fr 1fr 1fr; }
    .form-group { display: flex; flex-direction: column; gap: 0.4rem; }
    .form-group label { font-size: 0.82rem; font-weight: 600; color: var(--text); }
    .form-group label .req { color: #ef4444; font-size: 0.75rem; }
    .form-control { width: 100%; padding: 0.65rem 0.9rem; border: 1.5px solid #e2e8f0; border-radius: 10px; font-family: inherit; font-size: 0.88rem; color: var(--text); background: white; outline: none; transition: border-color 0.2s, box-shadow 0.2s; }
    .form-control:focus { border-color: var(--primary-light); box-shadow: 0 0 0 3px rgba(35,83,71,0.1); }
    textarea.form-control { resize: vertical; min-height: 100px; }
    select.form-control { cursor: pointer; }
    .form-hint { font-size: 0.75rem; color: #94a3b8; margin-top: 0.25rem; }
    .severity-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 0.75rem; }
    .severity-option { display: none; }
    .severity-label { display: flex; flex-direction: column; align-items: center; gap: 0.5rem; padding: 0.85rem 0.5rem; border-radius: 12px; border: 2px solid #e2e8f0; background: white; cursor: pointer; transition: all 0.2s; text-align: center; }
    .severity-label:hover { border-color: var(--secondary); background: #f0faf3; }
    .severity-icon { width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; }
    .severity-option:checked + .severity-label { border-color: currentColor; }
    #sev-ringan:checked + .severity-label { border-color: #3b82f6; background: #eff6ff; color: #1d4ed8; }
    #sev-ringan:checked + .severity-label .sev-icon { background: #dbeafe; color: #1d4ed8; }
    #sev-sedang:checked + .severity-label { border-color: #eab308; background: #fefce8; color: #a16207; }
    #sev-sedang:checked + .severity-label .sev-icon { background: #fef9c3; color: #a16207; }
    #sev-berat:checked + .severity-label { border-color: #f97316; background: #fff7ed; color: #c2410c; }
    #sev-berat:checked + .severity-label .sev-icon { background: #ffedd5; color: #c2410c; }
    #sev-kritis:checked + .severity-label { border-color: #ef4444; background: #fef2f2; color: #b91c1c; }
    #sev-kritis:checked + .severity-label .sev-icon { background: #fee2e2; color: #b91c1c; }
    .anonymous-toggle { display: flex; align-items: center; gap: 0.75rem; padding: 0.9rem 1.1rem; border-radius: 10px; background: #f8fdf9; border: 1.5px solid #e2e8f0; margin-bottom: 1.25rem; cursor: pointer; }
    .toggle-switch { width: 42px; height: 24px; border-radius: 12px; background: #e2e8f0; position: relative; transition: background 0.2s; flex-shrink: 0; }
    .toggle-switch.on { background: var(--primary); }
    .toggle-switch::after { content: ''; position: absolute; width: 18px; height: 18px; border-radius: 50%; background: white; top: 3px; left: 3px; transition: left 0.2s; box-shadow: 0 1px 3px rgba(0,0,0,0.2); }
    .toggle-switch.on::after { left: 21px; }
    .consent-card { background: #f0faf3; border: 1.5px solid #c5d9cc; border-radius: 12px; padding: 1.1rem 1.25rem; margin-bottom: 1.5rem; display: flex; gap: 0.85rem; align-items: flex-start; }
    .consent-card input[type="checkbox"] { width: 18px; height: 18px; accent-color: var(--primary); flex-shrink: 0; margin-top: 2px; }
    .consent-card p { font-size: 0.82rem; color: #374151; line-height: 1.6; }
    .submit-area { display: flex; gap: 1rem; justify-content: flex-end; align-items: center; }
    .btn-submit { padding: 0.75rem 2rem; border-radius: 10px; background: linear-gradient(135deg, var(--primary), var(--primary-light)); color: white; font-family: inherit; font-size: 0.9rem; font-weight: 700; cursor: pointer; border: none; display: flex; align-items: center; gap: 0.5rem; transition: transform 0.2s, box-shadow 0.2s; }
    .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 6px 16px rgba(22,56,50,0.3); }
    .btn-submit:disabled { opacity: 0.5; cursor: not-allowed; transform: none; }
    .btn-cancel { padding: 0.75rem 1.5rem; border-radius: 10px; border: 1.5px solid #e2e8f0; color: #64748b; background: white; font-family: inherit; font-size: 0.9rem; font-weight: 600; cursor: pointer; transition: all 0.2s; text-decoration: none; display: inline-flex; align-items: center; gap: 0.4rem; }
    .btn-cancel:hover { background: #f8fafc; }
    .btn-locate { padding: 0.75rem 1.5rem; border-radius: 10px; border: 1.5px solid var(--primary-light); color: var(--primary); background: white; font-family: inherit; font-size: 0.85rem; font-weight: 600; cursor: pointer; transition: all 0.2s; display: inline-flex; align-items: center; gap: 0.5rem; }
    .btn-locate:hover { background: #f0faf3; }
    .btn-locate:disabled { opacity: 0.6; cursor: not-allowed; }
    .map-toolbar { display: flex; gap: 1rem; margin-bottom: 1rem; flex-wrap: wrap; align-items: center; justify-content: space-between; }
    .map-toolbar .map-tip { display: flex; align-items: center; gap: 0.4rem; font-size: 0.78rem; color: #94a3b8; }
    #mapPicker { width: 100%; height: 380px; border-radius: 14px; overflow: hidden; border: 1.5px solid #e2e8f0; position: relative; z-index: 0; }
    @media (max-width: 768px) {
        .form-row.cols-2, .form-row.cols-3 { grid-template-columns: 1fr; }
        .severity-grid { grid-template-columns: repeat(2, 1fr); }
        .submit-area { flex-direction: column; }
        .btn-submit, .btn-cancel { width: 100%; justify-content: center; }
        .map-toolbar { flex-direction: column; align-items: stretch; }
        .btn-locate { width: 100%; justify-content: center; }
        #mapPicker { height: 300px; }
    }
</style>

<section class="page-hero">
    <div class="page-hero-content">
        <div class="badge"><i class="fas fa-exclamation-circle"></i> LAPORAN KERUSAKAN</div>
        <h2>Laporkan <span>Kerusakan Saluran</span></h2>
        <p>Bantu kami menjaga kondisi irigasi Sidoarjo dengan melaporkan kerusakan yang Anda temukan di lapangan secara cepat dan mudah.</p>
    </div>
</section>

<div class="main-container">
    <div class="info-banner">
        <i class="fas fa-info-circle"></i>
        <p>Laporan Anda akan <strong>diproses dan diverifikasi</strong> oleh petugas Dinas Pertanian Kabupaten Sidoarjo. Setelah dikirim, Anda akan mendapatkan <strong>kode laporan</strong> untuk memantau perkembangannya.</p>
    </div>

    <form method="POST" action="<?php echo e(route('laporan.store')); ?>" enctype="multipart/form-data" id="laporanForm">
        <?php echo csrf_field(); ?>

        <!-- Card 1: Informasi Saluran -->
        <div class="form-card">
            <div class="form-card-header">
                <div class="header-icon"><i class="fas fa-stream"></i></div>
                <div><h3>Informasi Saluran Irigasi</h3><p>Identifikasi saluran yang mengalami kerusakan</p></div>
            </div>
            <div class="form-card-body">
                <div class="form-row cols-2">
                    <div class="form-group">
                        <label><i class="fas fa-tag" style="margin-right:0.2rem;color:#94a3b8"></i> Nama Saluran <span class="req">*</span></label>
                        <input type="text" name="nama_saluran" class="form-control" placeholder="Contoh: Saluran Primer Krian" value="<?php echo e(old('nama_saluran')); ?>" required>
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-layer-group" style="margin-right:0.2rem;color:#94a3b8"></i> Jenis Saluran <span class="req">*</span></label>
                        <select name="jenis_saluran" class="form-control" required>
                            <option value="">-- Pilih Jenis Saluran --</option>
                            <option value="primer" <?php echo e(old('jenis_saluran')=='primer'?'selected':''); ?>>Saluran Primer</option>
                            <option value="sekunder" <?php echo e(old('jenis_saluran')=='sekunder'?'selected':''); ?>>Saluran Sekunder</option>
                            <option value="tersier" <?php echo e(old('jenis_saluran')=='tersier'?'selected':''); ?>>Saluran Tersier</option>
                            <option value="pintu" <?php echo e(old('jenis_saluran')=='pintu'?'selected':''); ?>>Pintu Air</option>
                            <option value="bendungan" <?php echo e(old('jenis_saluran')=='bendungan'?'selected':''); ?>>Bendungan / Embung</option>
                        </select>
                    </div>
                </div>
                <div class="form-row cols-3">
                    <div class="form-group">
                        <label><i class="fas fa-map-pin" style="margin-right:0.2rem;color:#94a3b8"></i> Kecamatan <span class="req">*</span></label>
                        <select name="kecamatan" class="form-control" required>
                            <option value="">-- Pilih Kecamatan --</option>
                            <?php $__currentLoopData = ['Sidoarjo','Buduran','Candi','Porong','Krembung','Tulangan','Tanggulangin','Jabon','Krian','Balongbendo','Wonoayu','Tarik','Prambon','Taman','Gedangan','Sedati','Sukodono','Waru']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($kec); ?>" <?php echo e(old('kecamatan')==$kec?'selected':''); ?>><?php echo e($kec); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-home" style="margin-right:0.2rem;color:#94a3b8"></i> Desa / Kelurahan</label>
                        <input type="text" name="desa" class="form-control" placeholder="Nama desa" value="<?php echo e(old('desa')); ?>">
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-road" style="margin-right:0.2rem;color:#94a3b8"></i> Alamat / Jalan</label>
                        <input type="text" name="alamat" class="form-control" placeholder="Nama jalan" value="<?php echo e(old('alamat')); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label><i class="fas fa-align-left" style="margin-right:0.2rem;color:#94a3b8"></i> Deskripsi Lokasi</label>
                    <textarea name="deskripsi_lokasi" class="form-control" placeholder="Deskripsikan lokasi saluran secara detail" style="min-height:80px"><?php echo e(old('deskripsi_lokasi')); ?></textarea>
                </div>
            </div>
        </div>

        <!-- Card 2: Detail Kerusakan -->
        <div class="form-card">
            <div class="form-card-header">
                <div class="header-icon"><i class="fas fa-tools"></i></div>
                <div><h3>Detail Kerusakan</h3><p>Jelaskan jenis dan tingkat keparahan kerusakan</p></div>
            </div>
            <div class="form-card-body">
                <div class="form-group" style="margin-bottom:1.25rem">
                    <label><i class="fas fa-tools" style="margin-right:0.2rem;color:#94a3b8"></i> Jenis Kerusakan <span class="req">*</span></label>
                    <textarea name="jenis_kerusakan" class="form-control" placeholder="Deskripsikan jenis kerusakan yang Anda temukan" style="min-height:100px" required><?php echo e(old('jenis_kerusakan')); ?></textarea>
                </div>
                <div class="form-group" style="margin-bottom:1.25rem">
                    <label style="margin-bottom:0.6rem"><i class="fas fa-exclamation-triangle" style="margin-right:0.2rem;color:#94a3b8"></i> Tingkat Keparahan <span class="req">*</span></label>
                    <div class="severity-grid">
                        <div>
                            <input type="radio" name="tingkat_keparahan" id="sev-ringan" value="ringan" class="severity-option" <?php echo e(old('tingkat_keparahan')=='ringan'?'checked':''); ?> required>
                            <label for="sev-ringan" class="severity-label">
                                <div class="severity-icon sev-icon" style="background:#dbeafe;color:#1d4ed8"><i class="fas fa-minus-circle"></i></div>
                                <div style="font-size:0.78rem;font-weight:700">Rusak Ringan</div>
                                <div style="font-size:0.68rem;color:#94a3b8">Fungsi masih berjalan</div>
                            </label>
                        </div>
                        <div>
                            <input type="radio" name="tingkat_keparahan" id="sev-sedang" value="sedang" class="severity-option" <?php echo e(old('tingkat_keparahan')=='sedang'?'checked':''); ?>>
                            <label for="sev-sedang" class="severity-label">
                                <div class="severity-icon sev-icon" style="background:#fef9c3;color:#a16207"><i class="fas fa-exclamation-circle"></i></div>
                                <div style="font-size:0.78rem;font-weight:700">Rusak Sedang</div>
                                <div style="font-size:0.68rem;color:#94a3b8">Fungsi terganggu sebagian</div>
                            </label>
                        </div>
                        <div>
                            <input type="radio" name="tingkat_keparahan" id="sev-berat" value="berat" class="severity-option" <?php echo e(old('tingkat_keparahan')=='berat'?'checked':''); ?>>
                            <label for="sev-berat" class="severity-label">
                                <div class="severity-icon sev-icon" style="background:#ffedd5;color:#c2410c"><i class="fas fa-exclamation-triangle"></i></div>
                                <div style="font-size:0.78rem;font-weight:700">Rusak Berat</div>
                                <div style="font-size:0.68rem;color:#94a3b8">Fungsi tidak berjalan</div>
                            </label>
                        </div>
                        <div>
                            <input type="radio" name="tingkat_keparahan" id="sev-kritis" value="kritis" class="severity-option" <?php echo e(old('tingkat_keparahan')=='kritis'?'checked':''); ?>>
                            <label for="sev-kritis" class="severity-label">
                                <div class="severity-icon sev-icon" style="background:#fee2e2;color:#b91c1c"><i class="fas fa-radiation-alt"></i></div>
                                <div style="font-size:0.78rem;font-weight:700">Kritis / Darurat</div>
                                <div style="font-size:0.68rem;color:#94a3b8">Ancaman langsung</div>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-row cols-2">
                    <div class="form-group">
                        <label><i class="fas fa-seedling" style="margin-right:0.2rem;color:#94a3b8"></i> Dampak terhadap Pertanian</label>
                        <select name="dampak_pertanian" class="form-control">
                            <option value="">-- Pilih Dampak --</option>
                            <option value="tidak-ada" <?php echo e(old('dampak_pertanian')=='tidak-ada'?'selected':''); ?>>Tidak ada dampak langsung</option>
                            <option value="ringan" <?php echo e(old('dampak_pertanian')=='ringan'?'selected':''); ?>>Dampak Ringan</option>
                            <option value="sedang" <?php echo e(old('dampak_pertanian')=='sedang'?'selected':''); ?>>Dampak Sedang</option>
                            <option value="berat" <?php echo e(old('dampak_pertanian')=='berat'?'selected':''); ?>>Dampak Berat</option>
                            <option value="sangat-berat" <?php echo e(old('dampak_pertanian')=='sangat-berat'?'selected':''); ?>>Sangat Berat</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-clock" style="margin-right:0.2rem;color:#94a3b8"></i> Estimasi Lama Kerusakan</label>
                        <select name="lama_kerusakan" class="form-control">
                            <option value="">-- Pilih Estimasi --</option>
                            <option value="baru" <?php echo e(old('lama_kerusakan')=='baru'?'selected':''); ?>>Baru terjadi</option>
                            <option value="1-7" <?php echo e(old('lama_kerusakan')=='1-7'?'selected':''); ?>>1 - 7 hari lalu</option>
                            <option value="7-30" <?php echo e(old('lama_kerusakan')=='7-30'?'selected':''); ?>>1 minggu - 1 bulan</option>
                            <option value="lebih-1" <?php echo e(old('lama_kerusakan')=='lebih-1'?'selected':''); ?>>Lebih dari 1 bulan</option>
                            <option value="tidak-tahu" <?php echo e(old('lama_kerusakan')=='tidak-tahu'?'selected':''); ?>>Tidak diketahui</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label><i class="fas fa-file-alt" style="margin-right:0.2rem;color:#94a3b8"></i> Dampak & Kondisi Terkini <span class="req">*</span></label>
                    <textarea name="deskripsi_kerusakan" class="form-control" placeholder="Jelaskan dampak dan kondisi terkini" required><?php echo e(old('deskripsi_kerusakan')); ?></textarea>
                </div>
            </div>
        </div>

        <!-- Card 3: Lokasi -->
        <div class="form-card">
            <div class="form-card-header">
                <div class="header-icon"><i class="fas fa-map-marked-alt"></i></div>
                <div><h3>Lokasi Koordinat</h3><p>Tandai lokasi dengan koordinat GPS</p></div>
            </div>
            <div class="form-card-body">
                <div class="form-row cols-2">
                    <div class="form-group">
                        <label><i class="fas fa-globe-asia" style="margin-right:0.2rem;color:#94a3b8"></i> Latitude</label>
                        <input type="text" name="latitude" id="inputLatitude" class="form-control" placeholder="-7.4500" value="<?php echo e(old('latitude')); ?>">
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-globe-asia" style="margin-right:0.2rem;color:#94a3b8"></i> Longitude</label>
                        <input type="text" name="longitude" id="inputLongitude" class="form-control" placeholder="112.7200" value="<?php echo e(old('longitude')); ?>">
                    </div>
                </div>

                <div class="map-toolbar">
                    <button type="button" class="btn-locate" id="btnLokasiSaya" onclick="gunakanLokasiSaya()">
                        <i class="fas fa-crosshairs"></i> Gunakan Lokasi Saya
                    </button>
                    <div class="map-tip"><i class="fas fa-hand-pointer"></i> Atau klik / geser pin pada peta untuk memilih lokasi</div>
                </div>

                <div id="mapPicker"></div>
                <div class="form-hint" id="mapHint" style="margin-top:0.5rem;">&nbsp;</div>
            </div>
        </div>

        <!-- Card 4: Data Pelapor -->
        <div class="form-card">
            <div class="form-card-header">
                <div class="header-icon"><i class="fas fa-user-circle"></i></div>
                <div><h3>Data Pelapor</h3><p>Informasi kontak untuk tindak lanjut</p></div>
            </div>
            <div class="form-card-body">
                <?php if(auth()->guard('web')->guest()): ?>
                <div class="anonymous-toggle" onclick="toggleAnonymous()" id="anonToggleArea">
                    <div class="toggle-switch" id="anonSwitch"></div>
                    <div><span style="font-size:0.85rem;font-weight:600;color:var(--text)">Laporkan sebagai anonim</span><br><small style="font-size:0.75rem;color:#94a3b8">Data pelapor tidak akan ditampilkan secara publik</small></div>
                </div>
                <input type="hidden" name="is_anonymous" id="isAnonymous" value="0">

                <div id="pelapor-fields">
                    <div class="form-row cols-2">
                        <div class="form-group">
                            <label><i class="fas fa-user" style="margin-right:0.2rem;color:#94a3b8"></i> Nama Lengkap <span class="req">*</span></label>
                            <input type="text" name="nama_pelapor" class="form-control" placeholder="Nama sesuai KTP" value="<?php echo e(old('nama_pelapor')); ?>" id="namaPelapor" required>
                        </div>
                        <div class="form-group">
                            <label><i class="fas fa-phone" style="margin-right:0.2rem;color:#94a3b8"></i> Nomor Telepon <span class="req">*</span></label>
                            <input type="tel" name="telepon" class="form-control" placeholder="08123456789" value="<?php echo e(old('telepon')); ?>" id="teleponPelapor" required>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                <div style="background:#f0fdf4;border:1px solid #86efac;border-radius:10px;padding:0.65rem 1rem;margin-bottom:1rem;font-size:0.82rem;color:#15803d;">
                    <i class="fas fa-check-circle"></i> Data pelapor diisi otomatis dari akun Anda: <strong><?php echo e(Auth::guard('web')->user()->name); ?></strong>
                </div>
                <input type="hidden" name="nama_pelapor" value="<?php echo e(Auth::guard('web')->user()->name); ?>">
                <input type="hidden" name="telepon" value="<?php echo e(Auth::guard('web')->user()->phone ?? '-'); ?>">
                <input type="hidden" name="email" value="<?php echo e(Auth::guard('web')->user()->email); ?>">
                <input type="hidden" name="is_anonymous" value="0">
                <?php endif; ?>

                <div class="consent-card">
                    <input type="checkbox" id="consent" onchange="updateSubmit()">
                    <p>Saya menyatakan bahwa informasi yang saya berikan adalah <strong>benar dan akurat</strong>. Saya memahami bahwa laporan ini akan digunakan oleh <strong>Dinas Pertanian Kabupaten Sidoarjo</strong> untuk keperluan pemeliharaan infrastruktur irigasi.</p>
                </div>
                <div class="submit-area">
                    <a href="<?php echo e(route('laporan.index')); ?>" class="btn-cancel">Batal</a>
                    <button type="submit" class="btn-submit" id="submitBtn" disabled><i class="fas fa-paper-plane"></i> Kirim Laporan</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    let isAnonymous = false;
    function toggleAnonymous() {
        isAnonymous = !isAnonymous;
        document.getElementById('anonSwitch').classList.toggle('on', isAnonymous);
        document.getElementById('isAnonymous').value = isAnonymous ? '1' : '0';
        const fields = document.getElementById('pelapor-fields');
        if (fields) {
            fields.style.opacity = isAnonymous ? '0.4' : '1';
            fields.style.pointerEvents = isAnonymous ? 'none' : '';
            document.getElementById('namaPelapor').required = !isAnonymous;
            document.getElementById('teleponPelapor').required = !isAnonymous;
        }
    }
    function updateSubmit() {
        document.getElementById('submitBtn').disabled = !document.getElementById('consent').checked;
    }

    // ================= MAP PICKER (Leaflet + Satelit) =================
    const defaultLat = -7.4500; // Default: Sidoarjo, Jawa Timur
    const defaultLng = 112.7200;

    const latInput = document.getElementById('inputLatitude');
    const lngInput = document.getElementById('inputLongitude');
    const mapHint  = document.getElementById('mapHint');

    const initialLat = parseFloat(latInput.value) || defaultLat;
    const initialLng = parseFloat(lngInput.value) || defaultLng;

    const map = L.map('mapPicker').setView([initialLat, initialLng], 14);

    // Layer citra satelit (Esri World Imagery)
    const satelliteLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
        attribution: 'Tiles &copy; Esri &mdash; Source: Esri, Maxar, Earthstar Geographics, and the GIS User Community',
        maxZoom: 19
    }).addTo(map);

    // Layer label jalan / nama tempat di atas citra satelit
    const labelLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/Reference/World_Boundaries_and_Places/MapServer/tile/{z}/{y}/{x}', {
        maxZoom: 19,
        opacity: 0.9
    }).addTo(map);

    // Marker yang bisa di-drag
    const marker = L.marker([initialLat, initialLng], { draggable: true }).addTo(map);

    function updateLatLng(lat, lng) {
        latInput.value = lat.toFixed(6);
        lngInput.value = lng.toFixed(6);
    }

    function setMapHint(html) {
        mapHint.innerHTML = html;
    }

    // Update input saat marker digeser
    marker.on('dragend', function (e) {
        const pos = e.target.getLatLng();
        updateLatLng(pos.lat, pos.lng);
        setMapHint('<i class="fas fa-check-circle" style="color:#22c55e;"></i> Koordinat dipilih dari peta.');
    });

    // Klik pada peta untuk memindahkan marker
    map.on('click', function (e) {
        marker.setLatLng(e.latlng);
        updateLatLng(e.latlng.lat, e.latlng.lng);
        setMapHint('<i class="fas fa-check-circle" style="color:#22c55e;"></i> Koordinat dipilih dari peta.');
    });

    // Sinkronisasi: jika user mengetik manual di input, pindahkan marker & peta
    function syncMarkerFromInputs() {
        const lat = parseFloat(latInput.value);
        const lng = parseFloat(lngInput.value);
        if (!isNaN(lat) && !isNaN(lng)) {
            marker.setLatLng([lat, lng]);
            map.setView([lat, lng], map.getZoom());
        }
    }
    latInput.addEventListener('change', syncMarkerFromInputs);
    lngInput.addEventListener('change', syncMarkerFromInputs);

    // Tombol "Gunakan Lokasi Saya"
    function gunakanLokasiSaya() {
        const btn = document.getElementById('btnLokasiSaya');
        if (!navigator.geolocation) {
            setMapHint('<i class="fas fa-exclamation-circle" style="color:#ef4444;"></i> Browser Anda tidak mendukung geolokasi.');
            return;
        }

        const originalHtml = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mencari lokasi...';
        btn.disabled = true;

        navigator.geolocation.getCurrentPosition(function (position) {
            const lat = position.coords.latitude;
            const lng = position.coords.longitude;

            updateLatLng(lat, lng);
            marker.setLatLng([lat, lng]);
            map.setView([lat, lng], 17);

            setMapHint('<i class="fas fa-check-circle" style="color:#22c55e;"></i> Lokasi Anda berhasil ditemukan.');
            btn.innerHTML = originalHtml;
            btn.disabled = false;
        }, function (error) {
            let msg = 'Gagal mendapatkan lokasi.';
            if (error.code === error.PERMISSION_DENIED) msg = 'Izin lokasi ditolak. Mohon izinkan akses lokasi di browser.';
            else if (error.code === error.TIMEOUT) msg = 'Waktu pencarian lokasi habis. Coba lagi.';
            setMapHint('<i class="fas fa-exclamation-circle" style="color:#ef4444;"></i> ' + msg);
            btn.innerHTML = originalHtml;
            btn.disabled = false;
        }, { enableHighAccuracy: true, timeout: 10000 });
    }

    // Perbaikan ukuran peta jika container baru terlihat (misal di dalam tab/modal)
    setTimeout(function () { map.invalidateSize(); }, 300);
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Rahmat Eka\Peta-Interaktif\resources\views/masyarakat/form-laporan.blade.php ENDPATH**/ ?>