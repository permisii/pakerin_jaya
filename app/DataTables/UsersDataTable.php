<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable {
    /**
     * Build the DataTable class.
     *
     * @param  QueryBuilder  $query  Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable {
        return (new EloquentDataTable($query))
            ->addColumn('unit.name', function (User $user) {
                return $user->unit->name ?? '-';
            })
            ->addColumn('active', function (User $user) {
                return $user->active ? '<span class="badge badge-success">Yes</span>' : '<span class="badge badge-danger">No</span>';
            })
            ->rawColumns(['active', 'action'])
            ->addColumn('action', 'users.action')
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder {
        $query = $model->newQuery()->with('unit')->select('users.*');

        if (request()->has('unit_id') && request()->unit_id != '') {
            $query->where('unit_id', request()->unit_id);
        }

        return $query;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder {
        return $this->builder()
            ->setTableId('users-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->selectStyleSingle()
            ->dom('<"d-block mb-2"B><"d-flex justify-content-between"lf>rtip')
            ->addTableClass('w-100')
            ->buttons([
                Button::make([
                    'text' => '<i class="fas fa-plus"></i> Add User',
                    'action' => 'function() {
                        window.location.href = "' . route('users.create') . '";
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
            Column::make('nip'),
            Column::make('name'),
            Column::make('email'),
            Column::make('unit.name')->title('Unit'),
            Column::make('active')->title('Active'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string {
        return 'Users_' . date('YmdHis');
    }
}
