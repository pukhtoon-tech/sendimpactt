<?php

namespace App\Http\Resources;
use App\Models\SmtpServer;

use Illuminate\Http\Resources\Json\JsonResource;

class SmtpResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
