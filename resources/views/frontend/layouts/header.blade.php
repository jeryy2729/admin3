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
<style>
    /* Smooth transition for nav elements */
    .navbar-nav .nav-link,
    .navbar-brand {
        transition: all 0.3s ease-in-out;
    }

    /* On hover effects for links */
    .navbar-nav .nav-link:hover {
        color: #fff !important;
        background: linear-gradient(45deg, #FF512F, #DD2476);
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        transform: scale(1.05);
    }

    /* Logo hover effect */
    .navbar-brand:hover {
        color: #DD2476 !important;
        transform: scale(1.05);
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
    }

    /* Smooth dropdown animation */
    .dropdown-menu {
        transition: all 0.4s ease-in-out;
        animation: fadeInDown 0.3s ease-in-out;
    }

    

</style>

</head>

<body>


<!-- Header Start --><header class="navigation">
<!-- Header Start -->
<header class="navigation">
    <!-- Header Top -->
    <div class="header-top text-white" style="background: linear-gradient(90deg, #FF512F, #DD2476);">
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
                    <div class="header-top-info small fw-semibold">
                        <a href="tel:+23-345-67890" class="text-white me-3 text-decoration-none">
                            <i class="bi bi-telephone-fill me-1"></i> +23-345-67890
                        </a>
                        <a href="mailto:support@gmail.com" class="text-white text-decoration-none">
                            <i class="bi bi-envelope-fill me-1"></i> support@gmail.com
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light shadow-sm py-3" style="background: linear-gradient(90deg, #ffffff, #f3f9ff);">
        <div class="container">
            <a class="navbar-brand fw-bold fs-3" href="{{ route('frontend.index') }}" style="color: #FF6F61;">
                Mega<span style="color: #FFBB00;">kit.</span>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="bi bi-list fs-2" style="color: #FF6F61;"></span>
            </button>

            <div class="collapse navbar-collapse text-center" id="navbarsExample09">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-center">
                  <li class="nav-item">
    <a class="nav-link px-3 fw-semibold text-dark" href="{{ route('frontend.index') }}" 
       title="{{ __('messages.home') }}" data-bs-toggle="tooltip">
        <i class="bi bi-house-door-fill fs-5 text-primary"></i>
    </a>
</li>
  <li class="nav-item">
                        <a class="nav-link px-3 fw-semibold text-dark" href="{{ route('frontend.tags') }}" title="{{ __('messages.tag') }}" data-bs-toggle="tooltip">
                            <i class="bi bi-tags-fill fs-5 text-success"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 fw-semibold text-dark" href="{{ route('frontend.categories') }}" title="{{ __('messages.category') }}" data-bs-toggle="tooltip">
                            <i class="bi bi-list-ul fs-5 text-warning"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 fw-semibold text-dark" href="{{ route('frontend.authpost') }}" title="{{ __('messages.post') }}" data-bs-toggle="tooltip">
                            <i class="bi bi-pencil-square fs-5 text-danger"></i>
                        </a>
                    </li>

                    @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link px-3 dropdown-toggle fw-semibold text-dark" href="#" role="button"
                            data-bs-toggle="dropdown" title="{{ Auth::user()->name }}" data-bs-toggle="tooltip">
                            <i class="bi bi-person-circle fs-5 text-info"></i>
                        </a>
<div class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3">
    <a class="dropdown-item" href="{{ route('profile.edit') }}">
        <i class="fas fa-user-circle me-2 text-primary"></i> {{__('messages.edit_profile')}}
    </a>

    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fas fa-sign-out-alt me-2 text-danger"></i> {{__('messages.logout')}}
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

