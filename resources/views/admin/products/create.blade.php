<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
        }
        .form-card {
            max-width: 700px;
            margin: auto;
            padding: 30px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease-in-out;
        }
        .form-card:hover {
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }
        .form-header {
            margin-bottom: 25px;
            text-align: center;
        }
        .form-header h1 {
            font-weight: 700;
            color: #333;
        }
        .btn-submit {
            width: 100%;
            font-weight: 600;
            font-size: 1.1rem;
        }
        .custom-file-label {
            overflow: hidden;
        }
        @media (max-width: 576px) {
            .form-card {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
<div class="container my-5">
    <div class="form-card">
        <div class="form-header">
            <h1><i class="bi bi-box-seam me-2"></i>Add New Product</h1>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="bi bi-exclamation-triangle me-2"></i>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label fw-bold">Product Name <span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" class="form-control form-control-lg" placeholder="Enter product name" value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label fw-bold">Price <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text">$</span>
                    <input type="number" name="price" id="price" class="form-control form-control-lg" placeholder="Enter product price" value="{{ old('price') }}" required step="0.01">
                </div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label fw-bold">Description</label>
                <textarea name="description" id="description" class="form-control form-control-lg" placeholder="Enter product description" rows="4">{{ old('description') }}</textarea>
            </div>

            <div class="mb-4">
                <label for="image" class="form-label fw-bold">Product Image</label>
                <input class="form-control form-control-lg" type="file" name="image" id="image">
            </div>

            <button type="submit" class="btn btn-success btn-lg btn-submit"><i class="bi bi-plus-circle me-2"></i>Add Product</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
