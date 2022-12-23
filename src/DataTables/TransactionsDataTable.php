<?php

namespace budisteikul\fin\DataTables;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use budisteikul\fin\Models\fin_transactions;
use budisteikul\fin\Models\fin_categories;
use budisteikul\toursdk\Helpers\GeneralHelper;

class TransactionsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query): EloquentDataTable
    {
        return datatables($query)
            ->addIndexColumn()
			->editColumn('category_id', function ($id) {
				$fin_categories = fin_categories::findOrFail($id->category_id);
				return $fin_categories->name;
            })
            ->addColumn('date_text', function($id){
                    return GeneralHelper::dateFormat($id->date,4);
                })
            ->editColumn('amount', function($id){
                return number_format($id->amount, 0, ',', '.');
            })
			->addColumn('action', function ($id) {
				return '<div class="btn-toolbar justify-content-end"><div class="btn-group mr-2 mb-0" role="group"><button id="btn-edit" type="button" onClick="EDIT(\''.$id->id.'\'); return false;" class="btn btn-sm btn-success"><i class="fa fa-edit"></i> Edit</button><button id="btn-del" type="button" onClick="DELETE(\''. $id->id .'\')" class="btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i> Delete</button></div><div class="btn-group mb-2" role="group"></div></div>';
            })
			->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Fin/TransactionsDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(fin_transactions $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->addAction(['title' => '','width' => '220px','class' => 'text-center'])
                    ->parameters([
						'language' => [
							'paginate' => [
								'previous'=>'<i class="fa fa-step-backward"></i>',
								'next'=>'<i class="fa fa-step-forward"></i>',
								'first'=>'<i class="fa fa-fast-backward"></i>',
								'last'=>'<i class="fa fa-fast-forward"></i>'
								]
							],
						'pagingType' => 'full_numbers',
						'responsive' => true,
						'order' => [0,'desc']
                    ])
					->ajax('/'.request()->path());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {
        return [
			["name" => "date", "title" => "date", "data" => "date", "orderable" => true, "visible" => false,'searchable' => false],
            ["name" => "DT_RowIndex", "title" => "No", "data" => "DT_RowIndex", "orderable" => false, "render" => null,'searchable' => false, 'width' => '30px'],
			["name" => "category_id", "title" => "Name", "data" => "category_id", "orderable" => false],
			["name" => "date_text", "title" => "Date", "data" => "date_text", "orderable" => false],
			["name" => "amount", "title" => "Amount", "data" => "amount", "orderable" => false]
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Fin/Transactions_' . date('YmdHis');
    }
}
