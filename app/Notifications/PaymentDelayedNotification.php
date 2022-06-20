<?php

namespace App\Notifications;

use App\Models\Payment;
use App\Models\PaymentDept;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushChannel;
use NotificationChannels\WebPush\WebPushMessage;

class PaymentDelayedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(PaymentDept $paymentDept, $delayDay = 0)
    {
        $this->delayDay = $delayDay;
        $this->paymentDept = $paymentDept;
        $this->paymentDept->propertyName = $this->paymentDept->contract->unit->property->name;
        $this->paymentDept->unitName = $this->paymentDept->contract->unit->name;
        $this->paymentDept->payment_dept_due_date = $this->paymentDept->due_date;
        $this->paymentDept->payment_dept_amount = $this->paymentDept->amount;
        $this->paymentDept->payment_dept_currency = $this->paymentDept->currency;
        $this->paymentDept->payment_dept_payment_type_id = $this->paymentDept->payment_type_id;
        $this->paymentDept->payment_dept_status_id = $this->paymentDept->status_id;
        $this->paymentDept->delayDay = $delayDay;

        $data = new \stdClass();
        $data->type = self::class;
        $data->data = (array)json_decode(json_encode($this->paymentDept),true);
        $this->notification = new \App\Models\Notification($data);

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['broadcast', 'database',WebPushChannel::class];
    }

    /**
     * @param mixed $notifiable
     * @return BroadcastMessage
     */
    public function toBroadcast($notifiable)
    {




        return new BroadcastMessage([
            'title' => $this->notification->title,
            'message' => $this->notification->message,
            'icon' => $this->notification->icon,
            'color' => $this->notification->color,
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
        return $this->paymentDept;
    }

    public function toWebPush($notifiable, $notification)
    {


        return (new WebPushMessage())
            ->title($this->notification->title)
            ->icon('/images/icons/icon-96x96.png')
            ->body($this->notification->message)
            ->action('Görüntüle', 'http://www.google.com')
            ->action('Görüntüle 123', 'view_account')
            ->badge(1)
            ->options(['TTL' => 1000]);
        // ->data(['id' => $notification->id])
        // ->dir()
        // ->image()
        // ->lang()
        // ->renotify()
        // ->requireInteraction()
        // ->tag()

    }
}
