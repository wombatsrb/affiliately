<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;

use Illuminate\Support\Facades\DB;

/**
 * Description of Services
 *
 * @author Krle
 */
class Services {
    private $name;
    private $description;
    private $price;
    private $category;
    private $status;
    private $type_id;
    
    function getName() {
        return $this->name;
    }

    function getDescription() {
        return $this->description;
    }

    function getPrice() {
        return $this->price;
    }

    function getCategory() {
        return $this->$category;
    }

    function getStatus() {
        return $this->status;
    }

    function getType_id() {
        return $this->type_id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setPrice($price) {
        $this->price = $price;
    }

    function setCategory($category) {
        $this->category = $category;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setType_id($type_id) {
        $this->type_id = $type_id;
    }

    public function addService() {
        $result = DB::table('services')
                ->insert([
                    'service_name'  => $this->name,
                    'service_description'  => $this->description,
                    'service_price'  => $this->price,
                    'service_category_id'  => $this->category,
                    'service_status'  => $this->status,
                    'service_type_id'  => $this->type_id
                ]);
        return $result;
    }

    public function getAllServices(){
        $result = DB::table('services')
                ->join('services_categories', 'id_service_category','=', 'service_category_id')
                ->join('services_types', 'id_service_type', '=', 'service_type_id')
                ->get();
        
        return $result;
    }

    public function getServiceById($id){
        $result = DB::table('services')
                ->join('services_categories', 'id_service_category','=', 'service_category_id')
                ->join('services_types', 'id_service_type', '=', 'service_type_id')
                ->where('id_service', '=', $id)
                ->first();
        
        return $result;
    }

    public function editServiceById($id){
        $result = DB::table('services')
                ->where('id_service', '=', $id)
                ->update([
                    'service_name'  => $this->name,
                    'service_description'  => $this->description,
                    'service_price'  => $this->price,
                    'service_category_id'  => $this->category,
                    'service_status'  => $this->status,
                    'service_type_id'  => $this->type_id
                ]);
        
        return $result;
    }

    public function deleteService($id){
        $result = DB::table('services')
                ->where('id_service','=',$id)
                ->delete();
        
        return $result;
    }
}
