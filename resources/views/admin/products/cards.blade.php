<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Our Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f5f5;
        }

        .product-card {
            border-radius: 15px;
            overflow: hidden;
            position: relative;
            transition: all 0.4s ease;
            background: #fff;
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .product-card img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product-card:hover img {
            transform: scale(1.05);
        }

        .badge-new {
            position: absolute;
            top: 12px;
            left: 12px;
            background-color: #ff4d4f;
            color: white;
            font-size: 0.75rem;
            padding: 4px 8px;
            border-radius: 5px;
            font-weight: bold;
            z-index: 2;
        }

        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 200px;
        }

        .card-title {
            font-weight: 700;
            font-size: 1.05rem;
        }

        .card-text {
            font-size: 0.85rem;
            color: #555;
            margin-bottom: 10px;
        }

        .price {
            font-size: 1.2rem;
            font-weight: 700;
            color: #28a745;
            margin-bottom: 12px;
        }

        .old-price {
            font-size: 0.9rem;
            color: #999;
            text-decoration: line-through;
            margin-left: 8px;
        }

        .rating {
            color: #f8b400;
            font-size: 0.85rem;
            margin-bottom: 10px;
        }

        .btn-card {
            margin-top: auto;
            display: flex;
            justify-content: space-between;
            gap: 5px;
        }

        .btn-card a {
            width: 50%;
            font-weight: 500;
            border-radius: 8px;
            padding: 7px 0;
            text-align: center;
            transition: 0.3s;
        }

        .btn-buy {
            background-color: #007bff;
            color: #fff;
            border: none;
        }

        .btn-buy:hover {
            background-color: #0056b3;
        }

        .btn-wishlist {
            background-color: #ffc107;
            color: #fff;
            border: none;
        }

        .btn-wishlist:hover {
            background-color: #e0a800;
        }

        .search-bar {
            max-width: 500px;
            margin: 0 auto 30px auto;
            display: flex;
        }

        .search-bar input {
            flex: 1;
            padding: 10px 15px;
            border-radius: 50px 0 0 50px;
            border: 1px solid #ccc;
            outline: none;
        }

        .search-bar button {
            border-radius: 0 50px 50px 0;
            border: none;
            padding: 0 20px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: 0.3s;
        }

        .search-bar button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<<div class="container mt-5">
    <div class="text-center mb-4">
        <h1 class="fw-bold">Our Products</h1>
        <p class="text-muted">Explore our exclusive collection</p>
    </div>

    <form action="{{ route('products.cards') }}" method="GET" class="search-bar mb-4">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products...">
        <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>

    <div class="row g-4">
        @forelse($products as $product)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card product-card shadow-sm">
                    @if($product->image)
                        <img src="{{ asset('uploads/products/'.$product->image) }}" alt="{{ $product->name }}">
                    @else
                        <img src="https://via.placeholder.com/400x250?text=No+Image" alt="No Image">
                    @endif

                    @if($loop->iteration <= 3)
                        <div class="badge-new">New</div>
                    @endif

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ Str::limit($product->description, 80) }}</p>

                        <div class="rating">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star-half-stroke"></i>
                            <i class="fa-regular fa-star"></i>
                        </div>

                        <p class="price">
                            $ {{ number_format($product->price, 2) }}
                            {{-- <span class="old-price">$ {{ number_format($product->old_price, 2) }}</span> --}}
                        </p>

                        <div class="btn-card">
                            {{-- *** MODIFICATION START: Replaced <a> with <form> for safe action *** --}}
                            <form action="{{ route('cart.add') }}" method="POST" style="width: 50%;">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="btn btn-buy w-100">
                                    <i class="fa-solid fa-cart-shopping me-2"></i>Buy Now
                                </button>
                            </form>
                            {{-- *** MODIFICATION END *** --}}

                            <a href="#" class="btn btn-wishlist"><i class="fa-solid fa-heart"></i>Wishlist</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p class="fs-5 text-muted">No products available.</p>
            </div>
        @endforelse
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</body>
</html>
