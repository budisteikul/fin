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
        $output = FirebaseHelper::read_payment('3fc1a358-99e5-4073-ae91-29807ec4ba7');
        if($output=="")
        {
            print_r("output");
        }
        print_r($output);
    }
    
}
