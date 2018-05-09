<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;

class OrdersController extends AdminController
{
    protected $ordersInstance;

    public function __construct() {
        parent::__construct();

        $this->ordersInstance = new Orders();

    }

    public function ordersView(){
        $allOrders = $this->ordersInstance->getAllOrders();

        $this->data['allOrders'] = $allOrders;

        return view('pages.back.orders', $this->data);
    }
    public function orderView($id){
        $orderData = $this->ordersInstance->getOrderById($id);
        $orderServicesData = $this->ordersInstance->getOrderServicesById($id);

        $this->data['orderData'] = $orderData;
        $this->data['orderServicesData'] = $orderServicesData;

        return view('pages.back.order', $this->data);
    }
    public function orderServiceView($id){
        
        $orderServiceData = $this->ordersInstance->getOrderService($id);
        $this->data['allWorkers'] = $this->userInstance->getAllWorkers();
        $this->data['orderStatuses'] = $this->othersInstance->getOrderServiceStatuses();
        $this->data['orderServiceData'] = $orderServiceData;
        $this->data['messages'] = $this->ordersInstance->getMessagesByOrderService($id);

        return view('pages.back.orderService', $this->data);

    }
    public function orderServiceStatusUpdate(Request $request, $id){
        $this->ordersInstance->setOrderServiceStatusId($request->service_status_id);
        $updateStatus = $this->ordersInstance->orderServiceStatusUpdate($id);

        if($updateStatus){
            return "Service Order Status has been Successfully changed!";
        }

        else{
            return "There was a problem with updating status!";
        }
    }
    public function orderServiceWorkerUpdate(Request $request, $id){
        $this->ordersInstance->setWorkerId($request->workerId);
        $updateWorkerId = $this->ordersInstance->orderServiceWorkerUpdate($id);

        if($updateWorkerId){
            return "Worker has been asigned!";
        }

        else{
            return "There was a problem with assigning worker!";
        }

    }
    public function orderServiceSendMessage(Request $request, $id)
    {
        $this->ordersInstance->setMessage($request->messageText);
        $this->ordersInstance->setUserId($request->userId);

        $result = $this->ordersInstance->sendMessageByOrderService($id);

        if ($result) {
            return "Message has been sent!";
        } else {
            return "There has been some problem with sending message!";
        }

    }


}
