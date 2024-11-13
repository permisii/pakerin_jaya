<tr>
    <th>
        <div class="btn-group">
            @if($pp->created_by === auth()->user()->id)
                <a href="{{ route('pps.show', $pp->id) }}"
                   class="btn btn-sm btn-default text-blue action-btn">
                    <i class="fas fa-info-circle"></i>
                    Detail
                </a>

                <form action="{{route('pps.destroy', $pp->id)}}" method="post"
                      id="delete-form-{{$pp->id}}">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="confirmDelete({{ $pp->id }})"
                            class="btn btn-sm btn-default text-danger action-btn"><i
                                class="fas fa-trash"></i> Delete
                    </button>
                </form>
            @endif

        </div>
    </th>
</tr>
