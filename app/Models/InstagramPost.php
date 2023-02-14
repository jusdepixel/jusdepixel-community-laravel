<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstagramPost extends Model
{
    use HasFactory;
    use HasUuids;

    protected int $ig_id;
    protected string $media_id;
    protected string $media_type;
    protected string $media_url;
    protected string $username;
    protected string $timestamp;
}
