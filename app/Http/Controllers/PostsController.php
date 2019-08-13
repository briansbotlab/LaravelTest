<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{

    public function __cunstruct(){
      $this->middleware('auth');
    }
    public function create(){
        return view('posts.create');
    }

    public function store(Request $request){

        $data = $request->validate([
          'caption' => 'required',
          'image' =>'required|image',
        ]);

        $imagepath = $request->file('image')->store('uploads','public');


        auth()->user()->posts()->create([
          'caption' => $data['caption'],
          'image' => $imagepath,
        ]);

        return redirect('/profile/'.auth()->user()->id);
    }

    public function show(Post $post){
        return view('posts.show',compact('post'));

    }

    public function index(){
      if (Auth::check()) {
          // 已登入
          $current_user_id = auth()->user()->id;

          $users = auth()->user()->following()->pluck('profiles.user_id');
          $posts = Post::whereIn('user_id', $users)->with('user')->orderBy('created_at','DESC')->paginate(5);
          return view('posts.index',compact('posts','current_user_id'));
        }

      return view('welcome');
    }
}
