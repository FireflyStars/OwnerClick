<?php

namespace App\Notifications;

use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentDeletedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
        $this->payment->propertyName = $this->payment->contract->unit->property->name;
        $this->payment->unitName = $this->payment->contract->unit->name;
        $this->payment->payment_dept_due_date = $this->payment->dept->due_date;
        $this->payment->payment_dept_amount = $this->payment->dept->amount;
        $this->payment->payment_dept_currency = $this->payment->dept->currency;
        $this->payment->payment_dept_payment_type_id = $this->payment->dept->payment_type_id;
        $this->payment->payment_dept_status_id = $this->payment->dept->status_id;

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
        return $this->payment;

    }
}
