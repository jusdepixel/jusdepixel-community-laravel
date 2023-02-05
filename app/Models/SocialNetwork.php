<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialNetwork extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'social_network_posts';

    protected string $social_network;
    protected string $social_id;
    protected string $media_id;
    protected string $type;
    protected string $url;
    protected string $username;
    protected \DateTime $timestamp;
}
