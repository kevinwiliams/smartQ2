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
            ->editColumn('description', function (BusinessCategory $model) {
                return Str::limit($model->description, 50);
            })
            ->editColumn('created_at', function (BusinessCategory $model) {
                return Carbon::parse($model->created_at)->format('d M Y, h:i a');
            })          
            ->rawColumns(['action'])
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
            ->orderBy(2, 'desc')
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
