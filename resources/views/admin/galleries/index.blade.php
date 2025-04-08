@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h2 class="mb-3">Daftar Galeri Dokumentasi</h2>

            <!-- Tombol Tambah Dokumentasi -->
            <a href="{{ route('galleries.create') }}" class="btn btn-success mb-3">
                <i class="fas fa-plus me-1"></i> Tambah Dokumentasi
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

            <!-- Form Pencarian -->
            <form action="{{ route('galleries.index') }}" method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari dokumentasi..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                </div>
            </form>

            <!-- Pesan Jika Tidak Ada Dokumentasi -->
            @if($galleries->isEmpty())
                <div class="alert alert-warning">Dokumentasi tidak ditemukan.</div>
            @else
                <!-- Tabel Galeri -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Foto</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th style="width:15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($galleries as $index => $gallery)
                            <tr id="row-{{ $gallery->id }}">
                                <td>{{ $galleries->firstItem() + $index }}</td>
                                <td>
                                    <img src="{{ Storage::url($gallery->photo) }}" class="img-thumbnail" width="100" height="70" style="object-fit: cover;">
                                </td>
                                <td>{{ $gallery->title }}</td>
                                <td>{{ Str::limit($gallery->description, 50) }}</td>
                                <td class="text-center">
                                    <a href="{{ route('galleries.edit', $gallery->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('galleries.destroy', $gallery->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm delete-btn" data-id="{{ $gallery->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Custom Pagination -->
                <nav class="d-flex justify-content-center mt-3">
                    {{ $galleries->links('pagination::bootstrap-5') }}
                </nav>
            @endif
        </div>
    </div>
</div>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".delete-btn").forEach(button => {
            button.addEventListener("click", function(event) {
                event.preventDefault();
                let form = this.closest("form");
                let row = this.closest("tr");

                Swal.fire({
                    title: "Yakin ingin menghapus?",
                    text: "Dokumentasi yang dihapus tidak bisa dikembalikan!",
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
                        form.submit();
                        row.style.transition = "opacity 0.5s ease-out";
                        row.style.opacity = "0";
                        setTimeout(() => row.remove(), 500);
                    }
                });
            });
        });
    });
</script>

@endsection
