<?php

declare(strict_types=1);

namespace App\Models\Instagram;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InstagramPost extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'instagram_id',
        'instagram_user_id',
        'caption',
        'permalink',
        'media_type',
        'media_url',
        'thumbnail_url',
        'timestamp',
    ];

    protected int $instagram_id;
    protected string $instagram_user_id;
    protected ?string $caption;
    protected string $permalink;
    protected string $media_type;
    protected string $media_url;
    protected ?string $thumbnail_url;
    protected string $timestamp;

    public function author(): BelongsTo
    {
        return $this->belongsTo(InstagramUser::class, 'instagram_user_id');
    }
}
