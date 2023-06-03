<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogUser;
use App\Models\Category;
use Illuminate\Http\Request;
use DB;
use Session;

class ZenBlogController extends Controller
{

    public function index(){
//        $blogs=Blog::where('status',1)
//            ->where('blog_type','popular')
//            ->orderby('id','desc')
//            ->skip(1)
//            ->take(3)
//            ->get();
        $blogs=DB::table('blogs')
            ->join('categories','blogs.category_id', 'categories.id')
            ->join('authors','blogs.author_id', 'authors.id')
            ->select('blogs.*','categories.category_name','authors.author_name')
            ->where('blogs.status',1)
            ->where('blog_type','popular')
            ->orderby('id','desc')
//            ->skip(1)
//            ->take(4)
            ->get();

//        $categories = Category::all();

        return view('frontEnd.home.home',[
            'blogs'=> $blogs,
//            'categories'=> $categories,
        ]);
    }
    public function blogDetail($slug)
    {
        $blogs=DB::table('blogs')
            ->join('categories','blogs.category_id', 'categories.id')
            ->join('authors','blogs.author_id', 'authors.id')
            ->select('blogs.*','categories.category_name','authors.author_name')
            ->where('slug',$slug)
            ->first();


        $catId=$blogs->category_id;
        $categoryWiseBlogs =DB::table('blogs')
            ->join('categories','blogs.category_id', 'categories.id')
            ->join('authors','blogs.author_id', 'authors.id')
            ->select('blogs.*','categories.category_name','authors.author_name')
            ->where('category_id',$catId)
            ->get();
//        return $categoryWiseBlogs;

        $comment = DB::table('comments')
            ->join('blog_users', 'comments.user_id','blog_users.id')
            ->select('comments.*','blog_users.name')
            ->where('comments.blog_id',$blogs->id)
            ->get();
//        return $comment;

        return view('frontEnd.blog.blog-detail',[
            'blogs'=> $blogs,
            'categoryWiseBlogs'=> $categoryWiseBlogs,
            'comments' => $comment,
        ]);
    }
    public function about()
    {
        return view('frontEnd.about.about');
    }
    public function contact()
    {
        return view('frontEnd.contact.contact');
    }
    public function category($id)
    {
        $categoryWiseBlogs =DB::table('blogs')
            ->join('categories','blogs.category_id', 'categories.id')
            ->join('authors','blogs.author_id', 'authors.id')
            ->select('blogs.*','categories.category_name','authors.author_name')
            ->where('blogs.category_id',$id)
            ->get();

        $category=Category::where('id',$id)->first();

            return view('frontEnd.categories.category',[
            'categoryWiseBlogs'=>$categoryWiseBlogs,
                'category'=>$category,
        ]);
    }
    public function userRegistration(){
        return view('frontEnd.user.user-register');
    }
    public function saveUser(Request $request){
        BlogUser::saveUser($request);
        return back();
    }
    public function loginUser()
    {
        return view('frontEnd.user.user-login');
    }
    public function checkLogin(Request $request)
    {
        $userInfo=BlogUser::where('email', $request->user_name)
        ->orWhere('phone',$request->user_name)
            ->first();
        if($userInfo)
        {
            $existingPass = $userInfo->password;
            if (password_verify($request->password,$existingPass))
            {
                Session::put('userId',$userInfo->id);
                Session::put('userName',$userInfo->name);
                return redirect('/');
            }
        }else
        {
            return back()->with('message','Please use a valid password or user name');
        }

        return view('frontEnd.user.user-login');
    }
    public function logout()
    {
        Session::forget('userId');
        Session::forget('userName');
        return redirect('/');
    }

}
