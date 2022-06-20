<?php

namespace App\Events;

use App\Models\EventMessage;
use App\Models\File;
use App\Models\Unit;
use App\Notifications\FileDeletedNotification;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class FileDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels, BaseEvents;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(File $file)
    {
        $this->data = $file;
//        Auth::user()->notify(new FileDeletedNotification($this->file));
        $this->insertEvent(Unit::class,$this->data->unit_id);

        //
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
        $eventMessage->title = __('events.file_deleted_title');
        $eventMessage->message = __('events.file_deleted_message',['name'=>@$data['name']]);
        $eventMessage->icon = 'unlink';
        $eventMessage->color = 'text-danger';
        return $eventMessage;
    }
}
