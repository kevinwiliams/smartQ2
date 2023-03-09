<?php

namespace App\Console\Commands;

use App\Http\Controllers\Common\CronjobController;
use App\Http\Controllers\Common\SMS_lib;
use Illuminate\Console\Command;
use App\Models\DisplaySetting;  
use App\Models\SmsSetting;
use App\Models\SmsHistory;  
use App\Models\Token; 
use DB, Response;
use Kutia\Larafirebase\Facades\Larafirebase;
use Mail;
use App\Models\User;
use App\Models\Location;
use App\Mail\TokenNotification;

class SmsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job:sms';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Notifications via SMS/Web';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $controller = new CronjobController();
        $controller->sms();

        return 0;
    }


}
