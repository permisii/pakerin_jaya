<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UnitResource;
use App\Http\Resources\UserResource;
use App\Models\Unit;
use App\Models\User;
use App\Support\Enums\IntentEnum;
use App\Traits\Controllers\Searchable;
use Illuminate\Http\Request;

class UserController extends Controller {
    use Searchable;

    public function index(Request $request, UsersDataTable $dataTable) {
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
        User::create($request->validated());

        return redirect()->route('users.index')->with('success', 'User created.');
    }

    public function show(User $user) {
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

        return $this->renderView('users.show', ['user' => $user]);
    }

    public function edit(User $user) {
        $units = UnitResource::collection(Unit::all());
        $user = new UserResource($user->load('unit', 'updatedBy', 'createdBy'));

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

        return $this->renderView('users.edit', ['user' => $user, 'units' => $units]);
    }

    public function update(UpdateUserRequest $request, User $user) {
        $data = $request->only(['name', 'email', 'nip', 'unit_id', 'active']);

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User updated.');
    }

    public function destroy(User $user) {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted.');
    }
}
