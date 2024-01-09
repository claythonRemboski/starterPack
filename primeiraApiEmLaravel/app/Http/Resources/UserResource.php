<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $formattedCreated = $this->created_at ? Carbon::make($this->created_at)->format('Y-m-d') : null;
        return [
            'identify' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'created' => $formattedCreated,
        ];
    }
}
