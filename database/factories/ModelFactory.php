<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'avatar' => $faker->imageUrl(100, 100),
        'address' => $faker->address,
        'role' => '0',
        'status' => '1',
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Song::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'cover' => $faker->imageUrl(700, 200),
        'link' => $faker->file(config('settings.source_music'), config('settings.source_audio'), false),
        'description' => $faker->paragraph,
        'publish_date' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
        'type' => 'audio',
        'author' => $faker->name,
        'rate_number' => $faker->numberBetween(4, 20),
        'rate_point' => $faker->randomFloat(2, 1, 5),
        'comment_number' => $faker->numberBetween(4, 20),
        'is_hot' => $faker->numberBetween(0, 1),
        'created_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
        'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
    ];
});

$factory->define(App\Models\Singer::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'avatar' => $faker->imageUrl(100, 100),
        'role' => $faker->numberBetween(1, 2),
        'created_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
        'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
    ];
});

$factory->define(App\Models\Singer::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'avatar' => $faker->imageUrl(100, 100),
        'role' => $faker->numberBetween(1, 2),
        'created_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
        'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
    ];
});

$factory->define(App\Models\Lyric::class, function (Faker\Generator $faker) {
    static $userIds;
    static $songIds;

    return [
        'user_id' => $faker->randomElement($userIds ?: $userIds = App\Models\User::pluck('id')->toArray()),
        'song_id' => $faker->randomElement($songIds ?: $songIds = App\Models\Song::pluck('id')->toArray()),
        'content' => $faker->paragraph,
        'status' => $faker->numberBetween(0, 1),
        'created_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
        'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
    ];
});

$factory->define(App\Models\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'cover' => $faker->imageUrl(700, 200),
        'created_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
        'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
    ];
});

$factory->define(App\Models\Album::class, function (Faker\Generator $faker) {
    static $categoryIds;

    return [
        'name' => $faker->name,
        'cover' => $faker->imageUrl(700, 200),
        'publish_date' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
        'category_id' => $faker->randomElement($categoryIds ?: $categoryIds = App\Models\Song::pluck('id')->toArray()),
        'rate_number' => $faker->numberBetween(4, 20),
        'rate_point' => $faker->randomFloat(2, 1, 5),
        'comment_number' => $faker->numberBetween(4, 20),
        'is_hot' => $faker->numberBetween(0, 1),
        'created_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
        'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
    ];
});

$factory->define(App\Models\Favorite::class, function (Faker\Generator $faker) {
    static $userIds;

    return [
        'name' => $faker->name,
        'cover' => $faker->imageUrl(700, 200),
        'user_id' => $faker->randomElement($userIds ?: $userIds = App\Models\User::pluck('id')->toArray()),
        'created_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
        'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
    ];
});

$factory->define(App\Models\FavoriteDetail::class, function (Faker\Generator $faker) {
    static $songIds;
    static $favoriteIds;
    return [
        'favorite_id' => $faker
            ->randomElement($favoriteIds ?: $favoriteIds = App\Models\Favorite::pluck('id')
            ->toArray()),
        'song_id' => $faker->randomElement($songIds ?: $songIds = App\Models\Song::pluck('id')->toArray()),
        'created_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
        'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
    ];
});

$factory->define(App\Models\AlbumDetail::class, function (Faker\Generator $faker) {
    static $songIds;
    static $albumIds;

    return [
        'album_id' => $faker->randomElement($albumIds ?: $albumIds = App\Models\Album::pluck('id')->toArray()),
        'song_id' => $faker->randomElement($songIds ?: $songIds = App\Models\Song::pluck('id')->toArray()),
        'created_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
        'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
    ];
});

$factory->define(App\Models\Rating::class, function (Faker\Generator $faker) {
    static $songIds;
    static $userIds;

    return [
        'user_id' => $faker->randomElement($userIds ?: $userIds = App\Models\User::pluck('id')->toArray()),
        'target_id' => $faker->randomElement($songIds ?: $songIds = App\Models\Song::pluck('id')->toArray()),
        'type' => '1',
        'point' => $faker->numberBetween(1, 5),
        'created_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
        'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
    ];
});

$factory->define(App\Models\Comment::class, function (Faker\Generator $faker) {
    static $songIds;
    static $userIds;

    return [
        'user_id' => $faker->randomElement($userIds ?: $userIds = App\Models\User::pluck('id')->toArray()),
        'target_id' => $faker->randomElement($songIds ?: $songIds = App\Models\Song::pluck('id')->toArray()),
        'type' => '1',
        'content' => $faker->paragraph,
        'created_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
        'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
    ];
});
