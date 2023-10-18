<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Initial user create

        $users=[
            [
             'first_name'=>'Admin',
             'last_name'=>'12',
             'email'=>'admin@gmail.com',
             'password'=>bcrypt('password')

            ],
            [
             'first_name'=>'User',
             'last_name'=>'12',
             'email'=>'user@gmail.com',
             'password'=>bcrypt('password')

            ]


        ];
        foreach($users as $user){
            User::create([
                'first_name'=>$user['first_name'],
                'last_name'=>$user['last_name'],
                'email'=>$user['email'],
                'password'=>$user['password']
            ]);
        }

        //Initial role create

        $roles=[
            [
             'name'=>'Admin'

            ],
            [
             'name'=>'User'

            ]
        ];
        foreach($roles as $role){
            Role::create([
                'name'=>$role['name']
            ]);
        }

        //Initial permission create

        $permissions=['create_user','edit_user','view_user','manage_role'];
        foreach($permissions as $permission){
            Permission::create([
                'name'=>$permission,
            ]);
        }


        //Assgn role to user then permission is assigned to user

        $user = User::select('id','first_name')->where('first_name','Admin')->first();
        $user->assignRole('Admin');
        $admin_role = Role::findByName('Admin');
        $admin_role->syncPermissions(Permission::all());

        $user = User::select('id','first_name')->where('first_name','User')->first();
        $user->assignRole('User');
        $general_user_role = Role::findByName('User');
        $general_user_role->syncPermissions(['view_user']);


    }
}
