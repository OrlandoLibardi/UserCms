<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use OrlandoLibardi\OlCms\AdminCms\app\Admin;

class UserCmsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        
        
        //Create ALL Roles
        $roles_all = [
            'Colaborador' => [ 'list'],
            'Editor' => [ 'list', 'create',  'edit'],
            'Administrador' => ['list', 'create',  'edit', 'delete'],
            'Super Administrador' => ['list', 'create',  'edit', 'delete', 'configure']
        ];

        foreach($roles_all as $key=>$value){
            $role = Role::create(['name' => $key]);
            $role->syncPermissions($value);
        }

        //Create a new user
        $user = User::create([
            'name' => 'Orlando Libardi',
            'email' => 'orlando@orlandolibardi.com.br',
            'password' => bcrypt('admin01')
        ]);
        
        //Assign role model id
        DB::table('model_has_roles')->insert([
            'role_id' =>  $role->id,
            'model_type' => 'App\User',
            'model_id' => $user->id
         ]);


         //Criar instancia no menu administrador
         Admin::create([
            'name' => 'Usuários',
            'route' => 'users.index',
            'icon' => 'fa fa-users',
            'parent_id' => 0,
            'minimun_can' => 'list',
            'order_at' => 10
        ]);

        $config = Admin::create([
                'name' => 'Configurações',
                'route' => '',
                'icon' => 'fa fa-cog',
                'parent_id' => 0,
                'minimun_can' => 'configure',
                'order_at' => 11
        ]);

        Admin::create([
            'name' => 'Permissões',
            'route' => 'roles.index',
            'icon' => '',
            'parent_id' => $config->id,
            'minimun_can' => 'configure',
            'order_at' => 1
        ]);

    }
}
