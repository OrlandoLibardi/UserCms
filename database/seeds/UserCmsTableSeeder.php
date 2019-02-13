<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserCmsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        //Permission configure
        Permission::create(['name' => 'configure']);
        
        //Create a new role
        $role = Role::create(['name' => 'Super Administrador']);
        $permissions = ['listar', 'criar', 'editar', 'deletar', 'configure'];
        
        //Assign permissions 
        $role->syncPermissions($permissions);
        
        //Create a new user
        $user = User::create([
            'name' => 'Orlando Libardi',
            'email' => 'orlando@orlandolibardi.com.br',
            'password' => bcrypt('admin01')
        ]);
        
        //Assign role
        $user->assignRole('Super administrador');
    }
}
