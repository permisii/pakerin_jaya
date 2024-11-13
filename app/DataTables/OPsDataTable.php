<?php

namespace App\DataTables;

use App\Models\OP;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class OPsDataTable extends DataTable {
    /**
     * Build the DataTable class.
     *
     * @param  QueryBuilder  $query  Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (OP $op) {
                return view('ops.action', ['op' => $op]);
            })
            ->addColumn('date', function (OP $op) {
                return $op->date->format('d/m/Y');
            })
            ->addColumn('head_of_section_id', function (OP $op) {
                return $op->headOfSection->name;
            })
            ->rawColumns(['action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(OP $model): QueryBuilder {
        $date_filter = request('date_filter');

        if ($date_filter) {
            $model = $model->where('date', 'like', $date_filter . '%');
        }

        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder {
        return $this->builder()
            ->setTableId('ops-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->selectStyleSingle()
            ->dom('<"d-flex justify-content-between"<"d-block mb-2"B><"ml-auto"f>>rtip')
            ->lengthChange(false)
            ->addTableClass('w-100')
            ->buttons([
                Button::make([
                    'text' => '<i class="fas fa-plus"></i> Tambah OP',
                    'action' => 'function() {
                        window.location.href = "' . route('ops.create') . '";
                    }',
                    'className' => 'btn btn-default text-blue',
                ]),
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array {
        return [
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::make('department')->title('Departemen'),
            Column::make('code')->title('Kode'),
            Column::make('no')->title('Nomor'),
            Column::make('date')->title('Tanggal'),
            Column::make('first_requestor')->title('Peminta 1'),
            Column::make('second_requestor')->title('Peminta 2'),
            Column::make('approved_by')->title('Disetujui Oleh'),
            Column::make('head_of_section_id')->title('Kepala Seksi'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string {
        return 'OPs_' . date('YmdHis');
    }
}
