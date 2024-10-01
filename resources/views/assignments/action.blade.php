@php
    use App\Support\Enums\WorkInstructionStatusEnum;
 $menuPrefix = request()->query('menu-prefix');
@endphp
<tr>
    <th>
        <div class="btn-group">
            <a href="{{ route('work-instructions.assignments.show', array_merge([$workInstruction->id, $id], $menuPrefix ? ['menu-prefix' => $menuPrefix] : [])) }}"
               class="btn btn-sm btn-default text-blue action-btn">
                <i class="fas fa-info-circle"></i>
                Detail
            </a>
            @if($workInstruction->status !== WorkInstructionStatusEnum::Submitted->value)
                <form action="{{ route('work-instructions.assignments.destroy', array_merge([$workInstruction->id, $id], $menuPrefix ? ['menu-prefix' => $menuPrefix] : [])) }}"
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
            @endif
            <a href="{{ route('work-instructions.assignments.edit', array_merge([$workInstruction->id, $id], $menuPrefix ? ['menu-prefix' => $menuPrefix] : [])) }}"
               class="btn btn-sm btn-default text-blue action-btn">
                <i class="fas fa-edit"></i>
                Edit
            </a>
        </div>
    </th>
</tr>
