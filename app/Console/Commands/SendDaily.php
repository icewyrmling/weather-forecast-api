<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use DB;

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
    protected $description = 'Send a daily weather forecast to users';

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
        $users = User::all();

        foreach ($users as $user) {
            $cities = DB::table('cities_by_user')->where('user_id', $user->id)->join('city', 'cities_by_user.city_id','=','city.city_id')->get();
            $message = "<h1 style='color:#ff99ff;'>Forecast for the selected cities:</h1> <hr>";
            foreach ($cities as $city) {
                $message .= "<h3 style='color:pink';>" . strtoupper($city->city_name) . "</h3>"
                . "&ensp; Min temperature for today: <b>"
                . $city->min_temp . "</b>"
                . "<br>&ensp; Max temperature for today: <b>"
                . $city->max_temp . "</b>"
                . ($city->precipitation > 0.1 ? "<br> <p style='color:magenta'>&ensp; Bring an umbrella, it is likely to rain! </p>" : "<br>");
            }

            Mail::send([], [], function ($mail) use ($user, $message) {
                $mail->from(env('MAIL_USERNAME'));
                $mail->to($user->email)
                    ->subject('Daily forecast');
                $mail->setBody($message, 'text/html');
            });
        }

        $this->info('Successfully sent weather forecast to everyone.');
        return 0;
    }
}
