<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class UserPostController extends Controller
{


    // Debug test3
    public function posts($id)
    {
        $user = User::findOrFail($id);
        $posts = $user->posts;

        return view('user.posts', compact('user', 'posts'));
    }

    public function index($userId){
        $user = User::findOrFail($userId);

        $posts = $user->posts()->paginate(5);

        return view('posts.user-posts',compact('user','posts'));
    }
}
