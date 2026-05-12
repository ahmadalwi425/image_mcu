@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                Detail MCU
            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <strong>No MR:</strong><br>
                        {{ $item->no_mr }}
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>Reg No:</strong><br>
                        {{ $item->reg_no }}
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>Nama:</strong><br>
                        {{ $item->nama }}
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>Tanggal Lahir:</strong><br>
                        {{ $item->tanggal_lahir }}
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>Tanggal Pendaftaran:</strong><br>
                        {{ $item->tanggal_pendaftaran }}
                    </div>

                    <!-- PEKERJAAN -->
                    @if(!empty($item->pekerjaan) && strlen($item->pekerjaan) > 1)
                    <div class="col-md-6 mb-3">
                        <strong>Pekerjaan:</strong><br>
                        {{ $item->pekerjaan }}
                    </div>
                    @endif

                    <!-- DESKRIPSI -->
                    <div class="col-md-12 mb-3">
                        <strong>Eselon/Penjamin:</strong><br>
                        <div class="border p-2 rounded bg-light">
                            {{ $item->deskripsi }}
                        </div>
                    </div>

                </div>

                <!-- FOTO -->
                <div class="text-center mt-4">
                    <img src="{{ asset('storage/' . $item->file_path) }}" 
                         class="img-fluid rounded shadow" 
                         style="max-height: 300px;">
                </div>

                <div class="text-center mt-3">
                    <a href="{{ route('mcu.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                </div>

            </div>
        </div>

    </div>
</div>

@endsection