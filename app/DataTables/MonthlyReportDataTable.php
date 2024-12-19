<?php

namespace App\DataTables;

use App\Models\Assignment;
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
            ->addColumn('action', function (Assignment $assignment) {
                //                return view('daily-report.action', ['workInstruction' => $assignment]);
            })
            ->addColumn('worker', function (Assignment $assignment) {
                return $assignment->user->name;
            })
            ->addColumn('work_date', function (Assignment $assignment) {
                return $assignment->workInstruction->work_date;
            })
            ->addColumn('percentage', function (Assignment $assignment) {
                return $assignment->percentage . '%';
            })
            ->addColumn('status', function (Assignment $assignment) {
                if ($assignment->workInstruction->status == WorkInstructionStatusEnum::Draft->value) {
                    return '<span class="badge badge-warning">Pending</span>';
                } elseif ($assignment->workInstruction->status == WorkInstructionStatusEnum::Submitted->value) {
                    return '<span class="badge badge-success">Approved</span>';
                }

                //                return '<span class="badge badge-danger">Rejected</span>';

            })
            ->rawColumns(['action', 'status'])
            ->setRowId('id');
    }

    public function query(Assignment $model): QueryBuilder {
        // Fetch the filters from the request
        $dateRange = request('date_range'); // Format: 'YYYY-MM-DD to YYYY-MM-DD'
        $workerId = request('worker_id');

        // Start building the query
        $query = $model->newQuery();

        // Filter by the selected date range
        if ($dateRange) {
            // Split the date range into start and end dates
            [$startDate, $endDate] = explode(' to ', $dateRange);
            //            $query->whereBetween('work_date', [$startDate, $endDate]);
            $query->whereHas('workInstruction', function ($query) use ($startDate, $endDate) {
                $query->whereBetween('work_date', [$startDate, $endDate]);
            });
        }

        // Filter by the selected worker
        if ($workerId) {
            //            $query->where('user_id', $workerId);
            $query->whereHas('workInstruction', function ($query) use ($workerId) {
                $query->where('user_id', $workerId);
            });
        }

        //        $query->where('status', WorkInstructionStatusEnum::Submitted->value);

        $query->whereHas('workInstruction', function ($query) {
            $query->where('status', WorkInstructionStatusEnum::Submitted->value);
        });

        $query->orderBy('work_instruction_id', 'desc');

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
            //            Column::computed('action')
            //                ->exportable(false)
            //                ->printable(false)
            //                ->width(60)
            //                ->addClass('text-center'),
            Column::make('worker')->title('Nama Pegawai'),
            Column::make('work_date')->title('Tanggal IK'),
            Column::make('assignment_number')->title('NO PK'),
            Column::make('problem')->title('Pekerjaan'),
            Column::make('percentage')->title('Persentase'),
            Column::make('status')->title('Status IK'),
        ];
    }

    protected function filename(): string {
        return 'DailyReport_' . date('YmdHis');
    }
}
