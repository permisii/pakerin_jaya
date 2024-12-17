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

    /**
     * Check single permission
     */
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
     * Check multiple permissions
     *
     * Usage:
     * ```
     * // Example 1: Redirect mode (default)
     * $this->checkMultiplePermissions([['read', 'users'], ['update', 'pps']]);
     *
     * // Example 2: Boolean mode (silent failure)
     * if (!$this->checkMultiplePermissions([['read', 'users'], ['update', 'pps']], true)) {
     * // Take alternative action
     * abort(403, 'Unauthorized');
     * }
     * ```
     */
    protected function checkMultiplePermissions(array $permissions, bool $returnBoolean = false, bool $strict = true) {
        $hasAnyPermission = false;

        foreach ($permissions as $permission) {
            [$permissionType, $menuCode] = $permission;

            // Get the user's access to the menu
            $accessMenu = auth()->user()->accessMenus()->whereHas('menu', function ($query) use ($menuCode) {
                $query->where('code', $menuCode);
            })->first();

            // If menu access is missing
            if (!$accessMenu) {
                if ($strict) {
                    if ($returnBoolean) {
                        return false;
                    }

                    return redirect()->route('dashboard')->with('error', 'You do not have permission to access this page.')->send();
                }

                continue; // Skip in non-strict mode
            }

            // Check for specific permissions
            $hasPermission = match ($permissionType) {
                'create' => $accessMenu->can_create,
                'read' => $accessMenu->can_read,
                'update' => $accessMenu->can_update,
                'delete' => $accessMenu->can_delete,
                'etc' => $accessMenu->can_etc,
                default => false,
            };

            if ($hasPermission) {
                $hasAnyPermission = true; // At least one permission is valid

                if (!$strict) {
                    // If not strict, allow one valid permission to pass
                    return $returnBoolean ? true : null;
                }
            } elseif ($strict) {
                // If strict, fail as soon as one permission check fails
                if ($returnBoolean) {
                    return false;
                }

                return redirect()->route('dashboard')->with('error', 'You do not have permission to access this page.')->send();
            }
        }

        // For strict checking, if all permissions pass
        if ($strict && !$returnBoolean) {
            return null; // Allow request
        }

        // For strict mode in boolean return or non-strict mode if no permission was valid
        return $returnBoolean ? $hasAnyPermission : ($hasAnyPermission ? null : redirect()->route('dashboard')->with('error', 'You do not have permission to access this page.')->send());
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
