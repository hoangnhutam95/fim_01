<?php

use Illuminate\Database\Seeder;
use App\Models\Favorite;

class FavoriteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Favorite::class, 5)->create();
    }
}
