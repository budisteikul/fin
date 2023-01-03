<?php

namespace budisteikul\fin\Controllers;
use App\Http\Controllers\Controller;

use budisteikul\fin\Requests\StoreTransferRequest;
use budisteikul\fin\Requests\UpdateTransferRequest;
use budisteikul\fin\Models\Transfer;

use budisteikul\fin\DataTables\TransferDataTable;
use budisteikul\toursdk\Helpers\WiseHelper;

class TransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TransferDataTable $dataTable)
    {
        return $dataTable->render('fin::fin.transfer.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fin::fin.transfer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTransferRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransferRequest $request)
    {
        $amount = $request->input('amount');
        $sourceAmount = 0;

        if($amount<50000)
        {
            return response()->json([
                    'errors' => [
                        'amount' => array('Amount must higher than 50.000')
                        ] 
                ],422);
        }

        
        $tw = new WiseHelper();
        $data_tw = $tw->getTempQuote($amount);
        foreach($data_tw->paymentOptions as $paymentOption)
        {
                
                if($paymentOption->payIn=="MC_DEBIT_OR_PREPAID")
                {
                    
                    $sourceAmount = $paymentOption->sourceAmount;
                }
                
            
                
        }
        

        Transfer::create([
            'idr' => $amount,
            'usd' => $sourceAmount,
            'status' => 0
        ]);

        response()->json(['success' => 'success'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function show(Transfer $transfer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function edit(Transfer $transfer)
    {
        return view('fin::fin.transfer.edit',['transfer'=>$transfer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTransferRequest  $request
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransferRequest $request, Transfer $transfer)
    {
        $amount = $request->input('amount');
        $sourceAmount = 0;

        if($amount<50000)
        {
            return response()->json([
                    'errors' => [
                        'amount' => array('Amount must higher than 50.000')
                        ] 
                ],422);
        }

        
        $tw = new WiseHelper();
        $data_tw = $tw->getTempQuote($amount);
        foreach($data_tw->paymentOptions as $paymentOption)
        {
                
                if($paymentOption->payIn=="MC_DEBIT_OR_PREPAID")
                {
                    
                    $sourceAmount = $paymentOption->sourceAmount;
                }
                
            
                
        }
        

        $transfer->update(['idr'=>$amount,'usd'=>$sourceAmount]);
        response()->json(['success' => 'success'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transfer $transfer)
    {
        $transfer->delete();
    }
}
