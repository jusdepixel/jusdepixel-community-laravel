<?php

namespace App\Jobs\Instagram;

use App\Instagram\Auth;
use App\Models\Instagram\InstagramUser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RefreshTokenJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private Auth $authenticate)
    {
        $users = InstagramUser::query()
            ->select(['token'])
            ->get();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        //
    }
}
