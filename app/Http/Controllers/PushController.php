<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Unit;
use App\Notifications\ReadNotificationNotification;
use App\Notifications\UnreadNotificationNotification;
use Illuminate\Http\Request;
use App\Notifications\PushDemo;
use App\User;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Support\Facades\Auth;
use Notification;

class PushController extends Controller
{


    /**
     * Store the PushSubscription.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'endpoint' => 'required',
            'keys.auth' => 'required',
            'keys.p256dh' => 'required'
        ]);
        $endpoint = $request->endpoint;
        $token = $request->keys['auth'];
        $key = $request->keys['p256dh'];
        $user = Auth::user();
        $user->updatePushSubscription($endpoint, $key, $token);

        return response()->json(['success' => true], 200);
    }

    public function notifications(Request $request)
    {
        /**
         * @var $notifications DatabaseNotificationCollection
         */
        $notifications = Auth::user()->notifications()->paginate(10);
        return view('notifications.sections', ['notifications' => $notifications]);
    }

    public function events(Request $request,$unit_id = null)
    {
        /**
         * @var $notifications DatabaseNotificationCollection
         */
        if ($unit_id == null) {
            $events = Event::query();
        } else {
            $events = Event::query()->where('eventable_type', Unit::class)->where('eventable_id', $unit_id);
        }

        $result = ['events' => $events->orderBy('id','desc')->paginate(15),'unitId'=>$unit_id];
        return view('events.sections', $result);
    }



    public function readNotifications($notificationId)
    {
        $notification = DatabaseNotification::find($notificationId);
        $notification->markAsRead();
        Auth::user()->notify(new ReadNotificationNotification($notification->id));


    }

    public function unreadNotifications($notificationId)
    {
        $notification = DatabaseNotification::find($notificationId);
        $notification->markAsUnread();
        Auth::user()->notify(new UnreadNotificationNotification($notification->id));

    }


}
