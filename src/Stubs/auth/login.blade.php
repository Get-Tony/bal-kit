<x-auth-layout>
    <x-slot name="subtitle">Sign in to your account</x-slot>

    <!-- Session Status -->
    @if (session('status'))
        <div class="alert alert-success mb-3" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
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

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                   name="password" required autocomplete="current-password">
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="mb-3 form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">
                Remember me
            </label>
        </div>

        <!-- Actions -->
        <div class="d-grid gap-2 mb-3">
            <button type="submit" class="btn btn-primary">
                Sign In
            </button>
        </div>

        <!-- Links -->
        <div class="text-center">
            @if (Route::has('password.request'))
                <a class="btn btn-link btn-sm" href="{{ route('password.request') }}">
                    Forgot your password?
                </a>
            @endif
        </div>

        <hr class="my-3">

        <div class="text-center">
            <p class="mb-0">Don't have an account?</p>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="btn btn-outline-primary btn-sm">
                    Create Account
                </a>
            @endif
        </div>
    </form>
</x-auth-layout>
