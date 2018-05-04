<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menus;

class MenusController extends AdminController
{
    public function __construct() {
        parent::__construct();
        $this->data['notParentMenu'] = $this->menuInstance->getMenuNotParent();

    }
    
    public function viewMenu() {
        $this->data['userMenu'] = $this->menuInstance->getMenuListByRole('User');
        $this->data['workerMenu'] = $this->menuInstance->getMenuListByRole('Worker');
        $this->data['adminMenu'] = $this->menuInstance->getMenuListByRole('Admin');
        
        return view('pages.back.menus', $this->data);
    }
    
    public function addMenu(Request $request){
        
        $rules  = $request->validate([
            'menu_name' => 'required|min:3|max:20',
            'menu_priority' => 'required|numeric',
            'url' => 'required|min:3|max:20',
            'menu_icon' => 'required|min:3|max:20',
            'menu_parent' => 'nullable|numeric',
            'roles' => 'required|numeric'
        ]);
        
        $this->menuInstance->setMenu_name($request->get('menu_name'));
        $this->menuInstance->setPriority($request->get('menu_priority'));
        $this->menuInstance->setUrl($request->get('url'));
        $this->menuInstance->setIcon($request->get('menu_icon'));
        $this->menuInstance->setMenu_parent($request->get('menu_parent'));
        $idRole = $request->get('roles');
        
        $result = $this->menuInstance->addMenuByRole($idRole);
        
        if($result){
            return redirect()->back()->with('success', 'Menu item has been added');
        }
        else{
            return redirect()->back()->with('error', 'There has been some error with adding menu item');
        }
        
    }
    
    public function singleMenuView($id){
        
        $this->data['menuItemData'] = $this->menuInstance->getMenuItemById($id);

        return view('pages.back.menuItem', $this->data);
    }
    
    public function editMenu(Request $request, $id){
        
        $rules  = $request->validate([
            'menu_name' => 'required|min:3|max:20',
            'menu_priority' => 'required|numeric',
            'url' => 'required|min:3|max:20',
            'menu_icon' => 'required|min:3|max:20',
        ]);
        
        $this->menuInstance->setMenu_name($request->get('menu_name'));
        $this->menuInstance->setPriority($request->get('menu_priority'));
        $this->menuInstance->setUrl($request->get('url'));
        $this->menuInstance->setIcon($request->get('menu_icon'));
        $this->menuInstance->setMenu_parent($request->get('menu_parent'));
        
        $result = $this->menuInstance->editMenuById($id);
        
        if($result){
            return redirect()->route('viewMenu')->with('success', 'Menu item has been successfully modified');
        }
        else{
            return redirect()->route('viewMenu')->with('error', 'There has been some error with editing menu item');
        }
        
        
        
    }
    
    public function deleteMenu($id){
        $result = $this->menuInstance->deleteMenuById($id);
        
        if($result){
            return redirect()->back()->with('success', 'Menu item has been successfuly removed');
        }
        else{
            return redirect()->back()->with('error', 'There has been some error with deleting menu item');
        }
        
    }
    
    
    
}
