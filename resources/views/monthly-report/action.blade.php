@php use App\Support\Enums\WorkInstructionStatusEnum; @endphp

<tr>
    <th>
        <div class="btn-group">
            @if($workInstruction->assignments()->count() === 0)
                <a href="{{route('work-instructions.assignments.index', $workInstruction->id)}}">
                    Create Assignment
                </a>

            @elseif($workInstruction->status === WorkInstructionStatusEnum::Draft)
                <a href="{{route('work-instructions.assignments.index', $workInstruction->id)}}">
                    Continue Assignment
                </a>

            @elseif($workInstruction->status === WorkInstructionStatusEnum::Submitted)
                <a href="{{route('work-instructions.assignments.index', $workInstruction->id)}}">
                    Assignment Details
                </a>
            @endif
        </div>
    </th>
</tr>
