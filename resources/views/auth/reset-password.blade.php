@extends('blog.layouts.password')

@section('password')
    <section
        style="
    background-color: #000;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: url({{ asset('blog_images/pexels1.jpg') }}) no-repeat;
    background-position: center;
    background-size: cover;
    width: 100%;">
        <div class="box">
            <div class="row log-row">
                <h2 class="forget-h2">Reset Password</h2>
                <form action="{{ route('password.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" placeholder="Email"
                                value="{{ old('email', $request->email) }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Repeat Password</label>
                            <input type="password" name="password_confirmation" class="form-control"
                                placeholder="Repeat Password">
                        </div>

                        <div class="forget reset-forget">
                            <label>
                                <a href="{{ route('login') }}">Login</a>
                            </label>
                            <label>
                                <a href="{{ route('register') }}">Create Account</a>
                            </label>
                        </div>

                        <div>
                            <button type="submit">Reset Password</button>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </section>
@endsection
