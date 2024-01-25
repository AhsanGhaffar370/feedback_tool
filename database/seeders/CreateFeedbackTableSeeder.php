<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Feedback;
use App\Models\Comment;
use App\Models\Vote;
use Carbon\Carbon;

class CreateFeedbackTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Feedback::insert([
        [
          'user_id' => '2',
          'title' => 'Lorem ipsum title',
          'description' => 'Lorem ipsum title Lorem ipsum title Lorem ipsum title Lorem ipsum title',
          'category_id' => '1',
          'status_id' => '1',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ],
        [
          'user_id' => '2',
          'title' => 'Lorem ipsum title1',
          'description' => 'Lorem ipsum title Lorem ipsum title Lorem ipsum title Lorem ipsum title1',
          'category_id' => '2',
          'status_id' => '2',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ],
        [
          'user_id' => '2',
          'title' => 'Lorem ipsum title2',
          'description' => 'Lorem ipsum title Lorem ipsum title Lorem ipsum title Lorem ipsum title2',
          'category_id' => '3',
          'status_id' => '3',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ],
        [
          'user_id' => '3',
          'title' => 'Lorem ipsum title3',
          'description' => 'Lorem ipsum title Lorem ipsum title Lorem ipsum title Lorem ipsum title3',
          'category_id' => '2',
          'status_id' => '2',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ],
        [
          'user_id' => '3',
          'title' => 'Lorem ipsum title4',
          'description' => 'Lorem ipsum title Lorem ipsum title Lorem ipsum title Lorem ipsum title4',
          'category_id' => '3',
          'status_id' => '3',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ],
      ]);

      Comment::insert([
        [
          'user_id' => '3',
          'feedback_id' => '1',
          'content' => 'lorem ipsum dolor sit amet, consectetur adipiscing elit.',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ],
        [
          'user_id' => '2',
          'feedback_id' => '5',
          'content' => 'lorem ipsum dolor sit amet, consectetur adipiscing elit.',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ],
        [
          'user_id' => '3',
          'feedback_id' => '2',
          'content' => 'lorem ipsum dolor sit amet, consectetur adipiscing elit.',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ],
        [
          'user_id' => '3',
          'feedback_id' => '2',
          'content' => 'lorem ipsum dolor sit amet, consectetur adipiscing elit.',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ],
      ]);

      Vote::insert([
        [
          'user_id' => '2',
          'feedback_id' => '4',
          'is_like' => '1',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ],
        [
          'user_id' => '2',
          'feedback_id' => '5',
          'is_like' => '1',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ],
        [
          'user_id' => '3',
          'feedback_id' => '2',
          'is_like' => '1',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ],
        [
          'user_id' => '3',
          'feedback_id' => '1',
          'is_like' => '1',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ],
      ]);

    }
}
