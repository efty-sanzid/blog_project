<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    private static $blog;
    public static function saveBlog($request)
    {
        self::$blog = new  Author();
        self::$blog->blog_name = $request->blog_name;
        self::$blog->save();
    }
}
