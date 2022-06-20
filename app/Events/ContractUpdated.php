<?php

namespace App\Events;

use App\Models\Contract;
use App\Models\EventMessage;
use App\Models\Unit;
use App\Notifications\ContractCreatedNotification;
use App\Notifications\ContractUpdatedNotification;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class ContractUpdated
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
//        Auth::user()->notify(new ContractUpdatedNotification($this->contract));
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
        $eventMessage->title = __('events.contract_updated_title',['propertyName'=>@$data['propertyName'],'unitName'=>@$data['unitName']]);
        $eventMessage->message =  __('events.contract_updated_title');
        $eventMessage->icon = 'assignment';
        $eventMessage->color = 'text-warning';
        return $eventMessage;
    }

}
