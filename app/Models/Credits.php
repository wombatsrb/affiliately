<?php
/**
 * Created by PhpStorm.
 * User: Krle-Desktop
 * Date: 5/6/2018
 * Time: 12:46 PM
 */

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Credits
{
    private $credit_amount;
    private $transaction_description;

    public function getCreditAmount()
    {
        return $this->credit_amount;
    }
    public function setCreditAmount($credit_amount): void
    {
        $this->credit_amount = $credit_amount;
    }

    public function getTransactionDescription()
    {
        return $this->transaction_description;
    }
    public function setTransactionDescription($transaction_description): void
    {
        $this->transaction_description = $transaction_description;
    }

    // FUNCTIONS //
    public function getCreditByUser($id){
        $result = DB::table('credits')
            ->join('users', 'user_id', '=', 'id_user')
            ->where('user_id', '=', $id)
            ->first();

        return $result;

    }

    public function chargeUser($id, $serviceOrderId){
        $currentCredit = DB::table('credits')
            ->where('user_id', '=', $id)
            ->first()
            ->amount;

        if($currentCredit - $this->credit_amount<0){
            return false;
        }
        else{
            $newCredit = $currentCredit - $this->credit_amount;

            $result = DB::table('credits')
                ->where('user_id', '=', $id)
                ->update([
                    'amount' => $newCredit
                ]);

            $transactionDetails = DB::table('credits_transactions')
                ->insert([
                    'user_id' => $id,
                    'transaction_amount' => (-1*$this->credit_amount),
                    'transaction_comment' => $this->getTransactionDescription(),
                    'order_service_id' => $serviceOrderId
                ]);

            return $result;
        }

    }

    public function getServiceChargeHistory($idOrderService){
        $result = DB::table('credits_transactions')
            ->join('orders_services', 'order_service_id', '=', 'id_order_service')
            ->where('order_service_id', '=', $idOrderService)
            ->get();

        return $result;
    }



}