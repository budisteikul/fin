<?php

namespace budisteikul\fin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use budisteikul\fin\Models\fin_transactions;
use budisteikul\fin\Models\fin_categories;
use Illuminate\Database\Eloquent\Builder;

use budisteikul\fin\Classes\FinClass;

class SalesController extends Controller
{
    
	
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tahun = date("Y");
        $tahun = $request->input('year');
        if($tahun=="") $tahun = date("Y");
        
        $fin_categories_revenues = fin_categories::where('type','Revenue')->whereHas('transactions', function (Builder $query) use ($tahun) {
                $query->whereYear('date',$tahun);
        })->orderBy('name')->get();
        
        $fin_categories_expenses = fin_categories::where('type','Expenses')->whereHas('transactions', function (Builder $query) use ($tahun) {
                $query->whereYear('date',$tahun);
        })->orderBy('name')->get();
        
        $fin_categories_cogs = fin_categories::where('type','Cost of Goods Sold')->whereHas('transactions', function (Builder $query) use ($tahun) {
                $query->whereYear('date',$tahun);
        })->orderBy('name')->get();
        
        
        return view('fin::fin.sales.profitloss',
            [
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
