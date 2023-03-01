<?php

namespace budisteikul\fin\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use budisteikul\toursdk\Helpers\WiseHelper;
use budisteikul\fin\Models\fin_transactions;

use budisteikul\toursdk\Models\ShoppingcartProduct;
use Ramsey\Uuid\Uuid;
use budisteikul\toursdk\Helpers\FirebaseHelper;
use budisteikul\toursdk\Helpers\TazapayHelper;
use budisteikul\toursdk\Helpers\BookingHelper;
use budisteikul\toursdk\Helpers\RapydHelper;
use Carbon\Carbon;

class TestController extends Controller
{
    public function test(Request $request)
    {
        $tw = new WiseHelper();
        

        
        $quote = $tw->postCreateQuote(null,'USD',100000,'IDR');
        $transfer = $tw->postCreateTransfer($quote->id,Uuid::uuid4()->toString(),148746146);
        //print_r($transfer);
        $fund = $tw->postFundTransfer($transfer->id);
        print_r($fund);
        
    }
    
}
