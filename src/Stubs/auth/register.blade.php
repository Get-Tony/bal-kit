<x-auth-layout>
    <x-slot name="subtitle">Create your account</x-slot>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                   name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                   name="email" value="{{ old('email') }}" required autocomplete="email">
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
                   name="password" required autocomplete="new-password">
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <div class="form-text">
                Use 8 or more characters with a mix of letters, numbers & symbols.
            </div>
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                   name="password_confirmation" required autocomplete="new-password">
            @error('password_confirmation')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Terms Agreement -->
        <div class="mb-3 form-check">
            <input class="form-check-input @error('terms') is-invalid @enderror" type="checkbox" name="terms" id="terms" required>
            <label class="form-check-label" for="terms">
                I agree to the <a href="#" class="text-decoration-none">Terms of Service</a>
                and <a href="#" class="text-decoration-none">Privacy Policy</a>
            </label>
            @error('terms')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Actions -->
        <div class="d-grid gap-2 mb-3">
            <button type="submit" class="btn btn-primary">
                Create Account
            </button>
        </div>

        <hr class="my-3">

        <div class="text-center">
            <p class="mb-0">Already have an account?</p>
            <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm">
                Sign In
            </a>
        </div>
    </form>
</x-auth-layout>
