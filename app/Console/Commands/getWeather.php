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
     * API Key et Base URL pour OpenWeather
     */
    protected $apiKey;
    protected $baseUrl;

    /**
     * Constructeur pour récupérer les valeurs de configuration
     */
    public function __construct()
    {
        parent::__construct();
        $this->apiKey = config('services.openweather.key');
        $this->baseUrl = config('services.openweather.baseUrl');
    }
    
    /**
     * Exécution de la commande
     */
    public function handle()
    {
        $place = $this->argument('place');

        $response = Http::get("{$this->baseUrl}weather", [
            'q'     => $place,
            'appid' => $this->apiKey,
            'units' => 'metric',
            'lang'  => 'ang'
        ]);
        
        if ($response->successful()) {
            $data = $response->json();
            $this->info("The weather of {$data['name']} :");
            $this->line("The temperature is {$data['main']['temp']}°C");
            $this->line("The wind speed is {$data['wind']['speed']}km/h ");
            $this->line("The weather is {$data['weather'][0]['description']}");
            $this->line("The humidity is {$data['main']['humidity']}% \n");
            $this->alert("Have a great day! Especially if you're the teacher ;)");
        } else {
            $this->error('Impossible to find the city.');
        }
    }
}