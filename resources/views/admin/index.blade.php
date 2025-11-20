<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f2f2f7;
        }
        .product-card {
            transition: transform 0.3s, box-shadow 0.3s;
            border-radius: 12px;
            overflow: hidden;
        }
        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        }
        .product-card img {
            height: 220px;
            object-fit: cover;
            transition: transform 0.3s;
        }
        .product-card:hover img {
            transform: scale(1.05);
        }
        .price-tag {
            font-size: 1.2rem;
            font-weight: 700;
            color: #28a745;
        }
        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 230px;
        }
        .btn-action {
            width: 48%;
        }
        .badge-discount {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: #dc3545;
            color: #fff;
            font-weight: 600;
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 0.8rem;
        }
        .star-rating i {
            color: #ffc107;
        }
        @media (max-width: 768px) {
            .product-card img {
                height: 180px;
            }
        }
    </style>
</head>
<body>
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Products</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle me-2"></i>Add Product</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-4">
        @forelse($products as $product)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card product-card shadow-sm position-relative">
                    {{-- Optional Discount Badge --}}
                    {{-- <span class="badge-discount">-20%</span> --}}

                    @if($product->image)
                        <img src="{{ asset('uploads/products/'.$product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    @else
                        <img src="https://via.placeholder.com/400x220?text=No+Image" class="card-img-top" alt="No Image">
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text text-muted" title="{{ $product->description }}">
                            {{ Str::limit($product->description, 70) }}
                        </p>

                        {{-- Star Ratings Example --}}
                        <div class="star-rating mb-2">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                            <i class="bi bi-star"></i>
                        </div>

                        <p class="price-tag mb-3">$ {{ $product->price }}</p>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm btn-action"><i class="bi bi-pencil-square me-1"></i>Edit</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline w-50">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm btn-action" onclick="return confirm('Are you sure?')"><i class="bi bi-trash3 me-1"></i>Delete</button>
                            </form>
                        </div>

                        {{-- Optional Add to Cart --}}
                        {{-- <a href="#" class="btn btn-success btn-sm mt-2 w-100"><i class="bi bi-cart me-1"></i>Add to Cart</a> --}}
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p class="fs-5">No products found.</p>
            </div>
        @endforelse
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
