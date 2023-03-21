<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        //$schedule->command('job:sms')->runInBackground()->everyMinute();
        $schedule->call('App\Http\Controllers\Common\CronjobController@sms')->everyMinute();
        //$schedule->command('job:generateDeptStats')->runInBackground()->everyFiveMinutes();
        //$schedule->call('App\Http\Controllers\Common\CronjobController@generateDepartmentStats')->everyFiveMinutes();
        //$schedule->command('job:generateLocationStats')->runInBackground()->everyFiveMinutes();
        //$schedule->call('App\Http\Controllers\Common\CronjobController@generateLocationStats')->everyFiveMinutes();
        //$schedule->command('job:generateUserStats')->runInBackground()->everyFiveMinutes();
        //$schedule->call('App\Http\Controllers\Common\CronjobController@generateUserStats')->everyFiveMinutes();
        //$schedule->command('job:generateScheduledReports')->runInBackground()->everyMinute();
        //$schedule->call('App\Http\Controllers\Common\CronjobController@generateScheduledReports')->everyMinute();        
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
