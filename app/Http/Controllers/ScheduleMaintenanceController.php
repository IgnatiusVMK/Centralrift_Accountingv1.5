<?php

namespace App\Http\Controllers;

use App\Models\ScheduledMaintenance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class ScheduleMaintenanceController extends Controller
{
    //

    public function index(){
        return view('system-maintenance.maintenance');
    }

    public function scheduleMaintenance(Request $request)
    {
        // Validate the request data
        $request->validate([
            'scheduled_at' => 'required|date|after:now',
            'maker_id' => 'required|max:255|integer',
        ]);

        // Create a new scheduled maintenance entry
        ScheduledMaintenance::create([
            'scheduled_at' => Carbon::parse($request->input('scheduled_at')),
            'maker_id' => $request->input('maker_id'),
        ]);

        return back()->with('success', 'Maintenance mode scheduled successfully.');
    }

    public function bringBackUp()
    {
        // Execute the 'up' command to bring the application out of maintenance mode
        Artisan::call('up');

        // Optionally, log the action or notify the user
        return back()->with('success', 'The system is now back online.');
    }
    }
