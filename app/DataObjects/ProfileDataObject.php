<?php

declare(strict_types=1);

namespace App\DataObjects;

readonly class ProfileDataObject
{
    public function __construct(
        public string $userName,
        public bool $isAuthenticated,
        public ?int $instagramId,
        public int $mediaCount,
        public ?string $userId,
        public ?string $accessToken,
    ) {}

    public static function make(
        object $profile
    ): self {
        return new self(
            userName: $profile->userName,
            isAuthenticated: $profile->isAuthenticated,
            instagramId: $profile->instagramId,
            mediaCount: $profile->mediaCount,
            userId: $profile->userId,
            accessToken: $profile->accessToken,
        );
    }
}
