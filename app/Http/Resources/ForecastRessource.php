<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ForecastRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'city' => $this['city']['name'] ?? 'Unknown city',
            'forecast' => array_map(function ($forecastItem) {
                return [
                    'datetime' => $forecastItem['dt_txt'],
                    'temperature' => $forecastItem['main']['temp'],
                    'humidity' => $forecastItem['main']['humidity'],
                    'weather_description' => $forecastItem['weather'][0]['description'],
                    'wind_speed' => $forecastItem['wind']['speed'],
                ];
            }, $this['list'] ?? []),
        ];
    }
}
