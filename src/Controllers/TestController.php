<?php

namespace budisteikul\fin\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use budisteikul\toursdk\Helpers\WiseHelper;
use budisteikul\fin\Models\fin_transactions;

use budisteikul\toursdk\Models\ShoppingcartProduct;
use Ramsey\Uuid\Uuid;

class TestController extends Controller
{
    public function test(Request $request)
    {
        print(date('Y-m-t'));
        //$amount = $request->input('amount');
        //$tw = new WiseHelper();
        //$tw->simulateAddFund($amount,'USD');
    }

    public function test___()
    {
        $tw = new WiseHelper();
        $quote = $tw->postCreateQuote(7.87,'USD');
        foreach($quote->paymentOptions as $paymentOption)
        {
            if($paymentOption->payIn=="BALANCE")
            {
                $transaction = new fin_transactions();
                $transaction->category_id = 11;
                $transaction->date = date('Y-m-d');
                $transaction->amount = $paymentOption->targetAmount;
                $transaction->save();
            }
        }
    }
    
}
