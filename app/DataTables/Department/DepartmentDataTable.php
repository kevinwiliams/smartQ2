<?php

namespace App\DataTables\Department;

use App\Models\Department;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DepartmentDataTable extends DataTable
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
            ->editColumn('created_at', function (Department $model) {
                return Carbon::parse($model->created_at)->format('d M Y, h:i a');
            })->editColumn('updated_at', function (Department $model) {
                $str = '';
                if ($model->updated_at)
                    $str = '<div class="badge badge-light fw-bolder">' . Carbon::parse($model->updated_at)->diffForHumans() . '</div>';
                // $str =  Carbon::parse($model->updated_at)->diffForHumans();     
                return $str;
            })
            ->editColumn('status', function (Department $model) {
                $col = ($model->status == 1) ? 'success' : 'danger';
                $txt = ($model->status == 1) ? 'Active' : 'Inactive';
                $str = '<div class="badge badge-light-' . $col . ' fw-bolder">' . $txt . '</div>';
                return $str;
            })
            ->editColumn('avg_wait_time', function (Department $model) {
                $str = "";
                if ($model->stats) {
                    if ($model->stats->wait_time)
                        $str = '<div class="badge badge-light fw-bolder">' . $model->stats->wait_time . ' mins</div>';
                }else{
                    $str = '<div class="badge badge-light fw-bolder">' . $model->avg_wait_time .' mins</div>';     
                }

                return $str;
            })
            ->addColumn('action', function (Department $model) {
                return view('pages.location.department._action-menu', compact('model'));
            })
            ->rawColumns(['updated_at', 'status', 'avg_wait_time']);
        // ->addColumn('action', 'department.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Department $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Department $model)
    {
        return $model->newQuery()
            ->where('department.location_id', $this->deptlocation_id);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('department-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            // ->dom('Bfrtip')
            ->orderBy(1)
            ->responsive()
            ->autoWidth(false)
            ->parameters(['scrollX' => true])
            ->addTableClass('align-middle table-row-dashed fs-6 gy-5');
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
            // Column::computed('action')
            //       ->exportable(false)
            //       ->printable(false)
            //       ->width(60)
            //       ->addClass('text-center'),
            Column::make('id'),
            Column::make('name'),
            Column::make('description'),
            Column::make('status'),
            Column::make('avg_wait_time'),
            Column::make('created_at'),
            Column::make('updated_at'),
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
        return 'Department_' . date('YmdHis');
    }
}
