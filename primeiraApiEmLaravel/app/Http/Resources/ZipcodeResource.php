<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ZipcodeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'UF' => $this->UF,
            'CIDADE' => $this->CIDADE,
            'CEP_INICIO_1' => $this->CEP_INICIO_1,
            'CEP_INICIO_2' => $this->CEP_INICIO_2,
            'CEP_FIM_1' => $this->CEP_FIM_1,
            'CEP_FIM_2' => $this->CEP_FIM_2,

        ];
    }
}
