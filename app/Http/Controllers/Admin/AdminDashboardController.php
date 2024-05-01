<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\TodaysBlogDataTable;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    function index(TodaysBlogDataTable $dataTable) : View|JsonResponse {
        $totalUsers = User::where('role', 'user')->count();
        $totalAdmins = User::where('role', 'admin')->count();
        $totalBlogs = Blog::count();
        $totalCategories = BlogCategory::count();
        $totalComments = BlogComment::count();
        $pendingApprovalComments = BlogComment::where('status', 0)->count();

        return $dataTable->render('admin.dashboard.index', compact(
            'totalUsers',
            'totalAdmins',
            'totalBlogs',
            'totalCategories',
            'totalComments',
            'pendingApprovalComments'
        ));

    }
}
