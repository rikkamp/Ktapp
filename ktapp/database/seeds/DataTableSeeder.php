<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('gegevens')->insert([
            'UserId'            => '1',
            'GegevensDatum'     => '2019-03-18',
            'GegevensWeek'      => '12',
            'GegevensDag'       => 'Maandag',
            'GegevensJaar'      => '2019',
            'GegevensKm'        => '132',
            'GegevensLocatie'   => 'Rotterdam',
            'GegevensAankomst'  => '17:30',
            'GegevensVertrek'   => '19:10',
            'GegevensNo'        => '02-hf-xz',
            'archived'          => 0,

        ]);
    }
}
