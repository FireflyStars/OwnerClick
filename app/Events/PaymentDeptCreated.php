<?php

namespace App\Events;

use App\Models\EventMessage;
use App\Models\Payment;
use App\Models\PaymentDept;
use App\Models\Unit;
use App\Notifications\PaymentCreatedNotification;
use App\Notifications\PaymentDeptCreatedNotification;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class PaymentDeptCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels, BaseEvents;

    /**
     * @var
     */
    public $paymentDept;
    public $userId;

    /**
     * Create a new event instance.
     *
     * @param PaymentDept $paymentDept
     * @param null $userId
     */
    public function __construct(PaymentDept $paymentDept, $userId = null)
    {
        $this->data = $paymentDept;
        $paymentDept->confirmPaymentStatus();
        $this->userId = Auth::id();
//        Auth::user()->notify(new \App\Notifications\PaymentDeptCreatedNotification($paymentDept));
        $this->insertEvent(Unit::class,$this->data->unit_id);

        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }

    static function get($data){
        $eventMessage = new EventMessage();
        $eventMessage->title = __('events.payment_dept_created_title',['propertyName'=>@$data['propertyName'],'unitName'=>@$data['unitName']]);
        $eventMessage->message = __('events.payment_dept_created_message',['due_date'=>$data['due_date'],'amount'=>$data['amount'],'currency'=>$data['currency'],'payment_type_id'=>Payment::getPaymentTypes()[$data['payment_type_id']]['name']]);
        $eventMessage->icon = 'file-invoice-dollar';
        $eventMessage->color = 'text-success';
        $eventMessage->url = route('payment-depts.show',$data['id']);
        return $eventMessage;
    }

}
