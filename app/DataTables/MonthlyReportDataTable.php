<?php

namespace App\DataTables;

use App\Models\WorkInstruction;
use App\Support\Enums\AssignmentStatusEnum;
use App\Support\Enums\WorkInstructionStatusEnum;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class MonthlyReportDataTable extends DataTable {
    /**
     * Build the DataTable class.
     *
     * @param  QueryBuilder  $query  Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (WorkInstruction $workInstruction) {
                return view('daily-report.action', ['workInstruction' => $workInstruction]);
            })
            ->addColumn('worker', function (WorkInstruction $workInstruction) {
                return $workInstruction->user->name;
            })
            ->addColumn('status', function (WorkInstruction $workInstruction) {
                if ($workInstruction->status == WorkInstructionStatusEnum::Draft->value) {
                    return '<span class="badge badge-warning">Pending</span>';
                } elseif ($workInstruction->status == WorkInstructionStatusEnum::Submitted->value) {
                    return '<span class="badge badge-success">Approved</span>';
                }

                //                return '<span class="badge badge-danger">Rejected</span>';

            })
            ->addColumn('assignments', function (WorkInstruction $workInstruction) {
                if ($workInstruction->assignments->isEmpty()) {
                    return '<span class="text-muted">No assignments</span>';
                }

                $assignmentList = '';
                foreach ($workInstruction->assignments as $assignment) {
                    // Determine the badge style based on the assignment's `status`
                    $statusBadge = '';
                    if ($assignment->status === AssignmentStatusEnum::Draft->value) {
                        $statusBadge = '<span class="badge badge-primary">Lanjut</span>';
                    } elseif ($assignment->status === AssignmentStatusEnum::Process->value) {
                        //
                    } elseif ($assignment->status === AssignmentStatusEnum::Done->value) {
                        $statusBadge = '<span class="badge badge-success">Selesai</span>';
                    }

                    $assignmentProblem = $assignment->problem;
                    $percentage = $assignment->percentage;

                    // Concatenate assignment details with the badge
                    $assignmentList .= '<li class="list-group-item">' .
                        "{$assignmentProblem} ({$percentage}%)" . ' ' . // Escape output for assignment problem
                        $statusBadge .
                        '</li>';
                }

                return '
    <ul class="list-group">
        ' . $assignmentList . '
    </ul>';
            })
            ->rawColumns(['action', 'status', 'assignments'])
            ->setRowId('id');
    }

    public function query(WorkInstruction $model): QueryBuilder {
        // Fetch the filters from the request
        $dateRange = request('date_range'); // Format: 'YYYY-MM-DD to YYYY-MM-DD'
        $workerId = request('worker_id');

        // Start building the query
        $query = $model->newQuery();

        // Filter by the selected date range
        if ($dateRange) {
            // Split the date range into start and end dates
            [$startDate, $endDate] = explode(' to ', $dateRange);
            $query->whereBetween('work_date', [$startDate, $endDate]);
        }

        // Filter by the selected worker
        if ($workerId) {
            $query->where('user_id', $workerId);
        }

        //        // Apply additional filters for admin or regular users
        //        if (auth()->user()->is_admin) {
        //            $query->where('status', WorkInstructionStatusEnum::Submitted->value);
        //        } else {
        //            $query->where('user_id', auth()->id());
        //        }

        return $query;
    }

    public function html(): HtmlBuilder {
        return $this->builder()
            ->setTableId('dailyreport-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                'excel',
                'csv',
                'pdf',
                'print',
            ]);
    }

    protected function getColumns(): array {
        return [
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::make('worker')->title('Nama Pegawai'),
            Column::make('work_date')->title('Tanggal Kerja'),
            Column::make('assignments')->title('Pekerjaan'),
            Column::make('status')->title('Status IK'),
        ];
    }

    protected function filename(): string {
        return 'DailyReport_' . date('YmdHis');
    }
}
