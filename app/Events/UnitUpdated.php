<?php

namespace App\Events;

use App\Models\EventMessage;
use App\Models\Unit;
use App\Notifications\UnitCreatedNotification;
use App\Notifications\UnitUpdatedNotification;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class UnitUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels, BaseEvents;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Unit $unit)
    {
        $this->data = $unit;
//        Auth::user()->notify(new UnitUpdatedNotification($this->unit));
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
        $eventMessage->title = __('events.unit_updated_title',['propertyName'=>@$data['propertyName'],'unitName'=>@$data['unitName']]);
        $eventMessage->message = __('events.unit_updated_message',['propertyName'=>$data['propertyName'],'name'=>@$data['name']]);
        $eventMessage->icon =Unit::getIconClass($data['type_id']);
        $eventMessage->color = 'text-warning';
        return $eventMessage;
    }
}
