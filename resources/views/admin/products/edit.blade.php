@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Edit Paket Internet</h2>

    <div class="card shadow p-4">
        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label"><i class="fas fa-tag me-2"></i>Nama Paket</label>
                <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label"><i class="fas fa-tachometer-alt me-2"></i>Kecepatan (Mbps)</label>
                <input type="number" name="speed" class="form-control" value="{{ $product->speed }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label"><i class="fas fa-dollar-sign me-2"></i>Harga (Rp)</label>
                <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label"><i class="fas fa-info-circle me-2"></i>Deskripsi</label>
                <textarea name="description" class="form-control" rows="3" required>{{ $product->description }}</textarea>
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('products.index') }}" class="btn btn-secondary me-2">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
