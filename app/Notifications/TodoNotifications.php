<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TodoNotifications extends Notification
{
    use Queueable;
    public $todo;
  
    public function __construct($todo)
    {
        $this->todo = $todo;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'id' => $this->todo->id,
            'title' => $this->todo->title,
            'creator' => $this->todo->created_user->name,
            'assignee' => $this->todo->assigned_user->name,
            'start_date' => $this->todo->start_date,
            'end_date' => $this->todo->end_date,
            'type' => $this->todo->status == 'A' ? 'awaiting' : ($this->todo->status == 'C' ? 'completed' : ($this->todo->status == 'P' ? 'pending' : 'missed'))

        ];
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
