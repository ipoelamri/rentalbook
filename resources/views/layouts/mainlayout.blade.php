<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rental Buku | @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>


<body>
    <div class="main d-flex flex-column justify-content-between">
        <nav class="navbar navbar-dark navbar-expand-lg bg-primary ">
            <div class="container-fluid px-5">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <a class="navbar-brand" href="#">Perpustakaan Digital</a>



            </div>
        </nav>
        <div class="body-content h-100">
            <div class="row h-100 g-0">
                <div class="sidebar col-lg-2 collapse d-lg-block " id="navbarTogglerDemo01">

                    @if (Auth::check() && Auth::user()->role_id == 1)
                        <!-- ini untuk admin -->
                        <a href = "/dashboard" @if (request()->route()->uri == 'dashboard') class = "active" @endif>Dashboard</a>
                        <a href = "/books" @if (request()->route()->uri == 'books') class = "active" @endif>Books</a>
                        <a href="/categories" @if (request()->route()->uri == 'categories' ||
                                request()->route()->uri == 'create-category' ||
                                request()->route()->uri == 'category-edit/{slug}') class = "active" @endif>Categories</a>
                        <a href="/users" @if (request()->route()->uri == 'users' ||
                                request()->route()->uri == 'user-detail/{slug}' ||
                                request()->route()->uri == 'user-inactive') class = "active" @endif>Users</a>
                        <a href="/rentlog" @if (request()->route()->uri == 'rentlog') class = "active" @endif>Rent Log</a>
                        <a href="/logout">Logout</a>
                    @elseif (Auth::check() && Auth::user()->role_id == 2)
                        <!-- ini untuk client -->
                        <a href="/" @if (request()->route()->uri == '/') class = "active" @endif>Home</a>
                        <a href="/profile" @if (request()->route()->uri == 'profile') class = "active" @endif>Profile</a>
                        <a href="/dashboard-user"
                            @if (request()->route()->uri == 'dashboard-user') class = "active" @endif>Dashboard</a>
                        <a href="/logout">Logout</a>
                    @else
                        <!-- ini untuk guest -->
                        <a href="/" @if (request()->route()->uri == '/') class = "active" @endif>Home</a>
                        <a href="/login" @if (request()->route()->uri == 'login') class = "active" @endif>Login</a>
                        <a href="/register" @if (request()->route()->uri == 'register') class = "active" @endif>Register</a>
                    @endif




                </div>
                <div class="content col-lg-10 p-5">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>

</body>

</html>
