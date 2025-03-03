@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Daftar Artikel</h1>
    <a href="{{ route('articles.create') }}" class="btn btn-primary mb-3">Tambah Artikel</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 20%;">Judul Artikel</th>
                <th style="width: 40%;">Deskripsi</th>
                <th style="width: 20%;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articles as $article)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $article->title }}</td>
                    <td class="desc-column">{{ $article->description }}</td>
                    <td>
                        <a href="{{ route('articles.edit', $article) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('articles.destroy', $article) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus Artikel?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Tambahkan CSS -->
<style>
    .desc-column {
        word-wrap: break-word;
        overflow-wrap: break-word;
        white-space: normal;
        max-width: 200px; /* Batasi lebar maksimal agar turun ke bawah */
    }

    .table td {
        vertical-align: top; /* Supaya konten dalam sel lebih rapi */
    }
</style>

@endsection
