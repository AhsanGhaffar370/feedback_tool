<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Carbon\Carbon;

class CreateCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Category::insert([
        [
          'name' => 'Bug report',
         'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ],
        [
          'name' => 'Feature request',
         'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ],
        [
          'name' => 'Improvement',
         'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ],
      ]);

    }
}
