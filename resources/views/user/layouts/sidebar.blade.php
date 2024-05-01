<div class="col-xl-3 col-lg-4 wow fadeInUp" data-wow-duration="1s">
    <div class="fp__dashboard_menu">
        <div class="dasboard_header">
            <div class="dasboard_header_img">
                <img src="{{ auth()->user()->avatar }}" alt="user" class="img-fluid w-100">
                <label for="upload"><i class="far fa-camera"></i></label>
                <form action="" id="avatar_form">
                    <input type="file" id="upload" hidden name="avatar">
                </form>
            </div>
            <h2>{{ auth()->user()->name }}</h2>
        </div>
        <div class="nav flex-column nav-pills">

            <a href="{{ route('user.dashboard') }}" class="nav-link spn">
            <span><i class="fas fa-user"></i></span> Personal Info</a>

            <a href="{{ route('user.blogs.index') }}" class="nav-link spn">
                <span><i class="fas fa-blog"></i></span> Blogs</a>

            <a href="{{ route('user.favoriteList') }}" class="nav-link spn">
                <span><i class="far fa-heart"></i></span> Favorite List</a>

            <a href="{{ route('user.changePassword') }}" class="nav-link spn">
                <span><i class="fas fa-user-lock"></i></span> Change Password</a>

            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="nav-link"
                    onclick="event.preventDefault();
                this.closest('form').submit();"
                    type="button"><span> <i class="fas fa-sign-out-alt"></i>
                    </span> Logout</button>
            </form>
        </div>
    </div>
</div>
