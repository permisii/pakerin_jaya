<?php

namespace App\DataTables;

use App\Models\Assignment;
use App\Models\WorkInstruction;
use App\Support\Enums\AssignmentStatusEnum;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Log;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AssignmentsDataTable extends DataTable {
    /**
     * Build the DataTable class.
     *
     * @param  QueryBuilder  $query  Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable {
        return (new EloquentDataTable($query))
            ->addColumn('work_instruction_id', function (Assignment $assignment) {
                return $assignment->work_instruction_id;
            })
            ->addColumn('id', function (Assignment $assignment) {
                return view('assignments.action', [
                    'workInstruction' => $assignment->workInstruction,
                    'assignment' => $assignment,
                    'id' => $assignment->id,
                ]);
            })
            ->editColumn('status', function (Assignment $assignment) {
                switch ($assignment->status) {
                    case AssignmentStatusEnum::Draft->value:
                        return '<span class="badge badge-primary">Lanjut</span>';
                    case AssignmentStatusEnum::Process->value:
                        return '<span class="badge badge-warning">Proses</span>';
                    case AssignmentStatusEnum::Done->value:
                        return '<span class="badge badge-success">Selesai Dilaporkan</span>';
                    default:
                        return '<span class="badge badge-secondary">Unknown</span>';
                }
            })
            ->rawColumns(['status', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Assignment $model): QueryBuilder {
        // Retrieve the work_instruction_id from the route parameters
        $workInstruction = request()->route('work_instruction');
        Log::info($workInstruction);

        // Filter assignments by the work_instruction_id
        return $model->newQuery()
            ->where('work_instruction_id', $workInstruction->id);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder {
        $workInstructionId = request()->route('work_instruction') ? request()->route('work_instruction')->id : null;
        $isAssignedUser = auth()->user()->id === request()->route('work_instruction')->user_id;

        $buttons = [
            Button::make([
                'text' => '<i class="fas fa-plus"></i> Tambah Pekerjaan',
                'action' => 'function() {
                window.location.href = "' . route('work-instructions.assignments.create', $workInstructionId) . '";
            }',
                'className' => 'btn btn-default text-blue',
            ]),
        ];

        if ($isAssignedUser) {
            $buttons[] = Button::make([
                'text' => '<i class="fas fa-check"></i> Reporting',
                'action' => 'function() {
                document.getElementById("submit-form").submit();
            }',
                'className' => 'btn btn-default text-success',
            ]);
        }

        return $this->builder()
            ->setTableId('assignments-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle()
            ->dom('<"d-block mb-2"B><"d-flex justify-content-between"lf>rtip')
            ->addTableClass('w-100')
            ->dom('<"d-flex justify-content-between"<"d-block mb-2"B><"ml-auto"f>>rtip')
            ->lengthChange(false)
            ->buttons($buttons);
    }

    /**
     * Get the dataTable columns definition.
     * $this->workInstruction = $workInstruction;
     */
    public function getColumns(): array {
        return [
            Column::make('id')
                ->title('Aksi')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::make('assignment_number')
                ->title('Nomor PK')
                ->addClass('text-left'),
            Column::make('problem')
                ->title('Masalah')
                ->addClass('text-left'),
            Column::make('percentage')
                ->title('Persentase')
                ->addClass('text-center'),
            Column::make('status')
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string {
        return 'Assignments_' . date('YmdHis');
    }
}
