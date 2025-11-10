@extends('layouts.app')

@push('styles')
  <link rel="stylesheet" href="{{ asset('assets/css/landing.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/plugins/animate.min.css') }}" type="text/css">
@endpush

@section('content')
<div class="landing-page">
  <!-- [ Header ] start -->
  <header id="home">
    <!-- [ Nav ] start -->
    <nav class="navbar navbar-expand-md navbar-dark top-nav-collapse default">
      <div class="container">
        <a class="navbar-brand" href="#">
          <img src="{{ asset('assets/images/logo-white.svg') }}" alt="logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01"
          aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="btn btn-primary" href="{{ url('login') }}">Login</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- [ Nav ] End -->
    
    <div class="container">
      <div class="row align-items-center justify-content-center text-center">
        <div class="col-md-9 col-xl-6">
          <h1 class="mt-sm-3 text-white mb-4 f-w-600 wow fadeInUp" data-wow-delay="0.2s">
            Welcome to <span class="text-primary">{{ config('app.name') }}</span>
          </h1>
          <h5 class="mb-4 text-white opacity-75 wow fadeInUp" data-wow-delay="0.4s">
            Platform manajemen event modern yang memudahkan pengelolaan acara Anda
          </h5>
          <div class="my-5 wow fadeInUp" data-wow-delay="0.6s">
            <a href="{{ url('login') }}" class="btn btn-primary">
                 Get Started
            </a>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- [ Header ] End -->
</div>
@endsection

@push('scripts')
  <script src="{{ asset('assets/js/plugins/wow.min.js') }}"></script>
  <script>
    new WOW().init();
    let ost = 0;
    document.addEventListener('scroll', function () {
      let cOst = document.documentElement.scrollTop;
      if (cOst == 0) {
        document.querySelector(".navbar").classList.add("top-nav-collapse");
      } else if (cOst > ost) {
        document.querySelector(".navbar").classList.add("top-nav-collapse");
        document.querySelector(".navbar").classList.remove("default");
      } else {
        document.querySelector(".navbar").classList.add("default");
        document.querySelector(".navbar").classList.remove("top-nav-collapse");
      }
      ost = cOst;
    });
  </script>
@endpush
