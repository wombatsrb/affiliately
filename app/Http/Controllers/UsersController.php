<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends AdminController
{
    public function __construct() {
        parent::__construct();
    }
    
    public function addUserView() {
        return view('pages.back.addUser', $this->data);
    }
    public function modifyUsersView() {
        $allUsersData = $this->userInstance->getAllUsers();
        $this->data['users']=$allUsersData;                
        return view('pages.back.listUsers', $this->data);
    }
    public function addUser(Request $request){
        
        $rules = $request->validate([
            'name' => 'required|min:2|max:25',
            'surname' => 'required|min:2|max:25',
            'email' => 'required|email|max:100|unique:users,email',
            'username'=> 'required|min:2|max:25|unique:users,username',
            'city' => 'required|min:2|max:50',
            'address1' => 'required|min:2|max:50',
            'address2' => 'min:2|max:50',
            'zip' => 'min:3|max:10',
            'country' => 'required|min:3|max:50',
            'password' => 'required|min:6|max:50|confirmed',
            'roles' => 'exists:roles,id_role',
            'statuses' => 'exists:users_statuses,id_user_status'
        ]);
        
        $this->userInstance->setName($request->get('name'));
        $this->userInstance->setSurname($request->get('surname'));
        $this->userInstance->setEmail($request->get('email'));
        $this->userInstance->setUsername($request->get('username'));
        $this->userInstance->setCity($request->get('city'));
        $this->userInstance->setCountry($request->get('country'));
        $this->userInstance->setAddress1($request->get('address1'));
        $this->userInstance->setAddress2($request->get('address2'));
        $this->userInstance->setZip($request->get('zip'));
        $this->userInstance->setPassword($request->get('password'));
        $this->userInstance->setUser_status_id($request->get('statuses'));
        $this->userInstance->setRole_id($request->get('roles'));
        
        $result = $this->userInstance->addUser();
        if($result){
            return redirect()->back()->with('success', 'User has been added successfully');
        }
        else{
            return redirect()->back()->with('error', 'There has been some problem with adding user');
        }
    }
    public function editUserView($id){
        
        $this->data['userData'] = $this->userInstance->getUserById($id);

        if($this->data['userData']->role_name=='User'){
            $this->data['creditData'] = $this->userInstance->getUserCreditHistory($id);
            $this->data['serviceHistory'] = $this->userInstance->getUserServiceHistory($id);
        }

        return view('pages.back.modifyUser', $this->data);
        
    }
    public function editUser(Request $request, $id){
        
        $rules = $request->validate([
            'name' => 'required|min:2|max:25',
            'surname' => 'required|min:2|max:25',
            'email' => 'required|email|max:100|unique:users,email,'.$id.',id_user',
            'username'=> 'required|min:2|max:25|unique:users,username,'.$id.',id_user',
            'city' => 'required|min:2|max:50',
            'address1' => 'required|min:2|max:50',
            'address2' => 'min:2|max:50',
            'zip' => 'min:3|max:10',
            'country' => 'required|min:3|max:50',
            'roles' => 'exists:roles,id_role',
            'statuses' => 'exists:users_statuses,id_user_status'
        ]);
        
        $this->userInstance->setName($request->get('name'));
        $this->userInstance->setSurname($request->get('surname'));
        $this->userInstance->setEmail($request->get('email'));
        $this->userInstance->setUsername($request->get('username'));
        $this->userInstance->setCity($request->get('city'));
        $this->userInstance->setCountry($request->get('country'));
        $this->userInstance->setAddress1($request->get('address1'));
        $this->userInstance->setAddress2($request->get('address2'));
        $this->userInstance->setZip($request->get('zip'));
        $this->userInstance->setUser_status_id($request->get('statuses'));
        $this->userInstance->setRole_id($request->get('roles'));
        
        $result = $this->userInstance->editUserById($id);
        
        if($result){
            return redirect()->back()->with('success', 'User has been edited successfully');
        }
        else{
            return redirect()->back()->with('error', 'There has been some problem with editing user');
        }        
    }
    public function deleteUser($id){
        
        $result = $this->userInstance->deleteUser($id);
        
        if($result){
            return redirect()->back()->with('success', 'User has been successfuly deleted');
        }
        else{
            return redirect()->back()->with('error', 'There has been some problem with deleting user');
        }
        
    }

    
    
    
    
    
}
