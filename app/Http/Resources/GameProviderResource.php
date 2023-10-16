<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Services\DOService;

class GameProviderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $do_service = new DOService();
        $img = $do_service->retrieveFile($this->img);
        return [
            'id'   => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'img' => $img,
        ];
    }
}
