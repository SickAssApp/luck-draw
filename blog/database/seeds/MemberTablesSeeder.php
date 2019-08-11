<?php

use Illuminate\Database\Seeder;
use App\User;

class MemberTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'              => 'default',
            'win_num_count'     => 0,
        ]);
    }
}
