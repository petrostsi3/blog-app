<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class UserPostController extends Controller
{

    public function showPosts($id)
    {
        return view('user.posts', ['posts' => $posts]);
    }
    
    public function index($userId){
        $user = User::findOrFail($userId);

        $posts = $user->posts()->paginate(5);

        return view('posts.user-posts',compact('user','posts'));
    }
}
