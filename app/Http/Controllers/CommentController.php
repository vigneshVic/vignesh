<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use App\Mail\UserCommentMail;
use App\Mail\AdminCommentMail;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Comment::class);

        $request->validate([
            'comment' => 'required|string|max:255'
        ]);

        $comment = new Comment;
        $comment->comment = $request->get('comment');
        $comment->status = 1;
        $comment->user()->associate($request->user());

        $post = Post::find($request->get('post_id'));
        $post->comments()->save($comment);

        if (auth()->user()->isAdmin()) {
            $users = $post->comments->pluck('user.email');
            // \Mail::to($users)->queue(new UserCommentMail($comment));
        }
        else {
            $admin = \App\User::admin()->pluck('email');
            // \Mail::to($admin)->queue(new AdminCommentMail($comment));

            $users = $post->comments->pluck('user.email');
            // \Mail::to($users)->queue(new UserCommentMail($comment));
        }

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);
        
        $validate = $request->validate([
            'comment' => 'required|string|max:255'
        ]);

        if ($request->has('status')) {
            $validate['status'] = $request->status;
        }

        $comment->update($validate);

        return response()->json(['message'=>'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        // \Mail::to($comment->user->email)->queue(new AdminCommentMail());

        $comment->delete();

        return response()->json(['message'=>'success']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function replyStore(Request $request)
    {
        $this->authorize('create', Comment::class);

        $request->validate([
            'comment' => 'required|string|max:255'
        ]);

        $reply = new Comment();
        $reply->comment = $request->get('comment');
        $reply->user()->associate($request->user());

        $comment = Comment::find($request->get('comment_id'));
        $comment->replies()->save($reply);

        return back();
    }
}
