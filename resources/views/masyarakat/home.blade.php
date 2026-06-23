@extends('layouts.app')

@section('title', 'Beranda - SIG Irigasi Sidoarjo')

@section('content')
<style>
    .hero { background: linear-gradient(135deg, #051F20 0%, #163832 50%, #235347 100%); color: white; padding: 5rem 2rem; text-align: center; position: relative; overflow: hidden; }
    .hero::before { content: ''; position: absolute; inset: 0; background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E"); opacity: 0.3; }
    .hero-content { position: relative; max-width: 800px; margin: 0 auto; }
    .badge { display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); padding: 0.4rem 1rem; border-radius: 9999px; font-size: 0.8rem; font-weight: 500; margin-bottom: 1.5rem; border: 1px solid rgba(255,255,255,0.2); }
    .hero h2 { font-size: 3rem; font-weight: 800; margin-bottom: 1rem; line-height: 1.2; }
    .hero h2 span { color: #DAF1DE; }
    .hero p { font-size: 1.1rem; opacity: 0.9; max-width: 600px; margin: 0 auto 2rem; line-height: 1.7; }
    .hero-buttons { display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; }
    .btn-white { background: white; color: var(--primary); padding: 0.8rem 1.8rem; border-radius: 9999px; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 0.5rem; transition: transform 0.2s; }
    .btn-white:hover { transform: translateY(-2px); }
    .btn-outline { background: rgba(255,255,255,0.1); color: white; padding: 0.8rem 1.8rem; border-radius: 9999px; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 0.5rem; border: 1px solid rgba(255,255,255,0.3); transition: all 0.2s; }
    .btn-outline:hover { background: rgba(255,255,255,0.2); }
    .stats-section { max-width: 1280px; margin: -3rem auto 0; padding: 0 2rem; position: relative; z-index: 10; }
    .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem; }
    .stat-card { background: white; border-radius: 16px; padding: 1.5rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); transition: transform 0.2s; }
    .stat-card:hover { transform: translateY(-4px); box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); }
    .stat-icon { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; margin-bottom: 1rem; }
    .stat-icon.blue { background: #DAF1DE; color: #163832; }
    .stat-icon.green { background: #c5e8ce; color: #0B2B26; }
    .stat-icon.orange { background: #b8dfc4; color: #051F20; }
    .stat-icon.purple { background: #DAF1DE; color: #235347; }
    .stat-card h3 { font-size: 2rem; font-weight: 700; color: var(--dark); margin-bottom: 0.25rem; }
    .stat-card p { color: var(--text-light); font-size: 0.9rem; margin-bottom: 0.75rem; }
    .stat-link { color: var(--primary); text-decoration: none; font-size: 0.8rem; font-weight: 600; display: inline-flex; align-items: center; gap: 0.25rem; }
    .categories-section { max-width: 1280px; margin: 4rem auto; padding: 0 2rem; }
    .section-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; }
    .section-header h2 { font-size: 1.8rem; font-weight: 700; color: var(--dark); }
    .section-header p { color: var(--text-light); margin-top: 0.25rem; }
    .link-arrow { color: var(--primary); text-decoration: none; font-weight: 600; font-size: 0.9rem; display: flex; align-items: center; gap: 0.25rem; }
    .categories-grid { display: grid; grid-template-columns: repeat(5, 1fr); gap: 1.5rem; }
    .category-card { background: white; border-radius: 16px; padding: 1.5rem; text-align: center; box-shadow: 0 1px 3px rgba(0,0,0,0.1); transition: all 0.2s; cursor: pointer; }
    .category-card:hover { transform: translateY(-4px); box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); }
    .category-icon { width: 64px; height: 64px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; margin: 0 auto 1rem; }
    .category-icon.red { background: #c5e8ce; color: #051F20; }
    .category-icon.green { background: #DAF1DE; color: #0B2B26; }
    .category-icon.blue { background: #b8dfc4; color: #163832; }
    .category-icon.orange { background: #a8d5b5; color: #0B2B26; }
    .category-icon.teal { background: #DAF1DE; color: #235347; }
    .category-card h4 { font-size: 1rem; font-weight: 600; color: var(--dark); margin-bottom: 0.25rem; }
    .category-card p { font-size: 0.8rem; color: var(--text-light); }
    .table-section { max-width: 1280px; margin: 0 auto 4rem; padding: 0 2rem; }
    .table-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; }
    .table-header h2 { font-size: 1.8rem; font-weight: 700; color: var(--dark); }
    .table-header p { color: var(--text-light); margin-top: 0.25rem; }
    .table-actions { display: flex; gap: 0.75rem; }
    .btn-secondary { background: white; color: var(--text); padding: 0.5rem 1rem; border-radius: 8px; text-decoration: none; font-weight: 500; font-size: 0.85rem; display: inline-flex; align-items: center; gap: 0.5rem; border: 1px solid #e2e8f0; transition: all 0.2s; }
    .btn-secondary:hover { background: #DAF1DE; }
    .btn-primary { background: linear-gradient(135deg, var(--primary), var(--secondary)); color: white; padding: 0.6rem 1.2rem; border-radius: 9999px; text-decoration: none; font-weight: 600; font-size: 0.85rem; display: inline-flex; align-items: center; gap: 0.5rem; border: none; cursor: pointer; transition: transform 0.2s, box-shadow 0.2s; }
    .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(22,56,50,0.3); }
    .table-container { background: white; border-radius: 16px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow: hidden; }
    table { width: 100%; border-collapse: collapse; }
    thead { background: linear-gradient(135deg, var(--primary), var(--secondary)); color: white; }
    th { padding: 1rem 1.5rem; text-align: left; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.05em; }
    td { padding: 1rem 1.5rem; border-bottom: 1px solid #DAF1DE; font-size: 0.9rem; }
    tr:hover td { background: #f0faf3; }
    .no-cell { color: var(--text-light); font-weight: 500; width: 50px; }
    .name-cell h4 { font-weight: 600; color: var(--dark); margin-bottom: 0.15rem; }
    .name-cell p { font-size: 0.8rem; color: var(--text-light); }
    .badge-type { display: inline-block; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; }
    .badge-type.primer { background: #DAF1DE; color: #051F20; }
    .badge-type.sekunder { background: #c5e8ce; color: #0B2B26; }
    .badge-type.tersier { background: #b8dfc4; color: #163832; }
    .badge-type.pintu { background: #a8d5b5; color: #235347; }
    .badge-type.bendungan { background: #DAF1DE; color: #235347; }
    .badge-status { display: inline-block; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; }
    .badge-status.aktif { background: #DAF1DE; color: #0B2B26; }
    .badge-status.perbaikan { background: #c5e8ce; color: #163832; }
    .badge-status.rusak { background: #8EB69B; color: #051F20; }
    .badge-status.baik { background: #DAF1DE; color: #0B2B26; }
    .badge-status.rusak-ringan { background: #dbeafe; color: #1d4ed8; }
    .badge-status.rusak-sedang { background: #fef9c3; color: #a16207; }
    .badge-status.rusak-berat { background: #fee2e2; color: #b91c1c; }
    .btn-peta { display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.4rem 1rem; border-radius: 9999px; font-size: 0.8rem; font-weight: 600; text-decoration: none; color: white; background: linear-gradient(135deg, #235347, #163832); transition: transform 0.2s; }
    .btn-peta:hover { transform: scale(1.05); }
    .pagination { display: flex; justify-content: space-between; align-items: center; padding: 1.5rem; }
    .pagination-info { color: var(--text-light); font-size: 0.85rem; }
    .table-footer { padding: 1rem 1.5rem; border-top: 1px solid #DAF1DE; display: flex; justify-content: space-between; align-items: center; }
    .update-info { color: var(--text-light); font-size: 0.8rem; }
    .manage-link { color: var(--primary); text-decoration: none; font-size: 0.85rem; font-weight: 600; display: inline-flex; align-items: center; gap: 0.25rem; }

    @media (max-width: 1024px) {
        .stats-grid { grid-template-columns: repeat(2, 1fr); }
        .categories-grid { grid-template-columns: repeat(3, 1fr); }
    }
    @media (max-width: 768px) {
        .hero h2 { font-size: 2rem; }
        .stats-grid { grid-template-columns: 1fr; }
        .categories-grid { grid-template-columns: repeat(2, 1fr); }
        .table-header { flex-direction: column; gap: 1rem; align-items: flex-start; }
    }
</style>

<!-- Hero -->
<section class="hero">
    <div class="hero-content">
        <div class="badge"><i class="fas fa-map-marked-alt"></i> SISTEM INFORMASI GEOGRAFI</div>
        <h2>Pemantauan Saluran <span>Irigasi Sidoarjo</span></h2>
        <p>Direktori lengkap sistem irigasi di Kabupaten Sidoarjo terintegrasi dengan peta interaktif untuk memudahkan pelaporan kerusakan dan pemantauan kondisi saluran irigasi secara real-time.</p>
        <div class="hero-buttons">
            <a href="#data-table" class="btn-white"><i class="fas fa-list"></i> Lihat Data Saluran</a>
            <a href="{{ route('peta.index') }}" class="btn-outline"><i class="fas fa-map"></i> Buka Peta Interaktif</a>
        </div>
    </div>
</section>

<!-- Stats -->
<section class="stats-section">
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon blue"><i class="fas fa-route"></i></div>
            <h3>{{ $totalSaluran }}</h3>
            <p>Total Saluran</p>
            <a href="{{ route('data-irigasi.index') }}" class="stat-link">Lihat semua &rarr;</a>
        </div>
        <div class="stat-card">
            <div class="stat-icon green"><i class="fas fa-check-circle"></i></div>
            <h3>{{ $saluranAktif }}</h3>
            <p>Saluran Aktif</p>
            <a href="{{ route('data-irigasi.index') }}?kondisi=baik" class="stat-link">Filter aktif &rarr;</a>
        </div>
        <div class="stat-card">
            <div class="stat-icon orange"><i class="fas fa-exclamation-triangle"></i></div>
            <h3>{{ $saluranRusak }}</h3>
            <p>Saluran Bermasalah</p>
            <a href="{{ route('data-irigasi.index') }}" class="stat-link">Filter rusak &rarr;</a>
        </div>
        <div class="stat-card">
            <div class="stat-icon purple"><i class="fas fa-layer-group"></i></div>
            <h3>5</h3>
            <p>Jenis Saluran</p>
            <a href="{{ route('peta.index') }}" class="stat-link">Lihat di peta &rarr;</a>
        </div>
    </div>
</section>

<!-- Categories -->
<section class="categories-section">
    <div class="section-header">
        <div>
            <h2>Jenis Saluran Irigasi</h2>
            <p>Pilih kategori untuk melihat daftar saluran irigasi</p>
        </div>
        <a href="{{ route('peta.index') }}" class="link-arrow">Lihat semua di peta <i class="fas fa-chevron-right"></i></a>
    </div>
    <div class="categories-grid">
        <div class="category-card" onclick="window.location='{{ route('data-irigasi.index') }}?jenis=primer'">
            <div class="category-icon red"><i class="fas fa-water"></i></div>
            <h4>Saluran Primer</h4>
            <p>{{ $categories['primer'] }} saluran</p>
        </div>
        <div class="category-card" onclick="window.location='{{ route('data-irigasi.index') }}?jenis=sekunder'">
            <div class="category-icon green"><i class="fas fa-stream"></i></div>
            <h4>Saluran Sekunder</h4>
            <p>{{ $categories['sekunder'] }} saluran</p>
        </div>
        <div class="category-card" onclick="window.location='{{ route('data-irigasi.index') }}?jenis=tersier'">
            <div class="category-icon blue"><i class="fas fa-project-diagram"></i></div>
            <h4>Saluran Tersier</h4>
            <p>{{ $categories['tersier'] }} saluran</p>
        </div>
        <div class="category-card" onclick="window.location='{{ route('data-irigasi.index') }}?jenis=pintu'">
            <div class="category-icon orange"><i class="fas fa-dungeon"></i></div>
            <h4>Pintu Air</h4>
            <p>{{ $categories['pintu'] }} unit</p>
        </div>
        <div class="category-card" onclick="window.location='{{ route('data-irigasi.index') }}?jenis=bendungan'">
            <div class="category-icon teal"><i class="fas fa-dam"></i></div>
            <h4>Bendungan</h4>
            <p>{{ $categories['bendungan'] }} unit</p>
        </div>
    </div>
</section>

<!-- Table -->
<section class="table-section" id="data-table">
    <div class="table-header">
        <div>
            <h2>Daftar Saluran Irigasi</h2>
            <p>Klik tombol peta untuk melihat lokasi saluran di peta interaktif</p>
        </div>
        <div class="table-actions">
            <a href="{{ route('data-irigasi.index') }}" class="btn-secondary"><i class="fas fa-bars"></i> Kelola Data</a>
            <a href="{{ route('peta.index') }}" class="btn-primary"><i class="fas fa-map"></i> Buka Peta</a>
        </div>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Saluran</th>
                    <th>Jenis</th>
                    <th>Kecamatan</th>
                    <th>Kondisi</th>
                    <th>Status</th>
                    <th>Lokasi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($salurans as $index => $saluran)
                <tr>
                    <td class="no-cell">{{ $salurans->firstItem() + $index }}</td>
                    <td class="name-cell">
                        <h4>{{ $saluran->nama }}</h4>
                        <p>{{ $saluran->alamat ?? '-' }}</p>
                    </td>
                    <td><span class="badge-type {{ $saluran->jenis }}">{{ ucfirst($saluran->jenis) }}</span></td>
                    <td>{{ $saluran->kecamatan }}</td>
                    <td>
                        @php
                            $statusClass = match($saluran->kondisi) {
                                'baik' => 'baik',
                                'perbaikan' => 'perbaikan',
                                'rusak-ringan' => 'rusak-ringan',
                                'rusak-sedang' => 'rusak-sedang',
                                'rusak-berat' => 'rusak-berat',
                                default => 'aktif'
                            };
                            $statusText = match($saluran->kondisi) {
                                'baik' => 'Baik',
                                'perbaikan' => 'Perbaikan',
                                'rusak-ringan' => 'Rusak Ringan',
                                'rusak-sedang' => 'Rusak Sedang',
                                'rusak-berat' => 'Rusak Berat',
                                default => ucfirst($saluran->kondisi)
                            };
                        @endphp
                        <span class="badge-status {{ $statusClass }}">{{ $statusText }}</span>
                    </td>
                    <td><span class="badge-status aktif"><i class="fas fa-check"></i> Aktif</span></td>
                    <td>
                        @if($saluran->latitude && $saluran->longitude)
                            <a href="{{ route('peta.index') }}?lat={{ $saluran->latitude }}&lng={{ $saluran->longitude }}" class="btn-peta"><i class="fas fa-map-marker-alt"></i> Peta</a>
                        @else
                            -
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pagination">
            <div class="pagination-info">Menampilkan {{ $salurans->firstItem() ?? 0 }}-{{ $salurans->lastItem() ?? 0 }} dari {{ $salurans->total() }} saluran</div>
            <div>{{ $salurans->links() }}</div>
        </div>

        <div class="table-footer">
            <div class="update-info">Data diperbarui secara real-time dari database</div>
            <a href="{{ route('data-irigasi.index') }}" class="manage-link">Lihat & kelola semua data &rarr;</a>
        </div>
    </div>
</section>
@endsection
