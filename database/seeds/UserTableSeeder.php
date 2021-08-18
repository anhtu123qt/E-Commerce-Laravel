<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        $adminRole = Role::where('name','admin')->first();
        $authorRole = Role::where('name','author')->first();
        $userRole = Role::where('name','user')->first();

        $admin = User::create([
            'name' => 'tuanh1',
            'email' => 'emtu123qt@gmail.com',
            'password' => md5('123456789')
        ]);
        $author = User::create([
            'name' => 'tuanh2',
            'email' => 'chitu123qt@gmail.com',
            'password' => md5('123456789')
        ]);
        $user = User::create([
            'name' => 'tuanh3',
            'email' => 'anhtu123qt@gmail.com',
            'password' => md5('123456789')
        ]);

        $admin->roles()->attach($adminRole);
        $author->roles()->attach($authorRole);
        $user->roles()->attach($userRole);
    }
}
