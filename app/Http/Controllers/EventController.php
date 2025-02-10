<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function create(Request $request)
    {
        $fields = $request->validate([
            "event_name" => ['required'],
            "date" => ['required', 'date'],
            "checkIn_start" => ['required', "date_format:H:i"],
            "checkIn_end" => ['required', "date_format:H:i", "after:checkIn_start"],
            "checkOut_start" => ['required', "date_format:H:i", "after:checkIn_end"],
            "checkOut_end" => ['required', "date_format:H:i", "after:checkOut_start"],
        ]);

        date_default_timezone_set('Asia/Manila');
        
        // Create event with all required fields
        Event::create([
            'event_name' => $fields['event_name'],
            'checkIn_start' => $fields['checkIn_start'],
            'checkIn_end' => $fields['checkIn_end'],
            'checkOut_start' => $fields['checkOut_start'],
            'checkOut_end' => $fields['checkOut_end'],
            'date' => $fields['date'],
            'admin_id' => Auth::id() // Get the current authenticated user's ID
        ]);

        return back()->with(["success" => "Event created successfully"]);
    }

    public function view()
    {
        $events = Event::all();
        return view('pages.events', compact('events'));
    }

    public function delete(Request $request)
    {
        $request->validate([
            "id" => ['required']
        ]);

        Event::find($request->id)->delete();
        return back()->with(["successful" => "Event deleted successfully"]);
    }

    public function update(Request $request)
    {
        $event = Event::find($request->id);
        
        if (!$event) {
            return back()->with('error', 'Event not found');
        }

        $event->update([
            'event_name' => $request->event_name,
            'date' => $request->date,
            'checkIn_start' => $request->checkIn_start,
            'checkIn_end' => $request->checkIn_end,
            'checkOut_start' => $request->checkOut_start,
            'checkOut_end' => $request->checkOut_end,
        ]);

        return back()->with('success', 'Event updated successfully');
    }

    // Add this method to check fines in real-time
    public function checkCurrentFines(Event $event)
    {
        $currentTime = now()->format('H:i');
        
        // Only calculate fines if we're past the check-out end time
        if ($currentTime > $event->checkOut_end) {
            app(FineController::class)->calculateEventFines($event);
        }
        
        return back()->with('success', 'Fines calculated successfully');
    }

    // Update the completeEvent method
    public function completeEvent($id)
    {
        $event = Event::findOrFail($id);
        
        // Calculate final fines for the event
        app(FineController::class)->calculateEventFines($event);
        
        $event->update(['status' => 'completed']); // Status value is now properly quoted
        
        return redirect()->route('logs')->with('success', 'Event completed and fines calculated successfully');
    }
}
