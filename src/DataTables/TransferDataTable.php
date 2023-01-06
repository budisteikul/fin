<?php

namespace budisteikul\fin\DataTables;

use budisteikul\toursdk\Models\Transfer;
use budisteikul\toursdk\Helpers\GeneralHelper;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TransferDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('status',function($id){
                if($id->status==1)
                {
                    return '<span class="badge badge-success">Completed</span>';
                }
                else if($id->status==3)
                {
                    return '<span class="badge badge-danger">Canceled</span>';
                }
                else
                {
                    return '<span class="badge badge-warning">Waiting</span>';
                }
            })
            ->editColumn('idr', function($id){
                return GeneralHelper::numberFormat($id->idr,'IDR');
            })
            ->editColumn('usd', function($id){
                return GeneralHelper::numberFormat($id->usd,'USD');
            })
            ->editColumn('created_at', function($id){
                    return GeneralHelper::dateFormat($id->created_at,10);
                })
            ->addColumn('bank', function($id){
                    return $id->recipient->account_holder .' - '. $id->recipient->account_number .' - '. $id->recipient->bank_name;
                })
            ->addIndexColumn()
            ->addColumn('action', function ($id) {
                
                

                return '<div class="btn-toolbar justify-content-end"><div class="btn-group mr-2 mb-0" role="group">
                
                <button id="btn-del" type="button" onClick="DELETE(\''. $id->id .'\')" class="btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i> Delete</button> 
                </div><div class="btn-group mb-2" role="group"></div></div>';
            })
            ->rawColumns(['action','status'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Transfer $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Transfer $model): QueryBuilder
    {
        return $model->with('recipient')->orderBy('created_at','DESC')->newQuery();
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
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            
                  
            Column::computed('DT_RowIndex')
                  ->width(30)
                  ->title('No')
                  ->orderable(false)
                  ->searchable(false)
                  ->addClass('text-center align-middle'),
            
            Column::make('created_at')->orderable(false)->width(200)
                  ->searchable(false),
            //Column::make('recipient.bank_name')->title('Bank Name')->width(200)->orderable(false)->addClass('align-middle'),
            //Column::make('recipient.account_number')->title('Account Number')->width(200)->orderable(false)->addClass('align-middle'),
            Column::make('bank')->title('To')->orderable(false)->width(400)->orderable(false)->addClass('align-middle'),
            Column::make('idr')->title('IDR')->orderable(false)->width(200)->addClass('align-middle'),
            Column::make('usd')->title('USD')->orderable(false)->width(200)->addClass('align-middle'),
            Column::make('status')->width(200)->orderable(false),

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
        return 'Transfer_' . date('YmdHis');
    }
}
