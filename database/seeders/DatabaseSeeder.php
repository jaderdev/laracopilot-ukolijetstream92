<?php

namespace Database\Seeders;

use App\Models\Composition;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create roles
        $adminRole    = Role::firstOrCreate(['name' => 'admin']);
        $composerRole = Role::firstOrCreate(['name' => 'composer']);
        $singerRole   = Role::firstOrCreate(['name' => 'singer']);

        // Create permissions
        $permissions = [
            'view compositions',
            'create compositions',
            'edit own compositions',
            'delete own compositions',
            'manage all compositions',
            'update composition status',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        // Assign permissions to roles
        $adminRole->syncPermissions($permissions);
        $composerRole->syncPermissions([
            'view compositions',
            'create compositions',
            'edit own compositions',
            'delete own compositions',
        ]);
        $singerRole->syncPermissions(['view compositions']);

        // Create admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@musicms.com'],
            [
                'name'     => 'Admin User',
                'password' => Hash::make('password'),
            ]
        );
        $admin->assignRole('admin');

        // Create composer users
        $composer1 = User::firstOrCreate(
            ['email' => 'beethoven@musicms.com'],
            [
                'name'     => 'Ludwig van Beethoven',
                'password' => Hash::make('password'),
            ]
        );
        $composer1->assignRole('composer');

        $composer2 = User::firstOrCreate(
            ['email' => 'mozart@musicms.com'],
            [
                'name'     => 'Wolfgang Mozart',
                'password' => Hash::make('password'),
            ]
        );
        $composer2->assignRole('composer');

        // Create singer users
        $singer1 = User::firstOrCreate(
            ['email' => 'adele@musicms.com'],
            [
                'name'     => 'Adele Singer',
                'password' => Hash::make('password'),
            ]
        );
        $singer1->assignRole('singer');

        $singer2 = User::firstOrCreate(
            ['email' => 'aria@musicms.com'],
            [
                'name'     => 'Aria Soprano',
                'password' => Hash::make('password'),
            ]
        );
        $singer2->assignRole('singer');

        // Create sample compositions
        $compositions = [
            [
                'title'     => 'Moonlight Sonata',
                'lyrics'    => "In the silver glow of moonlight pale,\nNotes cascade like a midnight tale.\nSoftly dancing on the ivory keys,\nWhispers carried on the evening breeze.\n\nEach chord a memory, each rest a sigh,\nThe melody soars as the hours fly by.\nMoonlight Sonata, eternal and true,\nA composer's heart poured into you.",
                'audio_path' => 'audio/moonlight_sonata.mp3',
                'video_url'  => 'https://www.youtube.com/watch?v=4Tr0otuiQuU',
                'isrc'       => 'USRC17607839',
                'status'     => 'registered',
                'user_id'    => $composer1->id,
            ],
            [
                'title'     => 'Ode to Joy',
                'lyrics'    => "Joy, bright spark of divinity,\nDaughter of Elysium,\nFire-inspired we tread thy sanctuary,\nHeavenly being, thy sanctuary.\n\nThy magic power reunites\nAll that custom has divided,\nAll men become brothers,\nUnder the sway of thy gentle wings.",
                'audio_path' => 'audio/ode_to_joy.mp3',
                'video_url'  => 'https://www.youtube.com/watch?v=_2_GKrQqHac',
                'isrc'       => 'USRC17607840',
                'status'     => 'registered',
                'user_id'    => $composer1->id,
            ],
            [
                'title'     => 'Symphony in G Minor',
                'lyrics'    => "Strings of fate entwine the night,\nViolets bloom in fading light.\nA symphony of joy and pain,\nEchoes through the morning rain.\n\nIn minor keys our sorrows sing,\nYet hope ascends on angel wings.\nEvery note a story told,\nOf silver hearts and threads of gold.",
                'audio_path' => 'audio/symphony_g_minor.mp3',
                'video_url'  => null,
                'isrc'       => 'USRC17607841',
                'status'     => 'pending',
                'user_id'    => $composer2->id,
            ],
            [
                'title'     => 'The Wandering Minstrel',
                'lyrics'    => "I roam the roads from town to town,\nMy lute upon my back.\nI sing of kings who lost their crown,\nAnd heroes on the track.\n\nThe wandering minstrel, free as air,\nWith stories old and new.\nI leave a song beyond compare,\nIn every heart I knew.",
                'audio_path' => 'audio/wandering_minstrel.mp3',
                'video_url'  => 'https://youtu.be/dQw4w9WgXcQ',
                'isrc'       => 'USRC17607842',
                'status'     => 'pending',
                'user_id'    => $composer2->id,
            ],
            [
                'title'     => 'Autumn Serenade',
                'lyrics'    => "Leaves of amber, gold and red,\nFall like whispers softly said.\nAutumn winds begin to blow,\nAs the harvest lanterns glow.\n\nSerenade of seasons past,\nSummer gone too sweet, too fast.\nNow the twilight lingers long,\nIn the heart of autumn's song.",
                'audio_path' => 'audio/autumn_serenade.mp3',
                'video_url'  => null,
                'isrc'       => 'USRC17607843',
                'status'     => 'registered',
                'user_id'    => $composer1->id,
            ],
        ];

        foreach ($compositions as $data) {
            Composition::firstOrCreate(
                ['isrc' => $data['isrc']],
                $data
            );
        }
    }
}