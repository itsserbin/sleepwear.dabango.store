<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Permission();
        $admin->name = 'Admin';
        $admin->slug = 'admin';
        $admin->save();


        $editProducts = new Permission();
        $editProducts->name = 'Edit products';
        $editProducts->slug = 'edit-products';
        $editProducts->save();

        $editSettings = new Permission();
        $editSettings->name = 'Edit options';
        $editSettings->slug = 'edit-options';
        $editSettings->save();

        $showOrders = new Permission();
        $showOrders->name = 'Show orders';
        $showOrders->slug = 'show-orders';
        $showOrders->save();

        $deleteOrders = new Permission();
        $deleteOrders->name = 'Delete orders';
        $deleteOrders->slug = 'delete-orders';
        $deleteOrders->save();

        $showClients = new Permission();
        $showClients->name = 'Show clients';
        $showClients->slug = 'show-clients';
        $showClients->save();

        $deleteClients = new Permission();
        $deleteClients->name = 'Delete clients';
        $deleteClients->slug = 'delete-clients';
        $deleteClients->save();

        $showBookkeeping = new Permission();
        $showBookkeeping->name = 'Show bookkeeping';
        $showBookkeeping->slug = 'show-bookkeeping';
        $showBookkeeping->save();

        $editUsers = new Permission();
        $editUsers->name = 'Edit users';
        $editUsers->slug = 'edit-users';
        $editUsers->save();
    }
}
