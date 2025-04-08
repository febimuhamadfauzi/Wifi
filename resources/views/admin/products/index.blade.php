@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h2 class="mb-3">Daftar Paket Internet</h2>

            <!-- Tombol Tambah Produk -->
            <a href="{{ route('products.create') }}" class="btn btn-success mb-3">
                <i class="fas fa-plus me-1"></i> Tambah Paket
            </a>

            <!-- Notifikasi Berhasil -->
            @if (session('success'))
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        Swal.fire({
                            title: "Berhasil!",
                            text: "{{ session('success') }}",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 2000
                        });
                    });
                </script>
            @endif

            <!-- Notifikasi Hapus -->
            @if (session('deleted'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil Dihapus!',
                        text: "{{ session('deleted') }}",
                        showConfirmButton: false,
                        timer: 2500,
                        customClass: {
                            popup: 'animate__animated animate__fadeInDown'
                        }
                    });
                </script>
            @endif

            <!-- Form Pencarian -->
            <form action="{{ route('products.index') }}" method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari paket..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                </div>
            </form>

            <!-- Pesan Jika Tidak Ada Produk -->
            @if($products->isEmpty())
                <div class="alert alert-warning fade-in">Produk tidak ditemukan.</div>
            @else
                <!-- Tabel Produk -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th style="width:20%">Nama Paket</th>
                                <th style="width: 10%">Kecepatan</th>
                                <th style="width:20%">Harga</th>
                                <th style="width: 30%">Deskripsi</th>
                                <th style="width:20%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $index => $product)
                            <tr id="row-{{ $product->id }}">
                                <td>{{ $products->firstItem() + $index }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->speed }} Mbps</td>
                                <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                <td>{{ Str::limit($product->description, 50) }}</td>
                                <td class="text-center">
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $product->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Custom Pagination -->
                <nav class="d-flex justify-content-center mt-3">
                    {{ $products->links('pagination::bootstrap-5') }}
                </nav>
            @endif
        </div>
    </div>
</div>

<!-- SweetAlert2 dan Animasi -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".delete-btn").forEach(button => {
            button.addEventListener("click", function() {
                let productId = this.getAttribute("data-id");
                let row = document.getElementById(`row-${productId}`);

                Swal.fire({
                    title: "Yakin ingin menghapus?",
                    text: "Data yang dihapus tidak bisa dikembalikan!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#6c757d",
                    confirmButtonText: "Ya, Hapus!",
                    cancelButtonText: "Batal",
                    showClass: {
                        popup: 'animate__animated animate__shakeX'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        let form = document.createElement("form");
                        form.method = "POST";
                        form.action = `/products/${productId}`;
                        form.innerHTML = `
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="DELETE">
                        `;
                        document.body.appendChild(form);
                        form.submit();

                        // Efek fade-out sebelum dihapus
                        row.style.transition = "opacity 0.5s ease-out";
                        row.style.opacity = "0";
                        setTimeout(() => row.remove(), 500);
                    }
                });
            });
        });
    });
</script>

<!-- Animasi dengan CSS -->
<style>
    .fade-in {
        animation: fadeIn 0.8s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
