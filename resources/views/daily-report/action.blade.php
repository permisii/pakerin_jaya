@php use App\Support\Enums\WorkInstructionStatusEnum; @endphp

<tr>
    <th>
        <div class="btn-group">
            @if($workInstruction->assignments()->count() === 0)
                <a href="{{route('work-instructions.assignments.index', [$workInstruction->id, 'menu-prefix' => 'daily-report'])}}"  class="btn btn-primary btn-sm">
                    Create Assignment
                </a>

            @elseif($workInstruction->status === WorkInstructionStatusEnum::Draft->value)
                <a href="{{route('work-instructions.assignments.index', [$workInstruction->id, 'menu-prefix' => 'daily-report'])}}"  class="btn btn-warning btn-sm">
                    Continue Assignment
                </a>

                <form action="{{route('work-instructions.update', [$workInstruction->id, 'menu-prefix' => 'daily-report'])}}" method="post" id="submit-form">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="{{WorkInstructionStatusEnum::Submitted}}">
                    <button type="submit" class="btn btn-success btn-sm">Finish</button>
                </form>

            @elseif($workInstruction->status === WorkInstructionStatusEnum::Submitted->value)
                <a href="{{route('work-instructions.assignments.index', [$workInstruction->id, 'menu-prefix' => 'daily-report'])}}" class="btn btn-info btn-sm">
                    Assignment Details
                </a>
            @endif
        </div>
    </th>
</tr>
