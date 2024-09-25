<?php

namespace App\Http\Controllers;

use App\DataTables\MonthlyReportDataTable;
use App\Models\WorkInstruction;
use Illuminate\Http\Request;

class MonthlyReportController extends Controller {
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, MonthlyReportDataTable $dataTable) {
        $this->checkPermission('read', 'monthly-reports');
        $this->setBreadcrumbs([
            'Home' => route('dashboard'),
            'Monthly Report' => '',
        ]);

        $this->setParams([
            'title' => 'Monthly Report',
            'subtitle' => 'List of monthly reports',
        ]);

        $todayWorkInstruction = WorkInstruction::where('work_date', date('Y-m-d'))
            ->where('user_id', auth()->id())
            ->first();

        return $dataTable->render('monthly-report.index', ['params' => $this->getParams(), 'breadcrumbs' => $this->getBreadcrumbs(), 'todayWorkInstruction' => $todayWorkInstruction]);
    }
}
