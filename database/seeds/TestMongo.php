<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestMongo extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'hunter2',
                'email' => 'hunter2@hunter2.com',
                'password' => Hash::make('hunter2'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'henter1',
                'email' => 'henter1@henter1.com',
                'password' => Hash::make('henter1'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'benter3',
                'email' => 'benter3@benter3.com',
                'password' => Hash::make('benter3'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'ginger0',
                'email' => 'ginger0@ginger0.com',
                'password' => Hash::make('ginger0'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'shrineIsle',
                'email' => 'shrineIsle@shrineIsle.com',
                'password' => Hash::make('shrineIsle'),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        DB::table('users')->insert($users);
    }
}
