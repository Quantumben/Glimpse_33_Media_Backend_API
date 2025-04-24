<?php

namespace App\Http\Resources;

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
        return [
            'id' => $this->id,
            'first_name' => $this->whenNotNull($this->first_name),
            'last_name' => $this->whenNotNull($this->last_name),
            'email' => $this->whenNotNull($this->email),
            'phone_number' => $this->whenNotNull($this->phone_number),
            'email_verified_at' => $this->whenNotNull($this->email_verified_at),
            'token' => $this->whenNotNull($this->token),
        ];
    }
}
