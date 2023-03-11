<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\Common\CronjobController;

class LocationStatsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job:generateLocationStats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Location Stats';

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
        $controller->generateLocationStats();

        return 0;
    }

  

    

}
