<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CaseNotifications extends Notification
{
    use Queueable;
    public $case;
    
    public function __construct($case)
    {
        $this->case = $case;
    }

    
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'id' => $this->case->case_id,
            'notify_type'=> $this->case->notify_type,
            'title' => $this->case->case_title,      
            'date' => $this->case->date,                
        ];
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
