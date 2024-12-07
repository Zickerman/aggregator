<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LinkResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'url' => $this->url,
            'frequency' => $this->frequency,
            'retries' => $this->retries,
            'updated_at' => $this->updated_at->format('d.m.y'),
        ];
    }
}
