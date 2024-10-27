<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Requests\EditPostRequest;
use App\Models\Post;
use File;
use Str;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function content(){
        return view('contact');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts=Post::join('users as us','us.id','=','posts.user_id')
           ->select('posts.*','us.name')->latest()->paginate(10);
        // $posts = Post::latest()->paginate(10);
        return view('home',compact('posts'));
    }

    public function edit($slug){
        try {
            $post = Post::findOrFail($slug); // Use firstOrFail for slug
            return view('edit',compact('post'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            $notification= trans('No Record Found');
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
    }

    public function create(){
       return view('create-post'); 
    }

    public function store(PostRequest $request){
        $imageFile=$request->file('image_file');
        $extension = $imageFile->getClientOriginalExtension();
        $fileName =  Str::random(3) . "." . $extension;
        $path = $imageFile->storeAs('public/' .  basename($fileName));
        $blogPost = new Post();
        // $blogPost->user_id=Auth::user()->id;
        $blogPost->user_id=11;
        $blogPost->title = $request->title;
        $blogPost->content = $request->content;
        $blogPost->image = $fileName;
        $blogPost->save();
        $notification= 'Blog has submited';
        $notification=array('message'=>$notification,'alert-type'=>'success');
        return redirect()->route('home')->with($notification);
    }


    public function update(EditPostRequest $request,$id){

        $imageFile=$request->file('image_file');
        $post=Post::find($id);
        if (!empty($imageFile)) {
            $extension = $imageFile->getClientOriginalExtension();
            $fileName =  Str::random(3) . "." . $extension;
            $path = $imageFile->storeAs('public/' . dirname($fileName), basename($fileName));
            $post->image = $fileName;
        }
        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();
        $notification= 'Blog has updated';
        $notification=array('message'=>$notification,'alert-type'=>'success');
        return redirect()->route('home')->with($notification);
    }

    public function destroy(Request $request){
        $post=Post::find($request->id);
        $post->delete();
        $notification= 'Deleted Successfully';
        return response()->json(['success'=>true,'message'=>$notification]); 
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
