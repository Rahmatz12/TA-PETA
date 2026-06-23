@extends('layouts.admin')

@section('title', 'Kelola Pengguna - SIG Irigasi Sidoarjo')
@section('page-title', 'Kelola Pengguna')

@section('content')
<style>
    .tab-bar { display: flex; gap: 0; border-bottom: 2px solid #e2e8f0; margin-bottom: 1.5rem; }
    .tab-btn { padding: 0.75rem 1.25rem; background: none; border: none; font-size: 0.88rem; font-weight: 600; color: #94a3b8; cursor: pointer; border-bottom: 2px solid transparent; margin-bottom: -2px; transition: all 0.2s; }
    .tab-btn:hover { color: var(--primary); }
    .tab-btn.active { color: var(--primary); border-bottom-color: var(--primary); }
    .tab-content { display: none; }
    .tab-content.active { display: block; }
    .card-white { background: white; border-radius: 14px; box-shadow: 0 1px 4px rgba(0,0,0,0.06); overflow: hidden; }
    .card-header { padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center; }
    .card-header h3 { font-size: 1rem; font-weight: 700; color: var(--dark); }
    .search-bar { display: flex; gap: 0.75rem; margin-bottom: 1.25rem; }
    .search-input { flex: 1; padding: 0.6rem 1rem; border: 1.5px solid #e2e8f0; border-radius: 10px; font-family: inherit; font-size: 0.85rem; outline: none; }
    .search-input:focus { border-color: var(--primary-light); }
    .btn-add { padding: 0.6rem 1.2rem; background: linear-gradient(135deg, var(--primary), var(--secondary)); color: white; border: none; border-radius: 10px; font-size: 0.85rem; font-weight: 700; cursor: pointer; display: inline-flex; align-items: center; gap: 0.4rem; transition: transform 0.2s; }
    .btn-add:hover { transform: translateY(-2px); }
    .btn-danger-sm { padding: 0.4rem 0.75rem; background: #fee2e2; color: #b91c1c; border: none; border-radius: 8px; font-size: 0.78rem; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 0.3rem; transition: all 0.2s; }
    .btn-danger-sm:hover { background: #b91c1c; color: white; }
    .role-badge { display: inline-block; padding: 0.2rem 0.6rem; border-radius: 6px; font-size: 0.72rem; font-weight: 700; text-transform: uppercase; }
    .role-admin { background: #ede9fe; color: #7c3aed; }
    .role-petugas { background: #dbeafe; color: #1d4ed8; }
    .role-masyarakat { background: #dcfce7; color: #16a34a; }
    .avatar-sm { width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; font-weight: 700; flex-shrink: 0; }
    .data-table { width: 100%; border-collapse: collapse; }
    .data-table th { padding: 0.75rem 1.25rem; text-align: left; font-size: 0.78rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid #f1f5f9; }
    .data-table td { padding: 0.85rem 1.25rem; border-bottom: 1px solid #f8fafc; font-size: 0.88rem; }
    .data-table tbody tr:hover td { background: #f8fafc; }
    .modal-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 2000; display: none; align-items: center; justify-content: center; backdrop-filter: blur(4px); }
    .modal-overlay.show { display: flex; }
    .modal-box { background: white; border-radius: 16px; width: 100%; max-width: 480px; padding: 1.75rem; box-shadow: 0 20px 60px rgba(0,0,0,0.3); }
    .modal-box h3 { font-size: 1.1rem; font-weight: 700; color: var(--dark); margin-bottom: 1.25rem; }
    .form-group { margin-bottom: 1rem; }
    .form-group label { display: block; font-size: 0.8rem; font-weight: 600; color: var(--text); margin-bottom: 0.35rem; }
    .form-control { width: 100%; padding: 0.6rem 0.85rem; border: 1.5px solid #e2e8f0; border-radius: 8px; font-family: inherit; font-size: 0.85rem; outline: none; }
    .form-control:focus { border-color: var(--primary-light); }
    .modal-actions { display: flex; gap: 0.75rem; justify-content: flex-end; margin-top: 1.25rem; }
    .btn-cancel-modal { padding: 0.55rem 1.1rem; background: #f1f5f9; color: #64748b; border: none; border-radius: 8px; font-size: 0.82rem; font-weight: 600; cursor: pointer; }
    .btn-save-modal { padding: 0.55rem 1.25rem; background: linear-gradient(135deg, var(--primary), var(--secondary)); color: white; border: none; border-radius: 8px; font-size: 0.82rem; font-weight: 700; cursor: pointer; }
    .empty-state { text-align: center; padding: 3rem; color: #94a3b8; }
    .empty-state i { font-size: 2.5rem; margin-bottom: 1rem; display: block; }
</style>

<div class="tab-bar">
    <button class="tab-btn {{ $tab == 'masyarakat' ? 'active' : '' }}" onclick="switchTab('masyarakat')">Masyarakat</button>
    <button class="tab-btn {{ $tab == 'admin' ? 'active' : '' }}" onclick="switchTab('admin')">Admin & Petugas</button>
</div>

<!-- Tab Masyarakat -->
<div id="tab-masyarakat" class="tab-content {{ $tab == 'masyarakat' ? 'active' : '' }}">
    <div class="card-white">
        <div class="card-header"><h3><i class="fas fa-users" style="margin-right:0.4rem;color:var(--primary-light)"></i>Daftar Masyarakat</h3></div>
        <div style="padding:1.25rem 1.5rem">
            <form method="GET" action="{{ route('admin.users.index') }}" class="search-bar">
                <input type="hidden" name="tab" value="masyarakat">
                <input type="text" name="search" class="search-input" placeholder="Cari nama atau email..." value="{{ $search }}">
                <button type="submit" class="btn-add"><i class="fas fa-search"></i> Cari</button>
            </form>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Peran</th>
                        <th>Tanggal Daftar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($masyarakats as $u)
                    <tr>
                        <td>
                            <div style="display:flex;align-items:center;gap:0.6rem">
                                <div class="avatar-sm" style="background:#e0f2fe;color:#0369a1">{{ substr($u->name, 0, 1) }}</div>
                                <span style="font-weight:600">{{ $u->name }}</span>
                            </div>
                        </td>
                        <td>{{ $u->email }}</td>
                        <td>{{ $u->phone ?? '-' }}</td>
                        <td><span class="role-badge role-masyarakat"><i class="fas fa-user"></i> Masyarakat</span></td>
                       
                        <td>
                            <form method="POST" action="{{ route('admin.users.masyarakat.destroy', $u->id) }}" style="display:inline" onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-danger-sm"><i class="fas fa-trash-alt"></i> Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6"><div class="empty-state"><i class="fas fa-inbox"></i>Belum ada data masyarakat</div></td></tr>
                    @endforelse
                </tbody>
            </table>
            <div style="padding:1rem 1.5rem;border-top:1px solid #f1f5f9">{{ $masyarakats->links() }}</div>
        </div>
    </div>
</div>

<!-- Tab Admin -->
<div id="tab-admin" class="tab-content {{ $tab == 'admin' ? 'active' : '' }}">
    <div class="card-white">
        <div class="card-header" style="display:flex;justify-content:space-between;align-items:center">
            <h3><i class="fas fa-user-shield" style="margin-right:0.4rem;color:var(--primary-light)"></i>Admin & Petugas</h3>
            <button class="btn-add" onclick="document.getElementById('modalTambahAdmin').classList.add('show')"><i class="fas fa-plus"></i> Tambah Admin/Petugas</button>
        </div>
        <div style="padding:1.25rem 1.5rem">
            <form method="GET" action="{{ route('admin.users.index') }}" class="search-bar">
                <input type="hidden" name="tab" value="admin">
                <input type="text" name="search" class="search-input" placeholder="Cari nama atau email..." value="{{ $search }}">
                <button type="submit" class="btn-add"><i class="fas fa-search"></i> Cari</button>
            </form>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Peran</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($admins as $a)
                    <tr>
                        <td>
                            <div style="display:flex;align-items:center;gap:0.6rem">
                                <div class="avatar-sm" style="background:#ede9fe;color:#7c3aed">{{ substr($a->name, 0, 1) }}</div>
                                <span style="font-weight:600">{{ $a->name }}</span>
                            </div>
                        </td>
                        <td>{{ $a->email }}</td>
                        <td>{{ $a->phone ?? '-' }}</td>
                        <td><span class="role-badge role-{{ $a->role }}"><i class="fas fa-{{ $a->role=='admin'?'shield-alt':'user-cog' }}"></i> {{ ucfirst($a->role) }}</span></td>
                        <td><span style="color:{{ $a->status=='aktif'?'#16a34a':'#ef4444' }};font-weight:600;font-size:0.82rem"><i class="fas fa-circle" style="font-size:0.5rem"></i> {{ ucfirst($a->status) }}</span></td>
                        <td>
                            <form method="POST" action="{{ route('admin.users.admin.destroy', $a->id) }}" style="display:inline" onsubmit="return confirm('Yakin ingin menghapus admin/petugas ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-danger-sm"><i class="fas fa-trash-alt"></i> Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6"><div class="empty-state"><i class="fas fa-inbox"></i>Belum ada data admin/petugas</div></td></tr>
                    @endforelse
                </tbody>
            </table>
            <div style="padding:1rem 1.5rem;border-top:1px solid #f1f5f9">{{ $admins->links() }}</div>
        </div>
    </div>
</div>

<!-- Modal Tambah Admin -->
<div class="modal-overlay" id="modalTambahAdmin">
    <div class="modal-box">
        <h3><i class="fas fa-user-plus" style="margin-right:0.4rem;color:var(--primary-light)"></i>Tambah Admin/Petugas</h3>
        <form method="POST" action="{{ route('admin.users.admin.store') }}">
            @csrf
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label>No. Telepon</label>
                <input type="tel" name="phone" class="form-control">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Peran</label>
                <select name="role" class="form-control" required>
                    <option value="petugas">Petugas</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="modal-actions">
                <button type="button" class="btn-cancel-modal" onclick="document.getElementById('modalTambahAdmin').classList.remove('show')">Batal</button>
                <button type="submit" class="btn-save-modal">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function switchTab(tab) {
        document.querySelectorAll('.tab-content').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.tab-btn').forEach(t => t.classList.remove('active'));
        document.getElementById('tab-' + tab).classList.add('active');
        event.target.classList.add('active');
    }
</script>
@endsection
