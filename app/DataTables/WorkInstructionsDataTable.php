<?php

namespace App\DataTables;

use App\Models\WorkInstruction;
use App\Support\Enums\WorkInstructionStatusEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class WorkInstructionsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param  QueryBuilder  $query  Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('user.nip', function (WorkInstruction $workInstruction) {
                return $workInstruction->user->nip ?? '-';
            })
            ->editColumn('user.name', function (WorkInstruction $workInstruction) {
                return $workInstruction->user->name ?? '-';
            })
            ->editColumn('work_date', function (WorkInstruction $workInstruction) {
                $workDate = Carbon::parse($workInstruction->work_date);
                return $workDate->format('d/m/Y');
            })
            ->editColumn('status', function (WorkInstruction $workInstruction) {
                return match ($workInstruction->status) {
                    WorkInstructionStatusEnum::Draft->value => '<span class="badge badge-warning">Pending</span>',
                    WorkInstructionStatusEnum::Submitted->value => '<span class="badge badge-success">Selesai Dilaporkan</span>',
                    WorkInstructionStatusEnum::Rejected->value => '<span class="badge badge-danger">Rejected</span>',
                    default => '-',
                };
            })
            ->rawColumns(['status', 'action'])
            ->editColumn('action', function (WorkInstruction $workInstruction) {
                return view('work-instructions.action', [
                    'workInstruction' => $workInstruction,
                    'id' => $workInstruction->id,
                ]);
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(WorkInstruction $model): QueryBuilder
    {
        $date_filter = request('date_filter');

        if ($date_filter) {
            $model = $model->where('work_date', 'like', $date_filter . '%');
        }

        return $model->newQuery()->with('user');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('work-instructions-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('<"d-flex justify-content-between"<"d-block mb-2"B><"ml-auto"f>>rtip')
            ->lengthChange(false)
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons(
                Button::make([
                    'text' => '<i class="fas fa-plus"></i> Tambah Instruksi Kerja',
                    'action' => 'function() {
                        window.location.href = "' . route('work-instructions.create') . '";
                    }',
                    'className' => 'btn btn-default text-blue',
                ]),
                Button::make([
                    'extend' => 'excel',
                    'text' => '<i class="far fa-file-excel"></i> Export Excel',
                    'title' => 'WorkInstructions_' . date('YmdHis'),
                    'className' => 'btn btn-default text-green',
                    'filename' => 'WorkInstructions_' . date('YmdHis'),
                    'exportOptions' => [
                        'columns' => ':not(:first-child)', // excluding action column
                    ],
                ]),
            );
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-left'),
            Column::make('work_date')->title('Work Date')
                ->width(100)
                ->addClass('text-center'),
            Column::make('user.nip')->title('NIP')
                ->width(100)
                ->addClass('text-center'),
            Column::make('user.name')->title('Name')
                ->addClass('text-left'),
            Column::make('status')
                ->width(120)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'WorkInstructions_' . date('YmdHis');
    }
}
