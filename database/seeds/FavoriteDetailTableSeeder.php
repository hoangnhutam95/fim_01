<?php

use Illuminate\Database\Seeder;
use App\Models\FavoriteDetail;

class FavoriteDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(FavoriteDetail::class, 30)->create();
    }
}
