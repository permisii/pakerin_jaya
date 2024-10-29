<?php

namespace App\Http\Controllers;

use App\Models\WorkInstruction;

abstract class Controller {
    protected $breadcrumbs = [];
    protected $params = [];

    protected function setBreadcrumbs(array $breadcrumbs) {
        $this->breadcrumbs = $breadcrumbs;
    }

    protected function getBreadcrumbs() {
        return $this->breadcrumbs;
    }

    protected function setParams(array $params) {
        $this->params = $params;
    }

    protected function getParams() {
        return $this->params;
    }

    protected function renderView($view, $data = []) {
        return view($view, array_merge($data, ['breadcrumbs' => $this->getBreadcrumbs(), 'params' => $this->getParams()]));
    }

    protected function checkPermission($permissionType, $menuCode) {
        // Get the user's access to this menu based on the menu code
        $accessMenu = auth()->user()->accessMenus()->whereHas('menu', function ($query) use ($menuCode) {
            $query->where('code', $menuCode);
        })->first();

        if (!$accessMenu) {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to access this page.')->send();
        }

        // Check for specific permission (create, read, update, delete)
        $hasPermission = match ($permissionType) {
            'create' => $accessMenu->can_create,
            'read' => $accessMenu->can_read,
            'update' => $accessMenu->can_update,
            'delete' => $accessMenu->can_delete,
            'etc' => $accessMenu->can_etc,
            default => false,
        };

        if (!$hasPermission) {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to access this page.')->send();
        }

        return true;
    }

    /**
     * Restrict other workers except admin
     * Used in WorkInstructionController and AssignmentController
     */
    protected function restrictOtherWorkerExceptAdmin(WorkInstruction $workInstruction): void {
        if (!auth()->user()->is_admin && $workInstruction->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
    }
}
