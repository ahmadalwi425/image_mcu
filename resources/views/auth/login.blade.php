<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="image/png" href="{{ asset('storage/assets/Logo.png') }}">
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light d-flex align-items-center" style="height:100vh;">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">

            <div class="card shadow-sm">
                <div class="card-body text-center">

                    <!-- LOGO -->
                    <img 
                        src="{{ asset('storage/assets/Logo.png') }}" 
                        alt="Logo"
                        style="max-width: 120px; margin-bottom: 15px;"
                    >

                    <h4 class="mb-4">Login</h4>

                    <!-- Error Message -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3 text-start">
                            <label class="form-label">Email</label>
                            <input 
                                type="email" 
                                name="email" 
                                class="form-control" 
                                placeholder="Masukkan email"
                                required
                            >
                        </div>

                        <div class="mb-3 text-start">
                            <label class="form-label">Password</label>
                            <input 
                                type="password" 
                                name="password" 
                                class="form-control" 
                                placeholder="Masukkan password"
                                required
                            >
                        </div>

                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary">
                                Login
                            </button>
                        </div>

                        <!-- <div class="text-center">
                            <small>
                                Belum punya akun? 
                                <a href="{{ route('register') }}">Register</a>
                            </small>
                        </div> -->

                    </form>

                </div>
            </div>

            <p class="text-center mt-3 text-muted">
                © {{ date('Y') }} MCU System
            </p>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>