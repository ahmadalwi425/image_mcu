@extends('layouts.app')

@section('title', 'Form MCU')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h5 class="mb-0">Form MCU</h5>
                </div>

                <div class="card-body">

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('mcu.store') }}" onsubmit="return validateForm()">
                        @csrf

                        <!-- PILIH PASIEN -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">Pilih Pasien</label>
                            <select id="pasien" class="form-select">
                                <option value="">-- Pilih Pasien --</option>
                                @foreach($data as $item)
                                    <option value='@json($item)'>
                                        {{ $item['reg_no'] }} / {{ $item['nama'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- DATA PASIEN -->
                        <div class="card mb-4 shadow-sm border-0 bg-light">
                            <div class="card-body">
                                <h6 class="mb-3 fw-bold">Data Pasien</h6>

                                <div class="row">

                                    <div class="col-md-6 mb-3">
                                        <label>No RM</label>
                                        <input type="text" id="no_mr" name="no_mr" class="form-control" readonly>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Reg No</label>
                                        <input type="text" id="reg_no" name="reg_no" class="form-control" readonly>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Nama</label>
                                        <input type="text" id="nama" name="nama" class="form-control" readonly>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Tanggal Pendaftaran</label>
                                        <input type="text" id="tanggal" name="tanggal" class="form-control" readonly>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Tanggal Lahir</label>
                                        <input type="text" id="tgl_lahir_view" class="form-control" readonly>
                                    </div>

                                    <input type="hidden" name="tgl_lahir" id="tgl_lahir">

                                    <div class="col-md-6 mb-3" id="pekerjaan_wrapper" style="display:none;">
                                        <label>Pekerjaan</label>
                                        <input type="text" id="pekerjaan_view" class="form-control" readonly>
                                        <input type="hidden" name="pekerjaan" id="pekerjaan">
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label>Deskripsi</label>
                                        <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3" readonly></textarea>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- WEBCAM -->
                        <div class="card mb-4 shadow-sm border-0">
                            <div class="card-body">
                                <h6 class="mb-3 fw-bold">Capture Foto</h6>

                                <div class="row text-center">
                                    <div class="col-md-6 mb-3">
                                        <video id="video" class="w-100 border rounded" autoplay playsinline></video>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <img id="preview" class="w-100 border rounded"/>
                                    </div>
                                </div>

                                <div class="text-center mt-3">
                                    <button type="button" class="btn btn-warning" onclick="takePhoto()">
                                        📸 Ambil Foto
                                    </button>
                                    @if(!request()->header('User-Agent') || Str::contains(request()->header('User-Agent'), ['Mobile','Android','iPhone']))
                                    <button type="button" class="btn btn-secondary mt-2" onclick="switchCamera()">
                                        🔄 Switch Camera
                                    </button>
                                    @endif
                                </div>

                                <canvas id="canvas" width="640" height="480" class="d-none"></canvas>
                                <input type="hidden" name="foto" id="foto">
                            </div>
                        </div>

                        <button class="btn btn-success w-100">Simpan</button>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
// =======================
// VALIDASI FORM
// =======================
function validateForm() {
    let foto = document.getElementById('foto').value;

    if (!foto) {
        alert('Silakan ambil foto terlebih dahulu!');
        return false;
    }

    return true;
}

// =======================
// DROPDOWN
// =======================
document.getElementById('pasien').addEventListener('change', function () {
    if (!this.value) return;

    let data = JSON.parse(this.value);

    document.getElementById('no_mr').value = data.no_mr;
    document.getElementById('reg_no').value = data.reg_no;
    document.getElementById('nama').value = data.nama;
    document.getElementById('tanggal').value = data.tanggal_registrasi;

    document.getElementById('tgl_lahir_view').value = data.tgl_lahir_format ?? data.tgl_lahir;
    document.getElementById('tgl_lahir').value = data.tgl_lahir;

    let pekerjaan = data.pekerjaan ?? '';

    if (pekerjaan && pekerjaan.length > 1) {
        document.getElementById('pekerjaan_wrapper').style.display = 'block';
        document.getElementById('pekerjaan_view').value = pekerjaan;
        document.getElementById('pekerjaan').value = pekerjaan;
    } else {
        document.getElementById('pekerjaan_wrapper').style.display = 'none';
        document.getElementById('pekerjaan').value = '';
    }

    document.getElementById('deskripsi').value = data.deskripsi ?? '-';
});

// =======================
// CAMERA
// =======================
let video = document.getElementById('video');
let currentStream = null;
let facingMode = "environment";

function startCamera() {
    if (currentStream) {
        currentStream.getTracks().forEach(track => track.stop());
    }

    navigator.mediaDevices.getUserMedia({
        video: { facingMode: facingMode }
    })
    .then(stream => {
        currentStream = stream;
        video.srcObject = stream;
    })
    .catch(err => {
        console.error(err);
        alert("Kamera tidak bisa diakses! Pastikan HTTPS aktif.");
    });
}

startCamera();

// =======================
// SWITCH CAMERA
// =======================
function switchCamera() {
    facingMode = (facingMode === "user") ? "environment" : "user";
    startCamera();
}

// =======================
// CAPTURE
// =======================
function takePhoto() {
    let canvas = document.getElementById('canvas');
    let ctx = canvas.getContext('2d');

    ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

    let dataURL = canvas.toDataURL('image/jpeg');

    document.getElementById('preview').src = dataURL;
    document.getElementById('foto').value = dataURL;
}
</script>

@endsection