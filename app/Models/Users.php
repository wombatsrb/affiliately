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
    private $name;
    private $surname;
    private $address1;
    private $address2;
    private $city;
    private $country;
    private $zip;
    private $username;
    private $role_id;
    private $user_status_id;
    
    function getRole_id() {
        return $this->role_id;
    }

    function getUser_status_id() {
        return $this->user_status_id;
    }

    function getEmail(){
        return $this->email;
    }
    function getPassword(){
        return $this->password;
    }  
    
    function getName() {
        return $this->name;
    }

    function getSurname() {
        return $this->surname;
    }

    function getAddress1() {
        return $this->address1;
    }

    function getAddress2() {
        return $this->address2;
    }

    function getCity() {
        return $this->city;
    }

    function getCountry() {
        return $this->country;
    }

    function getZip() {
        return $this->zip;
    }

    function getUsername() {
        return $this->username;
    }

    function setRole_id($role_id) {
        $this->role_id = $role_id;
    }

    function setUser_status_id($user_status_id) {
        $this->user_status_id = $user_status_id;
    }
    
    function setName($name) {
        $this->name = $name;
    }

    function setSurname($surname) {
        $this->surname = $surname;
    }

    function setAddress1($address1) {
        $this->address1 = $address1;
    }

    function setAddress2($address2) {
        $this->address2 = $address2;
    }

    function setCity($city) {
        $this->city = $city;
    }

    function setCountry($country) {
        $this->country = $country;
    }

    function setZip($zip) {
        $this->zip = $zip;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setEmail($value){
        $this->email = $value;
    } 
     
    function setPassword($value){
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
    
    public function addUser(){
        $result = DB::table('users')
                ->insert([
                    'name'  => $this->name,
                    'surname'  => $this->surname,
                    'email'  => $this->email,
                    'address1'  => $this->address1,
                    'address2'  => $this->address2,
                    'city'  => $this->city,
                    'country'  => $this->country,
                    'zip'  => $this->zip,
                    'password'  => md5($this->password),
                    'username'  => $this->username,
                    'role_id'  => $this->role_id,
                    'user_status_id'  => $this->user_status_id,
                    'date_of_registration' => date("Y-m-d H:i:s")
                ]);
        return $result;
    }
    public function getAllUsers(){
        $result = DB::table('users')
                ->join('roles', 'role_id','=', 'id_role')
                ->join('users_statuses', 'user_status_id', '=', 'id_user_status')
                ->get();
        
        return $result;
    }

    public function getAllWorkers(){
        $result = DB::table('users')
            ->join('roles', 'role_id','=', 'id_role')
            ->join('users_statuses', 'user_status_id', '=', 'id_user_status')
            ->where([
                ['role_name', '=', 'Worker'],
                ['status_name', '=', 'Active']
            ])
            ->get();

        return $result;
    }
    
    public function getUserById($id){
        $result = DB::table('users')
                ->join('roles', 'role_id','=', 'id_role')
                ->join('users_statuses', 'user_status_id', '=', 'id_user_status')
                ->where('id_user', '=', $id)
                ->first();
        
        return $result;
    }
    
    public function editUserById($id){
        $result = DB::table('users')
                ->where('id_user', '=', $id)
                ->update([
                    'name'  => $this->name,
                    'surname'  => $this->surname,
                    'email'  => $this->email,
                    'address1'  => $this->address1,
                    'address2'  => $this->address2,
                    'city'  => $this->city,
                    'country'  => $this->country,
                    'zip'  => $this->zip,
                    'username'  => $this->username,
                    'role_id'  => $this->role_id,
                    'user_status_id'  => $this->user_status_id,
                    'date_of_update' => date("Y-m-d H:i:s")
                ]);
        
        return $result;
    }
    
    public function deleteUser($id){
        
        $getDeleteStatusId = DB::table('users_statuses')
                            ->where('status_name', '=', 'Deleted')
                            ->select('id_user_status')
                            ->first()
                            ->id_user_status;
        
        $result = DB::table('users')
                ->where('id_user', '=', $id)
                ->update([
                    'user_status_id' => $getDeleteStatusId
                ]);
        
        return $result;
    }


    
    
    
    
    
    
    
}
