<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	factory(App\User::class, 1)->create()->each( function ($user) {
			$user->posts()->save($post = factory(App\Post::class)->make());
			$post->comments()->save(factory(App\Comment::class)->make());
		});
    }
}
