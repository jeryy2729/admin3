
@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel Access</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            border-radius: 10px 10px 0 0;
            background-color: #f96d41;
            color: white;
            font-size: 1.25rem;
        }

        .card-body {
            padding: 30px;
        }

        .btn-custom {
            background-color: #f96d41;
            border-color: #f96d41;
            transition: background-color 0.3s;
            width: 100%;
            margin-bottom: 15px;
        }

        .btn-custom:hover {
            background-color: #e75731;
            border-color: #e75731;
        }
    </style>
</head>
<body>

<div class="container-fluid d-flex justify-content-center align-items-center min-vh-100">
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-header">
                Welcome to Admin Panel
            </div>
            <div class="card-body">
                
            </div>
        </div>
    </div>
</div>

</body>
</html>
@endsection