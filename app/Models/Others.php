<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;

use Illuminate\Support\Facades\DB;

/**
 * Description of Others
 *
 * @author Krle-Desktop
 */
class Others {
    
    
    public function getRoles(){
        $result = DB::table('roles')
                ->get();
        return $result;
                
    }
    public function getUsersStatuses(){
        $result = DB::table('users_statuses')
                ->get();
        return $result;
                
    }
    public function getServiceTypes(){
        $result = DB::table('services_types')
                ->get();
        return $result;      
    }
    
    public function getCategories(){
        $result = DB::table('services_categories')
                ->get();
        return $result;      
    }
    
}