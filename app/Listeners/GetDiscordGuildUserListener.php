<?php

namespace App\Listeners;

use App\Models\DiscordRole;
use App\Models\DiscordUserRole;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class GetDiscordGuildUserListener
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
                $guildMember = $authUser->getGuildMember('869345535318958110');
                $authUser->global_name = $guildMember->nick;
                $authUser->save();
                foreach($guildMember->roles as $role)
                {
                    if(DiscordRole::where('discord_id', $role)->first())
                    {
                        DiscordUserRole::updateOrCreate([
                            'discord_role_id' => $role,
                            'user_id' => $authUser->id
                        ]);
                    } else {
                        $role = DiscordUserRole::where([['discord_role_id', $role], ['user_id', $authUser->id]])->first();
                        if($role)
                        {
                            $role->delete();
                        }

                    }

                }
            } catch(\Exception $exception) {
                dd($exception);
            }
        }
    }
}
