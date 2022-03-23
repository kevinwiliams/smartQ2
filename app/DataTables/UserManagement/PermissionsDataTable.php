<?php

namespace App\DataTables\UserManagement;

use App\Models\Permission;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PermissionsDataTable extends DataTable
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
            ->rawColumns(['assign', 'action'])        
            ->editColumn('created_at', function (Permission $model) {      
                return Carbon::parse($model->created_at)->format('d M Y, h:i a');
            })  
            ->editColumn('assign', function (Permission $model) {
                $roles = $model->getRoleNames()->toArray();
                $html = "";

                $style  = 'info';
                foreach ($roles as $_role) {
                    $html .= '<div class="badge badge-light-'.$style.' fw-bolder">'.ucfirst($_role).'</div> ';
                }  

                return $html;
            })
            ->addColumn('action', 'pages.apps.user-management.permissions._action-menu') ;  
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
                    ->setTableId('permissions-table')
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
            Column::make('id'),
            Column::make('name'),                        
            Column::computed('assign')->title(__('Assigned To'))
            ->addClass('align-items-right')
            ->exportable(false)
            ->printable(false)
            ->responsivePriority(-1),       
            Column::make('created_at'),
            Column::computed('action')

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
