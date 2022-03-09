<?php

namespace App\DataTables\Token;

use App\Models\Token;
use Carbon\Carbon;
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
                $col = ($model->is_vip == 1)? 'danger' : 'primary';
                $txt = ($model->status == 1)? 'Active' : 'Inactive';
                
                $str = '<div class="badge badge-light-'.$col.' fw-bolder">' .$model->token_no .'</div>';     
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
            ->editColumn('created_by', function (Token $model) {
                $officerName = !empty( $model->generated_by->firstname)? $model->generated_by->firstname:'N/A';
                return $officerName;
            })
            ->editColumn('created_at', function(Token $model){
                $str = '<div class="badge badge-light">' . Carbon::parse($model->created_at)->format('d M Y, h:i a') .'</div>';   
                $str = Carbon::parse($model->created_at)->format('d M Y, h:i a');  
                return $str;
            })
            ->addColumn('action', function (Token $model) {
                return view('pages.admin.token._active-menu', compact('model'));
            })
            ->rawColumns(['action','token_no','created_at']);
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
            // Column::make('is_vip'),
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
