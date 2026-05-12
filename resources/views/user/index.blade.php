@extends('layouts.app')

@section('content')

<div class="container py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-0">User Management</h3>
            <small class="text-muted">Kelola data pengguna sistem</small>
        </div>
        <a href="{{ route('user.create') }}" class="btn btn-primary shadow-sm">
            + Tambah User
        </a>
    </div>

    {{-- Alert --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Card Table --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <div class="table-responsive">
                <table id="table-user" class="table table-hover align-middle">

                    <thead class="table-light text-center">
                        <tr>
                            <th width="50">No</th>
                            <th class="text-start">Nama</th>
                            <th class="text-start">Email</th>
                            <th width="150">Status</th>
                            <th width="120">Level</th>
                            <th class="text-start">Poli</th>
                            <th width="170">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($users as $u)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>

                            <td class="fw-semibold">
                                {{ $u->name }}
                            </td>

                            <td class="text-muted small">
                                {{ $u->email }}
                            </td>
                            <td class="text">
                                @if($u->must_change_password == 1)
                                    <span class="badge bg-danger">Not Activated</span>
                                @else
                                    <span class="badge bg-success">Activated</span>
                                @endif
                            </td>
                            {{-- Level --}}
                            <td class="text">
                                @if($u->id_level == 1)
                                    <span class="badge bg-primary px-3 py-2">Admin</span>
                                @elseif($u->id_level == 2)
                                    <span class="badge bg-success px-3 py-2">Capture</span>
                                @else
                                    <span class="badge bg-secondary px-3 py-2">View</span>
                                @endif
                            </td>

                            {{-- Poli --}}
                            <td>
                                {{ $u->poli->nama_poli ?? '-' }}
                            </td>

                            {{-- Aksi --}}
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">

                                    <a href="{{ route('user.edit', $u->id) }}" 
                                    class="btn btn-sm btn-warning text-white btn-action">
                                        Edit
                                    </a>

                                    {{-- Reset Password --}}
                                    <form action="{{ route('user.reset-password', $u->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <button class="btn btn-sm btn-info text-white btn-action"
                                            onclick="return confirm('Reset password user ini?')">
                                            Reset
                                        </button>
                                    </form>

                                    {{-- Delete --}}
                                    <form action="{{ route('user.destroy', $u->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-sm btn-danger btn-action"
                                            onclick="return confirm('Yakin hapus user ini?')">
                                            Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-5">
                                <div class="d-flex flex-column align-items-center">
                                    <span style="font-size:40px;">📭</span>
                                    Belum ada data user
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>

@endsection


{{-- ================== STYLE ================== --}}
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<style>
    table.dataTable thead th {
        font-weight: 600;
        font-size: 14px;
    }

    .btn-action {
        height:30px;
    }

    table.dataTable tbody td {
        vertical-align: middle;
    }

    .dataTables_wrapper .dataTables_filter input {
        border-radius: 6px;
        padding: 5px 10px;
    }

    .dataTables_wrapper .dataTables_length select {
        border-radius: 6px;
    }
</style>


{{-- ================== SCRIPT ================== --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function () {
    $('#table-user').DataTable({
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50],
        ordering: true,
        responsive: true,
        columnDefs: [
            { orderable: false, targets: [0, 5] }
        ],
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
            infoEmpty: "Tidak ada data",
            zeroRecords: "Data tidak ditemukan",
            paginate: {
                next: "Next",
                previous: "Prev"
            }
        }
    });
});
</script>