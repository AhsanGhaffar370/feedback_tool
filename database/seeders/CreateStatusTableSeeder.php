<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;
use Carbon\Carbon;

class CreateStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Status::insert([
        [
          'name' => 'Under review',
         'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ],
        [
          'name' => 'In progress',
         'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ],
        [
          'name' => 'Completed',
         'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ],
      ]);

    }
}
