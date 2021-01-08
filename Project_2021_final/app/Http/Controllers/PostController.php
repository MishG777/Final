<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use App\Notifications\PostAddNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(){
        $posts=Post::with(['tags'])->get();
        return view('posts',compact('posts'));
    }

    public function tag($id){
        $tag=Tag::findOrFail($id);
        return view('tag',compact('tag'));
    }

    public function show($id){
        $post = Post::findOrFail($id);
        return view('post')->with('post',$post);
    }
    public function create(){
        $tags = Tag::all();
        return view('create', compact('tags'));
    }

    public function save(Request $request){
        $request->validate([
            'name' => 'required|unique:posts|max:255',
            'text' => 'required',
            'image'=> 'required'
        ]);

        $post=new Post($request->all());

        if ($request->hasFile('image')){
            $file=$request->file('image');
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('uploads/post/', $filename);
            $post->image=$filename;
        }else{
            return $request;
            $post->image='';
        }
        $user=Auth::user();
        $post->user_id=$user->id;
        $data=[
            "text"=>'პოსტი სათაურით'.'  '.$post->name.'  '.'დაემატა საიტზე'
        ];

        $post->save();
        $post->tags()->attach($request->tags);
        $user->notify(new PostAddNotification($data));
        return redirect()->back();
    }

    public function edit($postid){
        $post=Post::findOrFail($postid);
        return view('edit')->with('post',$post);
    }
    public function update(Request $request, $postid){
        $post=Post::findOrFail($postid);
        $post->update($request->all());
        return redirect()->back();
    }
    public function delete($id){
        $post=Post::findOrFail($id);
        $post->delete();
    }

    public function like(Post $post)
    {
        $user=Auth::user();
        if ($user->posts()->detach($post)==true){
            $user->posts()->detach($post);
        }else{
            $user->posts()->attach($post);
        }

        return redirect()->back();
    }

    public function liked(){
        $user=Auth::user();
        return view('liked', compact('user'));
    }

}
