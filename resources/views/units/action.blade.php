<tr>
    <th>
        <div class="btn-group">
            <a href="{{ route('units.show', $id) }}"
               class="btn btn-sm btn-default text-blue action-btn">
                <i class="fas fa-info-circle"></i>
                Detail
            </a>
            <form action="{{route('units.destroy', $id)}}" method="post"
                  id="delete-form-{{$id}}">
                @csrf
                @method('DELETE')
{{--                <button type="button" onclick="confirmDelete({{ $id }})"--}}
{{--                        class="btn btn-sm btn-default text-danger action-btn"><i--}}
{{--                        class="fas fa-trash"></i> Delete--}}
{{--                </button>--}}
                <button type="button" onclick="window.confirm('Are you sure?') ? document.getElementById('delete-form-{{$id}}').submit() : false"
                        class="btn btn-sm btn-default text-danger action-btn"><i
                        class="fas fa-trash"></i> Delete
                </button>
            </form>
        </div>

    </th>

</tr>
