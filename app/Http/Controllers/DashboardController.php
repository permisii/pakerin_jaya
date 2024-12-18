<?php

namespace App\Http\Controllers;

use App\Models\PP;
use App\Models\User;
use App\Models\WorkInstruction;
use App\Support\Enums\PPStatusEnum;
use App\Support\Enums\WorkInstructionStatusEnum;
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

        $usersCount = User::count();

        $unprocessedPps = PP::where('status', PPStatusEnum::Input)->count();

        $draftedWorkInstructions = WorkInstruction::where('status', WorkInstructionStatusEnum::Draft)->count();

        return $this->renderView('dashboard.index', [
            'breadcrumbs' => $this->getBreadcrumbs(),
            'users_count' => $usersCount,
            'unprocessed_pps' => $unprocessedPps,
            'drafted_work_instructions' => $draftedWorkInstructions,
            'params' => $this->getParams(),
        ]);
    }
}
