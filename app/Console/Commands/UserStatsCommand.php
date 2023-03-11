<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\Common\CronjobController;

class UserStatsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job:generateUserStats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate User Stats';

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
        $controller->generateUserStats();

        return 0;
    }

  

    

}
