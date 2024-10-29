<?php

namespace App\Http\Controllers;

use App\DataTables\WorkInstructionsDataTable;
use App\Http\Requests\WorkInstruction\StoreWorkInstructionRequest;
use App\Http\Requests\WorkInstruction\UpdateWorkInstructionRequest;
use App\Http\Resources\WorkInstructionResource;
use App\Models\WorkInstruction;

class WorkInstructionController extends Controller {
    public function index(WorkInstructionsDataTable $dataTable) {
        $this->checkPermission('read', 'work-instructions');
        $this->setBreadcrumbs([
            'Home' => route('dashboard'),
            'Instruksi Kerja' => '',
        ]);

        $this->setParams([
            'title' => 'Instruksi Kerja',
            'subtitle' => 'Data Instruksi Kerja',
        ]);

        return $dataTable->render('work-instructions.index', ['params' => $this->getParams(), 'breadcrumbs' => $this->getBreadcrumbs()]);
    }

    public function create() {
        $this->checkPermission('create', 'work-instructions');
        $this->setBreadcrumbs([
            'Home' => route('dashboard'),
            'Instruksi Kerja' => route('work-instructions.index'),
            'Create' => '',
        ]);

        $this->setParams([
            'title' => 'Instruksi Kerja',
            'subtitle' => 'Tambah Instruksi Kerja',
        ]);

        return $this->renderView('work-instructions.create');
    }

    public function store(StoreWorkInstructionRequest $request) {
        $this->checkPermission('create', 'work-instructions');
        $workInstruction = WorkInstruction::create($request->validated());

        return redirect()->route('work-instructions.assignments.index', $workInstruction->id)->with('success', 'WorkInstruction created.');
    }

    public function show(WorkInstruction $workInstruction) {
        $this->checkPermission('read', 'work-instructions');
        $this->restrictOtherWorkerExceptAdmin($workInstruction);
        $workInstruction = new WorkInstructionResource($workInstruction->load('user', 'updatedBy', 'createdBy'));

        $this->setBreadcrumbs([
            'Home' => route('dashboard'),
            'Instruksi Kerja' => route('work-instructions.index'),
            $workInstruction->id => '',
        ]);

        $this->setParams([
            'title' => 'Instruksi Kerja',
            'subtitle' => 'Detail Instruksi Kerja',
        ]);

        return $this->renderView('work-instructions.show', ['workInstruction' => $workInstruction]);
    }

    public function edit(WorkInstruction $workInstruction) {
        $this->checkPermission('update', 'work-instructions');
        $this->restrictOtherWorkerExceptAdmin($workInstruction);
        $workInstruction = new WorkInstructionResource($workInstruction);

        $this->setBreadcrumbs([
            'Home' => route('dashboard'),
            'Instruksi Kerja' => route('work-instructions.index'),
            $workInstruction->name => route('work-instructions.show', $workInstruction->id),
            'Edit' => '',
        ]);

        $this->setParams([
            'title' => 'Edit Instruksi Kerja',
            'subtitle' => 'Edit Detail Instruksi Kerja',
        ]);

        return $this->renderView('work-instructions.edit', ['workInstruction' => $workInstruction]);
    }

    public function update(UpdateWorkInstructionRequest $request, WorkInstruction $workInstruction) {
        $this->checkPermission('update', 'work-instructions');
        $workInstruction->update($request->validated());

        return redirect()->route('work-instructions.index')->with('success', 'WorkInstruction updated.');
    }

    public function destroy(WorkInstruction $workInstruction) {
        $this->checkPermission('delete', 'work-instructions');
        $workInstruction->assignments()->delete();
        $workInstruction->delete();

        return redirect()->route('work-instructions.index')->with('success', 'WorkInstruction deleted.');
    }
}
