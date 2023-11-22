<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name'=>'admin',
            'email'=>'admin111@gmail.com',
            'password'=>bcrypt('admin111'),
            'role' => '1',

        ]);
        $manager = User::create([
            'name'=>'manager',
            'email'=>'manager111@gmail.com',
            'password'=>bcrypt('manager111'),
            'role' => '2',

        ]);
//        $user->assignRole('admin');
        $admin->assignRole('admin');
        $manager->assignRole('manager');
    }
}
