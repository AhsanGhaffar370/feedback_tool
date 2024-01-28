<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// use Database\Seeders\UserTableSeeder;
use Database\Seeders\PermissionsTableSeeder;
use Database\Seeders\RolesTableSeeder;
use Database\Seeders\ConnectRelationshipsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      // \App\Models\User::factory(10)->create();
      $this->call(PermissionsTableSeeder::class);
      $this->call(RolesTableSeeder::class);
      $this->call(ConnectRelationshipsSeeder::class);
      $this->call(CreateCategoryTableSeeder::class);
      $this->call(CreateStatusTableSeeder::class);
      $this->call(UsersTableSeeder::class);
      $this->call(CreateFeedbackTableSeeder::class);
      $this->call(CreateNotificationTableSeeder::class);
    }
}
