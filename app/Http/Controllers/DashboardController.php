<?php

namespace App\Http\Controllers;

use App\Models\PP;
use App\Models\User;
use App\Support\Enums\PPStatusEnum;
use Illuminate\Http\Request;

class DashboardController extends Controller {
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request) {
        $this->setBreadcrumbs([
            'Home' => '',
        ]);

        $this->setParams([
            'title' => 'Dashboard',
            'subtitle' => 'Welcome to the dashboard',
        ]);

        $users_count = User::count();

        $unprocessed_pps = PP::where('status', PPStatusEnum::Input)->count();

        return $this->renderView('dashboard.index', [
            'breadcrumbs' => $this->getBreadcrumbs(),
            'users_count' => $users_count,
            'unprocessed_pps' => $unprocessed_pps,
            'params' => $this->getParams(),
        ]);
    }
}
