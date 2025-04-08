@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Edit Dokumentasi</h2>

    <div class="card shadow p-4">
        <form action="{{ route('galleries.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Input Judul Dokumentasi -->
            <div class="mb-3">
                <label class="form-label"><i class="fas fa-heading me-2"></i>Judul Dokumentasi</label>
                <input type="text" name="title" class="form-control" value="{{ $gallery->title }}" required>
            </div>

            <!-- Input Deskripsi Dokumentasi -->
            <div class="mb-3">
                <label class="form-label"><i class="fas fa-info-circle me-2"></i>Deskripsi</label>
                <textarea name="description" class="form-control" rows="3" required>{{ $gallery->description }}</textarea>
            </div>

            <!-- Input Foto -->
            <div class="mb-3">
                <label class="form-label"><i class="fas fa-image me-2"></i>Foto Dokumentasi</label>
                <input type="file" name="photo" class="form-control" accept="image/*" onchange="previewImage(event)">
            </div>

            <!-- Tampilkan gambar saat ini -->
            @if ($gallery->photo)
                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-eye me-2"></i>Foto Saat Ini</label>
                    <div>
                        <img id="photoPreview" src="{{ Storage::url($gallery->photo) }}" alt="Foto Dokumentasi" class="img-thumbnail" width="200">
                    </div>
                </div>
            @endif

            <div class="d-flex justify-content-end">
                <a href="{{ route('galleries.index') }}" class="btn btn-secondary me-2">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Update</button>
            </div>
        </form>
    </div>
</div>

<!-- Preview Foto -->
<script>
    function previewImage(event) {
        let reader = new FileReader();
        reader.onload = function() {
            let output = document.getElementById('photoPreview');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

@endsection
