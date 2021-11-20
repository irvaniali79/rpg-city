<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Honeypot\ProtectAgainstSpam;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Laravelista\Comments\CommentControllerInterface;
use Laravelista\Comments\Comment;

class CommentController extends Controller implements CommentControllerInterface
{
    public function __construct()
    {
        $this->middleware('api');
        
        if (Config::get('comments.guest_commenting') == true) {
            $this->middleware('auth')->except('store');
            $this->middleware(ProtectAgainstSpam::class)->only('store');
        } else {
            $this->middleware('auth');
        }
    }
    
    /**
     * Creates a new comment for given model.
     */
    public function store(Request $request)
    {
        // If guest commenting is turned off, authorize this action.
        if (Config::get('comments.guest_commenting') == false) {
            Gate::authorize('create-comment', Comment::class);
        }
        
        // Define guest rules if user is not logged in.
        if (!Auth::check()) {
            $guest_rules = [
                'guest_name' => 'required|string|max:255',
                'guest_email' => 'required|string|email|max:255',
            ];
        }
        
        // Merge guest rules, if any, with normal validation rules.
        Validator::make($request->all(), array_merge($guest_rules ?? [], [
            'commentable_type' => 'required|string',
            'commentable_id' => 'required|string|min:1',
            'message' => 'required|string',
          
            'advantages'=>'json',
            'disadvantages'=>'json'
        ]))->validate();
        
        $model = $request->commentable_type::findOrFail($request->commentable_id);
        
        $commentClass = Config::get('comments.model');
        $comment = new $commentClass;
        
        if (!Auth::check()) {
            $comment->guest_name = $request->guest_name;
            $comment->guest_email = $request->guest_email;
        } else {
            $comment->commenter()->associate(Auth::user());
        }
        
        $comment->commentable()->associate($model);
        $comment->comment = $request->message;
        $comment->advantages = $request->advantages;
        $comment->disadvantages = $request->disadvantages;
   
        $comment->approved = !Config::get('comments.approval_required');
        $comment->save();
        
        return response(['comment_id'=> $comment->getKey()]);
    }
    
    /**
     * Updates the message of the comment.
     */
    public function update(Request $request, Comment $comment)
    {
        Gate::authorize('edit-comment', $comment);
        
        Validator::make($request->all(), [
            'status' =>'requierd|boolean',
        ])->validate();
        
        $comment->update([
            'status' => $request->status
        ]);
        
        return response(['comment_id'=> $comment->getKey()]);
    }
    
    /**
     * Deletes a comment.
     */
    public function destroy(Comment $comment)
    {
        Gate::authorize('delete-comment', $comment);
        
        if (Config::get('comments.soft_deletes') == true) {
            $comment->delete();
        }
        else {
            $comment->forceDelete();
        }
        
        return response(200);
    }
    
    /**
     * Creates a reply "comment" to a comment.
     */
    public function reply(Request $request, Comment $comment)
    {
        Gate::authorize('reply-to-comment', $comment);
        
        Validator::make($request->all(), [
            'message' => 'required|string',
            'advantages'=>'json',
            'disadvantages'=>'json'
            
        ])->validate();
        
        $commentClass = Config::get('comments.model');
        $reply = new $commentClass;
        $reply->commenter()->associate(Auth::user());
        $reply->commentable()->associate($comment->commentable);
        $reply->parent()->associate($comment);
        
        $reply->comment = $request->message;
        $comment->advantages = $request->advantages;
        $comment->disadvantages = $request->disadvantages;
        
        $reply->approved = !Config::get('comments.approval_required');
        $reply->save();
        
        return response(['comment_id'=> $comment->getKey()]);
    }
}
