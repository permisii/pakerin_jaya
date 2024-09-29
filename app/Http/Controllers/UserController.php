<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\MenuResource;
use App\Http\Resources\UnitResource;
use App\Http\Resources\UserResource;
use App\Models\Menu;
use App\Models\Unit;
use App\Models\User;
use App\Support\Enums\IntentEnum;
use App\Traits\Controllers\Searchable;
use Illuminate\Http\Request;

class UserController extends Controller {
    use Searchable;

    public function index(Request $request, UsersDataTable $dataTable) {
        $this->checkPermission('read', 'users');
        $intent = $request->get('intent');

        switch ($intent) {
            case IntentEnum::USER_SEARCH_USERS->value:
                $users = $this->search($request, User::class, ['name', 'email']);

                return UserResource::collection($users);
        }

        $units = Unit::all();

        $this->setBreadcrumbs([
            'Home' => route('dashboard'),
            'Users' => '',
        ]);

        $this->setParams([
            'title' => 'Users',
            'subtitle' => 'List of users',
        ]);

        return $dataTable->render('users.index', ['units' => $units, 'params' => $this->getParams(), 'breadcrumbs' => $this->getBreadcrumbs()]);
    }

    public function create() {
        $this->checkPermission('create', 'users');
        $units = UnitResource::collection(Unit::all());

        $this->setBreadcrumbs([
            'Home' => route('dashboard'),
            'Users' => route('users.index'),
            'Create' => '',
        ]);

        $this->setParams([
            'title' => 'Create User',
            'subtitle' => 'Create a new user',
        ]);

        return $this->renderView('users.create', ['units' => $units]);
    }

    public function store(StoreUserRequest $request) {
        $this->checkPermission('create', 'users');
        User::create($request->validated());

        return redirect()->route('users.index')->with('success', 'User created.');
    }

    public function show(User $user) {
        $this->checkPermission('read', 'users');
        $units = UnitResource::collection(Unit::all());
        $user = new UserResource($user->load('unit', 'updatedBy', 'createdBy'));

        $this->setBreadcrumbs([
            'Home' => route('dashboard'),
            'Users' => route('users.index'),
            $user->name => '',
        ]);

        $this->setParams([
            'title' => 'User',
            'subtitle' => 'User details',
        ]);

        return $this->renderView('users.show', ['user' => $user, 'units' => $units]);
    }

    public function edit(User $user) {
        $this->checkPermission('update', 'users');
        $user = new UserResource($user->load('unit', 'updatedBy', 'createdBy'));
        $menus = MenuResource::collection(Menu::all());
        $userPermissions = $user->accessMenus->keyBy('menu_id');


        $this->setBreadcrumbs([
            'Home' => route('dashboard'),
            'Users' => route('users.index'),
            $user->name => route('users.show', $user->id),
            'Edit' => '',
        ]);

        $this->setParams([
            'title' => 'Edit User',
            'subtitle' => 'Edit user details',
        ]);

        return $this->renderView('users.edit', ['user' => $user, 'menus' => $menus, 'userPermissions' => $userPermissions]);
    }

    public function update(UpdateUserRequest $request, User $user) {
        $this->checkPermission('update', 'users');
        $data = $request->only(['name', 'email', 'nip', 'unit_id', 'active']);

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User updated.');
    }

    public function destroy(User $user) {
        $this->checkPermission('delete', 'users');
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted.');
    }

    public function updateAccess(Request $request, User $user) {
        $permissions = $request->permissions;

        logger($permissions);

        if ($permissions == null) {
            $user->accessMenus()->delete();
            return redirect()->route('users.index')->with('success', 'Permissions updated successfully.');
        }

        foreach ($permissions ?? [] as $menuCode => $perm) {
            // Find the menu ID based on the menu code
            $menu = Menu::where('code', $menuCode)->first();

            if (!$menu) {
                // Skip if the menu is not found
                continue;
            }

            // Check if the user already has access to this menu
            $accessMenu = $user->accessMenus()->where('menu_id', $menu->id)->first();

            // Gather permission values from the form
            $canRead = isset($perm['view']) ? 1 : 0;
            $canCreate = isset($perm['create']) ? 1 : 0;
            $canUpdate = isset($perm['update']) ? 1 : 0;
            $canDelete = isset($perm['delete']) ? 1 : 0;
            $canEtc = isset($perm['etc']) ? 1 : 0;

            // If no permissions are checked, delete the access menu if it exists
            if ($canRead == 0 && $canCreate == 0 && $canUpdate == 0 && $canDelete == 0 && $canEtc == 0) {
                if ($accessMenu) {
                    $accessMenu->delete();
                }

                continue;
            }

            // If the access menu exists, update it
            if ($accessMenu) {
                $accessMenu->update([
                    'can_read' => $canRead,
                    'can_create' => $canCreate,
                    'can_update' => $canUpdate,
                    'can_delete' => $canDelete,
                    'can_etc' => $canEtc,
                    'updated_by' => auth()->id(),
                ]);
            } else {
                // Otherwise, create a new access menu record
                $user->accessMenus()->create([
                    'menu_id' => $menu->id,
                    'can_read' => $canRead,
                    'can_create' => $canCreate,
                    'can_update' => $canUpdate,
                    'can_delete' => $canDelete,
                    'can_etc' => $canEtc,
                    'created_by' => auth()->id(),
                    'updated_by' => auth()->id(),
                ]);
            }
        }

        return redirect()->route('users.index')->with('success', 'Permissions updated successfully.');
    }
}