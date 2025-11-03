<x-auth-layout>
    <div class="az-card-signin shadow">
        <h1 class="text-primary text-center font-weight-bold mb-3">
            <span class="text-info">i</span>Clear
        </h1>

        <div class="text-center mb-4">
            <h4 class="font-weight-bold mb-1">Welcome back!</h4>
            <small class="text-muted">Please sign in to continue</small>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first('login') }}
            </div>
        @endif

        <form action="{{ route('login.student.submit') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" name="username" placeholder="Enter your username">
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" placeholder="Enter your password">
            </div>

            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
        </form>

        <div class="mt-3 text-center">
            <a href="#" class="d-block mb-2">Forgot password?</a>
            <small>Don't have an account?
                <a href="{{ route('register.student') }}" class="font-weight-bold text-primary">Create one</a>
            </small>
        </div>
    </div><!-- az-card-signin -->
</x-auth-layout>
