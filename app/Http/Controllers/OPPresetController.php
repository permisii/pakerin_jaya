<?php

namespace App\Http\Controllers;

use App\DataTables\OPPresetsDataTable;
use App\Http\Requests\StoreOPPresetRequest;
use App\Http\Requests\UpdateOPPresetRequest;
use App\Http\Resources\OPPresetResource;
use App\Models\OPPreset;
use App\Support\Enums\IntentEnum;
use App\Traits\Controllers\Filterable;
use App\Traits\Controllers\Searchable;
use Illuminate\Http\Request;

class OPPresetController extends Controller {
    use Filterable, Searchable;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, OPPresetsDataTable $dataTable) {
        $this->checkPermission('read', 'op-presets');
        $intent = $request->get('intent');

        switch ($intent) {
            case IntentEnum::OP_PRESET_SELECT2_SEARCH_OP_PRESETS->value:
                $opPresets = $this->search($request, OPPreset::class, ['name', 'department', 'code', 'no', 'date', 'first_requestor', 'second_requestor', 'approved_by']);
                $opPresets = $this->applyColumnFilters($opPresets, $request, ['head_of_section_id']);
                $opPresets->with('headOfSection');

                return OPPresetResource::collection($opPresets->paginate(5));
        }
        $this->setBreadcrumbs([
            'Home' => route('dashboard'),
            'Master OPPreset' => '',
        ]);

        $this->setParams([
            'title' => 'Master OP Preset',
            'subtitle' => 'Data OP Preset',
        ]);

        return $dataTable->render('op-presets.index', ['params' => $this->getParams(), 'breadcrumbs' => $this->getBreadcrumbs()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('op-presets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOPPresetRequest $request) {
        OPPreset::create($request->validated());

        return to_route('op-presets.index')->with('success', 'OPPreset created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(OPPreset $opPreset) {
        return view('op-presets.show', compact('opPreset'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OPPreset $opPreset) {
        $opPreset = $opPreset->load('headOfSection');

        return view('op-presets.edit', compact('opPreset'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOPPresetRequest $request, OPPreset $opPreset) {
        $opPreset->update($request->validated());

        return to_route('op-presets.index')->with('success', 'OPPreset updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OPPreset $opPreset) {
        $opPreset->delete();

        return back();
    }
}
