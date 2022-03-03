<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class PostController extends Controller
{
    //

    public function index()
    {

        
         $posts = Post::where('user_id','=',Auth::user()->id)->get();

       return view('backend.post.index', compact('posts'));
    }

    public function create()
    {
        return view('backend.post.create');
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3',
        ]);

        if ($validator->fails()) {

            return redirect('post')
                        ->withErrors($validator)
                        ->withInput();
        }

        Post::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'slug' => \Str::slug($request->title)
        ]);

        return redirect()->back();

    }

    public function show($id) {

          $post = Post::find($id);

        return view('backend.post.single',compact('post'));

    }

}
