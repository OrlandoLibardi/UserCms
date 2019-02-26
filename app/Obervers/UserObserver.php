<?php

namespace OrlandoLibardi\UserCms\app\Obervers;

use App\User;
use Hash;

class UserObserver{


    public function creating($user){
        $user->password = Hash::make($user->password);
    }
    

}