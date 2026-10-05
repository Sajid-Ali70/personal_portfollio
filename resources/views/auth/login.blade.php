@extends("frontend.home.common.layout")

@section("title", "Log In - ".config("app.name"))

@section("content")

<style>
    .auth-section {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 100px 15px 60px;
        margin-top: 50px;
        background: linear-gradient(135deg, #667eea, #764ba2);
    }

    .auth-card {
        width: 100%;
        max-width: 420px;
        background: #ffffff;
        padding: 45px 35px;
        border-radius: 16px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        transition: 0.3s ease;
    }

    .auth-card:hover {
        transform: translateY(-5px);
    }

    .auth-card h4 {
        font-weight: 600;
        margin-bottom: 30px;
        text-align: center;
        color: #333;
    }

    .form-control {
        height: 50px;
        border-radius: 10px;
        border: 1px solid #e0e0e0;
        padding: 12px 15px;
        transition: 0.2s;
    }

    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102,126,234,0.2);
    }

    .btn-login {
        width: 100%;
        height: 50px;
        border-radius: 10px;
        background: #667eea;
        color: #fff;
        font-weight: 600;
        border: none;
        transition: 0.3s;
    }

    .btn-login:hover {
        background: #5563d1;
    }

    .auth-footer {
        margin-top: 20px;
        text-align: center;
        font-size: 14px;
    }

    .auth-footer a {
        font-weight: 600;
        color: #667eea;
        text-decoration: none;
    }

    .auth-footer a:hover {
        text-decoration: underline;
    }

    @media (max-width: 576px) {
        .auth-section {
            padding-top: 120px;
        }

        .auth-card {
            padding: 35px 25px;
        }
    }
</style>

<section class="auth-section">
    <div class="auth-card">

        <h4>Welcome Back 👋</h4>

        @if ($errors->any())
            <div class="alert alert-danger rounded-3">
                @foreach ($errors->all() as $error)
                    <p class="mb-0">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('auth.login.submit') }}">
            @csrf

            <div class="mb-3">
                <input type="text"
                       class="form-control"
                       name="email_or_username"
                       placeholder="Email or Username"
                       value="{{ old('email_or_username') }}"
                       required>
            </div>

            <div class="mb-3">
                <input type="password"
                       class="form-control"
                       name="password"
                       placeholder="Password"
                       required>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <input type="checkbox" name="remember" value="1" id="rememberMe">
                    <label for="rememberMe"> Remember Me</label>
                </div>              
            </div>

            <button type="submit" class="btn-login">
                Log In
            </button>

            <div class="auth-footer">
                Don’t have an account?
                <a href="{{ route('auth.signup') }}">Create One</a>
            </div>

        </form>

    </div>
</section>

@endsection