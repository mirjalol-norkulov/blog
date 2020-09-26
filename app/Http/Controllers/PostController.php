<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function all()
    {
        return Post::all();
    }

    public function get(string $slug)
    {
        return Post::where('slug', $slug)->firstOrFail();
    }
}
