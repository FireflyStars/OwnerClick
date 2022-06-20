<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'note_read','group'=>'read']);
        Permission::create(['name' => 'note_write','group'=>'write']);
        Permission::create(['name' => 'note_delete','group'=>'delete']);
        Permission::create(['name' => 'note_update','group'=>'update']);

        // create permissions
        Permission::create(['name' => 'assignment_read','group'=>'read']);
        Permission::create(['name' => 'assignment_write','group'=>'write']);
        Permission::create(['name' => 'assignment_delete','group'=>'delete']);
        Permission::create(['name' => 'assignment_update','group'=>'update']);

        // create permissions
        Permission::create(['name' => 'detail_read','group'=>'read']);
        Permission::create(['name' => 'detail_write','group'=>'write']);
        Permission::create(['name' => 'detail_delete','group'=>'delete']);
        Permission::create(['name' => 'detail_update','group'=>'update']);

                // create permissions
        Permission::create(['name' => 'expense_read','group'=>'read']);
        Permission::create(['name' => 'expense_write','group'=>'write']);
        Permission::create(['name' => 'expense_delete','group'=>'delete']);
        Permission::create(['name' => 'expense_update','group'=>'update']);

                // create permissions
        Permission::create(['name' => 'person_read','group'=>'read']);
        Permission::create(['name' => 'person_write','group'=>'write']);
        Permission::create(['name' => 'person_delete','group'=>'delete']);
        Permission::create(['name' => 'person_update','group'=>'update']);

                // create permissions
        Permission::create(['name' => 'payment_read','group'=>'read']);
        Permission::create(['name' => 'payment_write','group'=>'write']);
        Permission::create(['name' => 'payment_delete','group'=>'delete']);
        Permission::create(['name' => 'payment_update','group'=>'update']);

                // create permissions
        Permission::create(['name' => 'fixture_read','group'=>'read']);
        Permission::create(['name' => 'fixture_write','group'=>'write']);
        Permission::create(['name' => 'fixture_delete','group'=>'delete']);
        Permission::create(['name' => 'fixture_update','group'=>'update']);

                // create permissions
        Permission::create(['name' => 'file_read','group'=>'read']);
        Permission::create(['name' => 'file_write','group'=>'write']);
        Permission::create(['name' => 'file_delete','group'=>'delete']);
        Permission::create(['name' => 'file_update','group'=>'update']);


        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'tenant']);
        $role1->givePermissionTo('payment_read');
        $role1->givePermissionTo('fixture_read');
        $role1->givePermissionTo('file_read');
        $role1->givePermissionTo('note_read');
        $role1->givePermissionTo('person_read');
        $role1->givePermissionTo('expense_read');
        $role1->givePermissionTo('detail_read');
        $role1->givePermissionTo('assignment_read');

        // create roles and assign existing permissions
        $roleCreator = Role::create(['name' => 'creator']);
        $permissions = Permission::all();
        foreach($permissions as $permission){
            $roleCreator->givePermissionTo($permission->name);
        }



        // gets all permissions via Gate::before rule; see AuthServiceProvider

//        // create demo users
//        $user = \App\Models\User::factory()->create([
//            'name' => 'Example User',
//            'email' => 'test@example.com',
//        ]);
//        $user->assignRole($role1);

    }
}
