<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        return view('admin.author.author',[
            'authors'=>Author::all()
        ]);
    }
    public function saveAuthor(Request $request)
    {
        Author::saveAuthor($request);
        return back();
    }
}
