<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Post;

class CheckPostOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
      
        if (!auth()->check()) {
            $notification = "You did not had authorize to access this page";
            $notification = array('message' => $notification, 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }
       
            $postId = $request->segment(2); 
            $post = Post::find($postId);

        if (!$post) {
            $notification = "You did not had authorize to access this page";
            $notification = array('message' => $notification, 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }

        // Check if logged-in user is the owner
        if ($post->user_id !== auth()->id()) {
            $notification = "You did not had authorize to access this page";
            $notification = array('message' => $notification, 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }

        return $next($request);
    }
}
