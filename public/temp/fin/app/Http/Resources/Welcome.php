<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Welcome extends JsonResource {

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'university' => $this->university,
            'lecturer' => $this->lecturer,
            'team_name' => $this->team_name
        ];
    }

}
