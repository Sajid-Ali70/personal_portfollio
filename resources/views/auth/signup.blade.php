@extends("frontend.home.common.layout")

@section("title", "Sign Up - ".config("app.name"))

@section("content")
<section class="signup-section py-5" style="    background: linear-gradient(135deg, #667eea, #764ba2);">
    <div class="container">
        <div class="row justify-content-center align-items-center" style="margin-top: 100px">
            
            <!-- Left Side Illustration / Info -->
            <div class="col-lg-6 d-none d-lg-flex flex-column align-items-center justify-content-center text-center">
                {{-- <img src="{{ asset('images/signup-illustration.png') }}" alt="Sign Up Illustration" class="img-fluid mb-4" style="max-width: 300px;"> --}}
                <h2 class="fw-bold text-dark" style="color: white">Join Us Today!</h2>
                <p class="text-dark" style="color: white">Create your account to get full access to the dashboard and manage your activities seamlessly.</p>
            </div>

            <!-- Right Side Sign Up Form -->
            <div class="col-lg-5 col-md-8 col-sm-10">
                <div class="signup-card bg-white shadow-sm rounded p-5" style="">
                    @if ($enable_registration)
                        <h3 class="text-center mb-4 fw-bold" style="color: white">Sign Up</h3>

                        <!-- Error Messages -->
                        @if ($errors->any())
                        <div class="alert alert-danger rounded-0">
                            @foreach ($errors->all() as $error)
                                <p class="mb-0">{{ $error }}</p>
                            @endforeach
                        </div>
                        @endif

                        <form action="{{ route('auth.signup') }}" method="POST" class="sign-form">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" class="form-control" placeholder="Full Name*" name="name" value="{{ old('name') }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <input type="text" class="form-control" placeholder="Username*" name="username" value="{{ old('username') }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <input type="email" class="form-control" placeholder="Email Address*" name="email" value="{{ old('email') }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <input type="password" class="form-control" placeholder="Password*" name="password" required>
                            </div>

                            <div class="form-group mb-3">
                                <input type="password" class="form-control" placeholder="Confirm Password*" name="password_confirmation" required>
                            </div>

                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary w-100">Sign Up</button>
                            </div>

                            <p class="text-center mb-0" style="color: white">
                                Already have an account? 
                                <a href="{{ route('auth.login') }}" class="text-dark fw-bold" style="color: white">Log In</a>
                            </p>
                        </form>
                    @else
                        <div class="alert alert-danger rounded-0 text-center m-0">
                            User registration is currently not allowed!
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</section>
@endsection

@section("styles")
<style>
    .signup-card {
        transition: 0.3s;
    }
    .signup-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(0,0,0,0.15);
    }
    .signup-card .form-control {
        border-radius: 0.375rem;
        padding: 14px 16px;
        border: 1px solid #ced4da;
        transition: all 0.2s;
    }
    .signup-card .form-control:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 0.2rem rgba(59,130,246,.25);
    }
    .signup-card .btn-primary {
        padding: 12px;
        font-weight: 600;
        border-radius: 0.375rem;
        background: #3b82f6;
        border: none;
        transition: background 0.3s;
    }
    .signup-card .btn-primary:hover {
        background: #2563eb;
    }
    .signup-section p {
        line-height: 1.5;
    }
</style>
@endsection