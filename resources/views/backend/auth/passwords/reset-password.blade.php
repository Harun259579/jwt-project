<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .reset-container {
            max-width: 400px;
            margin: 80px auto;
            padding: 30px;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .reset-container h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #343a40;
        }
        .btn-primary {
            width: 100%;
        }
    </style>
</head>
<body>

<div class="reset-container">

    <h2>Reset Password</h2>

    @if(session('status'))
        <div class="alert alert-success text-center">
            {{ session('status') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger text-center">
            {{ $errors->first() }}
        </div>
    @endif

    <!-- Form -->
    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <div class="mb-3">
            <input type="password" name="password" class="form-control" placeholder="Enter new password" required>
        </div>

        <div class="mb-3">
            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm new password" required>
        </div>

        <button type="submit" class="btn btn-primary">Reset Password</button>
    </form>

</div>

</body>
</html>
