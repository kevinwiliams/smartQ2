<?php

namespace App\DataTables\Location;

use App\Models\Company;
use App\Models\Location;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LocationDataTable extends DataTable
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
        ->rawColumns(['active','coords', 'name', 'location_stat', 'location_setup'])
        ->editColumn('name', function (Location $model) {
            $company = Company::where('id', $model->company_id)->pluck('name')->first();

            $location   = '<span class="text-dark fw-bolder text-hover-primary mb-1 fs-6">'.$model->name.'</span>';
            $location   .= '<span class="text-muted fw-bold d-block fs-7">'.$company.'</span>';
            return $location;
        })        
        ->editColumn('created_at', function (Location $model) {      
            return Carbon::parse($model->created_at)->format('d M Y, h:i a');
        })
        ->addColumn('location_setup', function(){
            $setupStats   = '<span class="text-dark fw-bold text-hover-primary mb-1 fs-6">Departments</span>: 4 <br>';
            $setupStats   .= '<span class="text-dark fw-bold text-hover-primary mb-1 fs-6">Counters</span>: 14';
            // $setupStats   .= '<span class="text-muted fw-bold d-block fs-7">Counters</span>: 12';

            return $setupStats;
        })
        ->addColumn('location_stat', function(){
            $html   = '<div class="d-flex flex-column w-100 me-2">';
            $html   .= '<div class="d-flex flex-stack mb-2">';
            $html   .= '<span class="text-muted me-2 fs-7 fw-bold">Pending: 50%</span>';
            $html   .= '</div>';
            $html   .= '<div class="progress-bar bg-primary" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>';
            $html   .= '</div>';
            $html   .= '</div>';

            return $html;
        })
       ->addColumn('coords', function (Location $model) {      
            if($model->lat)
                return '<div class="badge badge-success fw-bolder">'.$model->lat.','. $model->lon.'</div>';
           
        })
        ->addColumn('action', function (Location $model) {
            return view('pages.location._action-menu', compact('model'));
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Location $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Location $model)
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
                    ->setTableId('mv_location_table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    // ->dom('Bfrtip')
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
            Column::make('name'),                        
            Column::make('address'),        
            Column::make('coords'),
            Column::make('location_setup')->title('Setup'),        
            Column::make('location_stat')->title('Stats'),        
            Column::make('created_at'),    
            Column::make('updated_at'),    
            Column::computed('action')
            ->addClass('align-items-right')
            ->exportable(false)
            ->printable(false)
            ->width(100)            
            ->responsivePriority(-1)  
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Location_' . date('YmdHis');
    }
}
