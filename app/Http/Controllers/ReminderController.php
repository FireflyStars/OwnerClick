<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReminderRequest;
use App\Models\DateTime;
use App\Models\Reminder;
use App\Notifications\ReminderNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ReminderController extends Controller
{

    /**
     * @param Reminder $reminder
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $data['reminder'] = Reminder::find($id);
        return view('reminders.detail',$data);
    }

    /**
     * @param Reminder $reminder
     * @return \Illuminate\View\View
     */
    public function index(Reminder $reminder)
    {

        $data = [
            'reminders' => $reminder->paginate(15),
        ];
        if(request()->ajax()){
            return view('reminders.index', $data)->renderSections()['content'];
        }else{
            return view('reminders.index', $data);
        }

    }


    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $reminder = new Reminder();
        $reminder->reminder_date = Carbon::now()->format(\auth()->user()->date_format);
        $reminder->reminder_time = Carbon::now()->format(DateTime::getTimeFormatsFromPhp()[\auth()->user()->time_format]);
        $data = [
            'reminder' => $reminder,
            'formMethod' => 'post',
            'formAction' => 'reminders.store'
        ];
        return view('reminders.create', $data);
    }

    /**
     * @param \App\Http\Requests\ReminderRequest $request
     * @param \App\Models\Reminder $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ReminderRequest $request, Reminder $model)
    {
        Carbon::setLocale(config('app.locale'));
        Carbon::setLocale('tr');
        setlocale(LC_TIME, 'tr_TR');
        $userFormat = Carbon::now()->getIsoFormats('tr')['L'] . " " . Carbon::now()->getIsoFormats('tr')['LT'];
        $inputFormat = Request::input('reminder_date') . " " . Request::input('reminder_time');
        $carbon = Carbon::createFromIsoFormat($userFormat, $inputFormat);
        if($carbon->diffInMinutes(Carbon::now(),false) > 0){
            $carbon = Carbon::now();
        }

        $send_at = $carbon->toIso8601String();

        $reminder = new Reminder();
        $reminder->creator_id = Auth::user()->id;
        $reminder->type_id = Reminder::REMINDER_TYPE_DEFAULT;
        $reminder->send_at = $send_at;
        $reminder->unit_id = $request->input('unit_id');
        $reminder->title = $request->input('title');
        $reminder->note = $request->input('note');
        $reminder->save();


      \Thomasjohnkane\Snooze\ScheduledNotification::create(
          Auth::user(), // Target
          new ReminderNotification($reminder), // Notification
          $carbon // Send At
      );

        return \response()->json(['status' => true, 'message' => ['type' => 'success', 'title' => __('alert.success'), 'text' => __('alert.reminder_created_successfully',['date' =>Request::input('reminder_date'),'title'=>$reminder->title])], 'data' => ['id' => $model->id, 'name' => $model->title]]);
    }

    /**
     * @param \App\Models\Reminder $reminder
     * @return \Illuminate\View\View
     */
    public function edit(Reminder $reminder)
    {
        Carbon::setLocale(config('app.locale'));
        Carbon::setLocale('tr');
        setlocale(LC_TIME, 'tr_TR');
        $sendAt_date = Carbon::createFromFormat(\Carbon\Carbon::DEFAULT_TO_STRING_FORMAT,$reminder->send_at);
        $sendAt_time = Carbon::createFromFormat(\Carbon\Carbon::DEFAULT_TO_STRING_FORMAT,$reminder->send_at);
        $reminder->reminder_date = $sendAt_date->isoFormat(Carbon::now()->getIsoFormats('tr')['L']);
        $reminder->reminder_time = $sendAt_time->isoFormat(Carbon::now()->getIsoFormats('tr')['LT']);
        $data = [
            'reminder' => $reminder,
            'formMethod' => 'PUT',
            'formAction' => 'reminders.update'
        ];

        return view('reminders.create', $data);
    }

    /**
     * @param \App\Http\Requests\ReminderRequest $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ReminderRequest $request, Reminder $reminder)
    {
        Carbon::setLocale(config('app.locale'));
        Carbon::setLocale('tr');
        setlocale(LC_TIME, 'tr_TR');
        $userFormat = Carbon::now()->getIsoFormats('tr')['L'] . " " . Carbon::now()->getIsoFormats('tr')['LT'];
        $inputFormat = Request::input('reminder_date') . " " . Request::input('reminder_time');
        $carbon = Carbon::createFromIsoFormat($userFormat, $inputFormat);
        $send_at = $carbon->toIso8601String();
        if($carbon->diffInMinutes(Carbon::now(),false) > 0){
            $carbon = Carbon::now();
        }
        $reminder->update($request->all());
        $reminder->send_at = $send_at;
        $reminder->save();

        return \response()->json(['status' => true, 'message' => ['type' => 'success', 'title' => __('alert.success'), 'text' =>  __('alert.reminder_created_successfully',['date' =>Request::input('reminder_date'),'title'=>$reminder->title])], 'data' => ['id' => $reminder->id, 'name' => $reminder->name]]);
    }

    /**
     * @param \App\Models\Reminder $reminder
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Reminder $reminder)
    {
        $reminder->delete();
    }
}
