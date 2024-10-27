<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Post;

class CheckPostOwnerShipDelete
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return response()->json(['message' => 'You do not have authorization to access this page'], 403);
        }
    
        // Get the post ID from the request data
        $postId = $request->input('id'); 
    
        // Find the post
        $post = Post::find($postId);
    
        // Check if the post exists
        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }
    
        // Check if the logged-in user is the owner
        if ($post->user_id !== auth()->id()) {
            return response()->json(['message' => 'You do not have authorization to access this page'], 403);
        }
    

        return $next($request);
    }
}
