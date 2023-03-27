<?php

namespace App\DataTables\BusinessCategory;

use App\Models\BusinessCategory;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BusinessCategoryDataTable extends DataTable
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
            ->editColumn('name', function(BusinessCategory $model){
                $html = '<div class="d-flex align-items-sm-center mb-7">';
                // $html .= '<div class="symbol symbol-60px symbol-2by3 flex-shrink-0 me-4">';
                // $html .= '<img src="'. asset(theme()->getMediaUrlPath() . 'media/stock/600x400/img-3.jpg').'" class="mw-100" alt=""></div>';
                $html .= '<div class="symbol symbol-40px symbol-circle me-5">';
                $html .= '<img src="'. $model->logo_url.'" alt="image"></div>';
                // $html .= '<div class="symbol symbol-50px me-2">';
                // $html .= '<span class="symbol-label bg-light-success">'. theme()->getSvgIcon("icons/duotune/general/gen025.svg", "svg-icon-2x svg-icon-success").' </span></div>';

				$html .= '<div class="d-flex flex-row-fluid flex-wrap align-items-center">';
                $html .= '<div class="flex-grow-1 me-2">';
				$html .= '<a class="text-gray-800 fw-bolder text-hover-primary fs-4" href="'.theme()->getPageUrl('company/view/'.$model->id) .'">'.$model->name.'</a>';
                
                $html  .= '</div></div></div>';
				return $html;
            })
            ->editColumn('description', function (BusinessCategory $model) {
                return Str::limit($model->description, 50);
            })
            ->editColumn('created_at', function (BusinessCategory $model) {
                return Carbon::parse($model->created_at)->format('d M Y, h:i a');
            })          
            ->rawColumns(['action','name'])
            ->addColumn('action', function (BusinessCategory $model) {
                return view('pages.businesscategory._action-menu', compact('model'));
            }); 
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\BusinessCategory $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(BusinessCategory $model)
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
            ->setTableId('mv_category_table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            // ->dom('Bfrtip')
            ->orderBy(3, 'desc')
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
            Column::make('description'),
            Column::make('company_count')->title("Companies"),
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
        return 'BusinessCategories_' . date('YmdHis');
    }
}
