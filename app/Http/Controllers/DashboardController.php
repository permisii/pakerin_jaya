<?php

namespace App\Http\Controllers;

use App\Models\User;
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

        return $this->renderView('dashboard.index', ['breadcrumbs' => $this->getBreadcrumbs(), 'users_count' => $users_count]);
    }
}
