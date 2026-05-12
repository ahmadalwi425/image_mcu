@extends('layouts.app')

@section('content')

<div class="container py-4">

    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Edit User</h5>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('user.update', $user->id) }}">
                        @csrf
                        @method('PUT')

                        {{-- Nama --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama</label>
                            <input type="text" name="name" 
                                   class="form-control"
                                   value="{{ $user->name }}" required>
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" 
                                   class="form-control"
                                   value="{{ $user->email }}" required>
                        </div>

                        {{-- Level --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Level</label>
                            <select name="id_level" class="form-control" required>
                            <option value="1" {{ $user->id_level == 1 ? 'selected' : '' }}>
                                    Admin
                                </option>    
                            <option value="2" {{ $user->id_level == 2 ? 'selected' : '' }}>
                                    Capture
                                </option>
                                <option value="3" {{ $user->id_level == 3 ? 'selected' : '' }}>
                                    View
                                </option>
                            </select>
                        </div>

                        {{-- Poli --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Poli</label>
                            <select name="id_poli" class="form-control">
                                <option value="">-- Pilih Poli --</option>
                                @foreach($polis as $poli)
                                    <option value="{{ $poli->id }}" 
                                        {{ $user->id_poli == $poli->id ? 'selected' : '' }}>
                                        {{ $poli->nama_poli }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Tombol --}}
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('user.index') }}" class="btn btn-secondary">
                                Kembali
                            </a>

                            <button class="btn btn-primary">
                                Update User
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>

@endsection