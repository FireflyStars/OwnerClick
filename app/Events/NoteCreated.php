<?php

namespace App\Events;

use App\Models\Event;
use App\Models\EventMessage;
use App\Models\Note;
use App\Models\Unit;
use App\Notifications\NoteCreatedNotification;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class NoteCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels, BaseEvents;


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Note $note)
    {
        $this->data = $note;
//        Auth::user()->notify(new NoteCreatedNotification($this->data));
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
        $eventMessage->title = __('events.note_created_title',['propertyName'=>@$data['propertyName'],'unitName'=>@$data['unitName']]);
        $eventMessage->message = __('events.note_created_message',['title'=>$data['title']]);
        $eventMessage->icon = 'quote-right';
        $eventMessage->color = 'text-success';
        $eventMessage->url = route('notes.show',$data['id']);

        return $eventMessage;
    }

}
