<?php

use Illuminate\Database\Seeder;
use App\Models\Album;

class AlbumTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Album::class, 5)->create();
    }
}
