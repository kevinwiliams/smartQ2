<?php

namespace App\DataTables\VisitReason;

use App\Models\Department;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VisitReasonDataTable extends DataTable
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
            ->editColumn('reasons', function (Department $model) {                
                $htmlstr = "";
                if ($model->visitreasons()) {
                    $reasonarray = $model->visitreasons()->pluck('reason')->toArray();
                    foreach ($reasonarray as $_reason) {
                        $htmlstr .= '<div class="badge badge-secondary fw-bolder">' . $_reason .'</div> ';     
                    }
                    // return implode(", ", $model->visitreasons()->pluck('reason')->toArray());
                }

                return $htmlstr;
            })
            ->addColumn('action', function (Department $model) {
                return view('pages.location.reasonforvisit._action-menu', compact('model'));
            })
            ->rawColumns(['reasons']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Department $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Department $model)
    {
        return $model->newQuery()
            ->where('department.location_id', $this->deptlocation_id);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('visitreason-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            // ->dom('Bfrtip')
            ->orderBy(0,'asc')
            ->responsive()
            ->autoWidth(false)
            ->parameters(['scrollX' => true])
            ->addTableClass('align-middle table-row-dashed fs-6 gy-5');
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
            Column::make('name'),
            Column::make('reasons')->orderable(false),
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
        return 'VisitReasons_' . date('YmdHis');
    }
}
