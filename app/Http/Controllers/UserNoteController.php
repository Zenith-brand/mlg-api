<?php

namespace App\Http\Controllers;

use App\Http\Resources\NoteResource;
use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pageSize = $request->page_size ?? 5;
        $notes = Note::where('noteable_type', User::class)->paginate($pageSize);
        // $notes = Note::query()->paginate($pageSize);


        return ['status code' => 200, 'Notes' => NoteResource::collection($notes)->response()->getData(true)];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {

        //Validate data
        $data = $request->only('title', 'content');
        $validator = Validator::make($data, [
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['status code' => 400, 'message' => $validator->messages()], 400);
        }

        //Request is valid, create new note
        $note = Note::create([
            'title' => $request->title,
            'content' => $request->content,
            'noteable_id' => $user->id,
            'noteable_type' => User::class,


        ]);
        return response()->json(['status code' => 201, 'note' => new NoteResource($note)], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Note $note)
    {
        return response()->json(['status code' => 200, 'user' => new NoteResource($note)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, Note $note)
    {
        //Validate data
        $data = $request->only('title', 'content');
        $validator = Validator::make($data, [
            'title' => 'required_without:content',
            'content' => 'required_without:title',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['status code' => 400, 'message' => $validator->messages()], 400);
        }

        //Request is valid, update user
        $note->update($request->only(['title', 'content']));

        // return new NoteResource($user);
        return response()->json(['status code' => 200, 'note' => new NoteResource($note)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Note $note)
    {
        $note->delete();

        return response()->json(null, 204);
    }
}
