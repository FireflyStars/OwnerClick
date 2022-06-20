<?php

namespace App\Events;

use App\Models\Contract;
use App\Models\Event;
use App\Models\PaymentDept;
use App\Notifications\ContractCreatedNotification;
use App\Notifications\NearContractExpiresNotification;
use App\Notifications\PaymentDelayedNotification;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class NearContractExpires
{
    use Dispatchable, InteractsWithSockets, SerializesModels, BaseEvents;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Contract $contract,$delayDay)
    {
        $this->contract = $contract;
//        \Illuminate\Support\Facades\Notification::fake();

        Auth::user()->notify(new NearContractExpiresNotification($this->contract,$delayDay));
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

}
