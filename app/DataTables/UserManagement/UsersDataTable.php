<?php

namespace App\DataTables\UserManagement;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
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
            ->rawColumns(['action','user','last_login_at','id'])
            ->editColumn('last_login_at', function (User $model) {
                $str = '';

                if($model->last_login_at)
                    $str = '<div class="badge badge-light fw-bolder">' . Carbon::parse($model->last_login_at)->diffForHumans() .'</div>';     

                return $str;
            })
            ->editColumn('department', function (User $model) {
                return ($model->department)?$model->department->name:'';
            })
            ->editColumn('role', function (User $model) {                
                $str = '';
                
                foreach ($model->getRoleNames()->toArray() as $_roleName) {
                    $str = $_roleName;
                }

                return ucwords($str);
            })
            ->editColumn('id', '<div class="form-check form-check-sm form-check-custom form-check-solid"><input class="form-check-input" type="checkbox" value="1"></div>')
            ->editColumn('created_at', function (User $model) {      
                return Carbon::parse($model->created_at)->format('d M Y, h:i a');
            })
            ->addColumn('action', 'pages.apps.user-management.users._action-menu')
            // ->addColumn('user', 'pages.apps.user-management.users._user-td');
            ->addColumn('user', function (User $model) {
                return view('pages.apps.user-management.users._user-td', compact('model'));
            });  
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
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
                    ->setTableId('mv_table_users')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    // ->dom('Bfrtip')
                    ->orderBy(5)
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
            Column::make('id')->title('<div class="form-check form-check-sm form-check-custom form-check-solid me-3"><input class="form-check-input" type="checkbox" data-mv-check="true" data-mv-check-target="#mv_table_users .form-check-input" value="1" id="mv_users_select_all"></div>')
            ->orderable(false),
            Column::computed('user')
            ->addClass('d-flex align-items-center')           
            ->responsivePriority(-1),
            // Column::make('firstname'),
            // Column::make('lastname'),            
            Column::make('role'),
            Column::make('department')
            ->searchable(false),
            Column::make('last_login_at')->title(__('Last Login')),
            Column::make('created_at'),
            Column::computed('action')
            ->addClass('align-items-right')
            ->exportable(false)
            ->printable(false)
            ->width(100)            
            ->responsivePriority(-1),         
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Users_' . date('YmdHis');
    }
}
