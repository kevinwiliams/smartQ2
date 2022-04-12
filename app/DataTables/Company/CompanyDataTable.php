<?php

namespace App\DataTables\Company;

use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CompanyDataTable extends DataTable
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
            ->orderColumn('created_at', true)
            ->rawColumns(['active','action', 'name'])        
            ->editColumn('created_at', function (Company $model) {      
                return Carbon::parse($model->created_at)->format('d M Y, h:i a');
            })
            ->editColumn('name', function(Company $model){
                $html = '<div class="d-flex align-items-sm-center mb-7">';
                // $html .= '<div class="symbol symbol-60px symbol-2by3 flex-shrink-0 me-4">';
                // $html .= '<img src="'. asset(theme()->getMediaUrlPath() . 'media/stock/600x400/img-3.jpg').'" class="mw-100" alt=""></div>';

                $html .= '<div class="symbol symbol-50px me-2">';
                $html .= '<span class="symbol-label bg-light-success">'. theme()->getSvgIcon("icons/duotune/general/gen025.svg", "svg-icon-2x svg-icon-success").' </span></div>';

				$html .= '<div class="d-flex flex-row-fluid flex-wrap align-items-center">';
                $html .= '<div class="flex-grow-1 me-2">';
				$html .= '<a class="text-gray-800 fw-bolder text-hover-primary fs-4" href="'.theme()->getPageUrl('company/view/'.$model->id) .'">'.$model->name.'</a>';
                
                if(!empty($model->address))
                    $html .= '<span class="text-muted fw-bold d-block pt-1">'. theme()->getSvgIcon("icons/duotune/general/gen018.svg", "svg-icon-3"). $model->address. '</span>';
                
                $html  .= '</div></div></div>';
				return $html;
            })
            ->editColumn('active', function (Company $model) {      
                if($model->active){
                    return '<div class="badge badge-success fw-bolder">Active</div>';
                }else{
                    return '<div class="badge badge-danger fw-bolder">Inactive</div>';
                }
            })
            ->addColumn('action', function (Company $model) {
                return view('pages.company._action-menu', compact('model'));
            });  
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Company $model)
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
                    ->setTableId('mv_company_table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    // ->dom('Bfrtip')
                    ->orderBy(4, 'desc')
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
            Column::make('name'),                        
            // Column::make('address'),        
            Column::make('description'),
            Column::make('active'),
            Column::make('location_count')->title('Locations'),        
            Column::make('created_at'),    
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
        return 'Company_' . date('YmdHis');
    }
}
