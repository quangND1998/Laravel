<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Events\CommentSent;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $id)
    {
        $this->validate($request(), [
            'body' => 'required',
        ]);

        $user = auth()->user();
        $post = Post::find($id);
        $comment = Comment::create([
            'user_id' => $user->id,
            'post_id' => $post->id,
            'body' => request('body'),
        ]);


        broadcast(new CommentSent($user, $comment))->toOthers();

        return ['status' => 'Message Sent!'];
    }

    public function index( $id)
    {
        $post =Post::find($id);
        return $post->comments()->with('user')->get();
    }
}
