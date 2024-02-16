<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\DiscordRole;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $table = [
            ['discord_id' => 869346585337790504, 'role_name' => 'PDG', 'role_color' => 'black'],
            ['discord_id' => 871174336021684296, 'role_name' => 'Directeur', 'role_color' => '#ad1212'],
            ['discord_id' => 1195799289247572028, 'role_name' => 'Directeur(trice) Adjoint(e)', 'role_color' => '#310027'],
            ['discord_id' => 899712271389949962, 'role_name' => 'Responsable Générale', 'role_color' => '#71368A'],
            ['discord_id' => 899712271389949962, 'role_name' => 'Chef·fe d\'équipe', 'role_color' => '#1400ff'],
            ['discord_id' => 894675446514462720, 'role_name' => 'Agent Confirmé', 'role_color' => '#206694'],
            ['discord_id' => 882003696714649630, 'role_name' => 'Agent', 'role_color' => '#70bfff'],
            ['discord_id' => 889650698944405535, 'role_name' => 'Recrue', 'role_color' => 'white'],
            ['discord_id' => 963856088552337460, 'role_name' => 'Recrue N.W.A', 'role_color' => '#E67E22'],
        ];
        foreach($table as $t)
        {
            DiscordRole::create($t);
        }
    }
}
