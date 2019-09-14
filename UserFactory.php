<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'userType' => 1,
        'status' => 1
    ];
});

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'description' => $faker->text,
        'status' => 1
    ];
});

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'comment' => $faker->word,
        'status' => 1,
        'user_id' => function () {
        	return \DB::table('users')->where('userType', 2)->inRandomOrder()->first()->id;
            // return factory(App\User::class)->create(['userType'=>2])->id;
        }
        // 'user_type' => function (array $post) {
        //     return App\User::find($post['user_id'])->type;
        // }
    ];
});
