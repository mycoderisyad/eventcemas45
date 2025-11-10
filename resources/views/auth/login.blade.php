@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="card my-5">
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-end mb-4">
      <h3 class="mb-0"><b>Login</b></h3>
      <a href="{{ route('register') }}" class="link-primary">Don't have an account?</a>
    </div>

    @if ($errors->any())
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong>
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
      @csrf
      
      <div class="form-group mb-3">
        <label class="form-label">Email Address</label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
               placeholder="Email Address" value="{{ old('email') }}" required autofocus>
        @error('email')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" 
               placeholder="Password" required>
        @error('password')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="d-flex mt-1 justify-content-between align-items-center">
        <div class="form-check">
          <input class="form-check-input input-primary" type="checkbox" name="remember" id="customCheckc1" {{ old('remember') ? 'checked' : '' }}>
          <label class="form-check-label text-muted" for="customCheckc1">Keep me sign in</label>
        </div>
        <a href="{{ route('password.request') }}">
          <h5 class="text-secondary f-w-400 mb-0">Forgot Password?</h5>
        </a>
      </div>

      <div class="d-grid mt-4">
        <button type="submit" class="btn btn-primary">Login</button>
      </div>
    </form>

    <div class="saprator mt-3">
      <span>Login with</span>
    </div>
    
    <div class="row">
      <div class="col-4">
        <div class="d-grid">
          <button type="button" class="btn mt-2 btn-light-primary bg-light text-muted">
            <img src="{{ asset('assets/images/authentication/google.svg') }}" alt="Google"> <span class="d-none d-sm-inline-block"> Google</span>
          </button>
        </div>
      </div>
      <div class="col-4">
        <div class="d-grid">
          <button type="button" class="btn mt-2 btn-light-primary bg-light text-muted">
            <img src="{{ asset('assets/images/authentication/twitter.svg') }}" alt="Twitter"> <span class="d-none d-sm-inline-block"> Twitter</span>
          </button>
        </div>
      </div>
      <div class="col-4">
        <div class="d-grid">
          <button type="button" class="btn mt-2 btn-light-primary bg-light text-muted">
            <img src="{{ asset('assets/images/authentication/facebook.svg') }}" alt="Facebook"> <span class="d-none d-sm-inline-block"> Facebook</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
