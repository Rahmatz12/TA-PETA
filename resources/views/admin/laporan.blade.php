@extends('layouts.admin')

@section('title', 'Laporan Masyarakat - SIG Irigasi Sidoarjo')
@section('page-title', 'Laporan Masyarakat')

@section('content')
<style>
    .stats-row { display: grid; grid-template-columns: repeat(6, 1fr); gap: 0.85rem; margin-bottom: 1.5rem; }
    .sr-card { background: white; border-radius: 12px; padding: 1.1rem; text-align: center; box-shadow: 0 1px 3px rgba(0,0,0,0.06); }
    .sr-card h4 { font-size: 1.4rem; font-weight: 700; color: var(--dark); }
    .sr-card p { font-size: 0.72rem; color: #94a3b8; margin-top: 0.15rem; }
    .filter-bar { background: white; border-radius: 12px; padding: 1rem 1.25rem; box-shadow: 0 1px 3px rgba(0,0,0,0.06); margin-bottom: 1.25rem; display: flex; gap: 0.75rem; align-items: center; flex-wrap: wrap; }
    .filter-select { padding: 0.45rem 0.75rem; border-radius: 8px; border: 1px solid #e2e8f0; font-family: inherit; font-size: 0.8rem; outline: none; }
    .filter-input { padding: 0.45rem 0.85rem; border-radius: 8px; border: 1px solid #e2e8f0; font-family: inherit; font-size: 0.8rem; flex: 1; min-width: 160px; outline: none; }
    .btn-filter { padding: 0.45rem 1rem; background: var(--primary); color: white; border: none; border-radius: 8px; font-size: 0.8rem; font-weight: 600; cursor: pointer; }
    .card-white { background: white; border-radius: 14px; box-shadow: 0 1px 4px rgba(0,0,0,0.06); overflow: hidden; }
    .card-header { padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; }
    .card-header h3 { font-size: 1rem; font-weight: 700; color: var(--dark); }
    .data-table { width: 100%; border-collapse: collapse; }
    .data-table th { padding: 0.75rem 1.25rem; text-align: left; font-size: 0.78rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid #f1f5f9; }
    .data-table td { padding: 0.85rem 1.25rem; border-bottom: 1px solid #f8fafc; font-size: 0.85rem; }
    .data-table tbody tr:hover td { background: #f8fafc; }
    .badge-status { display: inline-flex; align-items: center; gap: 0.3rem; padding: 0.2rem 0.6rem; border-radius: 9999px; font-size: 0.68rem; font-weight: 600; }
    .s-menunggu { background: #fef9c3; color: #a16207; }
    .s-diverifikasi { background: #dcfce7; color: #16a34a; }
    .s-diproses { background: #ede9fe; color: #7c3aed; }
    .s-selesai { background: #dbeafe; color: #1d4ed8; }
    .s-ditolak { background: #fee2e2; color: #b91c1c; }
    .p-badge { display: inline-block; padding: 0.15rem 0.5rem; border-radius: 4px; font-size: 0.65rem; font-weight: 700; text-transform: uppercase; }
    .p-ringan { background: #dbeafe; color: #1d4ed8; }
    .p-sedang { background: #fef9c3; color: #a16207; }
    .p-berat { background: #ffedd5; color: #c2410c; }
    .p-kritis { background: #fee2e2; color: #b91c1c; }
    .action-btns { display: flex; gap: 0.3rem; }
    .btn-action { padding: 0.3rem 0.5rem; border-radius: 6px; font-size: 0.72rem; font-weight: 600; cursor: pointer; border: none; display: inline-flex; align-items: center; gap: 0.2rem; }
    .btn-verify { background: #dcfce7; color: #16a34a; }
    .btn-verify:hover { background: #16a34a; color: white; }
    .btn-process { background: #ede9fe; color: #7c3aed; }
    .btn-process:hover { background: #7c3aed; color: white; }
    .btn-done { background: #dbeafe; color: #1d4ed8; }
    .btn-done:hover { background: #1d4ed8; color: white; }
    .btn-reject { background: #fee2e2; color: #b91c1c; }
    .btn-reject:hover { background: #b91c1c; color: white; }
    .modal-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 2000; display: none; align-items: center; justify-content: center; backdrop-filter: blur(4px); }
    .modal-overlay.show { display: flex; }
    .modal-box { background: white; border-radius: 16px; width: 100%; max-width: 420px; padding: 1.5rem; box-shadow: 0 20px 60px rgba(0,0,0,0.3); }
    .modal-box h3 { font-size: 1rem; font-weight: 700; color: var(--dark); margin-bottom: 1rem; }
    .form-group { margin-bottom: 0.85rem; }
    .form-group label { display: block; font-size: 0.78rem; font-weight: 600; margin-bottom: 0.3rem; }
    .form-control { width: 100%; padding: 0.55rem 0.75rem; border: 1.5px solid #e2e8f0; border-radius: 8px; font-family: inherit; font-size: 0.82rem; outline: none; }
    .modal-actions { display: flex; gap: 0.6rem; justify-content: flex-end; margin-top: 1rem; }
    .btn-cancel-modal { padding: 0.5rem 1rem; background: #f1f5f9; color: #64748b; border: none; border-radius: 8px; font-size: 0.78rem; font-weight: 600; cursor: pointer; }
    .btn-save-modal { padding: 0.5rem 1.1rem; background: linear-gradient(135deg, var(--primary), var(--secondary)); color: white; border: none; border-radius: 8px; font-size: 0.78rem; font-weight: 700; cursor: pointer; }
    @media (max-width: 1024px) { .stats-row { grid-template-columns: repeat(3, 1fr); } }
    @media (max-width: 768px) { .stats-row { grid-template-columns: repeat(2, 1fr); } }
</style>

<div class="stats-row">
    <div class="sr-card"><h4 style="color:#0369a1">{{ $stats['total'] }}</h4><p>Total Laporan</p></div>
    <div class="sr-card"><h4 style="color:#d97706">{{ $stats['menunggu'] }}</h4><p>Menunggu</p></div>
    <div class="sr-card"><h4 style="color:#16a34a">{{ $stats['diverifikasi'] }}</h4><p>Diverifikasi</p></div>
    <div class="sr-card"><h4 style="color:#7c3aed">{{ $stats['diproses'] }}</h4><p>Diproses</p></div>
    <div class="sr-card"><h4 style="color:#1d4ed8">{{ $stats['selesai'] }}</h4><p>Selesai</p></div>
    <div class="sr-card"><h4 style="color:#b91c1c">{{ $stats['ditolak'] }}</h4><p>Ditolak</p></div>
</div>

<form method="GET" action="{{ route('admin.laporan.index') }}" class="filter-bar">
    <select name="status" class="filter-select" onchange="this.form.submit()">
        <option value="all">Semua Status</option>
        <option value="menunggu" {{ request('status')=='menunggu'?'selected':'' }}>Menunggu</option>
        <option value="diverifikasi" {{ request('status')=='diverifikasi'?'selected':'' }}>Diverifikasi</option>
        <option value="diproses" {{ request('status')=='diproses'?'selected':'' }}>Diproses</option>
        <option value="selesai" {{ request('status')=='selesai'?'selected':'' }}>Selesai</option>
        <option value="ditolak" {{ request('status')=='ditolak'?'selected':'' }}>Ditolak</option>
    </select>
    <input type="text" name="search" class="filter-input" placeholder="Cari kode, nama pelapor, atau saluran..." value="{{ request('search') }}">
    <button type="submit" class="btn-filter"><i class="fas fa-search"></i> Cari</button>
    <a href="{{ route('admin.laporan.index') }}" class="btn-filter" style="background:#94a3b8;text-decoration:none"><i class="fas fa-sync-alt"></i> Reset</a>
</form>

<div class="card-white">
    <div class="card-header"><h3><i class="fas fa-list" style="margin-right:0.4rem;color:var(--primary-light)"></i>Daftar Laporan</h3></div>
    <div style="overflow-x:auto">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Pelapor</th>
                    <th>Saluran</th>
                    <th>Kecamatan</th>
                    <th>Keparahan</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($laporans as $laporan)
                <tr>
                    <td><strong style="font-family:monospace;color:var(--primary)">{{ $laporan->kode_laporan }}</strong></td>
                    <td>{{ $laporan->is_anonymous ? 'Anonim' : $laporan->nama_pelapor }}</td>
                    <td>{{ $laporan->nama_saluran }}</td>
                    <td>{{ $laporan->kecamatan }}</td>
                    <td>
                        @php $pc = match($laporan->tingkat_keparahan){'ringan'=>'p-ringan','sedang'=>'p-sedang','berat'=>'p-berat','kritis'=>'p-kritis',default=>'p-ringan'}; @endphp
                        <span class="p-badge {{ $pc }}">{{ ucfirst($laporan->tingkat_keparahan) }}</span>
                    </td>
                    <td>
                        @php $sc = match($laporan->status){'menunggu'=>'s-menunggu','diverifikasi'=>'s-diverifikasi','diproses'=>'s-diproses','selesai'=>'s-selesai','ditolak'=>'s-ditolak',default=>'s-menunggu'}; @endphp
                        <span class="badge-status {{ $sc }}"><span style="width:6px;height:6px;border-radius:50%;background:currentColor"></span> {{ ucfirst($laporan->status) }}</span>
                    </td>
                    <td>{{ $laporan->created_at->format('d M Y') }}</td>
                    <td>
                        <div class="action-btns">
                            @if($laporan->status == 'menunggu')
                                <button class="btn-action btn-verify" onclick="openActionModal('verifikasi', {{ $laporan->id }})"><i class="fas fa-check"></i> Verifikasi</button>
                                <button class="btn-action btn-reject" onclick="openActionModal('tolak', {{ $laporan->id }})"><i class="fas fa-times"></i> Tolak</button>
                            @elseif($laporan->status == 'diverifikasi')
                                <button class="btn-action btn-process" onclick="openActionModal('proses', {{ $laporan->id }})"><i class="fas fa-tools"></i> Proses</button>
                            @elseif($laporan->status == 'diproses')
                                <button class="btn-action btn-done" onclick="openActionModal('selesai', {{ $laporan->id }})"><i class="fas fa-check-double"></i> Selesai</button>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" style="text-align:center;padding:2rem;color:#94a3b8"><i class="fas fa-inbox" style="font-size:2rem;display:block;margin-bottom:0.5rem"></i>Belum ada laporan</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="padding:1rem 1.5rem;border-top:1px solid #f1f5f9">{{ $laporans->links() }}</div>
</div>

<!-- Modal Verifikasi -->
<div class="modal-overlay" id="modalVerifikasi">
    <div class="modal-box">
        <h3>Verifikasi Laporan</h3>
        <form id="formVerifikasi" method="POST">
            @csrf
            <div class="form-group"><label>Catatan Verifikasi</label><textarea name="catatan" class="form-control" rows="3" placeholder="Catatan untuk pelapor..."></textarea></div>
            <div class="modal-actions">
                <button type="button" class="btn-cancel-modal" onclick="closeModals()">Batal</button>
                <button type="submit" class="btn-save-modal"><i class="fas fa-check"></i> Verifikasi</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Proses -->
<div class="modal-overlay" id="modalProses">
    <div class="modal-box">
        <h3>Proses Laporan</h3>
        <form id="formProses" method="POST">
            @csrf
            <div class="form-group"><label>Estimasi Perbaikan</label><input type="text" name="estimasi" class="form-control" placeholder="Contoh: 7-14 hari"></div>
            <div class="modal-actions">
                <button type="button" class="btn-cancel-modal" onclick="closeModals()">Batal</button>
                <button type="submit" class="btn-save-modal"><i class="fas fa-tools"></i> Proses</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Selesai -->
<div class="modal-overlay" id="modalSelesai">
    <div class="modal-box">
        <h3>Selesaikan Laporan</h3>
        <p style="font-size:0.85rem;color:#64748b;margin-bottom:1rem">Apakah Anda yakin ingin menyelesaikan laporan ini?</p>
        <form id="formSelesai" method="POST">
            @csrf
            <div class="modal-actions">
                <button type="button" class="btn-cancel-modal" onclick="closeModals()">Batal</button>
                <button type="submit" class="btn-save-modal"><i class="fas fa-check-double"></i> Selesai</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Tolak -->
<div class="modal-overlay" id="modalTolak">
    <div class="modal-box">
        <h3>Tolak Laporan</h3>
        <form id="formTolak" method="POST">
            @csrf
            <div class="form-group"><label>Alasan Penolakan</label><textarea name="catatan" class="form-control" rows="3" placeholder="Alasan penolakan..."></textarea></div>
            <div class="modal-actions">
                <button type="button" class="btn-cancel-modal" onclick="closeModals()">Batal</button>
                <button type="submit" class="btn-save-modal" style="background:#b91c1c"><i class="fas fa-times"></i> Tolak</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openActionModal(type, id) {
        closeModals();
        const base = '{{ url('admin/laporan') }}';
        if (type === 'verifikasi') { document.getElementById('formVerifikasi').action = base + '/' + id + '/verifikasi'; document.getElementById('modalVerifikasi').classList.add('show'); }
        else if (type === 'proses') { document.getElementById('formProses').action = base + '/' + id + '/proses'; document.getElementById('modalProses').classList.add('show'); }
        else if (type === 'selesai') { document.getElementById('formSelesai').action = base + '/' + id + '/selesai'; document.getElementById('modalSelesai').classList.add('show'); }
        else if (type === 'tolak') { document.getElementById('formTolak').action = base + '/' + id + '/tolak'; document.getElementById('modalTolak').classList.add('show'); }
    }
    function closeModals() { document.querySelectorAll('.modal-overlay').forEach(m => m.classList.remove('show')); }
</script>
@endsection
