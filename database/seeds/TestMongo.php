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
            ]
        ];

        DB::table('users')->insert($users);
    }
}
