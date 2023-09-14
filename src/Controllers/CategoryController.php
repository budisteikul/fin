<?php

namespace budisteikul\fin\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use budisteikul\fin\DataTables\CategoriesDataTable;
use Illuminate\Support\Facades\Validator;
use budisteikul\fin\Models\fin_categories;
use budisteikul\fin\Models\fin_transactions;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoriesDataTable $dataTable)
    {
        return $dataTable->render('fin::fin.categories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fin::fin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
          	'name' => 'required|string|max:255',
			'type' => 'in:Expenses,Revenue,Cost of Goods Sold'
       	]);
        
       	if ($validator->fails()) {
            $errors = $validator->errors();
			return response()->json($errors);
       	}
		
		$name =  $request->input('name');
		$type =  $request->input('type');
		
		$fin_categories = new fin_categories();
		$fin_categories->name = $name;
		$fin_categories->type = $type;
		$fin_categories->save();
		
		return response()->json([
					"id" => "1",
					"message" => 'Success'
				]);
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
        $fin_categories = fin_categories::findOrFail($id);
        return view('fin::fin.categories.edit',['categories'=>$fin_categories]);
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
          	'name' => 'required|string|max:255',
			'type' => 'in:Expenses,Revenue,Cost of Goods Sold'
       	]);
        
       	if ($validator->fails()) {
            $errors = $validator->errors();
			return response()->json($errors);
       	}
		
		$name =  $request->input('name');
		$type =  $request->input('type');
		
		$fin_categories = fin_categories::findOrFail($id);
		$fin_categories->name = $name;
		$fin_categories->type = $type;
		$fin_categories->save();
		
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
        fin_categories::find($id)->delete();
		fin_transactions::where('category_id', $id)->delete();
    }
}
