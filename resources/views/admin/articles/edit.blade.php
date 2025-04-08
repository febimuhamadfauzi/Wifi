@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Edit Artikel</h2>

    <div class="card shadow p-4">
        <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label"><i class="fas fa-heading me-2"></i>Judul Artikel</label>
                <input type="text" name="title" class="form-control" value="{{ $article->title }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label"><i class="fas fa-info-circle me-2"></i>Deskripsi</label>
                <textarea name="description" class="form-control" rows="3" required>{{ $article->description }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label"><i class="fas fa-image me-2"></i>Foto Artikel</label>
                <input type="file" name="photo" class="form-control" accept="image/*">
            </div>

            <!-- Tampilkan gambar saat ini -->
            @if ($article->photo)
                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-eye me-2"></i>Foto Saat Ini</label>
                    <div>
                        <img src="{{ Storage::url($article->photo) }}" alt="Foto Artikel" class="img-thumbnail" width="200">
                    </div>
                </div>
            @endif

            <div class="d-flex justify-content-end">
                <a href="{{ route('articles.index') }}" class="btn btn-secondary me-2">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
