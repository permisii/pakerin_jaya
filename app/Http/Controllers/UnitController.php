<?php

namespace App\Http\Controllers;

use App\DataTables\UnitsDataTable;
use App\Http\Requests\Unit\StoreUnitRequest;
use App\Http\Requests\Unit\UpdateUnitRequest;
use App\Http\Resources\UnitResource;
use App\Models\Unit;

class UnitController extends Controller {
    public function index(UnitsDataTable $dataTable) {
        $this->setBreadcrumbs([
            'Home' => route('dashboard'),
            'Units' => '',
        ]);

        $this->setParams([
            'title' => 'Units',
            'subtitle' => 'List of units',
        ]);

        return $dataTable->render('units.index', ['breadcrumbs' => $this->getBreadcrumbs(), 'params' => $this->getParams()]);
    }

    public function create() {
        $units = UnitResource::collection(Unit::all());

        $this->setBreadcrumbs([
            'Home' => route('dashboard'),
            'Units' => route('units.index'),
            'Create' => '',
        ]);

        $this->setParams([
            'title' => 'Create Unit',
            'subtitle' => 'Create a new unit',
        ]);

        return $this->renderView('units.create', ['units' => $units]);
    }

    public function store(StoreUnitRequest $request) {
        Unit::create($request->validated());

        return redirect()->route('units.index')->with('success', 'Unit created.');
    }

    public function show(Unit $unit) {
        $unit = new UnitResource($unit);

        $this->setBreadcrumbs([
            'Home' => route('dashboard'),
            'Units' => route('units.index'),
            $unit->name => '',
        ]);

        $this->setParams([
            'title' => 'Unit',
            'subtitle' => 'Unit details',
        ]);

        return $this->renderView('units.show', ['unit' => $unit]);
    }

    public function edit(Unit $unit) {
        $unit = new UnitResource($unit);

        $this->setBreadcrumbs([
            'Home' => route('dashboard'),
            'Units' => route('units.index'),
            $unit->name => route('units.show', $unit->id),
            'Edit' => '',
        ]);

        $this->setParams([
            'title' => 'Edit Unit',
            'subtitle' => 'Edit unit details',
        ]);

        return $this->renderView('units.edit', ['unit' => $unit]);
    }

    public function update(UpdateUnitRequest $request, Unit $unit) {
        $unit->update($request->validated());

        return redirect()->route('units.index')->with('success', 'Unit updated.');
    }

    public function destroy(Unit $unit) {
        $unit->delete();

        return redirect()->route('units.index')->with('success', 'Unit deleted.');
    }
}
