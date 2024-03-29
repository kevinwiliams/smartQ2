<?php

namespace App\DataTables\SMS;

use App\Models\SmsHistory;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SmsHistoryDataTable extends DataTable
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
            ->editColumn('message', function (SmsHistory $model) {
                return Str::limit($model->message, 50);
            })
            ->editColumn('response', function (SmsHistory $model) {
                return Str::limit($model->response, 50);
            })
            ->addColumn('action', function (SmsHistory $model) {
                return view('pages.sms._action-menu', compact('model'));
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\SmsHistory $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(SmsHistory $model)
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
            ->setTableId('smshistory-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->stateSave(true)
            ->orderBy(0)
            ->responsive()
            ->autoWidth(false)
            ->parameters(['scrollX' => true])
            ->addTableClass('align-middle table-row-dashed fs-6 gy-5');
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
            Column::make('from'),
            Column::make('to'),
            Column::make('message'),
            Column::make('response'),
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
        return 'SmsHistory_' . date('YmdHis');
    }
}
