<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notification;
use Carbon\Carbon;

class CreateNotificationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Notification::insert([
        [
          'user_id' => 2,
          'url' => '/feedback/1',
          'message' => "demo2 wrote a comment on your feedback.",
         'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ],
        [
          'user_id' => 2,
          'url' => '/feedback/2',
          'message' => "demo2 like your feedback.",
         'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ],
        [
          'user_id' => 3,
          'url' => '/feedback/5',
          'message' => "demo1 wrote a comment on your feedback.",
         'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ],
      ]);

    }
}
