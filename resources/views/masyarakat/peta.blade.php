@extends('layouts.app')

@section('title', 'Peta Interaktif - SIG Irigasi Sidoarjo')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    .map-page { height: calc(100vh - 64px); position: relative; }
    #map { position: absolute; top: 0; left: 0; right: 0; bottom: 0; z-index: 1; }
    .sidebar { position: absolute; top: 0; left: 0; bottom: 0; width: 340px; background: white; z-index: 1000; box-shadow: 2px 0 20px rgba(0,0,0,0.08); display: flex; flex-direction: column; overflow: hidden; }
    .sidebar-header { background: linear-gradient(135deg, var(--primary), var(--secondary)); color: white; padding: 16px 20px; }
    .sidebar-header h3 { font-size: 0.95rem; font-weight: 700; display: flex; align-items: center; gap: 0.5rem; }
    .sidebar-search { padding: 12px 16px; border-bottom: 1px solid #DAF1DE; }
    .search-box { display: flex; align-items: center; gap: 10px; background: #f0faf3; border: 1px solid #8EB69B; border-radius: 10px; padding: 10px 14px; }
    .search-box i { color: var(--text-light); font-size: 0.9rem; }
    .search-box input { border: none; background: transparent; outline: none; width: 100%; font-size: 0.85rem; color: var(--text); }
    .filter-chips { display: flex; flex-wrap: wrap; gap: 8px; padding: 12px 16px; border-bottom: 1px solid #DAF1DE; }
    .chip { padding: 6px 12px; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; cursor: pointer; border: 1.5px solid transparent; transition: all 0.2s; }
    .chip.all { background: var(--primary); color: white; }
    .chip.primer { background: #DAF1DE; color: #051F20; }
    .chip.sekunder { background: #c5e8ce; color: #0B2B26; }
    .chip.tersier { background: #b8dfc4; color: #163832; }
    .chip.pintu { background: #a8d5b5; color: #0B2B26; }
    .chip.bendungan { background: #DAF1DE; color: #235347; }
    .chip:hover { transform: scale(1.05); }
    .sidebar-stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px; padding: 12px 16px; border-bottom: 1px solid #DAF1DE; }
    .s-stat { text-align: center; padding: 10px 8px; border-radius: 10px; background: #DAF1DE; }
    .s-stat h4 { font-size: 1.3rem; font-weight: 700; }
    .s-stat p { font-size: 0.7rem; color: var(--text-light); margin-top: 2px; }
    .sidebar-list { flex: 1; overflow-y: auto; padding: 8px 0; }
    .list-item { display: flex; align-items: center; gap: 12px; padding: 12px 16px; cursor: pointer; transition: background 0.2s; border-bottom: 1px solid #DAF1DE; }
    .list-item:hover { background: #DAF1DE; }
    .list-icon { width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1rem; flex-shrink: 0; }
    .list-info { flex: 1; min-width: 0; }
    .list-info h4 { font-size: 0.85rem; font-weight: 600; color: var(--dark); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .list-info p { font-size: 0.75rem; color: var(--text-light); margin-top: 2px; }
    .list-badges { display: flex; gap: 4px; margin-top: 4px; }
    .lb { font-size: 0.65rem; padding: 2px 6px; border-radius: 4px; font-weight: 600; }
    .legend-panel { position: absolute; bottom: 24px; right: 24px; width: 260px; background: white; border-radius: 16px; box-shadow: 0 10px 40px -10px rgba(0,0,0,0.15); z-index: 1000; overflow: hidden; }
    .legend-header { background: linear-gradient(135deg, var(--primary), var(--secondary)); color: white; padding: 12px 16px; display: flex; align-items: center; justify-content: space-between; cursor: pointer; }
    .legend-header h4 { font-size: 0.85rem; font-weight: 700; display: flex; align-items: center; gap: 0.5rem; }
    .legend-body { padding: 16px; }
    .legend-section { margin-bottom: 16px; }
    .legend-section h5 { font-size: 0.7rem; font-weight: 700; color: var(--text-light); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 10px; }
    .legend-item { display: flex; align-items: center; gap: 10px; margin-bottom: 8px; font-size: 0.8rem; color: var(--text); }
    .legend-dot { width: 14px; height: 14px; border-radius: 50%; flex-shrink: 0; }
    .detail-card { position: absolute; bottom: 24px; right: 300px; width: 340px; background: white; border-radius: 20px; box-shadow: 0 20px 60px -10px rgba(0,0,0,0.2); z-index: 2000; display: none; flex-direction: column; overflow: hidden; }
    .card-img-box { height: 180px; position: relative; background: linear-gradient(135deg, #163832, #235347); overflow: hidden; display: flex; align-items: center; justify-content: center; color: #DAF1DE; font-size: 3rem; }
    .btn-close-card { position: absolute; top: 12px; right: 12px; width: 32px; height: 32px; background: rgba(0,0,0,0.5); border-radius: 50%; border: none; color: white; cursor: pointer; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(4px); font-size: 0.9rem; }
    .card-body { padding: 20px 24px 24px; }
    .badge-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; }
    .type-badge { font-size: 0.7rem; font-weight: 800; text-transform: uppercase; color: #163832; background: #DAF1DE; padding: 4px 12px; border-radius: 6px; letter-spacing: 0.05em; }
    .cond-badge { font-size: 0.8rem; font-weight: 700; display: flex; align-items: center; gap: 6px; padding: 4px 12px; border-radius: 50px; }
    .cond-badge.good { background: #DAF1DE; color: #0B2B26; }
    .cond-badge.warn { background: #fef3c7; color: #92400e; }
    .cond-badge.bad { background: #fee2e2; color: #b91c1c; }
    .card-title { font-size: 1.2rem; font-weight: 800; color: var(--dark); margin-bottom: 6px; line-height: 1.3; }
    .card-addr { font-size: 0.9rem; color: var(--text-light); display: flex; align-items: center; gap: 6px; margin-bottom: 16px; }
    .specs-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; background: #DAF1DE; padding: 16px; border-radius: 14px; margin-bottom: 16px; border: 1px solid #8EB69B; }
    .spec-item h5 { font-size: 0.65rem; color: var(--text-light); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px; font-weight: 600; }
    .spec-item p { font-size: 0.85rem; font-weight: 700; color: var(--dark); }
    .card-desc { font-size: 0.85rem; color: var(--text-light); margin-bottom: 16px; line-height: 1.6; }
    .btn-group { display: flex; gap: 10px; }
    .btn { flex: 1; padding: 10px; border-radius: 10px; border: none; font-weight: 600; font-size: 0.8rem; cursor: pointer; display: flex; justify-content: center; gap: 6px; align-items: center; text-decoration: none; }
    .btn-primary-dark { background: var(--dark); color: white; }
    .btn-secondary-light { background: #DAF1DE; color: #163832; }
    .custom-marker { transition: transform 0.3s; }
    @media (max-width: 1024px) {
        .sidebar { width: 280px; }
        .detail-card { right: 24px; width: 300px; }
        .legend-panel { width: 220px; }
    }
    @media (max-width: 768px) {
        .sidebar { display: none; }
        .detail-card { right: 16px; left: 16px; width: auto; bottom: 16px; }
        .legend-panel { display: none; }
    }
</style>
@endpush

@section('content')
<div class="map-page">
    <div id="map"></div>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h3><i class="fas fa-map-marked-alt"></i> Peta Saluran Irigasi</h3>
        </div>
        <div class="sidebar-search">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Cari nama saluran..." id="searchInput" onkeyup="searchSaluran()">
            </div>
        </div>
        <div class="filter-chips">
            <div class="chip all" onclick="filterChips('all', this)" id="chip-all">Semua</div>
            <div class="chip primer" onclick="filterChips('primer', this)">Primer ({{ $salurans->where('jenis', 'primer')->count() }})</div>
            <div class="chip sekunder" onclick="filterChips('sekunder', this)">Sekunder ({{ $salurans->where('jenis', 'sekunder')->count() }})</div>
            <div class="chip tersier" onclick="filterChips('tersier', this)">Tersier ({{ $salurans->where('jenis', 'tersier')->count() }})</div>
            <div class="chip pintu" onclick="filterChips('pintu', this)">Pintu ({{ $salurans->where('jenis', 'pintu')->count() }})</div>
            <div class="chip bendungan" onclick="filterChips('bendungan', this)">Bendungan ({{ $salurans->where('jenis', 'bendungan')->count() }})</div>
        </div>
        <div class="sidebar-stats">
            <div class="s-stat"><h4 style="color:var(--primary)">{{ $total }}</h4><p>Total</p></div>
            <div class="s-stat"><h4 style="color:#0B2B26">{{ $aktif }}</h4><p>Aktif</p></div>
            <div class="s-stat"><h4 style="color:#235347">{{ $total - $aktif }}</h4><p>Nonaktif</p></div>
        </div>
        <div class="sidebar-list" id="sidebarList">
            @foreach($salurans as $saluran)
            <div class="list-item" id="list-item-{{ $saluran->id }}" onclick="focusSaluran({{ $saluran->id }})">
                <div class="list-icon" style="background: {{ match($saluran->jenis) { 'primer' => '#DAF1DE', 'sekunder' => '#c5e8ce', 'tersier' => '#b8dfc4', 'pintu' => '#a8d5b5', 'bendungan' => '#DAF1DE', default => '#e2e8f0' } }}; color: {{ match($saluran->jenis) { 'primer' => '#051F20', 'sekunder' => '#0B2B26', 'tersier' => '#163832', 'pintu' => '#0B2B26', 'bendungan' => '#235347', default => '#64748b' } }};">
                    <i class="fas {{ match($saluran->jenis) { 'primer' => 'fa-water', 'sekunder' => 'fa-stream', 'tersier' => 'fa-project-diagram', 'pintu' => 'fa-dungeon', 'bendungan' => 'fa-dam', default => 'fa-map-marker' } }}"></i>
                </div>
                <div class="list-info">
                    <h4>{{ $saluran->nama }}</h4>
                    <p>{{ $saluran->kecamatan }}</p>
                    <div class="list-badges">
                        <span class="lb" style="background: {{ match($saluran->jenis) { 'primer' => '#DAF1DE', 'sekunder' => '#c5e8ce', 'tersier' => '#b8dfc4', 'pintu' => '#a8d5b5', 'bendungan' => '#DAF1DE', default => '#e2e8f0' } }}; color: {{ match($saluran->jenis) { 'primer' => '#051F20', 'sekunder' => '#0B2B26', 'tersier' => '#163832', 'pintu' => '#0B2B26', 'bendungan' => '#235347', default => '#64748b' } }}">{{ ucfirst($saluran->jenis) }}</span>
                        <span class="lb" style="background: {{ $saluran->kondisi == 'baik' ? '#DAF1DE' : ($saluran->kondisi == 'perbaikan' ? '#fef3c7' : '#fee2e2') }}; color: {{ $saluran->kondisi == 'baik' ? '#0B2B26' : ($saluran->kondisi == 'perbaikan' ? '#92400e' : '#b91c1c') }}">{{ ucfirst(str_replace('-', ' ', $saluran->kondisi)) }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Legend -->
    <div class="legend-panel">
        <div class="legend-header" onclick="toggleLegend()">
            <h4><i class="fas fa-map"></i> Legenda Peta</h4>
            <i class="fas fa-chevron-up" id="legendArrow"></i>
        </div>
        <div class="legend-body" id="legendBody">
            <div class="legend-section">
                <h5>Jenis Saluran</h5>
                <div class="legend-item"><div class="legend-dot" style="background:#163832"></div><span>Saluran Primer</span></div>
                <div class="legend-item"><div class="legend-dot" style="background:#235347"></div><span>Saluran Sekunder</span></div>
                <div class="legend-item"><div class="legend-dot" style="background:#8EB69B"></div><span>Saluran Tersier</span></div>
                <div class="legend-item"><div class="legend-dot" style="background:#0B2B26"></div><span>Pintu Air</span></div>
                <div class="legend-item"><div class="legend-dot" style="background:#DAF1DE;border:2px solid #163832"></div><span>Bendungan</span></div>
            </div>
        </div>
    </div>

    <!-- Detail Card -->
    <div class="detail-card" id="detailCard">
        <div class="card-img-box" id="cardImgBox">
            <i class="fas fa-water" id="cardIcon"></i>
        </div>
        <button class="btn-close-card" onclick="closeCard()"><i class="fas fa-times"></i></button>
        <div class="card-body">
            <div class="badge-row">
                <span class="type-badge" id="dType">SALURAN</span>
                <div class="cond-badge good" id="dCond"><div class="dot" style="width:8px;height:8px;border-radius:50%;background:currentColor"></div> <span id="dCondText">Baik</span></div>
            </div>
            <h2 class="card-title" id="dTitle">-</h2>
            <div class="card-addr"><i class="fas fa-map-marker-alt"></i> <span id="dAddr">-</span></div>
            <div class="specs-grid">
                <div class="spec-item"><h5>Koordinat</h5><p id="dCoords">-</p></div>
                <div class="spec-item"><h5>Level Air</h5><p id="dLevel" style="color:var(--secondary);font-weight:700">-</p></div>
                <div class="spec-item"><h5>Kecamatan</h5><p id="dKec">-</p></div>
                <div class="spec-item"><h5>Status</h5><p id="dStatus">-</p></div>
            </div>
            <p class="card-desc" id="dDesc">-</p>
            <div class="btn-group">
                <button class="btn btn-primary-dark" onclick="routeToMap()"><i class="fas fa-location-arrow"></i> Rute</button>
                <a href="{{ route('laporan.create') }}" class="btn btn-secondary-light"><i class="fas fa-exclamation-triangle"></i> Lapor</a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    const map = L.map('map', { zoomControl: true, attributionControl: false }).setView([-7.4478, 112.7183], 13);
    L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', { maxZoom: 19 }).addTo(map);

    const saluranData = @json($salurans);
    const markers = {};
    const typeColors = { primer: '#163832', sekunder: '#235347', tersier: '#8EB69B', pintu: '#0B2B26', bendungan: '#DAF1DE' };
    const typeIcons = { primer: 'fa-water', sekunder: 'fa-stream', tersier: 'fa-project-diagram', pintu: 'fa-dungeon', bendungan: 'fa-dam' };

    function getIcon(type) {
        const col = typeColors[type] || '#64748b';
        const icon = typeIcons[type] || 'fa-map-marker';
        return `<div style="background:${col}; width:40px; height:40px; border-radius:50%; display:flex; align-items:center; justify-content:center; border:3px solid white; box-shadow:0 4px 12px rgba(0,0,0,0.25); color:${type === 'bendungan' ? '#163832' : 'white'}; font-size:1rem;"><i class="fas ${icon}"></i></div>`;
    }

    saluranData.forEach(d => {
        if (d.latitude && d.longitude) {
            const m = L.marker([d.latitude, d.longitude], {
                icon: L.divIcon({ className: 'custom-marker', html: getIcon(d.jenis), iconSize: [40,40], iconAnchor: [20,20] })
            });
            m.on('click', () => { map.flyTo([d.latitude, d.longitude], 16, { duration: 1 }); openCard(d); });
            m.addTo(map);
            markers[d.id] = m;
        }
    });

    let currentSaluran = null;
    function openCard(d) {
        currentSaluran = d;
        document.getElementById('dTitle').innerText = d.nama;
        document.getElementById('dAddr').innerText = d.alamat || d.kecamatan || '-';
        document.getElementById('dType').innerText = d.jenis === 'pintu' ? 'PINTU AIR' : (d.jenis === 'bendungan' ? 'BENDUNGAN' : 'SALURAN ' + d.jenis.toUpperCase());
        document.getElementById('dCoords').innerText = d.latitude && d.longitude ? `${d.latitude}, ${d.longitude}` : '-';
        document.getElementById('dLevel').innerText = d.level_air || '-';
        document.getElementById('dKec').innerText = d.kecamatan || '-';
        document.getElementById('dStatus').innerText = d.status === 'aktif' ? 'Aktif' : 'Nonaktif';
        document.getElementById('dDesc').innerText = d.deskripsi || 'Tidak ada deskripsi.';
        const iconEl = document.getElementById('cardIcon');
        iconEl.className = 'fas ' + (typeIcons[d.jenis] || 'fa-water');

        const condBadge = document.getElementById('dCond');
        const condStyles = { 'baik': ['good','Baik'], 'perbaikan': ['warn','Perbaikan'], 'rusak-ringan': ['warn','Rusak Ringan'], 'rusak-sedang': ['warn','Rusak Sedang'], 'rusak-berat': ['bad','Rusak Berat'] };
        const [cls, text] = condStyles[d.kondisi] || ['good','Baik'];
        condBadge.className = 'cond-badge ' + cls;
        document.getElementById('dCondText').innerText = text;

        document.getElementById('detailCard').style.display = 'flex';
    }

    function closeCard() { document.getElementById('detailCard').style.display = 'none'; }
    function routeToMap() { if (currentSaluran) window.open(`https://www.google.com/maps?q=${currentSaluran.latitude},${currentSaluran.longitude}`, '_blank'); }
    function focusSaluran(id) { const d = saluranData.find(s => s.id === id); if (d && d.latitude && d.longitude) { map.flyTo([d.latitude, d.longitude], 16, { duration: 1 }); openCard(d); } }
    function searchSaluran() {
        const query = document.getElementById('searchInput').value.toLowerCase();
        document.querySelectorAll('.list-item').forEach(item => { item.style.display = item.innerText.toLowerCase().includes(query) ? 'flex' : 'none'; });
    }
    function filterChips(type, btn) {
        document.querySelectorAll('.chip').forEach(c => c.style.background = '');
        if (type === 'all') {
            for (let id in markers) markers[id].addTo(map);
            document.querySelectorAll('.list-item').forEach(item => item.style.display = 'flex');
        } else {
            for (let id in markers) map.removeLayer(markers[id]);
            saluranData.forEach(d => { if (d.jenis === type && markers[d.id]) markers[d.id].addTo(map); });
            document.querySelectorAll('.list-item').forEach(item => { const sid = parseInt(item.id.replace('list-item-','')); const s = saluranData.find(x => x.id === sid); item.style.display = s && s.jenis === type ? 'flex' : 'none'; });
        }
    }
    function toggleLegend() {
        const body = document.getElementById('legendBody');
        const arrow = document.getElementById('legendArrow');
        if (body.style.display === 'none') { body.style.display = 'block'; arrow.style.transform = 'rotate(0deg)'; }
        else { body.style.display = 'none'; arrow.style.transform = 'rotate(180deg)'; }
    }
    map.on('click', () => closeCard());

    // URL params
    const params = new URLSearchParams(window.location.search);
    const lat = params.get('lat'), lng = params.get('lng');
    if (lat && lng) map.setView([parseFloat(lat), parseFloat(lng)], 15);
</script>
@endpush
