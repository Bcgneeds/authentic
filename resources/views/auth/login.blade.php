@extends('layouts.app')

@section('title', 'Login — Authentic Eclectics')

@push('styles')
<style>
.auth-card {
    max-width: 460px;
    margin: 0 auto;
    padding: 2.5rem;
    border: 1px solid var(--ae-border);
    border-radius: 4px;
    background: #fff;
}
.form-control:focus {
    border-color: var(--ae-accent);
    box-shadow: 0 0 0 3px rgba(30,64,175,.15);
}
</style>
@endpush

@section('content')
<div style="background:var(--ae-cream); min-height:calc(100vh - 200px); padding:4rem 0;">
    <div class="container">
        <div class="auth-card">
            <div class="text-center mb-4">
                <div class="serif fw-bold mb-1" style="font-size:1.5rem;">Authentic <span class="text-gold">Eclectics</span></div>
                <h2 class="serif fw-bold mb-1" style="font-size:1.5rem;">Welcome Back</h2>
                <p class="text-muted" style="font-size:.85rem;">Sign in to your account</p>
            </div>

            @if($errors->any())
            <div class="alert alert-danger py-2 mb-4" style="font-size:.85rem;">
                {{ $errors->first() }}
            </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label small fw-semibold">Email Address</label>
                    <input type="email" name="email" class="form-control rounded-1"
                           value="{{ old('email') }}" required autofocus placeholder="you@example.com">
                </div>
                <div class="mb-4">
                    <label class="form-label small fw-semibold">Password</label>
                    <input type="password" name="password" class="form-control rounded-1" required placeholder="••••••••">
                </div>
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <label class="d-flex align-items-center gap-2" style="font-size:.83rem; cursor:pointer;">
                        <input type="checkbox" name="remember" style="accent-color:var(--ae-gold);"> Remember me
                    </label>
                </div>
                <button type="submit" class="btn-gold btn w-100 btn-lg">Sign In</button>
            </form>

            <hr class="my-4" style="border-color:var(--ae-border);">
            <div class="text-center" style="font-size:.85rem;">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-gold fw-semibold">Create one</a>
            </div>
        </div>
    </div>
</div>
@endsection
