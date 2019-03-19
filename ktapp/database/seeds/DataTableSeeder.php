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
        DB::table('days_of_week')->insert([
            'dag'     => 'Maandag',
        ]);
        //
        DB::table('gegevens')->insert([
            'user_id'            => '1',
            'gegevens_datum'     => '2019-03-18',
            'gegevens_week'      => '12',
            'days_id'            => '1',
            'gegevens_jaar'      => '2019',
            'gegevens_km'        => '132',
            'gegevens_locatie'   => 'Rotterdam',
            'gegevens_aankomst'  => '17:30',
            'gegevens_vertrek'   => '19:10',
            'gegevens_no'        => '02-hf-xz',
            'archived'           => 0,

        ]);
    }
}
