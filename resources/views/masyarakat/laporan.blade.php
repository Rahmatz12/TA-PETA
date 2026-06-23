@extends('layouts.app')

@section('title', 'Laporan Kerusakan - SIG Irigasi Sidoarjo')

@section('content')
<style>
    .page-hero { background: linear-gradient(135deg, #051F20 0%, #163832 50%, #235347 100%); color: white; padding: 3rem 2rem; position: relative; overflow: hidden; }
    .page-hero::before { content: ''; position: absolute; inset: 0; background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E"); opacity: 0.3; }
    .page-hero-content { position: relative; max-width: 1280px; margin: 0 auto; }
    .page-hero-content .badge { display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); padding: 0.4rem 1rem; border-radius: 9999px; font-size: 0.8rem; font-weight: 500; margin-bottom: 1rem; border: 1px solid rgba(255,255,255,0.2); }
    .page-hero-content h2 { font-size: 2.2rem; font-weight: 800; margin-bottom: 0.5rem; }
    .page-hero-content h2 span { color: #DAF1DE; }
    .page-hero-content p { font-size: 1rem; opacity: 0.85; max-width: 600px; }
    .main-container { max-width: 1280px; margin: 0 auto; padding: 2rem; }
    .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.25rem; margin-bottom: 2rem; }
    .stat-card { background: white; border-radius: 16px; padding: 1.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.07); display: flex; align-items: center; gap: 1rem; }
    .stat-icon { width: 52px; height: 52px; border-radius: 13px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; flex-shrink: 0; }
    .si-total { background: #e0f2fe; color: #0369a1; }
    .si-tunggu { background: #fef3c7; color: #d97706; }
    .si-proses { background: #ede9fe; color: #7c3aed; }
    .si-selesai { background: #dcfce7; color: #16a34a; }
    .stat-info h3 { font-size: 1.8rem; font-weight: 800; color: var(--dark); line-height: 1; }
    .stat-info p { font-size: 0.82rem; color: #64748b; margin-top: 0.2rem; }
    .search-card { background: white; border-radius: 16px; padding: 1.75rem; box-shadow: 0 2px 8px rgba(0,0,0,0.07); margin-bottom: 1.5rem; }
    .search-card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem; }
    .search-card-header h3 { font-size: 1.05rem; font-weight: 700; color: var(--dark); }
    .btn-primary { background: linear-gradient(135deg, var(--primary), var(--secondary)); color: white; padding: 0.6rem 1.2rem; border-radius: 9999px; text-decoration: none; font-weight: 600; font-size: 0.85rem; display: inline-flex; align-items: center; gap: 0.5rem; border: none; cursor: pointer; transition: transform 0.2s, box-shadow 0.2s; }
    .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(22,56,50,0.3); }
    .btn-outline-green { background: transparent; border: 1.5px solid var(--primary); color: var(--primary); padding: 0.5rem 1rem; border-radius: 8px; font-size: 0.82rem; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 0.4rem; transition: all 0.2s; text-decoration: none; }
    .btn-outline-green:hover { background: var(--primary); color: white; }
    .search-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem; }
    .input-group { display: flex; align-items: stretch; border: 1.5px solid #e2e8f0; border-radius: 10px; overflow: hidden; }
    .input-group:focus-within { border-color: var(--primary-light); }
    .input-prefix { background: #f8fafc; padding: 0 0.9rem; display: flex; align-items: center; font-size: 0.82rem; color: #64748b; font-weight: 600; border-right: 1.5px solid #e2e8f0; white-space: nowrap; }
    .input-group input { flex: 1; border: none; outline: none; padding: 0.65rem 0.85rem; font-family: inherit; font-size: 0.88rem; color: var(--text); background: white; }
    .btn-search { background: var(--primary); color: white; border: none; padding: 0 1.1rem; font-size: 0.82rem; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 0.4rem; transition: background 0.2s; white-space: nowrap; }
    .btn-search:hover { background: var(--primary-light); }
    .filter-bar { display: flex; align-items: center; gap: 0.6rem; flex-wrap: wrap; margin-bottom: 1.25rem; }
    .filter-bar span { font-size: 0.82rem; font-weight: 600; color: #64748b; }
    .filter-pill { padding: 0.4rem 1rem; border-radius: 9999px; border: 1.5px solid #e2e8f0; background: white; font-size: 0.8rem; font-weight: 500; color: #64748b; cursor: pointer; transition: all 0.2s; display: flex; align-items: center; gap: 0.35rem; text-decoration: none; }
    .filter-pill:hover { border-color: var(--primary); color: var(--primary); }
    .filter-pill.active { background: var(--primary); color: white; border-color: var(--primary); }
    .report-card { background: white; border-radius: 16px; padding: 1.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.07); display: grid; grid-template-columns: 1fr auto; gap: 1.5rem; align-items: start; margin-bottom: 1rem; transition: box-shadow 0.2s, transform 0.2s; }
    .report-card:hover { box-shadow: 0 8px 24px rgba(0,0,0,0.1); transform: translateY(-2px); }
    .report-top { display: flex; align-items: center; gap: 0.6rem; flex-wrap: wrap; margin-bottom: 0.5rem; }
    .sbadge { display: inline-flex; align-items: center; gap: 0.35rem; padding: 0.28rem 0.75rem; border-radius: 9999px; font-size: 0.74rem; font-weight: 600; }
    .s-menunggu { background: #fef9c3; color: #a16207; }
    .s-diverifikasi { background: #dcfce7; color: #16a34a; }
    .s-diproses { background: #ede9fe; color: #7c3aed; }
    .s-selesai { background: #dbeafe; color: #1d4ed8; }
    .s-ditolak { background: #fee2e2; color: #b91c1c; }
    .pbadge { padding: 0.22rem 0.6rem; border-radius: 6px; font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.04em; }
    .p-ringan { background: #dbeafe; color: #1d4ed8; }
    .p-sedang { background: #fef9c3; color: #a16207; }
    .p-berat { background: #ffedd5; color: #c2410c; }
    .p-kritis { background: #fee2e2; color: #b91c1c; }
    .report-title { font-size: 1rem; font-weight: 700; color: var(--dark); margin-bottom: 0.3rem; }
    .report-location { font-size: 0.84rem; color: #64748b; display: flex; align-items: center; gap: 0.35rem; }
    .report-desc { font-size: 0.84rem; color: #374151; line-height: 1.55; margin-top: 0.5rem; }
    .report-meta { display: flex; gap: 1.25rem; font-size: 0.78rem; color: #94a3b8; flex-wrap: wrap; margin-top: 0.5rem; }
    .report-code-wrap { text-align: right; }
    .report-code-label { font-size: 0.72rem; color: #94a3b8; font-weight: 500; }
    .report-code-value { font-size: 0.9rem; font-weight: 700; color: var(--primary); font-family: monospace; }
    .empty-state { text-align: center; padding: 4rem 2rem; background: white; border-radius: 16px; box-shadow: 0 2px 8px rgba(0,0,0,0.07); }
    .empty-icon { width: 80px; height: 80px; border-radius: 20px; background: #f1f5f9; display: flex; align-items: center; justify-content: center; font-size: 2rem; color: #94a3b8; margin: 0 auto 1.5rem; }
    @media (max-width: 900px) {
        .stats-grid { grid-template-columns: repeat(2, 1fr); }
        .search-grid { grid-template-columns: 1fr; }
        .report-card { grid-template-columns: 1fr; }
    }
    @media (max-width: 768px) {
        .stats-grid { grid-template-columns: 1fr 1fr; }
    }
</style>

<section class="page-hero">
    <div class="page-hero-content">
        <div class="badge"><i class="fas fa-clipboard-list"></i> LAPORAN KERUSAKAN</div>
        <h2>Cek Status <span>Laporan Anda</span></h2>
        <p>Pantau perkembangan laporan kerusakan irigasi yang telah diajukan secara real-time.</p>
    </div>
</section>

<div class="main-container">
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon si-total"><i class="fas fa-file-alt"></i></div>
            <div class="stat-info"><h3>{{ $stats['total'] }}</h3><p>Total Laporan</p></div>
        </div>
        <div class="stat-card">
            <div class="stat-icon si-tunggu"><i class="fas fa-clock"></i></div>
            <div class="stat-info"><h3>{{ $stats['menunggu'] }}</h3><p>Menunggu</p></div>
        </div>
        <div class="stat-card">
            <div class="stat-icon si-proses"><i class="fas fa-tools"></i></div>
            <div class="stat-info"><h3>{{ $stats['diproses'] }}</h3><p>Diproses</p></div>
        </div>
        <div class="stat-card">
            <div class="stat-icon si-selesai"><i class="fas fa-check-circle"></i></div>
            <div class="stat-info"><h3>{{ $stats['selesai'] }}</h3><p>Selesai</p></div>
        </div>
    </div>

    <div class="search-card">
        <div class="search-card-header">
            <div><h3><i class="fas fa-search" style="color:var(--primary-light);margin-right:0.4rem"></i>Cari Laporan</h3></div>
            <a href="{{ route('laporan.create') }}" class="btn-outline-green"><i class="fas fa-plus"></i> Buat Laporan Baru</a>
        </div>
        <form method="GET" action="{{ route('laporan.index') }}" class="search-grid">
            <div>
                <label style="font-size:0.8rem;font-weight:600;color:var(--text-light);display:block;margin-bottom:0.4rem">Kode Laporan</label>
                <div class="input-group">
                    <span class="input-prefix">IRG</span>
                    <input type="text" name="kode" placeholder="Contoh: 2026-00001" value="{{ request('kode') }}" autocomplete="off">
                    <button type="submit" class="btn-search"><i class="fas fa-search"></i> Cari</button>
                </div>
            </div>
            <div>
                <label style="font-size:0.8rem;font-weight:600;color:var(--text-light);display:block;margin-bottom:0.4rem">Nomor Telepon</label>
                <div class="input-group">
                    <span class="input-prefix">+62</span>
                    <input type="tel" name="telepon" placeholder="81234567890" value="{{ request('telepon') }}">
                    <button type="submit" class="btn-search"><i class="fas fa-search"></i> Cari</button>
                </div>
            </div>
        </form>
    </div>

    <div class="filter-bar">
        <span>Filter:</span>
        <a href="{{ route('laporan.index') }}" class="filter-pill {{ !request('status') || request('status')=='all' ? 'active' : '' }}">Semua</a>
        <a href="{{ route('laporan.index') }}?status=menunggu" class="filter-pill {{ request('status')=='menunggu' ? 'active' : '' }}"><span style="width:8px;height:8px;border-radius:50%;background:#eab308"></span> Menunggu</a>
        <a href="{{ route('laporan.index') }}?status=diverifikasi" class="filter-pill {{ request('status')=='diverifikasi' ? 'active' : '' }}"><span style="width:8px;height:8px;border-radius:50%;background:#22c55e"></span> Diverifikasi</a>
        <a href="{{ route('laporan.index') }}?status=diproses" class="filter-pill {{ request('status')=='diproses' ? 'active' : '' }}"><span style="width:8px;height:8px;border-radius:50%;background:#a855f7"></span> Diproses</a>
        <a href="{{ route('laporan.index') }}?status=selesai" class="filter-pill {{ request('status')=='selesai' ? 'active' : '' }}"><span style="width:8px;height:8px;border-radius:50%;background:#3b82f6"></span> Selesai</a>
        <a href="{{ route('laporan.index') }}?status=ditolak" class="filter-pill {{ request('status')=='ditolak' ? 'active' : '' }}"><span style="width:8px;height:8px;border-radius:50%;background:#ef4444"></span> Ditolak</a>
    </div>

    @forelse($laporans as $laporan)
    <div class="report-card">
        <div>
            <div class="report-top">
                @php
                    $sClass = match($laporan->status) {
                        'menunggu' => 's-menunggu',
                        'diverifikasi' => 's-diverifikasi',
                        'diproses' => 's-diproses',
                        'selesai' => 's-selesai',
                        'ditolak' => 's-ditolak',
                        default => 's-menunggu'
                    };
                    $sText = match($laporan->status) {
                        'menunggu' => 'Menunggu',
                        'diverifikasi' => 'Diverifikasi',
                        'diproses' => 'Diproses',
                        'selesai' => 'Selesai',
                        'ditolak' => 'Ditolak',
                        default => $laporan->status
                    };
                    $pClass = match($laporan->tingkat_keparahan) {
                        'ringan' => 'p-ringan',
                        'sedang' => 'p-sedang',
                        'berat' => 'p-berat',
                        'kritis' => 'p-kritis',
                        default => 'p-ringan'
                    };
                @endphp
                <span class="sbadge {{ $sClass }}"><span style="width:7px;height:7px;border-radius:50%;background:currentColor"></span> {{ $sText }}</span>
                <span class="pbadge {{ $pClass }}">{{ ucfirst($laporan->tingkat_keparahan) }}</span>
            </div>
            <div class="report-title">{{ $laporan->jenis_kerusakan }}</div>
            <div class="report-location"><i class="fas fa-map-marker-alt"></i> {{ $laporan->nama_saluran }} - {{ $laporan->kecamatan }}</div>
            <div class="report-desc">{{ Str::limit($laporan->deskripsi_kerusakan, 120) }}</div>
            <div class="report-meta">
                <span><i class="fas fa-user"></i> {{ $laporan->is_anonymous ? 'Anonim' : $laporan->nama_pelapor }}</span>
                <span><i class="fas fa-calendar"></i> {{ $laporan->created_at->format('d M Y') }}</span>
                <span><i class="fas fa-phone"></i> {{ $laporan->telepon }}</span>
            </div>
        </div>
        <div style="text-align:right">
            <div class="report-code-wrap">
                <div class="report-code-label">Kode Laporan</div>
                <div class="report-code-value">{{ $laporan->kode_laporan }}</div>
            </div>
        </div>
    </div>
    @empty
    <div class="empty-state">
        <div class="empty-icon"><i class="fas fa-inbox"></i></div>
        <h4>Belum Ada Laporan</h4>
        <p>Coba cari dengan nomor telepon atau kode laporan, atau mulai buat laporan baru.</p>
        <a href="{{ route('laporan.create') }}" class="btn-primary" style="display:inline-flex;margin:0 auto"><i class="fas fa-plus"></i> Buat Laporan Pertama</a>
    </div>
    @endforelse

    <div style="margin-top:1rem">{{ $laporans->links() }}</div>
</div>
@endsection
