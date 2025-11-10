@extends('layouts.auth')

@section('title', 'Register')

@section('content')
<div class="card my-5">
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-end mb-4">
      <h3 class="mb-0"><b>Sign up</b></h3>
      <a href="{{ route('login') }}" class="link-primary">Already have an account?</a>
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

    <form method="POST" action="{{ route('register') }}">
      @csrf
      
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group mb-3">
            <label class="form-label">First Name</label>
            <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" 
                   placeholder="First Name" value="{{ old('first_name') }}" required autofocus>
            @error('first_name')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group mb-3">
            <label class="form-label">Last Name</label>
            <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" 
                   placeholder="Last Name" value="{{ old('last_name') }}" required>
            @error('last_name')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>
      </div>

      <div class="form-group mb-3">
        <label class="form-label">Email Address</label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
               placeholder="Email Address" value="{{ old('email') }}" required>
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

      <div class="form-group mb-3">
        <label class="form-label">Confirm Password</label>
        <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" 
               placeholder="Confirm Password" required>
        @error('password_confirmation')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <p class="mt-4 text-sm text-muted">
        By Signing up, you agree to our <a href="#" class="text-primary">Terms of Service</a> and <a href="#" class="text-primary">Privacy Policy</a>
      </p>

      <div class="d-grid mt-3">
        <button type="submit" class="btn btn-primary">Create Account</button>
      </div>
    </form>

    <div class="saprator mt-3">
      <span>Sign up with</span>
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
