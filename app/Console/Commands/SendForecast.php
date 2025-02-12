<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Models\UserPlaces;
use App\Notifications\NotificationForecast;

class SendForecast extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send daily report emails to subscribed users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get all subscribed users
        $subscribedUsers = UserPlaces::where('send_forecast', true)->get();

        foreach ($subscribedUsers as $subscription) {
            $user = User::find($subscription->user_id);
            if ($user) {
                try {
                    $filePath = $this->makeCSV("Dennevy");

                    // Send the mail
                    $user->notify(new NotificationForecast($filePath));
                } catch (\Exception $e) {
                    $this->error("Failed to send email to {$user->email}: {$e->getMessage()}");
                }
            }
        }

        $this->info('All daily report emails have been sent.');
    }

    protected $apiKey;
    protected $baseUrl;

    public function makeCSV($city)
    {
        $this->apiKey = config('services.openweather.key');
        $this->baseUrl = config('services.openweather.baseUrl');


        $response = Http::get("$this->baseUrl/forecast", [
            'q' => $city,
            'appid' => $this->apiKey,
            'units' => 'metric',
            'lang' => 'fr',
        ]);

        if ($response->failed()) {
            return redirect()->back()->with('error', 'Unable to get weather data to generate CSV');
        }

        $data = $response->json();


        // $headers = [
        //     'Content-Type' => 'text/csv',
        //     'Content-Disposition' => "attachment; filename=\"{$city}_weather.csv\"",
        // ];
        $filePath = public_path() . "/data/" . (string)$data['list'][0]['dt'] . $city . ".csv";

        // Generate CSV
        // fputcsv function to create a csv

        $file = fopen($filePath, 'w');
        // head csv
        fputcsv($file, ['Time', 'Temperature (°C)', 'Description', 'Humidity (%)']);
        // data weather

        for ($i = 0; $i < count($data['list']) / 5 - 1; $i++) {
            fputcsv($file, [
                date('H:i:s', $data['list'][$i]['dt']),
                $data['list'][$i]['main']['temp'],
                $data['list'][$i]['weather'][0]['description'],
                $data['list'][$i]['main']['humidity'],
            ]);
        }

        fclose($file);

        return $filePath;
    }
}
