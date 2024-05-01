<?php

namespace App\Http\Controllers;

use App\Traits\BlogCategoryTrait;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Models\UserLikeBlogs;
use App\Models\UserLikeComment;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BlogsController extends Controller
{
    use BlogCategoryTrait;

    function index() : View {

        $categories = $this->blogCategory();

        $mostPopularCategories = Blog::query()
        ->select('id', 'category_id')
        ->with('category:id,name,slug,description,created_at,image')
        ->whereHas('category', function($query){
            $query->where('status', 1);
        })
        ->orderBy('view_count', 'DESC')
        ->groupBy('category_id')
        ->get();

        $categoryNames = [];
        $mostPopularCategories->map(function ($item) use (&$categoryNames){
            if(count($categoryNames) < 4){
                $categoryNames[] = $item->category;
            }
        });

        $mostPopularBlogs = Blog::query()
        ->with(['user', 'category'])
        ->whereHas('user')
        ->whereHas('category')
        ->orderBy('view_count', 'DESC')
        ->limit(6)
        ->get();

        $latestBlogs = Blog::with(['category', 'user'])->where('status', 1)->latest()->take(6)->get();

        $blogger = Blog::with(['user'])->where('status', 1)->orderBy('view_count', 'DESC')->take(6)->get();

        return view('blog.index', ['mostPopularCategories' => $categoryNames], compact('latestBlogs', 'categories', 'mostPopularBlogs', 'blogger'));
        //return view('blog.index');
        //return view('blog.login');
        //return view('blog.register');
        //return view('blog.forget-password');

    }

    function about() : View{
        return view('blog.about');
    }

    function category(Request $request, string $slug){
        $categories = $this->blogCategory();

        $category = BlogCategory::query()->with('blogs')->where('slug', $slug)->first();
        $blogs = $category->blogs()->latest()->paginate(6);

        return view('blog.category', compact('category','categories', 'blogs'));
    }


    function blog(Request $request) : View {
        $blogs = Blog::with(['category', 'user'])->where('status', 1);

        if($request->has('search') && $request->filled('search')){
            $blogs->where(function($query) use ($request) {
                $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%');
            });

        }

        if($request->has('category') &&  $request->filled('category')) {
            $blogs->whereHas('category', function($query) use ($request){
                $query->where('slug', $request->category);
            });
        }

        $blogs = $blogs->latest()->paginate(9);

        $categories = BlogCategory::where('status', 1)->get();

        return view('blog.article', compact( 'blogs', 'categories'));
    }

    function blogDetails(string $slug) : View {
        $blog = Blog::with(['user'])->where('slug', $slug)->where('status', 1)->firstOrFail();

        $comments = $blog->comments()->where('status', 1)->orderBy('id', 'DESC')->paginate(13);

        $categories = $this->blogCategory();

        $nextBlog = Blog::select('id', 'title', 'slug', 'image')->where('id', '>', $blog->id)
        ->orderBy('id', 'ASC')->first();
        $previousBlog = Blog::select('id', 'title', 'slug', 'image')->where('id', '<', $blog->id)
        ->orderBy('id', 'DESC')->first();

        $blog->increment('view_count');
        $blog->save();

        return view('blog.article_detail', compact('blog', 'categories', 'nextBlog', 'previousBlog', 'comments'));
    }

    function blogCommentStore(Request $request, string $blog_id) : RedirectResponse {
        $request->validate([
            'comment' => ['required', 'max:500']
        ]);

        Blog::findOrFail($blog_id);

        $comment = new BlogComment();
        $comment->blog_id = $blog_id;
        $comment->user_id = auth()->user()->id;
        $comment->comment = $request->comment;
        $comment->save();

        toastr()->success('Your comment has been submitted successfully and is awaiting approval.');
        return redirect()->back();

    }

    function blogFavorite(Request $request){

        $blog = Blog::query()->with(['user.articleLike', 'articleLikes' => function($query)
        {
            $query->where('user_id', auth()->id());
        }
        ])->where('id', $request->id)->firstOrFail();

        //$userLike = UserLikeBlogs::where('user_id', auth()->id())->where('blog_id', $blog->id)->first();
        $userLike = $blog->articleLikes->where('blog_id', $blog->id)->where('user_id', auth()->id())->first();

        if($userLike)
        {
            $blog->articleLikes()->delete();
            //UserLikeBlogs::query()->where('user_id', auth()->id())->where('blog_id', $blog->id)->delete();
            $blog->like_count--;
            $process = 0;
        }else {
            UserLikeBlogs::create([
                'user_id' => auth()->id(),
                'blog_id' => $blog->id
            ]);

            $blog->like_count++;
            $process = 1;

        }

        $blog->save();

        return response()->json(['status' => 'success', 'message' => 'Successfully', 'userLike', 'like_count' => $blog->like_count, 'process' => $process])
        ->setStatusCode(100);

    }

    function blogCommentFavorite(Request $request) {

        $comment = BlogComment::query()->with(['user.commentLike', 'commentLikes' => function($query)
        {
            $query->where('user_id', auth()->id());
        }
        ])->where('id', $request->id)->firstOrFail();

        $commentLike = UserLikeComment::where('user_id', auth()->id())->where('comment_id', $comment->id)->first();

        if($commentLike)
        {
            $comment->commentLikes()->delete();
            //UserLikeBlogs::query()->where('user_id', auth()->id())->where('blog_id', $blog->id)->delete();
            $comment->like_count--;
            $process = 0;
        }else {
            UserLikeComment::create([
                'user_id' => auth()->id(),
                'comment_id' => $comment->id
            ]);

            $comment->like_count++;
            $process = 1;

        }

        $comment->save();

        return response()->json(['status' => 'success', 'message' => 'Successfully', 'commentLike', 'like_count' => $comment->like_count, 'process' => $process])
        ->setStatusCode(100);

    }
}
