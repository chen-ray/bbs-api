<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    protected bool $showSensitiveFields = false;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if (!$this->showSensitiveFields) {
            $this->resource->makeHidden(['phone', 'email']);
        }

        $data = parent::toArray($request);
        $data['roles'] = RoleResource::collection($this->whenloaded('roles'));

        return $data;
    }

    public function showSensitiveFields(): static
    {
        $this->showSensitiveFields = true;
        return $this;
    }
}
