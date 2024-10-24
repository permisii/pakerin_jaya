<?php

namespace App\DataTables;

use App\Models\ServiceCard;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PCServiceCardsDataTable extends DataTable {
    /**
     * Build the DataTable class.
     *
     * @param  QueryBuilder  $query  Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable {
        return (new EloquentDataTable($query))
            ->addColumn('workers', function (ServiceCard $serviceCard) {
                return $serviceCard->workProcesses->map(function ($workProcess) {
                    return $workProcess->user->name;
                })->implode(', ');
            })
            ->addColumn('action', function (ServiceCard $serviceCard) {
                $editUrl = route('service-cards.edit', ['service_card' => $serviceCard->id, 'device_type' => \App\Models\PC::class, 'device_name' => $serviceCard->device->name]);
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
        $pc = request()->route('pc');

        return $model->newQuery()->where('device_id', $pc->id)->with('workProcesses.user');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder {
        return $this->builder()
            ->setTableId('pc-service-cards-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload'),
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
            Column::make('date'),
            Column::make('description'),
            Column::make('workers')->orderable(false)->searchable(false),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string {
        return 'PCServiceCards_' . date('YmdHis');
    }
}
