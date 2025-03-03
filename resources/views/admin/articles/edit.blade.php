@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Artikel</h1>
    <form action="{{ route('articles.update', $article) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Judul Artikel</label>
            <input type="text" name="title" class="form-control" value="{{ $article->title }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control" rows="4" required>{{ $article->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
