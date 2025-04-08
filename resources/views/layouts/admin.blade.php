<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
        }
        .sidebar {
            height: 100vh;
            width: 280px;
            position: fixed;
            background-color: #1e1e2d;
            padding-top: 20px;
            color: white;
        }
        .sidebar a, .sidebar .logout-btn {
            padding: 12px 20px;
            text-decoration: none;
            font-size: 16px;
            display: block;
            transition: 0.3s;
            border: none;
            background: none;
            text-align: left;
            width: 100%;
        }
        .sidebar a {
            color: white;
        }
        .sidebar .logout-btn {
            color: red;
            cursor: pointer;
        }
        .sidebar a:hover, .sidebar .active, .sidebar .logout-btn:hover {
            background-color: #373750;
            border-left: 4px solid #ffcc00;
        }
        .content {
            margin-left: 280px;
            padding: 20px;
        }
        .card {
            border-radius: 10px;
            padding: 20px;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h4 class="text-center">Admin Panel</h4>
        <hr class="bg-light">
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-home me-2"></i> Dashboard
        </a>
        <a href="{{ route('products.index') }}" class="{{ request()->routeIs('products.*') ? 'active' : '' }}">
            <i class="fas fa-box me-2"></i> Kelola Produk
        </a>
        <a href="{{ route('articles.index') }}" class="{{ request()->routeIs('articles.*') ? 'active' : '' }}">
            <i class="fas fa-newspaper me-2"></i> Kelola Artikel
        </a>
        <a href="{{ route('galleries.index') }}" class="{{ request()->routeIs('galleries.*') ? 'active' : '' }}">
            <i class="fas fa-image me-2"></i> Kelola Galeri
        </a>
        <hr class="bg-light">

        <!-- Tombol Logout -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="button" class="logout-btn" onclick="confirmLogout()">
                <i class="fas fa-sign-out-alt me-2"></i> Logout
            </button>
        </form>
    </div>

    <div class="content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function confirmLogout() {
            Swal.fire({
                title: "Anda yakin ingin logout?",
                text: "Anda akan keluar dari akun admin!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, Logout!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("logout-form").submit();
                }
            });
        }
    </script>

</body>
</html>
