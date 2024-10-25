<?php

namespace App\DataTables;

use App\Models\ServiceCard;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PrinterServiceCardsDataTable extends DataTable {
    /**
     * Build the DataTable class.
     *
     * @param  QueryBuilder  $query  Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable {
        return (new EloquentDataTable($query))
            ->addColumn('date', function (ServiceCard $serviceCard) {
                return Carbon::parse($serviceCard->date)->format('d-m-Y');
            })
            ->addColumn('workers', function (ServiceCard $serviceCard) {
                return $serviceCard->workProcesses->map(function ($workProcess) {
                    return $workProcess->user->name;
                })->implode(', ');
            })
            ->addColumn('action', function (ServiceCard $serviceCard) {
                $editUrl = route('service-cards.edit', ['service_card' => $serviceCard->id, 'device_type' => \App\Models\Printer::class, 'device_brand' => $serviceCard->device->brand]);
                $deleteUrl = route('service-cards.destroy', $serviceCard->id);

                return '
                    <div class="d-flex">
                        <a href="' . $editUrl . '" class="btn btn-sm btn-primary">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="' . $deleteUrl . '" method="post" class="ml-2 d-inline" onsubmit="return confirm(\'Are you sure?\')">
                            ' . csrf_field() . method_field('delete') . '
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                ';
            })
            ->rawColumns(['action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ServiceCard $model): QueryBuilder {
        $printer = request()->route('printer');

        return $model->newQuery()->where('device_id', $printer->id)->with('workProcesses.user');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder {
        return $this->builder()
            ->setTableId('printer-service-cards-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('<"d-flex justify-content-between"<"d-block mb-2"B><"ml-auto"f>>rtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make([
                    'text' => 'Tambah Uraian Pekerjaan',
                    'className' => 'btn btn-default text-blue',
                    'action' => 'function() {
                        window.location.href = "' . route('service-cards.create', ['device_type' => \App\Models\Printer::class, 'device_name' => request()->route('printer')->name, 'device_id' => request()->route('printer')->id]) . '";
                    }',
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
            Column::make('date')->title('Tanggal'),
            Column::make('description')->title('Uraian'),
            Column::make('workers')->title('Pekerja')->orderable(false)->searchable(false),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string {
        return 'PrinterServiceCards_' . date('YmdHis');
    }
}
