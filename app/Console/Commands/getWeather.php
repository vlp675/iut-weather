<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class getWeather extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-weather {place}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Affiche la météo d\'un lieu donné';

    /**
     * API Key and Base URL for OpenWeather
     */
    protected $apiKey;
    protected $baseUrl;

    /**
     * Constructor to get configuration values
     */
    public function __construct()
    {
        parent::__construct();
        $this->apiKey = config('services.openweather.key');
        $this->baseUrl = config('services.openweather.baseUrl');
    }

    /**
     * Execution of the command
     */
    public function handle()
    {
        // Get the city name from the request input
        $place = $this->argument('place');

        // Send a request to the weather API
        $response = Http::get("{$this->baseUrl}weather", [
            'q'     => $place,
            'appid' => $this->apiKey,
            'units' => 'metric',
            'lang'  => 'ang'
        ]);

        // If the response is successful 
        if ($response->successful()) {
            $data = $response->json();

            // We display all of the data to the user
            $this->info("The weather of {$data['name']} :");
            $this->line("The temperature is {$data['main']['temp']}°C");
            $this->line("The wind speed is {$data['wind']['speed']}km/h ");
            $this->line("The weather is {$data['weather'][0]['description']}");
            $this->line("The humidity is {$data['main']['humidity']}% \n");

            // With a friendly message ;)
            $this->alert("Have a great day! Especially if you're the teacher ;)");
        } else {
            // Show an error if the response is not successful
            $this->error('Impossible to find the city.');
        }
    }
}
