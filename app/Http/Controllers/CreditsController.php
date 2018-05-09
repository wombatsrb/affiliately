<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Credits;

class CreditsController extends AdminController
{

    protected $creditsInstance;

    public function __construct() {
        parent::__construct();
        $this->creditsInstance = new Credits();
    }

    public function addUserCredits(Request $request){

    }
    public function chargeServiceOrder(Request $request)
    {

        $rules  = $request->validate([
            'transaction_details' => 'required|min:10|max:100',
            'credits_amount' => 'required|numeric|min:0|max:5000'
        ]);

        $this->creditsInstance->setCreditAmount($request->credits_amount);
        $this->creditsInstance->setTransactionDescription($request->transaction_details);
        $serviceOrderId = $request->serviceOrderId;
        $result = $this->creditsInstance->chargeUser($request->userId, $serviceOrderId);

        if($result){
            return 'Successfully updated';
        }
        else{
            return 'Not enough credits';
        }

    }

    public function getServiceChargeHistory($idOrderService){

        $chargeData = $this->creditsInstance->getServiceChargeHistory($idOrderService);

        return json_encode($chargeData);
    }
}
