@extends('layouts.app')

@section('content')
    <form id="update-form-{{ $user->id }}" action="{{ route('users.update-access', $user->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline">
                    <div class="card-body">
                        <table id="data-table" class="table table-bordered table-striped table-hover nowrap">
                            <thead>
                            <th>Menu</th>
                            <th>
                                View
                                <button type="button" class="btn btn-sm btn-outline-primary" onclick="toggleCheckAll('view')">Check All</button>
                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeAll('view')">Remove All</button>
                            </th>
                            <th>
                                Create
                                <button type="button" class="btn btn-sm btn-outline-primary" onclick="toggleCheckAll('create')">Check All</button>
                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeAll('create')">Remove All</button>
                            </th>
                            <th>
                                Update
                                <button type="button" class="btn btn-sm btn-outline-primary" onclick="toggleCheckAll('update')">Check All</button>
                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeAll('update')">Remove All</button>
                            </th>
                            <th>
                                Delete
                                <button type="button" class="btn btn-sm btn-outline-primary" onclick="toggleCheckAll('delete')">Check All</button>
                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeAll('delete')">Remove All</button>
                            </th>
                            <th>
                                Etc
                                <button type="button" class="btn btn-sm btn-outline-primary" onclick="toggleCheckAll('etc')">Check All</button>
                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeAll('etc')">Remove All</button>
                            </th>
                            </thead>
                            <tbody>
                            @foreach($menus as $menu => $perm)
                                @php
                                    $userPerm = $userPermissions[$perm['id']] ?? null;
                                @endphp
                                <tr>
                                    <td>{{ ucfirst($perm['name']) }}</td>
                                    <td>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input checkbox-view" id="view-{{ $menu }}" name="permissions[{{ $perm['code'] }}][view]" {{ $userPerm && $userPerm->can_read ? 'checked' : '' }}>
                                            <label class="form-check-label" for="view-{{ $menu }}">View</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input checkbox-create" id="create-{{ $menu }}" name="permissions[{{ $perm['code'] }}][create]" {{ $userPerm && $userPerm->can_create ? 'checked' : '' }}>
                                            <label class="form-check-label" for="create-{{ $menu }}">Create</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input checkbox-update" id="update-{{ $menu }}" name="permissions[{{ $perm['code'] }}][update]" {{ $userPerm && $userPerm->can_update ? 'checked' : '' }}>
                                            <label class="form-check-label" for="update-{{ $menu }}">Update</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input checkbox-delete" id="delete-{{ $menu }}" name="permissions[{{ $perm['code'] }}][delete]" {{ $userPerm && $userPerm->can_delete ? 'checked' : '' }}>
                                            <label class="form-check-label" for="delete-{{ $menu }}">Delete</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input checkbox-etc" id="etc-{{ $menu }}" name="permissions[{{ $perm['code'] }}][etc]" {{ $userPerm && $userPerm->can_etc ? 'checked' : '' }}>
                                            <label class="form-check-label" for="etc-{{ $menu }}">Etc</label>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('users.index') }}" class="btn btn-default">
                            <i class="fa fa-fw fa-arrow-left"></i> Back to Users
                        </a>
                        <button type="submit" class="btn btn-primary float-right">Save Permissions</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('scripts')
    <script>
        function toggleCheckAll(type) {
            document.querySelectorAll('.checkbox-' + type).forEach(checkbox => {
                checkbox.checked = true;
            });
        }

        function removeAll(type) {
            document.querySelectorAll('.checkbox-' + type).forEach(checkbox => {
                checkbox.checked = false;
            });
        }
    </script>
@endsection
