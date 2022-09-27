<?php

namespace App\DataTables\Reports;

use App\Models\ScheduledReport;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ScheduledReportsDataTable extends DataTable
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
            ->blacklist(['report_name'])
            ->editColumn('user_id', function (ScheduledReport $model) {
                $officerName = !empty($model->user) ? $model->user->firstname : 'N/A';
                return $officerName . '<input type=hidden name=officer value=' . (!empty($model->user) ? $model->user_id : 0) . '><input type=hidden name=report-id value=' . $model->id . '>';
            })
            ->editColumn('created_at', function (ScheduledReport $model) {
                // $str = '<div class="badge badge-light">' . Carbon::parse($model->created_at)->format('d M Y, h:i a') . '</div>';
                $str = Carbon::parse($model->created_at)->format('d M Y, h:i a');
                return $str;
            })
            ->editColumn('active', function (ScheduledReport $model) {
                $col = ($model->active == 1) ? 'success' : 'danger';
                $txt = ($model->active == 1) ? 'Active' : 'Inactive';
                $str = '<div class="badge badge-light-' . $col . ' fw-bolder">' . $txt . '</div>';
                return $str;
            })            
            ->addColumn('action', function (ScheduledReport $model) {
                return view('pages.scheduledreports._active-menu', compact('model'));
            })
            ->rawColumns(['action', 'user_id','active']);;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ScheduledReport $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ScheduledReport $model)
    {        
        return $model->newQuery()
            ->where('user_id', $this->report_user_id);;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('scheduledreports-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('rtip')
                    ->responsive()
                    ->orderBy(5);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {        
        return [
            // Column::make('id'),
            Column::make('name'),
            Column::make('report_name')->title(__('Report Name')),
            Column::make('schedule_type')->title(__('Report Type')),
            Column::make('active')->title(__('Active')),
            Column::make('user_id')->title(__('User')),            
            // Column::make('is_vip'),
            // Column::make('created_by'),
            Column::make('created_at'),
            //Column::make('updated_at'),
            Column::computed('action')
                ->sortable(false)
                ->exportable(false)
                ->printable(false)
                ->width(100)
                ->addClass('text-center')
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
        return 'ScheduledReports_' . date('YmdHis');
    }
}
