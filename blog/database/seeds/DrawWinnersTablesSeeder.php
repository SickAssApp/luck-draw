<?php

use Illuminate\Database\Seeder;

class DrawWinnersTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_prize'               => 'N/A',
            'second_prize_one'          => 'N/A',
            'second_prize_two'          => 'N/A',
            'third_prize_one'           => 'N/A',
            'third_prize_two'           => 'N/A',
            'third_prize_three'         => 'N/A',
        ]);
    }
}
