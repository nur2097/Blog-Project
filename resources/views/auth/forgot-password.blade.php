@extends('blog.layouts.password')

@section('password')
    <section>
        <div class="password-box">
            <div class="row log-row">
                <h2 class="forget-h2">I Forgot My Password</h2>
                <form action="{{ route('password.email') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="forget-p">
                            <p>Forgot your password? No problem. Just let us know your email address;
                                We will email you a password reset link that will allow you to choose a new password.
                            </p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label forget-label">Email address</label>
                            <input type="email" name="email" class="form-control forget-input" placeholder="Email"
                                value="{{ old('email') }}">
                        </div>

                        <div class="forget">
                            <label>
                                <a href="{{ route('login') }}">Login</a>
                            </label>
                            <label>
                                <a href="{{ route('register') }}">Create Account</a>
                            </label>
                        </div>

                        <div>
                            <button type="submit">Verify Email</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
