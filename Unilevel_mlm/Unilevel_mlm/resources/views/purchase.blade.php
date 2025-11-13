<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Demo Purchase</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h3>Demo Purchase</h3>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('purchase.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="amount" class="form-label">Purchase Amount</label>
                <input type="number" name="amount" class="form-control" id="amount" required min="1">
            </div>
            <button type="submit" class="btn btn-primary">Purchase</button>
        </form>
    </div>
</body>

</html>
