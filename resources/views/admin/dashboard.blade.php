@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h1>Dashboard Admin</h1>

    <div class="card mt-3">
        <div class="card-body">
            <h3>Total Produk: <span id="totalProducts">{{ $totalProducts }}</span></h3>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function updateTotalProducts() {
        $.ajax({
            url: "{{ route('admin.total-products') }}",
            method: "GET",
            success: function(response) {
                $("#totalProducts").text(response.total);
            }
        });
    }

    // Update setiap 5 detik
    setInterval(updateTotalProducts, 5000);
</script>
@endsection
