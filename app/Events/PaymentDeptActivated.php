<?php

namespace App\Events;

use App\Models\EventMessage;
use App\Models\Payment;
use App\Models\PaymentDept;
use App\Models\Unit;
use App\Notifications\PaymentDeptDeletedNotification;
use App\Notifications\PaymentDeptUpdatedNotification;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class PaymentDeptActivated
{
    use Dispatchable, InteractsWithSockets, SerializesModels, BaseEvents;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(PaymentDept $paymentDept)
    {
        $this->data = $paymentDept;
//        Auth::user()->notify(new PaymentDeptUpdatedNotification($this->paymentDept));
        $this->insertEvent(Unit::class,$this->data->unit_id);

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
        $eventMessage->title = __('events.payment_dept_activated_title',['propertyName'=>@$data['propertyName'],'unitName'=>@$data['unitName']]);
        $eventMessage->message = __('events.payment_dept_activated_message',['due_date'=>$data['due_date'],'amount'=>$data['amount'],'currency'=>$data['currency'],'payment_type_id'=>Payment::getPaymentTypes()[$data['payment_type_id']]['name']]);
        $eventMessage->icon = 'file-invoice-dollar';
        $eventMessage->color = 'text-warning';
        $eventMessage->url = route('payment-depts.show',$data['id']);
        return $eventMessage;
    }
}
