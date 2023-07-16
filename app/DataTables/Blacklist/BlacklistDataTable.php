<?php

namespace App\DataTables\Blacklist;

use App\Models\Blacklist;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BlacklistDataTable extends DataTable
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
            ->editColumn('block_date', function (Blacklist $model) {      
                return Carbon::parse($model->created_at)->format('d M Y, h:i a');
            })
            ->editColumn('is_active', function(Blacklist $model){
                $col = ($model->is_active == 1)? 'danger' : 'success';
                $txt = ($model->is_active == 1)? 'Blocked' : 'Unblocked';
                $str = '<div class="badge badge-light-'.$col.' fw-bolder">' . $txt .'</div>';     
                return $str;
            })
            ->editColumn('client_id', function (Blacklist $model) {
                $user = $model->client;
                return view('pages.viplist._user-td', compact('user'));
            })
            ->editColumn('user_id', function (Blacklist $model) {                
                return $model->user->name;
            })
            ->rawColumns(['action','user_id','client_id','block_date','is_active'])
            ->addColumn('action', 'pages.blacklist._action-menu');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \VIPList $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Blacklist $model)
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
            ->setTableId('blacklist-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            // ->dom('Bfrtip')
            ->orderBy(4, 'asc')
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
            Column::make('block_reason'),
            Column::make('is_active')->title(__('Status')),
            Column::make('blocked_duration')->title(__('Duration')),
            Column::make('block_date'),
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
        return 'Blacklist_' . date('YmdHis');
    }
}
