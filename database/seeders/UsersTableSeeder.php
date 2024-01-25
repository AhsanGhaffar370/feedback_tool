<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MechanicDetail;
use App\Models\UserDetail;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userRole = config('roles.models.role')::where('name', '=', 'User')->first();
        $adminRole = config('roles.models.role')::where('name', '=', 'Admin')->first();
        $permissions = config('roles.models.permission')::all();

        /*
         * Add Users
         *
         */
        if (config('roles.models.defaultUser')::where('email', '=', 'admin@gmail.com')->first() === null) {
            $newUser = config('roles.models.defaultUser')::create([
                'name'     => 'Admin',
                'email'    => 'admin@gmail.com',
                'password' => bcrypt('demo2121'),
            ]);

            $newUser->attachRole($adminRole);
            foreach ($permissions as $permission) {
                $newUser->attachPermission($permission);
            }
        }

        if (config('roles.models.defaultUser')::where('email', '=', 'demo1@gmail.com')->first() === null) {
            $newUser = config('roles.models.defaultUser')::create([
                'name'     => 'demo1',
                'email'    => 'demo1@gmail.com',
                'password' => bcrypt('demo2121'),
            ]);
            

            $newUser->attachRole($userRole);
        }

        if (config('roles.models.defaultUser')::where('email', '=', 'demo2@gmail.com')->first() === null) {
            $newUser = config('roles.models.defaultUser')::create([
                'name'     => 'demo2',
                'email'    => 'demo2@gmail.com',
                'password' => bcrypt('demo2121'),
            ]);
            

            $newUser->attachRole($userRole);
        }

    }
}
