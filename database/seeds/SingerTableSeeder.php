<?php

use Illuminate\Database\Seeder;
use App\Models\Singer;

class SingerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Singer::class, 10)->create();
    }
}
