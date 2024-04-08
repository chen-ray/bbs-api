<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class CalculateActiveUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bbs:calculate-active-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate active users';

    /**
     * Execute the console command.
     */
    public function handle(User $user)
    {
        // print a message in console
        $this->info("Begin to calculate");

        $user->calculateAndCacheActiveUsers();

        $this->info("Calculation complete！");
    }
}
