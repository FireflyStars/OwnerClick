<?php

namespace App\Events;

use App\Models\EventMessage;
use App\Models\Person;
use App\Models\Unit;
use App\Models\UnitPerson;
use App\Notifications\UnitPersonCreatedNotification;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class UnitPersonCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels, BaseEvents;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(UnitPerson $unitPerson)
    {
        $this->data = $unitPerson;
//        Auth::user()->notify(new UnitPersonCreatedNotification($this->unitPerson));
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
        $eventMessage->title = __('events.unit_person_created_title',['propertyName'=>@$data['propertyName'],'unitName'=>@$data['unitName']]);
        $eventMessage->message =  __('events.unit_person_created_message',['personName'=>$data['personName'],'share'=>$data['share'],'type_id'=>UnitPerson::getUnitPersonTypes()[$data['type_id']]['name']]);
        $eventMessage->icon = 'user-tag';
        $eventMessage->color = 'text-success';
        return $eventMessage;
    }
}
