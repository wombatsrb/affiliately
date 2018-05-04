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
    
    private $menu_name;
    private $priority;
    private $url;
    private $icon;
    private $role_id;
    private $menu_parent;
    
    
    function getMenu_name() {
        return $this->menu_name;
    }

    function getPriority() {
        return $this->priority;
    }

    function getUrl() {
        return $this->url;
    }

    function getIcon() {
        return $this->icon;
    }

    function getRole_id() {
        return $this->role_id;
    }
    
    function getMenu_parent() {
        return $this->menu_parent;
    }

    
    function setMenu_name($menu_name) {
        $this->menu_name = $menu_name;
    }

    function setPriority($priority) {
        $this->priority = $priority;
    }

    function setUrl($url) {
        $this->url = $url;
    }

    function setIcon($icon) {
        $this->icon = $icon;
    }

    function setRole_id($role_id) {
        $this->role_id = $role_id;
    }

    function setMenu_parent($menu_parent) {
        $this->menu_parent = $menu_parent;
    }

        
    
    public function getMenuList(){
     $result = DB::table('menus as m1')
             ->get();
     
     return $result;
        
    }
    
    public function getMenuListByRole($role){
     if($role=='Admin'){
        $result = DB::table('menus as m')
                ->join('menus_roles', 'm.id_menu', '=', 'menu_id')
                ->join('roles', 'role_id', '=', 'id_role')
                ->where('role_name', '=', 'Admin')
                ->orWhere('role_name', '=', 'Worker')
                ->groupBy('menu_id')
                ->get();          
     }
     else{
        $result = DB::table('menus as m')
                ->join('menus_roles', 'm.id_menu', '=', 'menu_id')
                ->join('roles', 'role_id', '=', 'id_role')
                ->where('role_name', '=', $role)
                ->get();         
     }

     
     return $result;
        
    }
    
    public function getMenuNotParent(){
        $result = DB::table('menus')
                ->where('menu_parent', '=', null)
                ->get();
        
        return $result;
    }
    
    public function getMenuItemById($id){
        $result = DB::table('menus')
                ->where('id_menu', '=', $id)
                ->first();
        
        return $result;
    }
    
    public function addMenuByRole($idRole){
     $result = DB::table('menus')
             ->insertGetId([
                 'menu_name' => $this->menu_name,
                 'menu_priority' => $this->priority,
                 'menu_parent' => $this->menu_parent,
                 'menu_icon' => $this->icon,
                 'url' => $this->url
             ]);
     
     $result1 = DB::table('menus_roles')
             ->insert([
                'menu_id' => $result,
                'role_id' => $idRole
             ]);
     
     return $result;
        
    }
    
    public function editMenuById($id) {
        $result = DB::table('menus')
                ->where('id_menu', '=', $id)
                ->update([
                    'menu_name' => $this->menu_name,
                    'menu_priority' => $this->priority,
                    'menu_parent' => $this->menu_parent,
                    'menu_icon' => $this->icon,
                    'url' => $this->url
                ]);
        
        return $result;
        
    }

    public function deleteMenuById($idMenu){
     $result = DB::table('menus')
             ->where([
                 'id_menu' => $idMenu
             ])
             ->delete();
     
     $result1 = $this->deleteMenuRoles($idMenu);
     
     return $result1;
    }
    
    public function deleteMenuRoles($idMenu){
     $result = DB::table('menus_roles')
             ->where([
                 'menu_id' => $idMenu,
             ])
             ->delete();
     
     return $result;        
    }
    
    
    
    
}
