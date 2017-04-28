<?php

use Illuminate\Database\Seeder;
use App\Models\Lyric;

class LyricTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Lyric::class, 30)->create();
    }
}
