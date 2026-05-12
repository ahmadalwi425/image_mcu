@extends('layouts.app')

@section('title', 'Ganti Password')

@section('content')
<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">

            <div class="card border-0 shadow-lg password-card">
                <div class="card-body p-4 p-md-5">

                    {{-- Icon --}}
                    <div class="text-center mb-4">
                        <div class="icon-wrapper mb-3">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3 class="fw-bold mb-1">Ganti Password</h3>
                        <p class="text-muted small mb-0">
                            Gunakan password yang kuat dan aman
                        </p>
                    </div>

                    {{-- Warning First Login --}}
                    <div class="alert alert-warning text-center small">
                        Anda wajib mengganti password sebelum melanjutkan
                    </div>

                    {{-- Error --}}
                    @if ($errors->any())
                        <div class="alert alert-danger shadow-sm">
                            <ul class="mb-0 small">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        @method('PUT')

                        {{-- Password --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password Baru</label>
                            <div class="input-group modern-input">
                                <span class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input 
                                    type="password"
                                    name="password"
                                    id="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Masukkan password baru"
                                    required
                                >
                                <button class="btn btn-toggle" type="button" id="togglePassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>

                            {{-- Strength --}}
                            <small id="passwordStrength" class="text-muted"></small>
                        </div>

                        {{-- Confirm --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Konfirmasi Password</label>
                            <div class="input-group modern-input">
                                <span class="input-group-text">
                                    <i class="fas fa-check-circle"></i>
                                </span>
                                <input 
                                    type="password"
                                    name="password_confirmation"
                                    id="password_confirmation"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    placeholder="Ulangi password"
                                    required
                                >
                                <button class="btn btn-toggle" type="button" id="toggleConfirmPassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>

                            {{-- Match Info --}}
                            <small id="passwordMatch" class="text-muted"></small>
                        </div>

                        {{-- Button --}}
                        <button type="submit" class="btn btn-gradient w-100 py-2 fw-semibold">
                            <i class="fas fa-save me-2"></i>
                            Simpan Password
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>

</div>

{{-- JS --}}
<script>
document.addEventListener('DOMContentLoaded', function() {

    const password = document.getElementById('password');
    const confirm = document.getElementById('password_confirmation');
    const strengthText = document.getElementById('passwordStrength');
    const matchText = document.getElementById('passwordMatch');

    function toggle(inputId, btn) {
        const input = document.getElementById(inputId);
        const icon = btn.querySelector('i');

        input.type = input.type === 'password' ? 'text' : 'password';
        icon.classList.toggle('fa-eye');
        icon.classList.toggle('fa-eye-slash');
    }

    document.getElementById('togglePassword')
        .addEventListener('click', function() {
            toggle('password', this);
        });

    document.getElementById('toggleConfirmPassword')
        .addEventListener('click', function() {
            toggle('password_confirmation', this);
        });

    // Password strength checker
    password.addEventListener('input', function() {
        let val = password.value;
        let strength = "Lemah";

        if (val.length >= 8 && /[A-Z]/.test(val) && /[0-9]/.test(val)) {
            strength = "Kuat";
            strengthText.className = "text-success";
        } else if (val.length >= 6) {
            strength = "Sedang";
            strengthText.className = "text-warning";
        } else {
            strengthText.className = "text-danger";
        }

        strengthText.textContent = "Kekuatan password: " + strength;
    });

    // Password match checker
    confirm.addEventListener('input', function() {
        if (confirm.value === password.value) {
            matchText.textContent = "Password cocok";
            matchText.className = "text-success";
        } else {
            matchText.textContent = "Password tidak cocok";
            matchText.className = "text-danger";
        }
    });

});
</script>

{{-- STYLE --}}
<style>
body {
    background: linear-gradient(135deg, #eef2f7, #e6ecf5);
}

.password-card {
    border-radius: 20px;
}

.icon-wrapper {
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    font-size: 28px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: auto;
}

.modern-input {
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid #dee2e6;
}

.modern-input .input-group-text {
    background: #f8f9fa;
    border: none;
}

.modern-input .form-control {
    border: none;
}

.btn-toggle {
    border: none;
    background: #f8f9fa;
}

.btn-gradient {
    background: linear-gradient(135deg, #667eea, #764ba2);
    border: none;
    border-radius: 12px;
    color: white;
}

.btn-gradient:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
}

.alert {
    border-radius: 12px;
}
</style>

@endsection