<?php

namespace App\Http\Controllers;

use App\DataTables\DailyReportsDataTable;
use Illuminate\Http\Request;

class DailyReportController extends Controller {
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, DailyReportsDataTable $dataTable) {
        $this->setBreadcrumbs([
            'Home' => route('dashboard'),
            'Daily Report' => '',
        ]);

        $this->setParams([
            'title' => 'Daily Report',
            'subtitle' => 'List of daily reports',
        ]);

        return $dataTable->render('daily-report.index', ['params' => $this->getParams(), 'breadcrumbs' => $this->getBreadcrumbs()]);
    }
}
