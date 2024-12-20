<?php

namespace App\Http\Controllers;

use App\DataTables\AssignmentsDataTable;
use App\Http\Requests\Assignment\StoreAssignmentRequest;
use App\Http\Requests\Assignment\UpdateAssignmentRequest;
use App\Http\Resources\AssignmentResource;
use App\Models\Assignment;
use App\Models\WorkInstruction;
use App\Support\Enums\AssignmentStatusEnum;
use App\Support\Enums\IntentEnum;
use App\Support\Enums\WorkInstructionStatusEnum;
use App\Traits\Controllers\Filterable;
use App\Traits\Controllers\Searchable;
use Illuminate\Http\Request;

class AssignmentController extends Controller {
    use Filterable, Searchable;

    public function index(Request $request, AssignmentsDataTable $dataTable, WorkInstruction $workInstruction) {
        $intent = $request->get('intent');

        switch ($intent) {
            case IntentEnum::ASSIGNMENT_SELECT2_SEARCH_ASSIGNMENTS->value:
                $assignments = $this->search($request, Assignment::class, ['assignment_number', 'problem']);
                $assignments = $this->applyColumnFilters($assignments, $request, ['assignment_number']);

                return AssignmentResource::collection($assignments->paginate(5));
        }
        $this->checkPermission('read', 'assignments');
        $this->restrictOtherWorkerExceptAdmin($workInstruction);
        $this->setBreadcrumbs([
            'Home' => route('dashboard'),
            'Instruksi Kerja' => route('work-instructions.index'),
            $workInstruction->id => route('work-instructions.show', $workInstruction->id),
            'Assignments' => '',
        ]);

        $this->setParams([
            'title' => 'Pekerjaan',
            'subtitle' => 'Detail Instruksi Kerja',
        ]);

        return $dataTable->with('work_instruction_id', $workInstruction->id)->render('assignments.index', [
            'breadcrumbs' => $this->getBreadcrumbs(),
            'workInstruction' => $workInstruction,
            'params' => $this->getParams(),
        ]);
    }

    public function create(WorkInstruction $workInstruction) {
        $this->checkPermission('create', 'assignments');
        $this->restrictOtherWorkerExceptAdmin($workInstruction);
        $assignments = AssignmentResource::collection($workInstruction->assignments()->get());

        $this->setBreadcrumbs([
            'Home' => route('dashboard'),
            'Instruksi Kerja' => route('work-instructions.index'),
            $workInstruction->id => route('work-instructions.show', $workInstruction->id),
            'Tambah Pekerjaan' => '',
        ]);

        $this->setParams([
            'title' => 'Pekerjaaan',
            'subtitle' => $workInstruction->work_date,
        ]);

        return $this->renderView('assignments.create', [
            'assignments' => $assignments,
            'workInstruction' => $workInstruction,
        ]);
    }

    public function store(StoreAssignmentRequest $request, WorkInstruction $workInstruction) {
        $this->checkPermission('create', 'assignments');
        $data = $request->validated();
        // $data['status'] = $request->has('status_checkbox') ? AssignmentStatusEnum::Done : AssignmentStatusEnum::Draft;
        if (isset($data['percentage'])) {
            if ($data['percentage'] < 100) {
                $data['status'] = AssignmentStatusEnum::Draft->value;
            } else {
                $data['status'] = AssignmentStatusEnum::Done->value;
            }
        }

        $workInstruction->assignments()->create($data);

        $this->updateWorkInstructionStatus($workInstruction);

        return redirect()->route('work-instructions.assignments.index', $workInstruction->id)
            ->with('success', 'Assignment created.');
    }

    public function show(WorkInstruction $workInstruction, Assignment $assignment) {
        $this->checkPermission('read', 'assignments');
        $this->restrictOtherWorkerExceptAdmin($workInstruction);
        $assignment = new AssignmentResource($assignment->load('workInstruction', 'updatedBy', 'createdBy'));

        $this->setBreadcrumbs([
            'Home' => route('dashboard'),
            'Instruksi Kerja' => route('work-instructions.index'),
            $workInstruction->id => route('work-instructions.show', $workInstruction->id),
            $assignment->name => '',
        ]);

        $this->setParams([
            'title' => 'Assignment',
            'subtitle' => $workInstruction->work_date,
        ]);

        return $this->renderView('assignments.show', [
            'assignment' => $assignment,
            'workInstruction' => $workInstruction,
        ]);
    }

    public function edit(WorkInstruction $workInstruction, Assignment $assignment) {
        $this->checkPermission('update', 'assignments');
        $this->restrictOtherWorkerExceptAdmin($workInstruction);
        $assignment = new AssignmentResource($assignment);

        $this->setBreadcrumbs([
            'Home' => route('dashboard'),
            'Instruksi Kerja' => route('work-instructions.index'),
            $workInstruction->id => route('work-instructions.show', $workInstruction->id),
            $assignment->name => route('work-instructions.assignments.show', [$workInstruction->id, $assignment->id]),
            'Edit' => '',
        ]);

        $this->setParams([
            'title' => 'Edit Assignment',
            'subtitle' => $workInstruction->work_date,
        ]);

        return $this->renderView('assignments.edit', [
            'assignment' => $assignment,
            'workInstruction' => $workInstruction,
        ]);
    }

    public function update(UpdateAssignmentRequest $request, WorkInstruction $workInstruction, Assignment $assignment) {
        $this->checkPermission('update', 'assignments');
        $data = $request->validated();
        // $data['status'] = $request->has('status_checkbox') ? AssignmentStatusEnum::Done : AssignmentStatusEnum::Draft;
        if ($data['percentage'] < 100) {
            $data['status'] = AssignmentStatusEnum::Draft->value;
        } else {
            $data['status'] = AssignmentStatusEnum::Done->value;
        }
        $assignment->update($data);

        $this->updateWorkInstructionStatus($workInstruction);

        return redirect()->route('work-instructions.assignments.index', $workInstruction->id)->with('success', 'Assignment updated.');
    }

    public function destroy(WorkInstruction $workInstruction, Assignment $assignment) {
        $this->checkPermission('delete', 'assignments');
        $assignment->delete();

        return redirect()->route('work-instructions.assignments.index', $workInstruction->id)->with('success', 'Assignment deleted.');
    }

    /**
     * if all assignments are done, update the work instruction status to submitted, otherwise set it to draft
     */
    private function updateWorkInstructionStatus(WorkInstruction $workInstruction): void {
        $workInstruction->update([
            'status' => $workInstruction->assignments()->where('status', AssignmentStatusEnum::Done)->count() === $workInstruction->assignments()->count()
                ? WorkInstructionStatusEnum::Submitted
                : WorkInstructionStatusEnum::Draft,
        ]);
    }
}
