<?php

namespace App\Notifications;

use App\Models\PaymentDept;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentDeptDeletedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(PaymentDept $paymentDept)
    {
        $this->paymentDept = $paymentDept;
        $this->paymentDept->propertyName = $this->paymentDept->contract->unit->property->name;
        $this->paymentDept->unitName = $this->paymentDept->contract->unit->name;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }



    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return $this->paymentDept;
    }
}
