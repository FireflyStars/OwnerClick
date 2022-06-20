<?php

namespace App\Events;

use App\Models\EventMessage;
use App\Models\Fixture;
use App\Models\Unit;
use App\Notifications\FixtureCreatedNotification;
use App\Notifications\FixtureUpdatedNotification;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class FixtureUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels, BaseEvents;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Fixture $fixture)
    {
        $this->data = $fixture;
//        Auth::user()->notify(new FixtureUpdatedNotification($this->fixture));
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
        $eventMessage->title = __('events.fixture_updated_title',['propertyName'=>@$data['propertyName'],'unitName'=>@$data['unitName']]);
        $eventMessage->message = __('events.fixture_updated_message',['name'=>$data['name']]);
        $eventMessage->icon = 'chair';
        $eventMessage->color = 'text-warning';
        return $eventMessage;
    }
}
