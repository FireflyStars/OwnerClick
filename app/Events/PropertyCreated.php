<?php

namespace App\Events;

use App\Models\EventMessage;
use App\Models\Property;
use App\Models\Unit;
use App\Notifications\PropertyCreatedNotification;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class PropertyCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels, BaseEvents;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Property $property)
    {
        $this->data = $property;
//        Auth::user()->notify(new PropertyCreatedNotification($this->property));
        $this->insertEvent(Property::class,$this->data->unit_id);

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
        $eventMessage->title = __('events.property_created_title',['propertyName'=>@$data['propertyName'],'unitName'=>@$data['unitName']]);
        $eventMessage->message = __('events.property_created_message',['address'=>$data['address'],'type_id'=>Property::getTypes()[$data['type_id']]['name']]);
        $eventMessage->icon = Property::getIconClass($data['type_id']);
        $eventMessage->color = 'text-success';
        return $eventMessage;
    }
}
