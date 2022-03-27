<?php

namespace App\DataTables\Company;

use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CompanyDataTable extends DataTable
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
            ->rawColumns(['action'])        
            ->editColumn('created_at', function (Company $model) {      
                return Carbon::parse($model->created_at)->format('d M Y, h:i a');
            })                       
            ->addColumn('action', function (Company $model) {
                return view('pages.apps.user-management.permissions._action-menu', compact('model'));
            });  
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Permission $model)
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
                    ->setTableId('kt_permissions_table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    // ->dom('Bfrtip')
                    ->orderBy(0)
                    ->responsive()
                    ->autoWidth(false)
                    ->parameters(['scrollX' => true])
                    ->addTableClass('align-middle table-row-dashed fs-6 gy-5')
                   ;
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [                       
            Column::make('name'),                        
            Column::make('description'),    
            Column::computed('assign')->title(__('Assigned To'))
            ->addClass('align-items-right')
            ->exportable(false)
            ->printable(false)
            ->responsivePriority(-1),       
            Column::make('created_at'),    
            Column::computed('action')
            ->addClass('align-items-right')
            ->exportable(false)
            ->printable(false)
            ->width(100)            
            ->responsivePriority(-1)  
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Permissions_' . date('YmdHis');
    }
}
