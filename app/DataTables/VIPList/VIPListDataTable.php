<?php

namespace App\DataTables\VIPList;

use App\Models\VIPList as ModelsVIPList;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VIPListDataTable extends DataTable
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
            ->editColumn('created_at', function (ModelsVIPList $model) {      
                return Carbon::parse($model->created_at)->format('d M Y, h:i a');
            })
            ->editColumn('client_id', function (ModelsVIPList $model) {
                $user = $model->client;
                return view('pages.viplist._user-td', compact('user'));
            })
            ->editColumn('user_id', function (ModelsVIPList $model) {                
                return $model->user->name;
            })
            ->rawColumns(['action','user_id','client_id','created_at'])
            ->addColumn('action', 'pages.viplist._action-menu');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \VIPList $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ModelsVIPList $model)
    {

        $query = $model->newQuery()->where('location_id', $this->location_id);

        return $query;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('viplist-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            // ->dom('Bfrtip')
            ->orderBy(2, 'asc')
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
            Column::make('client_id')->title(__('Client')),
            Column::make('reason'),
            Column::make('created_at'),
            Column::make('user_id')->title(__('User')),
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
        return 'VIPList_' . date('YmdHis');
    }
}
