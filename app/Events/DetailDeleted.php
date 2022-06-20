<?php

namespace App\Events;

use App\Models\Detail;
use App\Models\EventMessage;
use App\Models\Unit;
use App\Notifications\DetailCreatedNotification;
use App\Notifications\DetailDeletedNotification;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class DetailDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels, BaseEvents;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Detail $detail)
    {
        $this->data = $detail;
//        Auth::user()->notify(new DetailDeletedNotification($this->detail));
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
        $eventMessage->title = __('events.detail_deleted_title',['propertyName'=>@$data['propertyName'],'unitName'=>@$data['unitName']]);
        $eventMessage->message = __('events.detail_deleted_message',['detail'=>$data['detail']]);
        $eventMessage->icon = 'info';
        $eventMessage->color = 'text-danger';
        return $eventMessage;
    }
}
