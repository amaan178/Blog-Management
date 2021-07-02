<?php

namespace App\Http\Middleware;

use App\Models\Post;
use Closure;
use Illuminate\Http\Request;

class ValidateAuthorForEditAndDeletePost
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(is_object($request->post)) {
            if(! ($request->post->user_id == auth()->id())) {
                return redirect(abort(401));
            }
        } else if(is_numeric($request->post))
        {
            if(! (Post::withTrashed()->findOrFail($request->post))->user_id == auth()->id()) {
                return redirect(abort(401));
            }
        }
        return $next($request);
    }
}
