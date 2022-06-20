<?php

namespace App\Notifications;

use App\Models\Contract;
use App\Models\Payment;
use App\Models\PaymentDept;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NearContractExpiresNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Contract $contract, $delayDay = 0)
    {
        $this->contract = $contract;
        $this->contract->delayDay = $delayDay;
        $this->contract->propertyName = $this->contract->unit->property->name;
        $this->contract->unitName = $this->contract->unit->name;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['broadcast', 'database'];
    }

    /**
     * @param mixed $notifiable
     * @return BroadcastMessage
     */
    public function toBroadcast($notifiable)
    {
        $data = new \stdClass();
        $data->type = self::class;
        $data->data = (array)json_decode(json_encode($this->contract));
        $notification = new \App\Models\Notification($data);
        return new BroadcastMessage([
            'title' => $notification->title,
            'message' => $notification->message,
        ]);
    }


    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return $this->contract;
    }


}
