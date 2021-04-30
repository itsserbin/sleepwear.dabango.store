<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = Role::where('slug', 'administrator')->first();
        $manager = Role::where('slug', 'manager')->first();

        $showOrders = Permission::where('slug', 'show-orders')->first();
        $admin = Permission::where('slug', 'admin')->first();

        $user1 = new User();
        $user1->name = 'Admin';
        $user1->email = 'serbin.ssd@gmail.com';
        $user1->password = bcrypt('secret');;
        $user1->save();
        $user1->roles()->attach($administrator);
        $user1->permissions()->attach($admin);

        $user2 = new User();
        $user2->name = 'Andrew';
        $user2->email = 'new_andrew17@ukr.net';
        $user2->password = bcrypt('secret');;
        $user2->save();
        $user2->roles()->attach($administrator);
        $user2->permissions()->attach($admin);

        $user3 = new User();
        $user3->name = 'Karina';
        $user3->email = 'karina.youbrand@gmail.com';
        $user3->password = bcrypt('secret');
        $user3->save();
        $user3->roles()->attach($manager);
        $user3->permissions()->attach($showOrders);

        $user4 = new User();
        $user4->name = 'Max';
        $user4->email = 'obertunmaks@gmail.com';
        $user4->password = bcrypt('secret');
        $user4->save();
        $user4->roles()->attach($manager);
        $user4->permissions()->attach($showOrders);
    }
}
