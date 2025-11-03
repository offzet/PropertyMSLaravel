<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Property Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        .property-card {
            transition: transform 0.2s;
        }
        .property-card:hover {
            transform: translateY(-5px);
        }
        .navbar-brand {
            font-weight: bold;
        }
        .sticky-sidebar {
            position: sticky;
            top: 20px;
        }
    </style>
</head>
<body class="bg-light">
    <!-- Navigation -->
    @include('layouts.customer-nav')

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Flash Messages -->
    @if(session('success'))
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1050">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1050">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
    @endif

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    @stack('scripts')
</body>
</html>