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
    public function test()
    {
        $shoppingcart_products = ShoppingcartProduct::whereHas('shoppingcart', function ($query) {
                return $query->where('booking_status','CONFIRMED');
        })->whereNotNull('date')->where('date', '<', date('Y-m-d H:i:s') )->orderBy('date', 'DESC')->get();
        foreach($shoppingcart_products as $shoppingcart_product)
        {
            print_r($shoppingcart_product->shoppingcart->confirmation_code .'<br />');
            print_r($shoppingcart_product->shoppingcart->session_id .'<br />');
            $shoppingcart_product->shoppingcart->session_id = Uuid::uuid4()->toString();
            $shoppingcart_product->shoppingcart->save();
        }
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
