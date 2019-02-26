<?php

namespace OrlandoLibardi\UserCms\app;
use App\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;


class ServiceUser
{

    /**
     * Retorna Model_has_roles de acordo com o Role do usuário atual
     */
    public static function getUserRoles($roleId)
    {
       $temp = DB::table('model_has_roles')
            ->where('role_id', '<=', $roleId)  
            ->get();
        return array_pluck($temp, 'model_id', 'model_id');
    }
    /**
     * Retornas uma lista de Roles disponíveis para o usuário atual
     */
    public static function getRoles($roleId){
       return  Role::where('id', '<=', $roleId)
                     ->pluck('name','name')
                     ->all();
    } 
    /**
     * Retorna os usuários de acordo com os ids selecionados pelo role
     */
    public static function Users($userRole){
        return User::whereIn('id', $userRole)
                ->orderBy('name','ASC')
                ->get();
    }
    public static function deleteModelHasRole($id){
        return DB::table('model_has_roles')->where('model_id', $id)->delete();
    }

    /**
     * 
     */
    public static function setParamsUpdateUser($params){

         if(!empty($params['password'])){
            $params['password'] = Hash::make($params['password']);
        }else{
            $params = array_except($params,array('password')); 
        }
        return $params;
    } 

    /**
    * 
    */
    
    public static function delete($ids){
        
        $ids = json_decode($ids);
        
        foreach($ids as $id){
            if(is_numeric($id))  User::find($id)->delete();
        }

    } 


}