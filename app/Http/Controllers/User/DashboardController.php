<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\UserLikeBlogs;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    function index() : View {
        $totalBlogs = Blog::where('user_id', auth()->user()->id)->count();
        $favoriteBlogs = UserLikeBlogs::where( 'user_id', auth()->user()->id)->count();

        return view('user.dashboard.sections.personal-info', compact('totalBlogs', 'favoriteBlogs'));
    }

    function favoriteList() : View{
        $favoriteBlogs = UserLikeBlogs::where( 'user_id', auth()->user()->id)->get();

        return view('user.dashboard.sections.favorite-list', compact( 'favoriteBlogs'));
    }

    function changePassword() : View {
        return view('user.dashboard.change-password');
    }

}
