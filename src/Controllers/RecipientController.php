<?php

namespace budisteikul\fin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use budisteikul\fin\DataTables\RecipientDataTable;
use Illuminate\Support\Facades\Validator;
use budisteikul\toursdk\Models\Recipient;
use budisteikul\toursdk\Helpers\WiseHelper;

class RecipientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RecipientDataTable $dataTable)
    {
        return $dataTable->render('fin::fin.recipients.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
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
        $validator = Validator::make($request->all(), [
            'action' => 'required',
            'status' => 'required',
        ]);
        
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json($errors);
        }
        
        $action =  $request->input('action');
        $status =  $request->input('status');

        if($action=="update")
        {
            Recipient::query()->update(['auto_transfer' => 0]);
            $recipient = Recipient::findOrFail($id);
            if($status==1)
            {
                $recipient->auto_transfer = 1;
                $recipient->save();
            }
            
        }

        return response()->json([
                    "id" => "1",
                    "message" => 'Success'
                ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        WiseHelper::deleteRecipient($id->wise_id);
        Recipient::find($id)->delete();
    }
}
