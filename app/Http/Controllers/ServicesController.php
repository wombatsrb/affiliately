<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServicesController extends AdminController
{
    public function __construct() {
        parent::__construct();
    }
    
    public function addServiceView() {
        return view('pages.back.addService', $this->data);
    }
    
    public function addService(Request $request){
        
        $rules = $request->validate([
            'name' => 'required|min:2|max:25',
            'description' => 'required|min:10|max:150',
            'price'=> 'required|numeric',
            'category' => 'required|numeric',
            'status' => 'required|numeric',
            'type' => 'required|numeric',
        ]);
        
        $this->serviceInstance->setName($request->get('name'));
        $this->serviceInstance->setDescription($request->get('description'));
        $this->serviceInstance->setPrice($request->get('price'));
        $this->serviceInstance->setCategory($request->get('category'));
        $this->serviceInstance->setStatus($request->get('status'));
        $this->serviceInstance->setType_id($request->get('type'));
        
        $result = $this->serviceInstance->addService();
        if($result){
            return redirect()->back()->with('success', 'Service has been added successfully');
        }
        else{
            return redirect()->back()->with('error', 'There has been some problem with adding service');
        }
    }
    
    public function modifyServicesView() {
        $allServicesData = $this->serviceInstance->getAllServices();
        $this->data['services']=$allServicesData;                
        return view('pages.back.listServices', $this->data);
    }
    
    public function editServiceView($id) {
        $this->data['serviceData'] = $this->serviceInstance->getServiceById($id);
        return view('pages.back.modifyService', $this->data);
    }
    
    public function editService($id, Request $request) {
        $rules = $request->validate([
            'name' => 'required|min:2|max:25',
            'description' => 'required|min:10|max:150',
            'price'=> 'required|numeric',
            'category' => 'required|numeric',
            'status' => 'required|numeric',
            'type' => 'required|numeric',
        ]);
        
        $this->serviceInstance->setName($request->get('name'));
        $this->serviceInstance->setDescription($request->get('description'));
        $this->serviceInstance->setPrice($request->get('price'));
        $this->serviceInstance->setCategory($request->get('category'));
        $this->serviceInstance->setStatus($request->get('status'));
        $this->serviceInstance->setType_id($request->get('type'));
        
        $result = $this->serviceInstance->editServiceById($id);
        
        if($result){
            return redirect()->back()->with('success', 'Service has been edited successfully');
        }
        else{
            return redirect()->back()->with('error', 'There has been some problem with editing service');
        }
    }
    
     public function deleteService($id) {
        $result = $this->serviceInstance->deleteService($id);
        
        if($result){
            return redirect()->back()->with('success', 'User has been successfuly deleted');
        }
        else{
            return redirect()->back()->with('error', 'There has been some problem with deleting user');
        }
    }
}
