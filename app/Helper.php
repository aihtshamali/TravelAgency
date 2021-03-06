<?php
use App\Payment;
use App\Sale;
if (!function_exists('classActivePath')) {
    function classActivePath($segment, $value)
    {
        if(!is_array($value)) {
            return Request::segment($segment) == $value ? ' menu-open' : '';
        }
        foreach ($value as $v) {
            if(Request::segment($segment) == $v) return ' menu-open';
        }
        return '';
    }
}

if (!function_exists('classActiveSegment')) {
    function classActiveSegment($segment, $value)
    {
        if(!is_array($value)) {
            return Request::segment($segment) == $value ? 'active' : '';
        }
        foreach ($value as $v) {
            if(Request::segment($segment) == $v) return 'active';
        }
        return '';
    }
}
if (!function_exists('getPayment')) {
    function getPayment($id)
    {
        $payment=Payment::selectRaw('Sum(Amount) as payment')
                    ->where('CustomerIDRef',$id)
                    ->where('StatusCode','Approved')->first();

        return $payment->payment;
    }
}
if (!function_exists('getSale')) {
    function getSale($id)
    {
        $sale=Sale::selectRaw('Sum(Amount) as sale')
                ->where('CustomerIDRef',$id)
                ->where('SaleStatus','Approved')
                ->where('Amount','>',0)->first();
        return $sale->sale;
    }
}
if (!function_exists('getRefund')) {
    function getRefund($id)
    {
        $sale=Sale::selectRaw('Sum(Amount) as refund')
                ->where('CustomerIDRef',$id)
                ->where('SaleStatus','Approved')
                ->where('Amount','<',0)->first();
        return $sale->refund;
    }
}