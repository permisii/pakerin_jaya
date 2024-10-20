<?php

namespace App\Http\Controllers;

use App\DataTables\PCsDataTable;
use App\Http\Requests\StorePCRequest;
use App\Http\Requests\UpdatePCRequest;
use App\Models\PC;
use App\Support\Enums\IntentEnum;
use Illuminate\Http\Request;

class PCController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, PCsDataTable $dataTable) {
        $intent = $request->get('intent');

        switch ($intent) {
            case IntentEnum::PC_SELECT2_SEARCH_PCS->value:
                // TODO: optimize select2 backend by using limit?
                return PC::where('name', 'like', '%' . $request->get('q') . '%')
                    ->get();
        }

        $this->checkPermission('read', 'pcs');
        $this->setBreadcrumbs([
            'Home' => route('dashboard'),
            'Master PC' => '',
        ]);

        $this->setParams([
            'title' => 'Master PC',
            'subtitle' => 'Data PC',
        ]);

        return $dataTable->render('pcs.index', ['params' => $this->getParams(), 'breadcrumbs' => $this->getBreadcrumbs()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('pcs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePCRequest $request) {
        $pc = PC::create($request->validated());

        return redirect(route('pcs.show', $pc))->with('success', 'PC created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PC $pc) {
        return view('pcs.show', compact('pc'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PC $pc) {
        return view('pcs.edit', compact('pc'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePCRequest $request, PC $pc) {
        $pc->update($request->validated());

        return back()->with('success', 'PC updated successfully.');
//        return redirect(route('pcs.show', $pc))->with('success', 'PC updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PC $pc) {
        $pc->delete();
        return back();
    }

    public function serviceCards(PC $pc) {
        $serviceCards = $pc->serviceCards->load([
            'device',
            'worker',
            'assignment'
        ]);
        return view('pcs.service-cards', compact('pc', 'serviceCards'));
    }
}
