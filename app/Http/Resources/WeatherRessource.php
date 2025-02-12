<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WeatherRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request){
        return [
            'city' => $this['name'] ?? 'Unknown city',
            'temperature' => $this['main']['temp'],
            'humidity' => $this['main']['humidity'],
            'weather_description' => $this['weather'][0]['description'],
            'wind_speed' => $this['wind']['speed'],
        ];
    }
}
