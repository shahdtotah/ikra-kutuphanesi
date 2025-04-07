<?php

namespace App\Http\Resources\V1;


use Illuminate\Http\Resources\Json\JsonResource;

class WritersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray( $request): array
    {
        return [
            "id"=> $this->id,
            "name"=> $this->name,
            "birthDate"=> $this->birthDate,
            "nationality"=> $this->nationality,
            "biography"=> $this->biography,
            "imagePath"=> $this->imagePath,      //change
        ];
    }
}
