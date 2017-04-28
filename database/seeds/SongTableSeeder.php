<?php

use Illuminate\Database\Seeder;
use App\Models\Song;

class SongTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Song::class, 20)->create();
    }
}
