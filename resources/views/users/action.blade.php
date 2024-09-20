<tr>
    <th>
        <div class="btn-group">
            <a href="{{ route('users.show', $id) }}"
               class="btn btn-sm btn-default text-blue action-btn">
                <i class="fas fa-info-circle"></i>
                Detail
            </a>
            <form action="{{route('users.destroy', $id)}}" method="post"
                  id="delete-form-{{$id}}">
                @csrf
                @method('DELETE')
                <button type="button" onclick="confirmDelete({{ $id }})"
                        class="btn btn-sm btn-default text-danger action-btn"><i
                        class="fas fa-trash"></i> Delete
                </button>
            </form>
            <button onclick="resetpass()" class="btn btn-sm btn-default text-info action-btn"><i
                    class="fas fa-fw fa-lock-open"></i> Reset Pass
            </button>
            {{--                                <a href="{{ route('users.akses') }}" class="btn btn-sm btn-default text-blue"><i--}}
            {{--                                        class="fas fa-check"></i> Akses</a>--}}
            <a href="{{route('users.edit', $id)}}"
               class="btn btn-sm btn-default text-blue action-btn">
                <i class="fas fa-edit"></i>
                Edit
            </a>
        </div>

    </th>

</tr>
