<?php

namespace App\Events;

use App\Models\EventMessage;
use App\Models\Outgoing;
use App\Models\Unit;
use App\Notifications\OutgoingCreatedNotification;
use App\Notifications\OutgoingDeletedNotification;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class OutgoingDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels, BaseEvents;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Outgoing $outgoing)
    {
        $this->data = $outgoing;
//        Auth::user()->notify(new OutgoingDeletedNotification($this->outgoing));
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
        $eventMessage->title = __('events.outgoing_deleted_title',['propertyName'=>@$data['propertyName'],'unitName'=>@$data['unitName']]);
        $eventMessage->message = __('events.outgoing_deleted_message',['payment_type_id'=>Outgoing::getPropertyTypes()[$data['payment_type_id']]['name'],'amount'=>$data['amount'],'currency'=>$data['currency'], 'name'=>$data['name']]);
        $eventMessage->icon = 'paint-roller';
        $eventMessage->color = 'text-danger';
        return $eventMessage;
    }
}
