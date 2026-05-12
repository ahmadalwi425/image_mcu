@extends('layouts.app')

@section('content')

<div class="container py-4">

    {{-- Header --}}
    <div class="mb-4">
        <h3 class="fw-bold mb-1">Tambah User</h3>
        <p class="text-muted mb-0">Isi data pengguna baru dengan lengkap</p>
    </div>

    {{-- Card Form --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">

            {{-- Error --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('user.store') }}">
                @csrf

                <div class="row">

                    {{-- Nama --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Nama</label>
                        <input type="text" name="name" 
                               class="form-control" 
                               placeholder="Masukkan nama"
                               required>
                    </div>

                    {{-- Email --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" 
                               class="form-control" 
                               placeholder="Masukkan email"
                               required>
                    </div>

                    {{-- Level --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Level</label>
                        <select name="id_level" class="form-select" required>
                            <option value="">-- Pilih Level --</option>
                            <option value="1">Admin</option>
                            <option value="2">Capture</option>
                            <option value="3">MCU</option>
                        </select>
                    </div>

                    {{-- Poli --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Poli (Opsional)</label>
                        <select name="id_poli" class="form-control">
                            <option value="">-- Pilih Poli --</option>
                            @foreach($polis as $poli)
                                <option value="{{ $poli->id }}">
                                    {{ $poli->nama_poli }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>

                {{-- Button --}}
                <div class="d-flex justify-content-end mt-3">
                    <a href="{{ route('user.index') }}" class="btn btn-secondary me-2">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-success">
                        Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>

@endsection