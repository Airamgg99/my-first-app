<?php

namespace App\Http\Controllers\Calendar;

use App\Http\Controllers\Controller;
use App\Models\Events\Event;
use App\Models\Users\User_workplace;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserCalendarController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $events = Event::where('user_id', $userId)->get();
        $userWorkplaces = User_workplace::where('user_id', $userId)
            ->with('workplace')
            ->get()
            ->pluck('workplace');

        $formattedEvents = $events->map(function ($event) {
            $color = '#1B3D73';

            if ($event->workplace_id == 1) {
                $color = '#B233FF';
            } elseif ($event->workplace_id == 2) {
                $color = '#A8E864';
            } elseif ($event->workplace_id == 3) {
                $color = '#33B2FF';
            }

            return [
                'id' => $event->id,
                'title' => $event->title,
                'start' => $event->startDate . 'T' . $event->start,
                'end' => $event->endDate . 'T' . $event->end,
                'user_id' => $event->user_id,
                'workplace_id' => $event->workplace_id,
                'color' => $color,
            ];
        });

        return view('calendar.user.user', [
            'events' => $formattedEvents,
            'workplaces' => $userWorkplaces
        ]);
    }


    public function createUserTask(Request $request)
    {
        $userId = Auth::id();

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'start' => 'required|date_format:Y-m-d\TH:i',
            'end' => 'required|date_format:Y-m-d\TH:i|after_or_equal:start',
            'workplace_id' => 'required|exists:workplaces,id',
        ]);

        $startDateTime = Carbon::parse($validatedData['start']);
        $endDateTime = Carbon::parse($validatedData['end']);

        $event = Event::create([
            'title' => $validatedData['title'],
            'startDate' => $startDateTime->format('Y-m-d'),
            'start' => $startDateTime->format('H:i'),
            'endDate' => $endDateTime->format('Y-m-d'),
            'end' => $endDateTime->format('H:i'),
            'user_id' => $userId,
            'workplace_id' => $validatedData['workplace_id']
        ]);

        return response()->json($event);
    }

    public function updateUserTask(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'start' => 'required|date_format:Y-m-d\TH:i',
            'end' => 'required|date_format:Y-m-d\TH:i|after_or_equal:start',
            'workplace_id' => 'required|exists:workplaces,id',
        ]);

        $event = Event::findOrFail($id);

        $startDateTime = Carbon::parse($validatedData['start']);
        $endDateTime = Carbon::parse($validatedData['end']);

        $event->update([
            'title' => $validatedData['title'],
            'startDate' => $startDateTime->format('Y-m-d'),
            'start' => $startDateTime->format('H:i'),
            'endDate' => $endDateTime->format('Y-m-d'),
            'end' => $endDateTime->format('H:i'),
            'workplace_id' => $validatedData['workplace_id']
        ]);

        return response()->json($event);
    }

    public function deleteUserEvent($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return response()->json($event);
    }
}
