<?php

namespace App\DataTables\Token;

use App\Models\Token;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TokenDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $query = Token::where('status', '0')
        ->orderBy('is_vip', 'DESC')
        ->orderBy('id', 'ASC');

        return datatables()
            ->eloquent($query)
            ->editColumn('token_no', function(Token $model){
                $str = '<div class="badge badge-light fw-bolder">' .$model->token_no .'</div>';     
                return $str;
            })
            ->editColumn('client_id', function (Token $model) {
                $clientName = !empty( $model->client->firstname)? $model->client->firstname:'N/A';
                return $clientName;
                // return $model->client->firstname;
            })
            ->editColumn('counter_id', function (Token $model) {
                return $model->counter->name;
            })
            ->editColumn('department_id', function (Token $model) {
                return $model->department->name;
            })
            ->editColumn('user_id', function (Token $model) {
                $officerName = !empty( $model->officer->firstname)? $model->officer->firstname:'N/A';
                return $officerName;
            })
            ->addColumn('action', function (Token $model) {
                return view('pages.admin.token._active-menu', compact('model'));
            })
            ->rawColumns(['action','token_no']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Token $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Token $model)
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
                    ->setTableId('token-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('rtip')
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
            // Column::computed('action')
            //       ->exportable(false)
            //       ->printable(false)
            //       ->width(60)
            //       ->addClass('text-center'),
            Column::make('id'),
            Column::make('token_no'),
            Column::make('client_id')->title(__('Client Name')),
            Column::make('department_id')->title(__('Department')),
            Column::make('counter_id')->title(__('Counter')),
            Column::make('user_id')->title(__('Officer')),
            Column::make('is_vip'),
            Column::make('created_by'),
            Column::make('created_at'),
            //Column::make('updated_at'),
            Column::computed('action')
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
        return 'Token_' . date('YmdHis');
    }
}
