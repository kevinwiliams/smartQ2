<?php

namespace App\DataTables\Alerts;

use App\Models\Alert;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AlertsDataTable extends DataTable
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
            ->editColumn('description', function (Alert $model) {
                return Str::limit($model->description, 50);
            })
            ->editColumn('start_date', function(Alert $model){
                return Carbon::parse($model->created_at)->format('d M Y, h:i a');
            })
            ->editColumn('end_date', function(Alert $model){
                return Carbon::parse($model->created_at)->format('d M Y, h:i a');
            })
            ->editColumn('active', function(Alert $model){
                $col = ($model->active == 1)? 'success' : 'danger';
                $txt = ($model->active == 1)? 'Active' : 'Inactive';
                $str = '<div class="badge badge-light-'.$col.' fw-bolder">' . $txt .'</div>';     
                return $str;
            })
            ->addColumn('action', function (Alert $model) {
                return view('pages.alerts._action-menu', compact('model'));
            })
            ->rawColumns(['active']);;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Service $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Alert $model)
    {
        // return $model->newQuery();
        $locationId = $this->request->get('location_id'); // Get the filtered location_id

        $query = $model->newQuery();

        if ($locationId) {
            // Filter alerts based on location_id
            $query->whereHas('locations', function ($query) use ($locationId) {
                $query->where('location_id', $locationId);
            });
        }

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
                    ->setTableId('alerts-table')                    
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    // ->dom('Bfrtip')
                    ->orderBy(0,'asc')
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
            Column::make('title'),
            Column::make('start_date'),
            Column::make('end_date'),
            Column::make('active'),
            Column::make('location_names'),
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
        return 'Alerts_' . date('YmdHis');
    }
}
