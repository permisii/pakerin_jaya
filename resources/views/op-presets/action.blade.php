<tr>
    <th>
        <div class="btn-group">
            <a href="{{ route('op-presets.show', $id) }}"
               class="btn btn-sm btn-default text-blue action-btn">
                <i class="fas fa-info-circle"></i>
                Detail
            </a>

            {{--            @if($workInstruction->user_id === auth()->user()->id)--}}
            <form action="{{route('op-presets.destroy', $id)}}" method="post"
                  id="delete-form-{{$id}}">
                @csrf
                @method('DELETE')
                <button type="button" onclick="confirmDelete({{ $id }})"
                        class="btn btn-sm btn-default text-danger action-btn"><i
                        class="fas fa-trash"></i> Delete
                </button>
            </form>
            {{--            @endif--}}

        </div>
    </th>
</tr>
