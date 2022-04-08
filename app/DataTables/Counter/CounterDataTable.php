<?php

namespace App\DataTables\Counter;

use App\Models\Counter;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CounterDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->rawColumns(['updated_at', 'status'])
            ->editColumn('created_at', function(Counter $model){
                return Carbon::parse($model->created_at)->format('d M Y, h:i a');
            })->editColumn('updated_at', function(Counter $model){
                $str = '';
                if($model->updated_at)
                    $str = '<div class="badge badge-light fw-bolder">' . Carbon::parse($model->updated_at)->diffForHumans() .'</div>';     
                return $str;
            })
            ->editColumn('status', function(Counter $model){
                $col = ($model->status == 1)? 'success' : 'danger';
                $txt = ($model->status == 1)? 'Active' : 'Inactive';
                $str = '<div class="badge badge-light-'.$col.' fw-bolder">' . $txt .'</div>';     
                return $str;
            })
            ->addColumn('action', function (Counter $model) {
                return view('pages.counter._action-menu', compact('model'));
            });  
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Counter $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Counter $model)
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
                    ->setTableId('counter-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    // ->dom('Bfrtip')
                    ->orderBy(1);
                    // ->buttons(
                    //     Button::make('create'),
                    //     Button::make('export'),
                    //     Button::make('print'),
                    //     Button::make('reset'),
                    //     Button::make('reload')
                    // );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('name'),
            Column::make('description'),
            Column::make('status'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Counter_' . date('YmdHis');
    }
}
