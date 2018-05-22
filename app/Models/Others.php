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
    public function getOrderServiceStatuses(){
        $result = DB::table('orders_services_statuses')
                ->get();
        return $result;
    }

    public function getOrderStatuses(){
        $result = DB::table('orders_statuses')
            ->get();
        return $result;
    }

    public function getUnreadMessages($id) {
        $result = DB::table('orders_services_comments')
            ->where([
                ['seenByWorker','=',0],
                ['worker_id','=',$id]
            ])
            ->join('orders_services','order_service_id','=','id_order_service')
            ->join('users', 'user_id', '=', 'id_user')
            ->join('roles', 'role_id', '=', 'id_role')
            ->groupBy('order_service_id')
            ->get();

        return $result;
    }

    public function getPendingOrders() {
        $result = DB::table('orders')
            ->join('orders_statuses','orders.order_status_id', '=', 'id_order_status')
            ->join('users','orders.user_id','=', 'users.id_user')
            ->where('order_status_id', '=', 1)
            ->get();

        return $result;
    }

    public function getWaitingServices() {
        $result = DB::table('services')
            ->join('orders_services', 'id_service','=', 'service_id')
            ->join('orders_services_statuses', 'id_order_service_status', '=', 'order_service_status_id')
            ->where('id_order_service_status','=',1)
            ->get();

        return $result;
    }

    public function getAllocatedServices($id) {
        $result = DB::table('services')
            ->join('orders_services', 'id_service','=', 'service_id')
            ->join('orders_services_statuses', 'id_order_service_status', '=', 'order_service_status_id')
            ->where([
                ['id_order_service_status','=',2],
                ['worker_id','=',$id]
            ])
            ->get();

        return $result;
    }
}