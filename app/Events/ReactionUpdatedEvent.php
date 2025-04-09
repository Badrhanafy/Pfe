<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Post;

class ReactionUpdatedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $post;

    public function __construct(Post $post)
    {
        $this->post = $post->loadCount(['reactions as like_count' => function($query) {
            $query->where('type', 'like');
        }, 'reactions as dislike_count' => function($query) {
            $query->where('type', 'dislike');
        }]);
    }

    public function broadcastOn()
    {
        return new Channel('post.'.$this->post->id);
    }

    public function broadcastAs()
    {
        return 'reaction.updated';
    }
}