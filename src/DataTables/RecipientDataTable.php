<?php

namespace budisteikul\fin\DataTables;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
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
    public function dataTable(QueryBuilder $query): EloquentDataTable
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
    public function query(Recipient $model): QueryBuilder
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
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::make('created_at')
                  ->visible(false)
                  ->searchable(false),
            Column::computed('DT_RowIndex')
                  ->width(30)
                  ->title('No')
                  ->orderable(false)
                  ->searchable(false)
                  ->addClass('text-center align-middle'),
            //Column::make('wise_id')->title('ID')->orderable(false)->addClass('align-middle'),
            Column::make('bank_name')->title('Bank Name')->orderable(false)->addClass('align-middle'),
            Column::make('account_holder')->title('Account Holder')->orderable(false)->addClass('align-middle'),
            Column::make('account_number')->title('Account Number')->orderable(false)->addClass('align-middle'),
            Column::make('auto_transfer')->title('Auto Transfer')->orderable(false)->addClass('text-center align-middle'),
            /*
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(220)
                  ->addClass('text-center'),
            */
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
