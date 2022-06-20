<?php

namespace App\Events;

use App\Models\Contract;
use App\Models\EventMessage;
use App\Models\Unit;
use App\Notifications\ContractDeletedNotification;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class ContractDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels, BaseEvents;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Contract $contract)
    {
        $this->data = $contract;
//        Auth::user()->notify(new ContractDeletedNotification($this->contract));
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
        $eventMessage->title = __('events.contract_deleted_title',['propertyName'=>@$data['propertyName'],'unitName'=>@$data['unitName']]);
        $eventMessage->message = '<strong>' . $data['start_date'] . "-" . $data['end_date'] . "</strong> tarihleri arasında <strong>" . @$data['rental_price'] . @$data['rental_currency'] . '</strong> tutarında <strong>' . Contract::getPaymentPeriods()[$data['payment_period']]['name'] . '</strong> ';
        $eventMessage->message  = __('events.contract_deleted_message',['start_date'=>$data['start_date'],'end_date'=>$data['end_date'],'rental_price'=>@$data['rental_price'],'rental_currency'=>@$data['rental_currency'],'payment_period'=>Contract::getPaymentPeriods()[$data['payment_period']]['name']]);
        $eventMessage->icon = 'assignment';
        $eventMessage->color = 'text-danger';
        return $eventMessage;
    }
}
