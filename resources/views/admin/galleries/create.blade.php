@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Tambah Dokumentasi</h2>

    <div class="card shadow p-4">
        <form action="{{ route('galleries.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Input Judul Dokumentasi -->
            <div class="mb-3">
                <label class="form-label"><i class="fas fa-heading me-2"></i>Judul Dokumentasi</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <!-- Input Deskripsi Dokumentasi -->
            <div class="mb-3">
                <label class="form-label"><i class="fas fa-info-circle me-2"></i>Deskripsi</label>
                <textarea name="description" class="form-control" rows="3" required></textarea>
            </div>

            <!-- Input Foto -->
            <div class="mb-3">
                <label class="form-label"><i class="fas fa-image me-2"></i>Foto Dokumentasi</label>
                <input type="file" name="photo" class="form-control" accept="image/*" onchange="previewImage(event)" required>
            </div>

            <!-- Preview Foto Sebelum Upload -->
            <div class="mb-3 d-none" id="photoPreviewContainer">
                <label class="form-label"><i class="fas fa-eye me-2"></i>Preview Foto</label>
                <div>
                    <img id="photoPreview" class="img-thumbnail" width="200">
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('galleries.index') }}" class="btn btn-secondary me-2">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Simpan</button>
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
            document.getElementById('photoPreviewContainer').classList.remove('d-none');
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

@endsection
