<?php

namespace App\Http\Controllers;

use App\DataTables\MonthlyReportDataTable;
use Illuminate\Http\Request;

class MonthlyReportController extends Controller {
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, MonthlyReportDataTable $dataTable) {
        $this->setBreadcrumbs([
            'Home' => route('dashboard'),
            'Monthly Report' => '',
        ]);

        $this->setParams([
            'title' => 'Monthly Report',
            'subtitle' => 'List of monthly reports',
        ]);

        return $dataTable->render('monthly-report.index', ['params' => $this->getParams(), 'breadcrumbs' => $this->getBreadcrumbs()]);
    }
}
