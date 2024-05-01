@extends('blog.layouts.sign')

@section('sign')
    <section>
        <div class="box">
            <div class="row log-row">
                <h2>Login</h2>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" placeholder="Email" required
                             value="{{ old('email') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>

                        <div class="forget">
                            <label>
                                <input type="checkbox" name="remember">Remember Me

                            </label>
                            <label>
                                <a href="{{ route('password.request') }}">I Forgot My Password</a>
                            </label>
                        </div>

                        <div>
                            <button type="submit">Login</button>
                        </div>

                        <div class="register">
                            <p>Don't have an account? <a href="{{ route('register') }}">Create Account</a></p>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </section>
@endsection
