<?php

namespace App\Http\Controllers\Calendar;

use App\Http\Controllers\Controller;
use App\Models\Events\Event;
use App\Models\Users\User;
use App\Models\Users\User_workplace;
use App\Models\Workplaces\Workplace;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminCalendarController extends Controller
{
    public function index()
    {
        $events = Event::all();
        $workplaces = Workplace::all();
        $users = User::all();

        $formattedEvents = $events->map(function ($event) {
            $color = '#1B3D73';

            if ($event->workplace_id == 1) {
                $color = '#A756ED';
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

        return view('calendar.admin.admin', [
            'events' => $formattedEvents,
            'workplaces' => $workplaces,
            'users' => $users
        ]);
    }

    public function getWorkplaces($userId)
    {
        $user = User::find($userId);
        $workplaces = $user->workplaces;
        return response()->json($workplaces);
    }

    public function getWorkplacesByUser($userId = null)
    {
        if ($userId) {
            $userWorkplaces = User_workplace::where('user_id', $userId)
                ->with('workplace')
                ->get()
                ->pluck('workplace');
        } else {
            $userWorkplaces = Workplace::all();
        }

        return response()->json($userWorkplaces);
    }

    public function createAdminTask(Request $request)
    {
        $adminId = Auth::id();

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'start' => 'required|date_format:Y-m-d\TH:i',
            'end' => 'required|date_format:Y-m-d\TH:i|after_or_equal:start',
            'workplace_id' => 'nullable|exists:workplaces,id',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $userId = $validatedData['user_id'] ?? $adminId;
        $workplaceId = $validatedData['workplace_id'];

        $startDateTime = Carbon::parse($validatedData['start']);
        $endDateTime = Carbon::parse($validatedData['end']);

        $event = Event::create([
            'title' => $validatedData['title'],
            'startDate' => $startDateTime->format('Y-m-d'),
            'start' => $startDateTime->format('H:i'),
            'endDate' => $endDateTime->format('Y-m-d'),
            'end' => $endDateTime->format('H:i'),
            'user_id' => $userId,
            'workplace_id' => $workplaceId
        ]);

        return response()->json($event);
    }


    public function updateAdminTask(Request $request, $id)
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

    public function deleteAdminEvent($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return response()->json($event);
    }
}
