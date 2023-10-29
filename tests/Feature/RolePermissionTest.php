<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RolePermissionTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_add_role(): void
    {
        $response = $this->get('/');
        $roles=['admin' , 'writer' , 'user' , 'guest' ,
                'moderator' , 'editor' , 'viewer' , 'subscriber',
                'vip-user' , 'customer' , 'support' , 'api-user', 'super-user'
        ];
        foreach ($roles as $role){
            Role::create([
                'name' => $role
            ]);
        }

        $response->assertStatus(200);
    }


    public function test_add_permission(): void
    {
        $response = $this->get('/');

        $permissions=['create' , 'update' , 'delete' , 'read' ,
                      'create-user' , 'manage' , 'admin-access' ,
                      'moderator' , 'approve' , 'override' , 'restrict',
                      'invoice' , 'billing' , 'dashboard' , 'profile',
                      'generate-api-tokens' , 'manage-api-clients' , 'manage-vendors',
        ];
        foreach ($permissions as $permission){
            Permission::create([
                'name' => $permission
            ]);
        }

        $response->assertStatus(200);
    }


    public function test_role_permission_relation(): void
    {
        $response = $this->get('/');
        //using sync to connect pivot table
        $role= Role::find(1);
        $permissions_Id =Permission::whereIn( 'id' , [1,2,3,4])->pluck('id');
        $role->permissions()->sync($permissions_Id);



//       $role = Role::find(1);
//       $permissions = Permission::whereIn('id' , [1,2,3])->get();
//       foreach ($permissions as  $permission){
//           DB::table('permission_role')->insert([
//               'role_id' => $role->id,
//               'permission_id' => $permission->id,
//           ]);
//       }


        $response->assertStatus(200);
    }



    public function test_user_role_relation(): void
    {
        $response = $this->get('/');

        $roles = Role::whereIn('id' , [2,3])->pluck('id');
        $user = User::find(1);
        $user->roles()->sync($roles);
        $newRole = Role::find(1);
        $user->roles()->sync($newRole , false);
        $newRole2 = Role::find(4);
        $user->roles()->syncWithoutDetaching($newRole2);




        // When we use a raw SQL database, we don't need to use ElQuent model
//       $user= DB::table('users')->where('id' , '=' , 1 );
//       The codes above and below are the same
//        $user = User::where('id' , 1);
//         $user = User::find(1);
//         $role = Role::find(1);
//         DB::table('role_user')->insert([
//            'user_id' => $user->id,
//            'role_id'=> $role->id,
//         ]);

        $response->assertStatus(200);
    }


    public function test_load_user_roles()
    {
        $user = User::find(1);
        $user->load('roles');
        dd($user->toArray());

    }


    public function test_has_user_role()
    {
        $user = User::with('roles')->find(1);
//        We converted this code into a function in the user model
//       so that we can use it in different parts of the program
//        dd($user->roles()->where('name' , 'admin')->exists());
//        dd($user->isAdmin());
        //use has role to check any role-user
        dd($user->hasRole('admin'));

    }
}
