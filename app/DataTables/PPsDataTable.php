<?php

namespace App\DataTables;

use App\Models\PP;
use App\Support\Enums\PPStatusEnum;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PPsDataTable extends DataTable {
    /**
     * Build the DataTable class.
     *
     * @param  QueryBuilder  $query  Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable {
        return (new EloquentDataTable($query))
            ->addColumn('need_date', function (PP $pp) {
                return $pp->need_date->format('d/m/Y');
            })
            ->addColumn('status', function (PP $pp) {
                return $pp->status == PPStatusEnum::Input
                    ? '<span class="badge badge-primary">Input</span>'
                    : '<span class="badge badge-warning">Proses</span>';
            })
            ->addColumn('created_by', function (PP $pp) {
                return $pp->createdBy->name;
            })
            ->addColumn('action', function (PP $pp) {
                return view('pps.action', ['pp' => $pp]);
            })
            ->rawColumns(['status', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(PP $model): QueryBuilder {
        $date_filter = request('date_filter');
        $status_filter = request('status_filter');

        if ($date_filter) {
            $model = $model->where('need_date', 'like', $date_filter . '%');
        }

        if ($status_filter) {
            $model = $model->where('status', $status_filter);
        }

        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder {
        return $this->builder()
            ->setTableId('pps-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->selectStyleSingle()
            ->dom('<"d-flex justify-content-between"<"d-block mb-2"B><"ml-auto"f>>rtip')
            ->lengthChange(false)
            ->addTableClass('w-100')
            ->buttons([
                Button::make([
                    'text' => '<i class="fas fa-plus"></i> Tambah PP',
                    'action' => 'function() {
                        window.location.href = "' . route('pps.create') . '";
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
            Column::make('item_name')->title('Nama Barang'),
            Column::make('remaining')->title('Sisa'),
            Column::make('need')->title('Kebutuhan'),
            Column::make('buy')->title('Pembelian'),
            Column::make('unit')->title('Satuan'),
            Column::make('need_date')->title('Tanggal Kebutuhan'),
            Column::make('status')->title('Status'),
            Column::make('created_by')->title('Dibuat Oleh'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string {
        return 'PPs_' . date('YmdHis');
    }
}
