@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                <span>Data MCU</span>

                <!-- FILTER TANGGAL -->
                <form method="GET" action="{{ route('mcu.index') }}" class="d-flex gap-2">
                    <input 
                        type="date" 
                        name="tanggal" 
                        class="form-control form-control-sm"
                        value="{{ $tanggal }}"
                    >
                    <button class="btn btn-sm btn-light">
                        Filter
                    </button>
                </form>
            </div>

            <div class="card-body">

                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>No MR</th>
                            <th>Reg No</th>
                            <th>Nama</th>
                            <th>Tgl Lahir</th>
                            <th>Tgl Daftar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->no_mr }}</td>
                            <td>{{ $item->reg_no }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->tanggal_lahir }}</td>
                            <td>{{ $item->tanggal_pendaftaran }}</td>
                            <td>
                                <a href="{{ route('mcu.show', $item->id) }}" 
                                   class="btn btn-sm btn-primary">
                                   👁
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">
                                Tidak ada data
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