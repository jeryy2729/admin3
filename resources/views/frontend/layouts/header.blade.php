<!doctype html>
<html lang="en">
  <head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="megakit,business,company,agency,multipurpose,modern,bootstrap4">
  
  <meta name="author" content="themefisher.com">

  <title>Megakit| Html5 Agency template</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- bootstrap.min css -->
  <link rel="stylesheet" href="{{url('frontend/plugins/bootstrap/css/bootstrap.min.css')}}">
  <!-- Icon Font Css -->
  <link rel="stylesheet" href="{{url('frontend/plugins/themify/css/themify-icons.css')}}">
  <link rel="stylesheet" href="{{url('frontend/plugins/fontawesome/css/all.css')}}">
  <link rel="stylesheet" href="{{url('frontend/plugins/magnific-popup/dist/magnific-popup.css')}}">
  <!-- Owl Carousel CSS -->
  <link rel="stylesheet" href="{{url('frontend/plugins/slick-carousel/slick/slick.css')}}">
  <link rel="stylesheet" href="{{url('frontend/plugins/slick-carousel/slick/slick-theme.css')}}">

  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="{{url('frontend/css/style.css')}}">
    @stack('styles')

</head>

<body>


<!-- Header Start --><header class="navigation">
    <!-- Header Top -->
    <div class="header-top text-white" style="background: linear-gradient(90deg, #ff7e5f, #feb47b);">
        <div class="container">
            <div class="row justify-content-between align-items-center py-2">
                <div class="col-lg-4 col-md-6">
                    <div class="header-top-socials d-flex gap-3">
                        <a href="https://www.facebook.com/themefisher" target="_blank" class="text-white">
                            <i class="bi bi-facebook fs-5"></i>
                        </a>
                        <a href="https://twitter.com/themefisher" target="_blank" class="text-white">
                            <i class="bi bi-twitter-x fs-5"></i>
                        </a>
                        <a href="https://github.com/themefisher/" target="_blank" class="text-white">
                            <i class="bi bi-github fs-5"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-8 col-md-6 text-lg-end text-md-end mt-2 mt-md-0">
                    <div class="header-top-info small">
                        <a href="tel:+23-345-67890" class="text-white me-3">
                            <i class="bi bi-telephone-fill me-1"></i> +23-345-67890
                        </a>
                        <a href="mailto:support@gmail.com" class="text-white">
                            <i class="bi bi-envelope-fill me-1"></i> support@gmail.com
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light shadow-sm py-3" style="background-color: #ffffff;">
        <div class="container">
            <a class="navbar-brand fw-bold fs-3 text-primary" href="{{ route('frontend.index') }}">
                Mega<span class="text-warning">kit.</span>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="bi bi-list fs-2 text-primary"></span>
            </button>

            <div class="collapse navbar-collapse text-center" id="navbarsExample09">
<ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-center">
    <li class="nav-item">
        <a class="nav-link px-3" href="{{ route('frontend.index') }}" title="Home" data-bs-toggle="tooltip">
            <i class="bi bi-house-door-fill fs-5"></i>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link px-3" href="{{ route('frontend.tags') }}" title="Tags" data-bs-toggle="tooltip">
            <i class="bi bi-tags-fill fs-5"></i>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link px-3" href="{{ route('frontend.categories') }}" title="Categories" data-bs-toggle="tooltip">
            <i class="bi bi-list-ul fs-5"></i>
        </a>
    </li>
    <!-- <li class="nav-item">
        <a class="nav-link px-3" href="{{ route('user.posts.index') }}" title="Blog Post" data-bs-toggle="tooltip">
            <i class="bi bi-journal-richtext fs-5"></i>
        </a>
    </li> -->
    <li class="nav-item">
        <a class="nav-link px-3" href="{{ route('frontend.authpost') }}" title="Post" data-bs-toggle="tooltip">
            <i class="bi bi-pencil-square fs-5"></i>
        </a>
    </li>

    @auth
    <li class="nav-item dropdown">
        <a class="nav-link px-3 dropdown-toggle" href="#" role="button"
            data-bs-toggle="dropdown" title="{{ Auth::user()->name }}" data-bs-toggle="tooltip">
            <i class="bi bi-person-circle fs-5"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
            <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right me-2"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </li>
    @endauth
</ul>
          </div>
        </div>
    </nav>
</header>

