<?php

namespace App\Http\Controllers;

use App\Exports\EventExport;
use App\Http\Resources\Event\EventCollection;
use App\Http\Resources\Event\EventResource;
use App\Models\Category;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use CSV;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();
        return response()->json(new EventCollection($events));
    }

    public function exportCSV()
    {
        return CSV::download(new EventExport, 'event-records.csv');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' =>  'required|string|max:255',
            'description' =>  'required|string|max:255',
            'date' =>  'required|date',
            'user_id' =>  'required|integer|max:255',
            'category_id' =>  'required|integer|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $user = User::find($request->user_id);
        if (is_null($user)) {
            return response()->json('User not found', 404);
        }

        $category = Category::find($request->category_id);
        if (is_null($category)) {
            return response()->json('Category not found', 404);
        }

        $event = Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
        ]);

        return response()->json([
            'Event created' => new EventResource($event)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show($event_id)
    {
        $event = Event::find($event_id);
        if (is_null($event)) {
            return response()->json('Event not found', 404);
        }
        return response()->json(new EventResource($event));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $validator = Validator::make($request->all(), [
            'title' =>  'required|string|max:255',
            'description' =>  'required|string|max:255',
            'date' =>  'required|date',
            'user_id' =>  'required|integer|max:255',
            'category_id' =>  'required|integer|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $user = User::find($request->user_id);
        if (is_null($user)) {
            return response()->json('User not found', 404);
        }

        $category = Category::find($request->category_id);
        if (is_null($category)) {
            return response()->json('Category not found', 404);
        }

        $event->title = $request->title;
        $event->description = $request->description;
        $event->date = $request->date;
        $event->user_id = $request->user_id;
        $event->category_id = $request->category_id;

        $event->save();

        return response()->json([
            'Event updated' => new EventResource($event)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return response()->json('Event deleted');
    }
}
