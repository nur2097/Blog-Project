@extends('blog.layouts.sign')

@section('sign')
    <section>
        <div class="register-box">
            <div class="row log-row">
                <h2>Create Account</h2>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="row">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Name"
                                value="{{ old('name') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" placeholder="Email"
                                value="{{ old('email') }}">
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

                        <div>
                            <button type="submit">Register</button>
                        </div>

                        <div class="register">
                            <p>Do you have an account? <a href="{{ route('login') }}">Login</a></p>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </section>
@endsection
