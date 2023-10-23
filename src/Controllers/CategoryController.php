<?php

namespace budisteikul\fin\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use budisteikul\fin\DataTables\CategoriesDataTable;
use Illuminate\Support\Facades\Validator;
use budisteikul\fin\Models\fin_categories;
use budisteikul\fin\Models\fin_transactions;
use budisteikul\fin\Classes\FinClass;

class CategoryController extends Controller
{
    public function test()
    {
        $test = FinClass::getChild(29);
        print_r($test);
    }
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
        $categories = FinClass::getCategories();
        return view('fin::fin.categories.create',['categories'=>$categories]);
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
          	'name' => 'required|string|max:255|unique:fin_categories,name',
			'type' => 'in:Expenses,Revenue,Cost of Goods Sold'
       	]);
        
       	if ($validator->fails()) {
            $errors = $validator->errors();
			return response()->json($errors);
       	}
		
		$name =  $request->input('name');
		$type =  $request->input('type');
		$parent_id =  $request->input('parent_id');

		$fin_categories = new fin_categories();
		$fin_categories->name = $name;
        $fin_categories->parent_id = $parent_id;
		if($parent_id>0) {
            $type = fin_categories::select(['type'])->where('id', $parent_id)->first();
            $fin_categories->type = $type->type;
        } else {
            $fin_categories->type = $type;
        }
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
    public function edit(fin_categories $category)
    {
        $categories = FinClass::getCategories(true,$category->id);
        return view('fin::fin.categories.edit',['category'=>$category,'categories'=>$categories]);
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
        $parent_id =  $request->input('parent_id');
		
		$fin_categories = fin_categories::findOrFail($id);
		$fin_categories->name = $name;
        $fin_categories->parent_id = $parent_id;
        

        if($parent_id>0) {
            $type = fin_categories::select(['type'])->where('id', $parent_id)->first();
            $fin_categories->type = $type->type;
        } else {
            $fin_categories->type = $type;
        }
		
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
    public function destroy(fin_categories $category)
    {
        fin_categories::where('parent_id',$category->id)->update(['parent_id'=>0]);
        fin_transactions::where('category_id', $category->id)->delete();
        $category->delete();
		
    }
}
