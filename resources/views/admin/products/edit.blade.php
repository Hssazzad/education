<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f4f6f9; }
        .form-card {
            max-width: 700px;
            margin: auto;
            padding: 30px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease-in-out;
        }
        .form-card:hover { box-shadow: 0 15px 40px rgba(0,0,0,0.15); }
        .btn-submit { width: 100%; font-weight: 600; font-size: 1.1rem; }
        img.preview { max-height: 200px; object-fit: cover; margin-bottom: 15px; border-radius: 8px; }
    </style>
</head>
<body>
<div class="container my-5">
    <div class="form-card">
        <div class="mb-4 text-center">
            <h1><i class="bi bi-pencil-square me-2"></i>Edit Product</h1>
        </div>

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-bold">Product Name</label>
                <input type="text" name="name" class="form-control form-control-lg" value="{{ old('name', $product->name) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Price</label>
                <div class="input-group">
                    <span class="input-group-text">$</span>
                    <input type="number" name="price" class="form-control form-control-lg" value="{{ old('price', $product->price) }}" required step="0.01">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Description</label>
                <textarea name="description" class="form-control form-control-lg" rows="4">{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Current Image</label><br>
                @if($product->image)
                    <img src="{{ asset('uploads/products/'.$product->image) }}" class="preview" alt="Product Image">
                @else
                    <p>No image uploaded</p>
                @endif
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Change Image</label>
                <input type="file" name="image" class="form-control form-control-lg">
            </div>

            <button type="submit" class="btn btn-success btn-lg btn-submit"><i class="bi bi-save me-2"></i>Update Product</button>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
