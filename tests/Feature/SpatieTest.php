<?php

namespace Tests\Feature;


use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class SpatieTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_spatie_role_create(): void
    {
        $response = $this->get('/');

        //    $role = Role::Create(['name' => 'admin']);
//         $role = Role::updateOrCreate(['name' => 'writer']);

        $roles = ['admin', 'editor', 'author' , 'writer' , 'user' , 'guest' ,
                  'moderator'  , 'viewer' , 'subscriber',
                  'vip-user' , 'customer' , 'support' , 'api-user', 'super-user'];

        foreach ($roles as $role) {
            Role::updateOrCreate(['name' => $role]);
        }

        $response->assertStatus(200);
    }


    public function test_spatie_permission_create(): void
    {
        $response = $this->get('/');


//        $role = Permission::create(['name' => 'create user' ]);
//        $role = Permission::updateOrCreate(['name' => 'update user']);
        $permissions=['create' , 'update' , 'delete' , 'read' ,
                      'create-user' , 'manage' , 'admin-access' ,
                      'moderator' , 'approve' , 'override' , 'restrict',
                      'invoice' , 'billing' , 'dashboard' , 'profile',
                      'generate-api-tokens' , 'manage-api-clients' , 'manage-vendors',
        ];

        foreach ($permissions as  $permission){
            Permission::updateOrCreate(['name' => $permission]);
        }



        $response->assertStatus(200);
    }


    public function test_spatie_give_permission_to_role()
    {
        $response = $this->get('/');

        $role= Role::findByName('admin');
//        $role->givePermissionTo('create user');
//        $permissions = Permission::all();

        $permissions = Permission::pluck('id');

        $role->syncPermissions($permissions);

        dd($role->load('permissions')->toArray());

        $response->assertStatus(200);

    }



    public function test_spatie_give_permission_to_user(): void
    {
        $response = $this->get('/');

        $user = User::find(3);
        $permission = Permission::findByName('read' );
        $user->givePermissionTo($permission);




        $response->assertStatus(200);
    }



    public function test_spatie_assign_role_to_user(): void
    {
        $response = $this->get('/');

        $user = User::find(3);
        $user->syncRoles(5);



        dd($user->load('roles')->toArray());



        $response->assertStatus(200);
    }



    public function test_spatie_has_permission(): void
    {
        $response = $this->get('/');

        $user = User::find(1);
        $role = Role::findByName('admin');

        $query = User::has('roles')->get();


        dd($query->toArray());




        $response->assertStatus(200);
    }



    public function test_spatie_query_builder_whereHas(): void
    {
        $response = $this->get('/');



        $query = User::whereHas('roles' , function ($item){
            $item->where('name' , 'admin');
        })->get();


        dd($query->toArray());




        $response->assertStatus(200);
    }
}
