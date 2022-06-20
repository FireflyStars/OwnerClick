<?php

namespace App\Notifications;

use App\Models\Contract;
use App\Models\ContractTerminate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReadNotificationNotification extends Notification
{
    use Queueable;
    public $notification;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($notificationId)
    {
        $this->notification = $notificationId;

    }


    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['broadcast'];
    }



    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toBroadcast($notifiable)
    {
        return ['nid'=>$this->notification];
    }
}
