@extends('blog.layouts.user_master')

@section('content')
    <div class="fp_dashboard_body fp__change_password">
        <div class="fp__review_input">
            <div class="comment_input pt-0">
                <h3 class="user_change_password">change password</h3>
                <form method="POST" action="{{ route('profile.password.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-xl-6">
                            <div class="fp__comment_imput_single">
                                <label class="user_password">Current Password</label>
                                <input type="password" placeholder="Current Password" name="current_password">
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="fp__comment_imput_single">
                                <label class="user_password">New Password</label>
                                <input type="password" placeholder="New Password" name="password">
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="fp__comment_imput_single" style="margin-bottom: 15px;">
                                <label class="user_password">confirm Password</label>
                                <input type="password" placeholder="Confirm Password" name="password_confirmation">
                            </div>
                            <button type="submit" class="common_btn mt_20">submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
