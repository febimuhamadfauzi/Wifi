@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h2 class="mb-3">Daftar Artikel</h2>

            <!-- Tombol Tambah Artikel -->
            <a href="{{ route('articles.create') }}" class="btn btn-success mb-3">
                <i class="fas fa-plus me-1"></i> Tambah Artikel
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
            <form action="{{ route('articles.index') }}" method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari artikel..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                </div>
            </form>

            <!-- Pesan Jika Tidak Ada Artikel -->
            @if($articles->isEmpty())
                <div class="alert alert-warning fade-in">Artikel tidak ditemukan.</div>
            @else
                <!-- Tabel Artikel -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th style="width: 40%">Judul Artikel</th>
                                <th>Deskripsi</th>
                                <th>Foto</th>
                                <th style="width:30%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($articles as $index => $article)
                            <tr id="row-{{ $article->id }}">
                                <td>{{ $articles->firstItem() + $index }}</td>
                                <td>{{ $article->title }}</td>
                                <td>{{ Str::limit($article->description, 50) }}</td>
                                <td>
                                    @if ($article->photo)
                                        <img src="{{ Storage::url($article->photo) }}" alt="Foto Artikel" class="img-thumbnail" style="max-width: 100px; height: auto;">
                                    @else
                                        <span class="badge bg-secondary">Tidak ada foto</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $article->id }}">
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
                    {{ $articles->links('pagination::bootstrap-5') }}
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
            button.addEventListener("click", function() {
                let articleId = this.getAttribute("data-id");
                let row = document.getElementById(`row-${articleId}`);

                Swal.fire({
                    title: "Yakin ingin menghapus?",
                    text: "Artikel yang dihapus tidak bisa dikembalikan!",
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
                        form.action = `/articles/${articleId}`;
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
