<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        app('db.connection')->table('users')->insert([
            'name' => $faker->name,
            'email' => $faker->email,
            'password' => app('hash')->make('secret'),
            'email_verified_at' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        app('db.connection')->table('posts')->insert([
            'user_id' => 1,
            'title' => $faker->sentence,
            'body' => $faker->paragraph,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
