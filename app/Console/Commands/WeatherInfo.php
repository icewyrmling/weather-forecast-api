<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class WeatherInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'info:weather';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieve forecast to the database';

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
        $cities = db::table('city')->get();
        $data;
        $opts = [
            "http" => [
                "method" => "GET",
                "header" => "Accept-language: en\r\n" .
                    "Cookie: foo=bar\r\n" .
                    "X-Requested-With: XMLHttpRequest\r\n",
            ]
        ];

        $context = stream_context_create($opts);

        $url_b = "https://cors-anywhere.herokuapp.com/http://api.weatherapi.com/v1/forecast.json?key=" . env("VUE_APP_WEATHER_API_KEY") . "&q=";
        $url_e = "&days=1&aqi=no&alerts=no";

        foreach ($cities as $city) {
            $response = file_get_contents(strval($url_b . urlencode($city->city_name) . $url_e), false, $context);

            $response = json_decode($response);

            //var_dump($response->forecast->forecastday['0']->day);

            DB::table("city")->where("city_id", $city->city_id)->update([
                "min_temp" => $response->forecast->forecastday['0']->day->mintemp_c,
                "max_temp" => $response->forecast->forecastday['0']->day->maxtemp_c,
                "precipitation" => $response->forecast->forecastday['0']->day->totalprecip_mm
            ]);
        }

        $this->info("Successfully fetched forecast.");
        return 0;
    }
}
