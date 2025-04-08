@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Tambah Artikel</h2>

    <div class="card shadow p-4">
        <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label"><i class="fas fa-heading me-2"></i>Judul Artikel</label>
                <input type="text" name="title" class="form-control" placeholder="Masukkan judul artikel" required>
            </div>
            <div class="mb-3">
                <label class="form-label"><i class="fas fa-align-left me-2"></i>Deskripsi</label>
                <textarea name="description" class="form-control" rows="3" placeholder="Masukkan deskripsi artikel" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label"><i class="fas fa-image me-2"></i>Foto Artikel</label>
                <input type="file" name="photo" class="form-control" accept="image/*">
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('articles.index') }}" class="btn btn-secondary me-2">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
