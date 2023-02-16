<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InstagramUser extends Model
{
    use HasFactory;
    use HasUuids;

    protected int $ig_id;
    protected string $timestamp;
    protected string $username;
    protected int $media_count;
    protected string $token;

    public function posts(): HasMany
    {
        return $this->HasMany(InstagramPost::class, 'ig_id', 'ig_id');
    }
}
