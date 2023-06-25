<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotepadContactResource extends JsonResource
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
            'full_name' => $this->full_name,
            'company_name' => $this->whenNotNull($this->company_name),
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'birth_date' => $this->whenNotNull($this->birth_date),
            'photo' => $this->whenNotNull($this->photo),
        ];
    }
}
