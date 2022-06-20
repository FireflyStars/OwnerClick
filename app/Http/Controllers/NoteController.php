<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Fixture;
use App\Http\Requests\NoteRequest;
use App\Models\Note;
use App\Http\Requests\UserRequest;
use App\Models\User;
use http\Env\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

class NoteController extends Controller
{

    /**
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $data['note'] = Note::find($id);
        return view('notes.detail', $data);

    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data = [
            'note' => new Note(),
            'formMethod' => 'post',
            'formAction' => 'notes.store'
        ];
        return view('notes.create', $data);
    }

    /**
     * @param \App\Http\Requests\UserRequest $request
     * @param \App\Models\Note $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(NoteRequest $request, Note $model)
    {
        $model = Note::create($request->merge(['creator_id' => Auth::id()])->all());
        $files = (array)\Illuminate\Support\Facades\Request::input('files');

        foreach ($files as $file) {
            $fileUpdate = File::find($file);
            $fileUpdate->temp = 0;
            $fileUpdate->note_id = $model->id;
            $fileUpdate->unit_id = $model->unit_id;
            $fileUpdate->save();
        }
        $response = [
            'status' => true,
            'message' => ['type' => 'success', 'title' => __('alert.success'), 'text' => __('alert.note_created_successfully')],
            'data' => ['id' => $model->id, 'name' => $model->name]
        ];
        return \response()->json($response, \Illuminate\Http\Response::HTTP_CREATED);
    }

    /**
     * @param \App\Models\Note $note
     * @return \Illuminate\View\View
     */
    public function edit(Note $note)
    {
        $data = [
            'note' => $note,
            'formMethod' => 'PUT',
            'formAction' => 'notes.update'
        ];

        return view('notes.create', $data);
    }

    /**
     * @param \App\Http\Requests\NoteRequest $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(NoteRequest $request, Note $note)
    {
        $note->update($request->all());

        $files = (array)\Illuminate\Support\Facades\Request::input('files');

        foreach ($files as $file) {
            $fileUpdate = File::find($file);
            $fileUpdate->temp = 0;
            $fileUpdate->note_id = $note->id;
            $fileUpdate->unit_id = $note->unit_id;
            $fileUpdate->save();
        }
        return \response()->json(['status' => true, 'message' => ['type' => 'success', 'title' => __('alert.success'), 'text' => __('alert.note_updated_successfully')], 'data' => ['id' => $note->id, 'name' => $note->name]]);
    }

    /**
     * @param \App\Models\Note $note
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Note $note)
    {
        $note->delete();
    }
}
