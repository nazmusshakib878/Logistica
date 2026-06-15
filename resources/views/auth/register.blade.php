@extends('layouts.master')

@section('title', 'Create Account | Logistica')

@section('content')
<section class="auth-radiant-shell">
    <div class="container">
        <div class="auth-radiant-panel">
            <div class="row g-0">
                <div class="col-lg-6">
                    <div class="auth-visual">
                        <span class="auth-pill"><i class="fa fa-user-plus"></i> New Account</span>
                        <div>
                            <h1 class="auth-title text-white">Create a bright new shipping workspace.</h1>
                            <p class="fs-5 mb-0">Set up your profile and start requesting logistics support with a smoother, sharper flow.</p>
                        </div>
                        <div class="auth-stat-grid">
                            <div class="auth-stat">
                                <h4 class="text-white mb-1">Easy</h4>
                                <small>Signup</small>
                            </div>
                            <div class="auth-stat">
                                <h4 class="text-white mb-1">Live</h4>
                                <small>Bookings</small>
                            </div>
                            <div class="auth-stat">
                                <h4 class="text-white mb-1">Smart</h4>
                                <small>Freight</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="auth-form-panel">
                        <h6 class="text-secondary text-uppercase mb-3">Join Logistica</h6>
                        <h2 class="mb-4">Create Account</h2>

                        <form method="POST" action="{{ route('register.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold">Full Name</label>
                                <input id="name" type="text" name="name" value="{{ old('name') }}" class="form-control auth-input" placeholder="Your name" required autofocus>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label fw-bold">Email Address</label>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control auth-input" placeholder="you@example.com" required>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label fw-bold">Phone Number</label>
                                <input id="phone" type="tel" name="phone" value="{{ old('phone') }}" class="form-control auth-input" placeholder="+8801XXXXXXXXX" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label fw-bold">Password</label>
                                <input id="password" type="password" name="password" class="form-control auth-input" placeholder="Minimum 8 characters" required>
                            </div>

                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label fw-bold">Confirm Password</label>
                                <input id="password_confirmation" type="password" name="password_confirmation" class="form-control auth-input" placeholder="Repeat password" required>
                            </div>

                            <button type="submit" class="btn auth-gradient-btn w-100">Create Account</button>
                        </form>

                        <p class="mb-0 mt-4 text-center">
                            Already have an account?
                            <a class="auth-soft-link" href="{{ route('login') }}">Login</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
