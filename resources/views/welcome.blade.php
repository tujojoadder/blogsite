<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BlogSite | Welcome</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body class="bg-dark">
    <div class="container-fluid vh-100" style="background: url('images/pc1.avif') no-repeat center center; background-size: cover;">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-md-5">
                <div class="card shadow">
                    <div class="card-body p-5 text-center">
                        <h1 class="mb-4">
                            <i class="bi bi-pencil-square"></i> <span class="text-danger">EUIT</span> Blog
                        </h1>
                        <p class="lead mb-4 text-muted">Share your thoughts with the world</p>
                        
                        <div class="d-grid gap-2">
                            @if (Route::has('login'))
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="btn btn-primary btn-lg">
                                        <i class="bi bi-speedometer2"></i> Dashboard
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                                        <i class="bi bi-box-arrow-in-right"></i> Log In
                                    </a>
                                    
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg">
                                            <i class="bi bi-person-plus"></i> Register
                                        </a>
                                    @endif
                                @endauth
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>