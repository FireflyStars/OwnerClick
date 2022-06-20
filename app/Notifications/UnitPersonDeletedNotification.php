<?php

namespace App\Notifications;

use App\Models\Person;
use App\Models\UnitPerson;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UnitPersonDeletedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(UnitPerson $unitPerson)
    {
        $this->unitPerson = $unitPerson;
        $this->unitPerson->propertyName = $this->unitPerson->unit->property->name;
        $this->unitPerson->unitName = $this->unitPerson->unit->name;
        $this->unitPerson->personName = $this->unitPerson->person->name;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }



    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return $this->unitPerson;
    }
}
