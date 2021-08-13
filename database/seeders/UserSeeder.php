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

//        $user1 = new User();
//        $user1->name = 'Admin';
//        $user1->email = 'serbin.ssd@gmail.com';
//        $user1->password = bcrypt('secret');;
//        $user1->save();
//        $user1->roles()->attach($administrator);
//        $user1->permissions()->attach($admin);
//

        $user4 = new User();
        $user4->name = 'Artur';
        $user4->email = 'shepelevartur@gmail.com';
        $user4->password = bcrypt('secret');
        $user4->save();
        $user4->roles()->attach($administrator);
        $user4->permissions()->attach($admin);
    }
}
