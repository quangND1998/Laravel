<?php

namespace App\Events;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CommentSent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $user;

        public $comment;

        public function __construct(User $user, Comment $comment)
        {
            $this->user = $user;

            $this->comment = $comment;
        }

        public function broadcastOn()
        {
            return new PrivateChannel('comment');
        }
}
