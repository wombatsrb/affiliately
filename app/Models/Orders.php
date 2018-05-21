<?php
/**
 * Created by PhpStorm.
 * User: Krle-Desktop
 * Date: 5/5/2018
 * Time: 4:47 PM
 */

namespace App\Models;
use Illuminate\Support\Facades\DB;

class Orders
{
    private $user_id;
    private $order_service_status_id;
    private $worker_id;
    private $message;
    private $order_status_id;

    public function getOrderStatusId()
    {
        return $this->order_status_id;
    }
    public function setOrderStatusId($order_status_id): void
    {
        $this->order_status_id = $order_status_id;
    }
    public function getUserId()
    {
        return $this->user_id;
    }
    public function setUserId($user_id): void
    {
        $this->user_id = $user_id;
    }
    public function getOrderServiceStatusId()
    {
        return $this->order_service_status_id;
    }
    public function setOrderServiceStatusId($order_service_status_id): void
    {
        $this->order_service_status_id = $order_service_status_id;
    }
    public function getWorkerId()
    {
        return $this->worker_id;
    }
    public function setWorkerId($worker_id): void
    {
        $this->worker_id = $worker_id;
    }
    public function getMessage()
    {
        return $this->message;
    }
    public function setMessage($message): void
    {
        $this->message = $message;
    }


    public function getAllOrders(){
        $result = DB::table('orders')
            ->groupBy('id_order')
            ->join('orders_statuses','orders.order_status_id', '=', 'id_order_status')
            ->join('users','orders.user_id','=', 'users.id_user')
            ->select('orders.*', 'orders_statuses.*', 'users.name', 'users.surname', 'users.email')
            ->get();

        return $result;
    }
    public function getOrderById($id){
        $result = DB::table('orders')
            ->join('orders_statuses','orders.order_status_id', '=', 'id_order_status')
            ->join('users','orders.user_id','=', 'users.id_user')
            ->select('orders.*', 'orders_statuses.*', 'users.name', 'users.surname', 'users.email')
            ->where('id_order', '=', $id)
            ->first();

        return $result;
    }
    public function getOrderServicesById($id){
        $result = DB::table('orders_services')
            ->join('orders_services_statuses', 'order_service_status_id', '=', 'id_order_service_status')
            ->join('services', 'service_id', '=', 'id_service')
            ->join('services_types', 'service_type_id', '=', 'id_service_type')
            ->join('services_categories', 'service_category_id', '=', 'id_service_category')
            ->leftJoin('users','orders_services.worker_id', '=', 'users.id_user')
            ->select('orders_services.*', 'orders_services_statuses.*', 'services.*', 'services_types.*', 'services_categories.*', 'orders_services.worker_id',  'users.username')
            ->where('order_id', '=', $id)
            ->get();

        return $result;
    }
    public function getOrderService($id){
        $result = DB::table('orders_services')
            ->join('orders_services_statuses', 'order_service_status_id', '=', 'id_order_service_status')
            ->join('services', 'service_id', '=', 'id_service')
            ->join('services_types', 'service_type_id', '=', 'id_service_type')
            ->join('services_categories', 'service_category_id', '=', 'id_service_category')
            ->leftJoin('users as worker','orders_services.worker_id', '=', 'worker.id_user')
            ->join('orders', 'orders_services.order_id', '=', 'orders.id_order')
            ->join('users as customer', 'orders.user_id', '=', 'customer.id_user')
            ->select('orders_services.*', 'orders_services_statuses.*', 'services.*', 'services_types.*', 'services_categories.*', 'orders_services.worker_id',  'worker.username','customer.id_user as customer_id', 'customer.name as customer_name', 'customer.surname as customer_surname', 'customer.email as customer_email')
            ->where('id_order_service', '=', $id)
            ->first();

        return $result;
    }
    public function orderServiceStatusUpdate($id){
        $serviceStatusId = $this->getOrderServiceStatusId();

        $result = DB::table('orders_services')
            ->where('id_order_service', '=', $id)
            ->update([
                'order_service_status_id' => $serviceStatusId
            ]);

        return $result;
    }
    public function orderServiceWorkerUpdate($id){
        $workerId = $this->getWorkerId();

        $result = DB::table('orders_services')
            ->where('id_order_service', '=', $id)
            ->update([
                'worker_id' => $workerId
            ]);

        return $result;
    }
    public function getMessagesByOrderService($id){
        $result = DB::table('orders_services_comments')
            ->where('order_service_id', '=', $id)
            ->join('users', 'user_id', '=', 'id_user')
            ->join('roles', 'role_id', '=', 'id_role')
            ->get();

        return $result;

    }
    public function sendMessageByOrderService($id){
        $result = DB::table('orders_services_comments')
            ->insert([
                'order_service_id' => $id,
                'user_id' => $this->user_id,
                'message' => $this->message,
                'seenByUser' => 0,
                'seenByWorker' => 1,
                'seenByWorkerDate' => now()
            ]);

        return $result;
    }
    public function changeSeenStatus($orderServiceId){
        $result = DB::table('orders_services_comments')
            ->where([
                ['order_service_id', '=', $orderServiceId],
                ['seenByWorker', '=', 0]
            ])
            ->update([
                'seenByWorker' => 1,
                'seenByWorkerDate' => now()
            ]);

        return $result;
    }
    public function getOrdersByUserId($id) {
        $result = DB::table('orders')
            ->where('user_id','=',$id)
            ->groupBy('id_order')
            ->join('orders_statuses','orders.order_status_id', '=', 'id_order_status')
            ->join('users','orders.user_id','=', 'users.id_user')
            ->select('orders.*', 'orders_statuses.*', 'users.name', 'users.surname', 'users.email')
            ->get();

        return $result;
    }
    public function changeOrderStatus($orderId){
        $result = DB::table('orders')
            ->where('id_order', '=', $orderId)
            ->update([
                'order_status_id' => $this->getOrderStatusId()
            ]);
        return $result;

    }
    public function checkIfWorkerJob($idWorker, $idServiceOrder){
        $result = DB::table('orders_services')
            ->where([
                ['worker_id', '=', $idWorker],
                ['id_order_service', '=', $idServiceOrder]
            ]);

        return $result;
    }
    public function getOrderServiceByWorkerId($workerId){
        $result = DB::table('orders_services')
            ->join('orders_services_statuses', 'order_service_status_id', '=', 'id_order_service_status')
            ->join('services', 'service_id', '=', 'id_service')
            ->join('services_types', 'service_type_id', '=', 'id_service_type')
            ->join('services_categories', 'service_category_id', '=', 'id_service_category')
            ->leftJoin('users','orders_services.worker_id', '=', 'users.id_user')
            ->select('orders_services.*', 'orders_services_statuses.*', 'services.*', 'services_types.*', 'services_categories.*', 'orders_services.worker_id',  'users.username')
            ->where('worker_id', '=', $workerId)
            ->get();

        return $result;
    }
}