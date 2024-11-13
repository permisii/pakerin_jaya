<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePPRequest;
use App\Http\Requests\UpdatePPRequest;
use App\Models\PP;
use App\Traits\Controllers\Filterable;
use App\Traits\Controllers\Searchable;
use Illuminate\Http\Request;

class PPController extends Controller {
    use Filterable, Searchable;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, PPsDataTable $dataTable) {
        $this->checkPermission('read', 'pps');
        $this->setBreadcrumbs([
            'Home' => route('dashboard'),
            'Master PP' => '',
        ]);

        $this->setParams([
            'title' => 'Master PP',
            'subtitle' => 'Data PP',
        ]);

        return $dataTable->render('pps.index', ['params' => $this->getParams(), 'breadcrumbs' => $this->getBreadcrumbs()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('pps.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePPRequest $request) {
        $pc = PP::create($request->validated());

        return redirect(route('pps.service-cards.index', $pc))->with('success', 'PP created successfully.');

        //        return redirect(route('pps.show', $pc))->with('success', 'PP created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PP $pc) {
        return view('pps.show', compact('pc'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PP $pc) {
        return view('pps.edit', compact('pc'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePPRequest $request, PP $pc) {
        $pc->update($request->validated());

        return redirect(route('pps.service-cards.index', $pc))->with('success', 'PP created successfully.');

        //        return back()->with('success', 'PP updated successfully.');
        //        return redirect(route('pps.show', $pc))->with('success', 'PP updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PP $pc) {
        $pc->delete();

        return back();
    }

    public function serviceCards(PP $pc, PPServiceCardsDataTable $dataTable) {
        return $dataTable->render('pps.service-cards', ['pc' => $pc]);
    }
}
