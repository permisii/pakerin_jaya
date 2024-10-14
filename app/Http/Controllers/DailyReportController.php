<?php

namespace App\Http\Controllers;

use App\DataTables\DailyReportsDataTable;
use Illuminate\Http\Request;

class DailyReportController extends Controller {
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, DailyReportsDataTable $dataTable) {
        $this->checkPermission('read', 'daily-reports');
        $this->setBreadcrumbs([
            'Home' => route('dashboard'),
            'Daily Report' => '',
        ]);

        $this->setParams([
            'title' => 'Laporan Harian',
            'subtitle' => 'Daftar Laporan Harian',
        ]);

        return $dataTable->render('daily-report.index', ['params' => $this->getParams(), 'breadcrumbs' => $this->getBreadcrumbs()]);
    }
}
