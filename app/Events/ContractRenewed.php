<?php

namespace App\Events;

use App\Models\Contract;
use App\Models\EventMessage;
use App\Models\Unit;
use App\Notifications\ContractCreatedNotification;
use App\Notifications\ContractRenewedNotification;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class ContractRenewed
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
//        $this->contract->propertyName = $this->contract->unit->property->name;
//        $this->contract->unitName = $this->contract->unit->name;
//        Auth::user()->notify(new ContractRenewedNotification($this->contract));
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
        $eventMessage->title = __('events.contract_renewed_title',['propertyName'=>@$data['propertyName'],'unitName'=>@$data['unitName']]);
        $eventMessage->message = __('events.contract_renewed_message',['start_date'=>$data['start_date'],'end_date'=>$data['end_date'],'rental_price'=>@$data['rental_price'], 'rental_currency'=>@$data['rental_currency'],'payment_period'=>Contract::getPaymentPeriods()[$data['payment_period']]['name']]);
        $eventMessage->icon = 'file-signature';
        $eventMessage->color = 'text-warning';
        return $eventMessage;
    }
}
