<tr>
    <th>
        <div class="btn-group">
            <a href="{{ route('ops.show', $op->id) }}"
               class="btn btn-sm btn-default text-blue action-btn">
                <i class="fas fa-info-circle"></i>
                Detail
            </a>
            @if($op->canBeDeleted())
                <form action="{{route('ops.destroy', $op->id)}}" method="post"
                      id="delete-form-{{$op->id}}">
                    @csrf
                    @method('DELETE')
                    {{--                <button type="button" onclick="confirmDelete({{ $op->id }})"--}}
                    {{--                        class="btn btn-sm btn-default text-danger action-btn"><i--}}
                    {{--                        class="fas fa-trash"></i> Delete--}}
                    {{--                </button>--}}
                    <button type="button"
                            onclick="window.confirm('Are you sure?') ? document.getElementById('delete-form-{{$op->id}}').submit() : false"
                            class="btn btn-sm btn-default text-danger action-btn"><i
                            class="fas fa-trash"></i> Delete
                    </button>
                </form>
            @endif
        </div>

    </th>

</tr>
