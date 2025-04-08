@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Tambah Paket Internet</h2>

    <div class="card shadow p-4">
        <form action="{{ route('products.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label"><i class="fas fa-tag me-2"></i>Nama Paket</label>
                <input type="text" name="name" class="form-control" placeholder="Masukkan nama paket" required>
            </div>
            <div class="mb-3">
                <label class="form-label"><i class="fas fa-tachometer-alt me-2"></i>Kecepatan (Mbps)</label>
                <input type="number" name="speed" class="form-control" placeholder="Masukkan kecepatan internet" required>
            </div>
            <div class="mb-3">
                <label class="form-label"><i class="fas fa-dollar-sign me-2"></i>Harga (Rp)</label>
                <input type="number" name="price" class="form-control" placeholder="Masukkan harga paket" required>
            </div>
            <div class="mb-3">
                <label class="form-label"><i class="fas fa-info-circle me-2"></i>Deskripsi</label>
                <textarea name="description" class="form-control" rows="3" placeholder="Masukkan deskripsi paket" required></textarea>
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('products.index') }}" class="btn btn-secondary me-2">
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
