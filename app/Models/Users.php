<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;

use Illuminate\Support\Facades\DB;

/**
 * Description of Users
 *
 * @author Krle-Desktop
 */
class Users {
    
    private $email;
    private $password;
    
    public function getEmail(){
        return $this->email;
    }
    public function setEmail($value){
        $this->email = $value;
    } 
    public function getPassword(){
        return $this->password;
    }    
    public function setPassword($value){
        $this->password = $value;
    }   
    

    public function checkAdmin(){
        $result = DB::table('users')
                ->select('id_user', 'name', 'surname', 'role_name')
                ->where([
                    'email' => $this->email,
                    'password' => md5($this->password)
                ])
                ->join('roles', 'role_id', '=', 'id_role')
                ->first();
        
        return $result;

    }
    
    
    
}
