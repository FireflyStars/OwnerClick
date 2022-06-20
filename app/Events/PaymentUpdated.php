<?php

namespace App\Events;

use App\Models\EventMessage;
use App\Models\Payment;
use App\Models\PaymentDept;
use App\Models\Unit;
use App\Notifications\PaymentDeletedNotification;
use App\Notifications\PaymentUpdatedNotification;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class PaymentUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels, BaseEvents;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Payment $payment)
    {
        $this->data = $payment;
        $payment->dept->confirmPaymentStatus();

//        Auth::user()->notify(new PaymentUpdatedNotification($this->payment));
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
        $eventMessage->title = __('events.payment_updated_title',['propertyName'=>@$data['propertyName'],'unitName'=>@$data['unitName']]);
        $eventMessage->message = __('events.payment_updated_message',['payment_dept_due_date'=>$data['payment_dept_due_date'],'payment_dept_amount'=>$data['payment_dept_amount'],'payment_dept_currency'=>$data['payment_dept_currency'],'payment_dept_payment_type_id'=>Payment::getPaymentTypes()[$data['payment_dept_payment_type_id']]['name'],'amount'=>$data['amount'],'currency'=>$data['currency'],'payment_dept_status_id'=>PaymentDept::getSituations()[$data['payment_dept_status_id']]['name']]);
        $eventMessage->icon = 'hand-holding-usd';
        $eventMessage->color = 'text-warning';
        $eventMessage->url = route('payment-depts.show',$data['ref_payment_id']);
        return $eventMessage;
    }
}
