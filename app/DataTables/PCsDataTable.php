<?php

namespace App\DataTables;

use App\Models\PC;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PCsDataTable extends DataTable {
    /**
     * Build the DataTable class.
     *
     * @param  QueryBuilder  $query  Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'pcs.action')
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(PC $model): QueryBuilder {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder {
        return $this->builder()
            ->setTableId('pcs-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->selectStyleSingle()
            ->dom('<"d-flex justify-content-between"<"d-block mb-2"B><"ml-auto"f>>rtip')
            ->lengthChange(false)
            ->addTableClass('w-100')
            ->buttons([
                Button::make([
                    'text' => '<i class="fas fa-plus"></i> Tambah PC',
                    'action' => 'function() {
                        window.location.href = "' . route('pcs.create') . '";
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
            Column::make('name')->title('Nama'),
            Column::make('date_of_initial_use')->title('Tanggal Penggunaan Awal'),
            Column::make('index'),
            Column::make('section')->title('Bagian'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string {
        return 'PCs_' . date('YmdHis');
    }
}
