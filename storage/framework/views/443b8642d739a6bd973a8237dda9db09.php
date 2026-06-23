<?php $__env->startSection('title', 'Peta Interaktif - SIG Irigasi Sidoarjo'); ?>
<?php $__env->startSection('page-title', 'Peta Interaktif'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .map-page { height: calc(100vh - 140px); position: relative; border-radius: 14px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
    #map { position: absolute; top: 0; left: 0; right: 0; bottom: 0; z-index: 1; }
    .map-sidebar { position: absolute; top: 0; left: 0; bottom: 0; width: 320px; background: white; z-index: 1000; box-shadow: 2px 0 20px rgba(0,0,0,0.08); display: flex; flex-direction: column; overflow: hidden; }
    .ms-header { background: linear-gradient(135deg, var(--primary), var(--secondary)); color: white; padding: 14px 16px; }
    .ms-header h3 { font-size: 0.9rem; font-weight: 700; display: flex; align-items: center; gap: 0.5rem; }
    .ms-search { padding: 10px 14px; border-bottom: 1px solid #f1f5f9; }
    .ms-search-box { display: flex; align-items: center; gap: 8px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 8px 12px; }
    .ms-search-box i { color: #94a3b8; font-size: 0.85rem; }
    .ms-search-box input { border: none; background: transparent; outline: none; width: 100%; font-size: 0.82rem; }
    .ms-stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px; padding: 10px 14px; border-bottom: 1px solid #f1f5f9; }
    .ms-stat { text-align: center; padding: 8px; background: #f8fafc; border-radius: 8px; }
    .ms-stat h4 { font-size: 1.2rem; font-weight: 700; color: var(--primary); }
    .ms-stat p { font-size: 0.68rem; color: #94a3b8; margin-top: 2px; }
    .ms-list { flex: 1; overflow-y: auto; padding: 8px 0; }
    .ms-item { display: flex; align-items: center; gap: 10px; padding: 10px 14px; cursor: pointer; transition: background 0.2s; border-bottom: 1px solid #f8fafc; }
    .ms-item:hover { background: #f8fafc; }
    .ms-icon { width: 36px; height: 36px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 0.85rem; flex-shrink: 0; }
    .ms-info { flex: 1; min-width: 0; }
    .ms-info h4 { font-size: 0.82rem; font-weight: 600; color: var(--dark); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .ms-info p { font-size: 0.72rem; color: #94a3b8; margin-top: 1px; }
    .ms-badge { font-size: 0.6rem; padding: 2px 6px; border-radius: 4px; font-weight: 600; }
    .legend-panel { position: absolute; bottom: 16px; right: 16px; width: 220px; background: white; border-radius: 12px; box-shadow: 0 8px 24px rgba(0,0,0,0.12); z-index: 1000; padding: 12px; }
    .legend-panel h4 { font-size: 0.78rem; font-weight: 700; margin-bottom: 8px; color: var(--dark); }
    .legend-item { display: flex; align-items: center; gap: 8px; margin-bottom: 6px; font-size: 0.75rem; }
    .legend-dot { width: 12px; height: 12px; border-radius: 50%; flex-shrink: 0; }
    .detail-card { position: absolute; bottom: 16px; right: 250px; width: 300px; background: white; border-radius: 14px; box-shadow: 0 12px 40px rgba(0,0,0,0.18); z-index: 2000; display: none; flex-direction: column; overflow: hidden; }
    .dc-img { height: 140px; background: linear-gradient(135deg, #163832, #235347); display: flex; align-items: center; justify-content: center; color: #DAF1DE; font-size: 2.5rem; position: relative; }
    .dc-close { position: absolute; top: 8px; right: 8px; width: 28px; height: 28px; background: rgba(0,0,0,0.4); border-radius: 50%; border: none; color: white; cursor: pointer; font-size: 0.8rem; }
    .dc-body { padding: 16px; }
    .dc-title { font-size: 1rem; font-weight: 700; color: var(--dark); margin-bottom: 4px; }
    .dc-addr { font-size: 0.78rem; color: #94a3b8; margin-bottom: 10px; }
    .dc-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; background: #f8fafc; padding: 10px; border-radius: 8px; margin-bottom: 10px; }
    .dc-item h5 { font-size: 0.6rem; color: #94a3b8; text-transform: uppercase; margin-bottom: 2px; }
    .dc-item p { font-size: 0.78rem; font-weight: 600; color: var(--dark); }
    .custom-marker { transition: transform 0.3s; }
    @media (max-width: 1024px) { .map-sidebar { display: none; } .detail-card { right: 16px; width: auto; left: 16px; } .legend-panel { display: none; } }
</style>

<div class="map-page">
    <div id="map"></div>

    <div class="map-sidebar">
        <div class="ms-header"><h3><i class="fas fa-map-marked-alt"></i> Peta Saluran Irigasi</h3></div>
        <div class="ms-search">
            <div class="ms-search-box"><i class="fas fa-search"></i><input type="text" placeholder="Cari saluran..." onkeyup="filterList(this.value)"></div>
        </div>
        <div class="ms-stats">
            <div class="ms-stat"><h4><?php echo e($total); ?></h4><p>Total</p></div>
            <div class="ms-stat"><h4><?php echo e($aktif); ?></h4><p>Aktif</p></div>
            <div class="ms-stat"><h4><?php echo e($total - $aktif); ?></h4><p>Nonaktif</p></div>
        </div>
        <div class="ms-list" id="msList">
            <?php $__currentLoopData = $salurans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="ms-item" id="ms-<?php echo e($s->id); ?>" onclick="focusSaluran(<?php echo e($s->id); ?>)">
                <div class="ms-icon" style="background:<?php echo e(match($s->jenis){'primer'=>'#e0f2fe','sekunder'=>'#dcfce7','tersier'=>'#fef3c7','pintu'=>'#ede9fe','bendungan'=>'#f3e8ff',default=>'#e0f2fe'}); ?>;color:<?php echo e(match($s->jenis){'primer'=>'#0369a1','sekunder'=>'#16a34a','tersier'=>'#d97706','pintu'=>'#7c3aed','bendungan'=>'#9333ea',default=>'#0369a1'}); ?>">
                    <i class="fas <?php echo e(match($s->jenis){'primer'=>'fa-water','sekunder'=>'fa-stream','tersier'=>'fa-project-diagram','pintu'=>'fa-dungeon','bendungan'=>'fa-dam',default=>'fa-water'}); ?>"></i>
                </div>
                <div class="ms-info">
                    <h4><?php echo e($s->nama); ?></h4>
                    <p><?php echo e($s->kecamatan); ?> - <?php echo e(ucfirst($s->jenis)); ?></p>
                </div>
                <span class="ms-badge" style="background:<?php echo e($s->kondisi=='baik'?'#dcfce7':($s->kondisi=='perbaikan'?'#f3e8ff':'#fee2e2')); ?>;color:<?php echo e($s->kondisi=='baik'?'#16a34a':($s->kondisi=='perbaikan'?'#7c3aed':'#b91c1c')); ?>"><?php echo e(ucfirst(str_replace('-',' ',$s->kondisi))); ?></span>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    <div class="legend-panel">
        <h4>Legenda Peta</h4>
        <div class="legend-item"><div class="legend-dot" style="background:#163832"></div><span>Saluran Primer</span></div>
        <div class="legend-item"><div class="legend-dot" style="background:#235347"></div><span>Saluran Sekunder</span></div>
        <div class="legend-item"><div class="legend-dot" style="background:#8EB69B"></div><span>Saluran Tersier</span></div>
        <div class="legend-item"><div class="legend-dot" style="background:#0B2B26"></div><span>Pintu Air</span></div>
        <div class="legend-item"><div class="legend-dot" style="background:#DAF1DE;border:2px solid #163832"></div><span>Bendungan</span></div>
    </div>

    <div class="detail-card" id="detailCard">
        <div class="dc-img"><i class="fas fa-water" id="dcIcon"></i><button class="dc-close" onclick="closeCard()"><i class="fas fa-times"></i></button></div>
        <div class="dc-body">
            <div class="dc-title" id="dcTitle">-</div>
            <div class="dc-addr" id="dcAddr">-</div>
            <div class="dc-grid">
                <div class="dc-item"><h5>Koordinat</h5><p id="dcCoords">-</p></div>
                <div class="dc-item"><h5>Level Air</h5><p id="dcLevel">-</p></div>
                <div class="dc-item"><h5>Kecamatan</h5><p id="dcKec">-</p></div>
                <div class="dc-item"><h5>Kondisi</h5><p id="dcCond">-</p></div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    const map = L.map('map', { zoomControl: true, attributionControl: false }).setView([-7.4478, 112.7183], 13);
    L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', { maxZoom: 19 }).addTo(map);

    const saluranData = <?php echo json_encode($salurans, 15, 512) ?>;
    const markers = {};
    const typeColors = { primer: '#163832', sekunder: '#235347', tersier: '#8EB69B', pintu: '#0B2B26', bendungan: '#DAF1DE' };
    const typeIcons = { primer: 'fa-water', sekunder: 'fa-stream', tersier: 'fa-project-diagram', pintu: 'fa-dungeon', bendungan: 'fa-dam' };

    function getIcon(type) {
        const col = typeColors[type] || '#64748b';
        const icon = typeIcons[type] || 'fa-map-marker';
        return `<div style="background:${col};width:36px;height:36px;border-radius:50%;display:flex;align-items:center;justify-content:center;border:3px solid white;box-shadow:0 4px 12px rgba(0,0,0,0.25);color:${type==='bendungan'?'#163832':'white'};font-size:0.85rem;"><i class="fas ${icon}"></i></div>`;
    }

    saluranData.forEach(d => {
        if (d.latitude && d.longitude) {
            const m = L.marker([d.latitude, d.longitude], {
                icon: L.divIcon({ className: 'custom-marker', html: getIcon(d.jenis), iconSize: [36,36], iconAnchor: [18,18] })
            });
            m.on('click', () => { map.flyTo([d.latitude, d.longitude], 16, { duration: 1 }); openCard(d); });
            m.addTo(map);
            markers[d.id] = m;
        }
    });

    function openCard(d) {
        document.getElementById('dcTitle').innerText = d.nama;
        document.getElementById('dcAddr').innerText = d.alamat || d.kecamatan || '-';
        document.getElementById('dcCoords').innerText = d.latitude ? `${d.latitude}, ${d.longitude}` : '-';
        document.getElementById('dcLevel').innerText = d.level_air || '-';
        document.getElementById('dcKec').innerText = d.kecamatan || '-';
        document.getElementById('dcCond').innerText = d.kondisi ? d.kondisi.replace('-', ' ').replace(/\b\w/g, l=>l.toUpperCase()) : '-';
        document.getElementById('dcIcon').className = 'fas ' + (typeIcons[d.jenis] || 'fa-water');
        document.getElementById('detailCard').style.display = 'flex';
    }
    function closeCard() { document.getElementById('detailCard').style.display = 'none'; }
    function focusSaluran(id) { const d = saluranData.find(s => s.id === id); if (d && d.latitude) { map.flyTo([d.latitude, d.longitude], 16, { duration: 1 }); openCard(d); } }
    function filterList(q) { document.querySelectorAll('.ms-item').forEach(el => el.style.display = el.innerText.toLowerCase().includes(q.toLowerCase()) ? 'flex' : 'none'); }
    map.on('click', () => closeCard());
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Rahmat Eka\Peta-Interaktif\resources\views/admin/peta.blade.php ENDPATH**/ ?>