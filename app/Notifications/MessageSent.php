<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MessageSent extends Notification
{
    use Queueable;

    protected $senderName;

    // 👇 هادي باش تمرر اسم المرسل
    public function __construct($senderName)
    {
        $this->senderName = $senderName;
    }

    public function via($notifiable)
    {
        return ['database']; // 👈 باش يدار ف notifications table + email
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting('Hello!')
            ->line('You have received a new message from ' . $this->senderName)
            ->action('View Messages', url('/messages')) // بدل الرابط حسب المسار ديالك
            ->line('Thank you for using our application!');
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'New message from ' . $this->senderName,
        ];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'New message from ' . $this->senderName,
        ];
    }
}
