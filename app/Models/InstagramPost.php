<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InstagramPost extends Model
{
    use HasFactory;
    use HasUuids;

    protected int $ig_id;
    protected string $timestamp;
    protected ?string $caption;
    protected string $permalink;
    protected string $media_id;
    protected string $media_type;
    protected string $media_url;
    protected ?string $thumbnail_url;

    public function user(): BelongsTo
    {
        return $this->belongsTo(InstagramUser::class, 'ig_id', 'ig_id');
    }
}
