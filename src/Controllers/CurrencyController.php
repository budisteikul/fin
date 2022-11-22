<?php

namespace budisteikul\fin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use budisteikul\toursdk\Helpers\WiseHelper;

class CurrencyController extends Controller
{
	public function index()
    {
        $data = array();
        
        return view('fin::fin.currencies.index',
            [
                'data'=>$data,
                'amount'=>'400000'
            ]);
    }

    public function store(Request $request)
    {
        $data = array();
        
        $targetAmount = $request->input('amount');
        //$targetAmount = 800000;
        if($targetAmount!="" && $targetAmount>=50000)
        {
            $tw = new WiseHelper();
            $data_tw = $tw->getTempQuote($targetAmount);
            foreach($data_tw->paymentOptions as $paymentOption)
            {
                if($paymentOption->payIn=="BALANCE")
                {

                    $data[] = [
                        'type' => $paymentOption->payIn,
                        'value' => $paymentOption->sourceAmount,
                    ];
                    
                }
                if($paymentOption->payIn=="MC_DEBIT_OR_PREPAID")
                {
                    
                    $data[] = [
                        'type' => $paymentOption->payIn,
                        'value' => $paymentOption->sourceAmount,
                    ];

                }
                if($paymentOption->payIn=="MC_BUSINESS_DEBIT")
                {
                    
                    $data[] = [
                        'type' => $paymentOption->payIn,
                        'value' => $paymentOption->sourceAmount,
                    ];

                }
            
                
            }
        }

        
        return view('fin::fin.currencies.index',
            [
                'data'=>$data,
                'amount'=>$targetAmount
            ]);
    }
}

?>