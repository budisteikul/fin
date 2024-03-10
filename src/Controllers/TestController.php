<?php

namespace budisteikul\fin\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use budisteikul\fin\Classes\FinClass;
use budisteikul\toursdk\Helpers\GeneralHelper;
use Barryvdh\DomPDF\Facade as PDF;

use budisteikul\fin\Models\fin_transactions;
use budisteikul\fin\Models\fin_categories;

use Webklex\PDFMerger\Facades\PDFMergerFacade as PDFMerger;

class TestController extends Controller
{
    public function test()
    {
        print_r(FinClass::first_date_transaction());
        $fin_transactions = fin_transactions::orderBy('date')->first();
        print_r($fin_transactions->date);
    }
    
}
