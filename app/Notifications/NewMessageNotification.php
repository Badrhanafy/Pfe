<?php
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;

class NewMessageNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['database']; // ghadi tsift notification l database
    }

    public function toDatabase($notifiable)
    {
        return [
            'sender_id' => $this->message->sender_id,
            'message_id' => $this->message->id,
            'content' => $this->message->message,
        ];
    }
}

