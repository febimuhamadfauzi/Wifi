@extends('layouts.admin')

@section('content')
<h3 class="mb-4">Dashboard Admin</h3>
<div class="row">
    <!-- Produk -->
    <div class="col-md-4">
        <a href="{{ route('products.index') }}" class="text-decoration-none d-block card-link">
            <div class="card shadow text-white bg-primary">
                <div class="card-body">
                    <i class="fas fa-box fa-2x"></i>
                    <h5 class="mt-2">Total Produk</h5>
                    <h3 id="totalProducts">{{ $totalProducts }}</h3>
                </div>
            </div>
        </a>
    </div>

    <!-- Artikel -->
    <div class="col-md-4">
        <a href="{{ route('articles.index') }}" class="text-decoration-none d-block card-link">
            <div class="card shadow text-white bg-success">
                <div class="card-body">
                    <i class="fas fa-newspaper fa-2x"></i>
                    <h5 class="mt-2">Total Artikel</h5>
                    <h3 id="totalArticles">{{ $totalArticles }}</h3>
                </div>
            </div>
        </a>
    </div>

    <!-- Galeri -->
    <div class="col-md-4">
        <a href="{{ route('galleries.index') }}" class="text-decoration-none d-block card-link">
            <div class="card shadow text-white bg-warning">
                <div class="card-body">
                    <i class="fas fa-image fa-2x"></i>
                    <h5 class="mt-2">Total Galeri</h5>
                    <h3 id="totalGallery">{{ $totalGallery }}</h3>
                </div>
            </div>
        </a>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $(".card-link").on("mousedown", function() {
            $(this).find(".card").css("transform", "scale(0.95)");
        });

        $(".card-link").on("mouseup mouseleave", function() {
            $(this).find(".card").css("transform", "scale(1)");
        });
    });

    function updateCounts() {
        $.ajax({
            url: "{{ route('admin.total-counts') }}",
            method: "GET",
            success: function(response) {
                $("#totalProducts").text(response.totalProducts);
                $("#totalArticles").text(response.totalArticles);
                $("#totalGallery").text(response.totalGallery);
            }
        });
    }

    setInterval(updateCounts, 5000);
</script>

<style>
    .card {
        transition: transform 0.2s ease-in-out;
    }
</style>
@endsection
