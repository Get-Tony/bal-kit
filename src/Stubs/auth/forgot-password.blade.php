<x-auth-layout>
    <x-slot name="subtitle">Reset your password</x-slot>

    <div class="mb-4 text-center">
        <p class="text-muted">
            Forgot your password? No problem. Just let us know your email address
            and we will email you a password reset link.
        </p>
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="alert alert-success mb-3" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                   name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Actions -->
        <div class="d-grid gap-2 mb-3">
            <button type="submit" class="btn btn-primary">
                Send Password Reset Link
            </button>
        </div>

        <hr class="my-3">

        <div class="text-center">
            <p class="mb-0">Remember your password?</p>
            <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm">
                Back to Sign In
            </a>
        </div>
    </form>
</x-auth-layout>
