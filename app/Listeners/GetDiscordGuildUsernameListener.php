<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class GetDiscordGuildUsernameListener
{
    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $authUser = Auth::user();
        if($authUser)
        {
            try {
                $guildMember = $authUser->getGuildMember('869345535318958110')->nick;
                $authUser->global_name = $guildMember;
                $authUser->save();
            } catch(\Exception $exception) {
                dd($exception);
            }
        }
    }
}
