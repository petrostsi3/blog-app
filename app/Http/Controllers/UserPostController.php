<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class UserPostController extends Controller
{


    // Debug test3
    public function showPosts($id)
    {
        
        $posts = Post::where('user_id', $id)->get();

        return view('user.posts', ['posts' => $posts]);
    }

    public function index($userId){
        $user = User::findOrFail($userId);

        $posts = $user->posts()->paginate(5);

        return view('posts.user-posts',compact('user','posts'));
    }
}
