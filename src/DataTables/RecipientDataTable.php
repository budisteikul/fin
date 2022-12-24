<?php

namespace budisteikul\fin\DataTables;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use budisteikul\toursdk\Models\Recipient;

class RecipientDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->addIndexColumn()
            ->editColumn('auto_transfer', function($id){
                if($id->auto_transfer==1)
                {
                    return '<a href="#" onClick="UPDATE(\''. $id->id .'\',0)"><i class="fas fa-check-circle text-success"></i></a>';
                }
                else
                {
                    return '<a href="#" onClick="UPDATE(\''. $id->id .'\',1)"><i class="fas fa-times-circle text-danger"></i></a>';
                }
            })
			->addColumn('action', function ($id) {
				return '<div class="btn-toolbar justify-content-end"><div class="btn-group mr-2 mb-0" role="group">
                <button id="btn-del" type="button" onClick="DELETE(\''. $id->id .'\')" class="btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i> Delete</button></div><div class="btn-group mb-2" role="group"></div></div>';
            })
			->rawColumns(['action','auto_transfer']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Fin/CategoriesDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Recipient $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->addAction(['title' => '','width' => '220px','class' => 'text-center'])
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
    protected function getColumns()
    {
        return [
			["name" => "id", "title" => "created_at", "data" => "created_at", "orderable" => true, "visible" => false,'searchable' => false],
            ["name" => "DT_RowIndex", "title" => "No", "data" => "DT_RowIndex", "orderable" => false, "render" => null,'searchable' => false, 'width' => '30px'],
            ["name" => "wise_id", "title" => "ID", "data" => "wise_id", "orderable" => false],
            ["name" => "nickname", "title" => "Nickname", "data" => "nickname", "orderable" => false],
			["name" => "account_holder", "title" => "Account Holder", "data" => "account_holder", "orderable" => false],
			["name" => "account_number", "title" => "Account Number", "data" => "account_number", "orderable" => false],
            ["name" => "auto_transfer", "title" => "Auto Transfer", "data" => "auto_transfer", "orderable" => false,'class' => 'text-center']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Fin/Recipient_' . date('YmdHis');
    }
}
