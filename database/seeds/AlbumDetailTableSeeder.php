<?php

use Illuminate\Database\Seeder;
use App\Models\AlbumDetail;

class AlbumDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(AlbumDetail::class, 20)->create();
    }
}
