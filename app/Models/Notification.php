<?php

namespace App\Models;

use App\Scopes\OwnerScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\DatabaseNotification;

class Notification extends Model
{
    use HasFactory;

    public $title;
    public $message;
    public $icon;
    public $color;
    public $type;

    public function __construct($notification = null)
    {
        switch ($notification->type) {
            case('App\Notifications\PaymentDelayedNotification'):
                $this->title = __('notifications.payment_delayed_title',['day' =>$notification->data["delayDay"]]);
                $this->message = __('notifications.payment_delayed_message',['propertyName'=>$notification->data['propertyName'],'unitName'=>$notification->data['unitName'],'payment_dept_due_date'=> $notification->data['payment_dept_due_date'],'payment_dept_amount'=>$notification->data['payment_dept_amount'],'payment_dept_currency'=>$notification->data['payment_dept_currency'],'delayDay'=>$notification->data["delayDay"]]);
                $this->icon = 'house';
                $this->color = 'bg-info';
                $this->url = route('units.show', $notification->data['contract']['unit_id']);
                $this->target = '#ajax-content';
                break;

            case('App\Notifications\NearContractExpiresNotification'):
                $this->title = __('notifications.near_contract_expires_title',['propertyName'=>@$notification->data['propertyName'],'unitName'=>@$notification->data['unitName']]) ;
                $this->message = __('notifications.near_contract_expires_message',['start_date'=>$notification->data['start_date'],'end_date' =>$notification->data['end_date'],'rental_price'=>@$notification->data['rental_price'],'rental_currency'=>@$notification->data['rental_currency'],'payment_period'=>Contract::getPaymentPeriods()[$notification->data['payment_period']]['name'],'delayDay'=>$notification->data["delayDay"]]);
                $this->icon = 'assignment';
                $this->color = 'bg-primary';
                $this->url = route('units.show', $notification->data['unit_id']);
                $this->target = '#ajax-content';
                break;
            case('App\Notifications\ReminderNotification'):
                $unitPrefix = null;
                if(isset($notification->data['unit'])){
                    $unitPrefix = __('notifications.reminder_message_prefix',['property'=>@$notification->data['unit']['property']['name'],'unit'=>@$notification->data['unit']['name']]);
                }
                $this->title =  __('notifications.reminder_title',['title'=> @$notification->data['title']]);

                $this->message =  $unitPrefix . $notification->data['note'];
                $this->icon = 'notifications';
                $this->color = 'bg-primary';
                    $this->url = route('calendar.index');
                $this->target = '#ajax-content';

                break;
        }
    }

}
