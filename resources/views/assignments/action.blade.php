@php use App\Support\Enums\WorkInstructionStatusEnum;
 $isAdmin = auth()->user()->is_admin;
@endphp

<tr>
    <th>
        <div class="btn-group">
            @if($isAdmin)
                <a href="{{ route('work-instructions.assignments.show', [$workInstruction->id, $id]) }}"
                   class="btn btn-sm btn-default text-blue action-btn">
                    <i class="fas fa-info-circle"></i>
                    Detail
                </a>
            @endif

            @if(!$isAdmin && $workInstruction->user_id === auth()->user()->id)
                <form action="{{ route('work-instructions.assignments.destroy', [$workInstruction->id, $id]) }}"
                      method="post"
                      id="delete-form-{{ $id }}">
                    @csrf
                    @method('DELETE')
                    {{--                    <button type="button" onclick="confirmDelete({{ $id }})"--}}
                    {{--                            class="btn btn-sm btn-default text-danger action-btn">--}}
                    {{--                        <i class="fas fa-trash"></i> Delete--}}
                    {{--                    </button>--}}
                    <button onclick="confirm('Are you sure?')"
                            class="btn btn-sm btn-default text-danger action-btn">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </form>

                {{--            @if($assignment->status !== \App\Support\Enums\AssignmentStatusEnum::Done->value)--}}

                @if($workInstruction->status !== WorkInstructionStatusEnum::Submitted->value)
                    <a href="{{ route('work-instructions.assignments.edit', [$workInstruction->id, $id]) }}"
                       class="btn btn-sm btn-default text-blue action-btn">
                        <i class="fas fa-edit"></i>
                        Edit
                    </a>
                @endif
            @endif


        </div>
    </th>
</tr>
