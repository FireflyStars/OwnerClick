<?php

namespace App\Events;

use App\Models\EventMessage;
use App\Models\Person;
use App\Models\Unit;
use App\Notifications\PersonCreatedNotification;
use App\Notifications\PersonDeletedNotification;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class PersonDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels, BaseEvents;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Person $person)
    {
        $this->data = $person;
//        Auth::user()->notify(new PersonDeletedNotification($this->person));
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
        $eventMessage->title = __('events.person_deleted_title',['name'=>@$data['name']]);
        $eventMessage->message =  __('events.person_deleted_message',['name'=>@$data['name']]);;
        $eventMessage->icon = 'user';
        $eventMessage->color = 'text-danger';
        return $eventMessage;
    }
}
