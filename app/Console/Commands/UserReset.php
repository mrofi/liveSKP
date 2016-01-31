<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class UserReset extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:reset {--password=abdinegara}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset Password Semua User';

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
     * @return mixed
     */
    public function handle()
    {
        User::whereNotNull('id')->update(['password' => bcrypt($this->option('password'))]);
    }
}
