<?php

namespace budisteikul\fin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use budisteikul\fin\Models\fin_transactions;
use budisteikul\fin\Models\fin_categories;
use budisteikul\toursdk\Models\Shoppingcart;
use budisteikul\toursdk\Models\ShoppingcartProduct;
use Illuminate\Database\Eloquent\Builder;

class SalesController extends Controller
{
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fin_date_start = env('FIN_DATE_START');
        $fin_date_end = date('Y-m-d') .' 23:59:00';

        $tahun = $request->input('year');

        if($tahun=="") $tahun = date("Y");
        
        $shoppingcarts = Shoppingcart::whereHas('shoppingcart_products', function ($query) use ($tahun) {
                            return $query->whereYear('date',$tahun);
                         })->where('booking_status','CONFIRMED')
                         ->select(['booking_channel'])
                         ->groupBy('booking_channel')
                         ->get();
        

        $fin_categories_revenues = fin_categories::where('type','Revenue')->whereHas('transactions', function (Builder $query) use ($tahun,$fin_date_start,$fin_date_end) {
                $query->whereYear('date',$tahun)->where('date', '>=', $fin_date_start )->where('date', '<=', $fin_date_end );
        })->orderBy('name')->get();

        $fin_categories_expenses = fin_categories::where('type','Expenses')->whereHas('transactions', function (Builder $query) use ($tahun,$fin_date_start,$fin_date_end) {
                $query->whereYear('date',$tahun)->where('date', '>=', $fin_date_start )->where('date', '<=', $fin_date_end );
        })->orderBy('name')->get();
        
        $fin_categories_cogs = fin_categories::where('type','Cost of Goods Sold')->whereHas('transactions', function (Builder $query) use ($tahun,$fin_date_start,$fin_date_end) {
                $query->whereYear('date',$tahun)->where('date', '>=', $fin_date_start )->where('date', '<=', $fin_date_end );
        })->orderBy('name')->get();
        
        
        return view('fin::fin.sales.profitloss',
            [
                'shoppingcarts'=>$shoppingcarts,
                'fin_categories_revenues'=>$fin_categories_revenues,
                'fin_categories_expenses'=>$fin_categories_expenses,
                'fin_categories_cogs'=>$fin_categories_cogs,
                'tahun'=>$tahun
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
