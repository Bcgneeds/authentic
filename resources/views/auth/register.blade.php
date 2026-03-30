@extends('layouts.app')

@section('title', 'Register — Authentic Eclectics')

@push('styles')
<style>
.auth-card {
    max-width: 480px;
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
                <h2 class="serif fw-bold mb-1" style="font-size:1.5rem;">Create Account</h2>
                <p class="text-muted" style="font-size:.85rem;">Join us and start discovering unique finds</p>
            </div>

            @if($errors->any())
            <div class="alert alert-danger py-2 mb-4" style="font-size:.85rem;">
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('register.post') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label small fw-semibold">Full Name</label>
                    <input type="text" name="name" class="form-control rounded-1"
                           value="{{ old('name') }}" required autofocus placeholder="John Doe">
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold">Email Address</label>
                    <input type="email" name="email" class="form-control rounded-1"
                           value="{{ old('email') }}" required placeholder="you@example.com">
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold">Password</label>
                    <input type="password" name="password" class="form-control rounded-1" required
                           placeholder="Minimum 8 characters">
                </div>
                <div class="mb-4">
                    <label class="form-label small fw-semibold">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control rounded-1" required placeholder="••••••••">
                </div>
                <button type="submit" class="btn-gold btn w-100 btn-lg">Create Account</button>
            </form>

            <hr class="my-4" style="border-color:var(--ae-border);">
            <div class="text-center" style="font-size:.85rem;">
                Already have an account?
                <a href="{{ route('login') }}" class="text-gold fw-semibold">Sign in</a>
            </div>
        </div>
    </div>
</div>
@endsection
