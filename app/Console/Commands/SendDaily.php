<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\User;

class SendDaily extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends a daily email';

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
        $user = User::all();
        foreach($user as $all){
            Mail::raw("auto generated mail", function($message){
                $message->from("sophjoanna@gmail.com");
                $message->to($all->email)->subject("Daily weather");
            });
        }
        $this->info("Daily forecast was sent successfully");
    }
}
