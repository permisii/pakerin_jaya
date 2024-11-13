<?php

namespace App\DataTables;

use App\Models\PP;
use App\Support\Enums\PPStatusEnum;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class OPCreatePPsDataTable extends DataTable {
    /**
     * Build the DataTable class.
     *
     * @param  QueryBuilder  $query  Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable {
        return (new EloquentDataTable($query))
            ->addColumn('checkbox', function (PP $pp) {
                return '<input type="checkbox" name="pp_ids[]" value="' . $pp->id . '">';
            })
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
            ->rawColumns(['checkbox', 'status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(PP $model): QueryBuilder {
        return $model->newQuery()->where('status', PPStatusEnum::Input);
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
            ->lengthChange(false)
            ->addTableClass('w-100');
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array {
        return [
            Column::make('checkbox')->title('<input type="checkbox" id="checkAll">')->addClass('text-center'),
            Column::make('item_name')->title('Nama Barang'),
            Column::make('need')->title('Kebutuhan'),
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
        return 'OPsCreatePPs_' . date('YmdHis');
    }
}
