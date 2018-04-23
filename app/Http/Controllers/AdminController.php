<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use App\Models\Menus;
use App\Models\Users;
use Illuminate\Http\Request;
use function abort;
use function redirect;
use function session;
use function view;
/**
 * Description of AdminController
 *
 * @author Krle-Desktop
 */
class AdminController extends Controller {
    
    private $userInstance;
    private $menuInstance;
    
    protected $data = array();


    public function __construct(){
        $this->userInstance = new Users();
        $this->menuInstance = new Menus();
        
        /* Getting Menu items for logged role */
        if(session()->has('user')){
            $menuItems = $this->menuInstance->getMenuListByRole(session()->get('user')->role_name);
            $this->data['menus'] = $menuItems;

            
        }
        
    }
    
    
    public function loginCheck(){
        if(session()->has('user')){
            if(session()->get('user')->role_name == 'Admin' || session()->get('user')->role_name == 'Worker'){
                return redirect()->route('adminDashboard');
            }
            else{
                session()->forget('user');
                return abort(404);
            }
        }
        else{
            return $this->adminLogin();
        }

    }
    
    
    public function adminLogin(){
        return view('pages.back.login');
    }
    
    public function adminLogout(){
        session()->forget('user');
        return redirect()->route('adminLogin');
    }
    
    public function adminCheck(Request $request){

        $this->userInstance->setEmail($request->get('email'));
        $this->userInstance->setPassword($request->get('password'));
        
        $result = $this->userInstance->checkAdmin();
        
        if($result){
            session()->put('user', $result);
            return $this->loginCheck();
        }
        else{
            return redirect()->back()->with('error', 'Wrong password or email');
        }
        
        
    }
    
    public function adminDashboard(){
        return view('pages.back.dashboard', $this->data);
    }

    
    
}
