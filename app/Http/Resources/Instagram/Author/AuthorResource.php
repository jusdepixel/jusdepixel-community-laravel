<?php

declare(strict_types=1);

namespace App\Http\Resources\Instagram\Author;

use Illuminate\Http\Resources\Json\JsonResource;

final class AuthorResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'instagram_id' => $this->instagram_id,
            'username' => $this->username
        ];
    }
}
