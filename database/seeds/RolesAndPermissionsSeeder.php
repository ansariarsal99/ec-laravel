<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');
        Role::create(['name' => 'super_admin']);
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);
        Role::create(['name' => 'customer_admin']);
        Role::create(['name' => 'product_manager']);
        Role::create(['name' => 'inventory_manager']);
        Role::create(['name' => 'discount_manager']);
        Role::create(['name' => 'content_manager']);
        Role::create(['name' => 'order_manager']);
        Role::create(['name' => 'user_manager']);
        Role::create(['name' => 'coupon_manager']);

        /** @var \App\User $user */
        factory(App\User::class)->create()->each(function ($user) {
            $user->assignRole('user'); // assuming 'supscription' was a typo
        });

        /** @var \App\User $user */
        $admin = User::where('email', 'superadmin@email.com')->first();
        if($admin){
            $admin->update(['password' => bcrypt('admin123$')]);
        }else{
        $admin = factory(User::class)->create([
            'name' => 'Super Admin',
            'first_name' => 'Super',
            'last_name' =>  'Admin',
            'email' => 'superadmin@email.com',
            'password' => bcrypt('admin123$')
        ]);
        }


        $admin->assignRole('super_admin');


    }
}
