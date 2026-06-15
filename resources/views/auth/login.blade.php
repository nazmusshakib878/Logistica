@extends('layouts.master')

@section('title', 'Login | Logistica')

@section('content')
<section class="auth-radiant-shell">
    <div class="container">
        <div class="auth-radiant-panel">
            <div class="row g-0">
                <div class="col-lg-6">
                    <div class="auth-visual">
                        <span class="auth-pill"><i class="fa fa-shield-alt"></i> Secure Access</span>
                        <div>
                            <h1 class="auth-title text-white">Move smarter with your logistics account.</h1>
                            <p class="fs-5 mb-0">Track faster, create bookings, and keep your transport work flowing from one polished place.</p>
                        </div>
                        <div class="auth-stat-grid">
                            <div class="auth-stat">
                                <h4 class="text-white mb-1">24/7</h4>
                                <small>Support</small>
                            </div>
                            <div class="auth-stat">
                                <h4 class="text-white mb-1">180+</h4>
                                <small>Routes</small>
                            </div>
                            <div class="auth-stat">
                                <h4 class="text-white mb-1">Fast</h4>
                                <small>Updates</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="auth-form-panel">
                        <h6 class="text-secondary text-uppercase mb-3">Welcome Back</h6>
                        <h2 class="mb-4">Login to Logistica</h2>

                        <form method="POST" action="{{ route('login.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label fw-bold">Email Address</label>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control auth-input" placeholder="you@example.com" required autofocus>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label fw-bold">Password</label>
                                <input id="password" type="password" name="password" class="form-control auth-input" placeholder="Your password" required>
                            </div>

                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="form-check">
                                    <input id="remember" type="checkbox" name="remember" class="form-check-input">
                                    <label for="remember" class="form-check-label">Remember me</label>
                                </div>
                                <span class="text-muted small">Role auto-detected</span>
                            </div>

                            <button type="submit" class="btn auth-gradient-btn w-100">Login</button>
                        </form>

                        <p class="mb-0 mt-4 text-center">
                            New here?
                            <a class="auth-soft-link" href="{{ route('register') }}">Create account</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
