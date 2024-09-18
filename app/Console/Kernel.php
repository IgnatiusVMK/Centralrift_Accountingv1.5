<?php

namespace App\Console;

use App\Models\ScheduledMaintenance;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            // Check for any scheduled maintenance that is due
            $maintenance = ScheduledMaintenance::where('is_completed', false)
                ->where('scheduled_at', '<=', now())
                ->first();

            if ($maintenance) {
                Artisan::call('down');
                $maintenance->update(['is_completed' => true]);
            }
        })->everyMinute();
    }
        
    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
    
}
