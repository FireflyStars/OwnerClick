<?php

namespace App\Events;

use App\Models\Event;
use App\Models\File;
use App\Models\Person;
use App\Models\Property;
use App\Models\Unit;
use App\Models\UnitPerson;
use App\Models\User;
use Illuminate\Contracts\Notifications\Dispatcher;
use Illuminate\Support\Facades\Auth;

trait  BaseEvents
{

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function insertEvent($eventable_type = User::class, $eventable_id = null)
    {

        if ($this->data->unit_id and $this->data->unit) {
            $this->data->unitName = $this->data->unit->name;
            $this->data->propertyName = $this->data->unit->property->name;
            if ($eventable_id == null) {
                $eventable_id = $this->data->unit_id;
            }
        }
        if (isset($this->data->person)) {
            $this->data->personName = $this->data->person->name;
        }
        if ($this->data->contract_id) {
            if ($eventable_id == null) {
                $eventable_id = $this->data->contract->unit->id;
            }
            if (isset($this->data->contract)) {
                $this->data->unitName = $this->data->contract->unit->name;
                $this->data->propertyName = $this->data->contract->unit->property->name;
                $this->data->start_date = $this->data->contract->start_date;
                $this->data->end_date = $this->data->contract->end_date;
                $this->data->payment_period = $this->data->contract->payment_period;
                $this->data->rental_price = $this->data->contract->rental_price;
                $this->data->rental_currency = $this->data->contract->rental_currency;
            }

            $this->data->unit_id = $eventable_id;
        }
        if (get_class($this->data) === Unit::class) {
            $eventable_id = $this->data->id;
            $this->data->unitName = $this->data->name;
            $this->data->propertyName = $this->data->property->name;
        }

        if (get_class($this->data) === File::class) {
            switch ($this->data->type_id) {
                case File::FILE_TYPE_PERSON :
                    $eventable_type= Person::class;
                    $eventable_id = $this->data->person_id;
                    break;
                default:
                    $eventable_id = $this->data->unit_id;

            }
        }

        if (get_class($this->data) === Property::class) {
            $eventable_id = $this->data->id;
            $this->data->propertyName = $this->data->name;
        }

        if (get_class($this->data) === Person::class) {
            $eventable_id = $this->data->id;
            $this->data->propertyName = $this->data->name;
            $this->data->unitName = $this->data->name;
        }

        if ($this->data->ref_payment_id) {
            $this->data->payment_dept_due_date = $this->data->dept->due_date;
            $this->data->payment_dept_amount = $this->data->dept->amount;
            $this->data->payment_dept_currency = $this->data->dept->currency;
            $this->data->payment_dept_payment_type_id = $this->data->dept->payment_type_id;
            $this->data->payment_dept_status_id = $this->data->dept->status_id;
        }


        $event = new Event();
        $event->type = self::class;
        $event->creator_id = Auth::user()->id;
        $event->creator_name = Auth::user()->name;
        $event->eventable_type = $eventable_type;
        $event->eventable_id = $eventable_id;
        $event->data = $this->data->toJson();
        $event->save();
    }


}
