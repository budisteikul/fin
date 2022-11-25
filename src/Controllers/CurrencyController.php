<?php

namespace budisteikul\fin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use budisteikul\toursdk\Helpers\WiseHelper;

class CurrencyController extends Controller
{
	public function index()
    {
        return view('fin::fin.currencies.index');
    }

    public function store(Request $request)
    {
        $targetAmount = $request->input('amount');
        if($targetAmount!="" && $targetAmount>=50000)
        {
            $message = '';
            
            $tw = new WiseHelper();
            $data_tw = $tw->getTempQuote($targetAmount);
            foreach($data_tw->paymentOptions as $paymentOption)
            {
                
                if($paymentOption->payIn=="MC_DEBIT_OR_PREPAID")
                {
                    
                    $message = $paymentOption->sourceAmount .' USD';
                }
                
            
                
            }

            return response()->json([
                    "id" => "1",
                    "message" => number_format($targetAmount, 0, ',', '.') .' IDR = '. $message
                ]);
            
        }

        return response()->json([
                    'amount' => 'Amount must higher than 50.000'
                ]);
        
    }
}

?>