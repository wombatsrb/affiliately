<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;

use Illuminate\Support\Facades\DB;

/**
 * Description of Menus
 *
 * @author Krle-Desktop
 */
class Menus {
    
    public function getMenuList(){
     $result = DB::table('menus as m1')
             
             ->get();
     
     return $result;
        
    }
    
    public function getMenuListByRole($role){
     $result = DB::table('menus as m')
             ->join('menus_roles', 'm.id_menu', '=', 'menu_id')
             ->join('roles', 'role_id', '=', 'id_role')
             ->where('role_name', '=', $role)
             ->get();
     
     return $result;
        
    }    
    
    
}
