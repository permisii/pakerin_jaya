<?php

namespace App\Http\Controllers;

use App\DataTables\OPCreatePPsDataTable;
use App\DataTables\OPsDataTable;
use App\Http\Requests\StoreOPRequest;
use App\Http\Requests\UpdateOPRequest;
use App\Models\OP;
use App\Models\PP;
use App\Support\Enums\PPStatusEnum;
use App\Traits\Controllers\Filterable;
use App\Traits\Controllers\Searchable;
use Illuminate\Http\Request;

class OPController extends Controller {
    use Filterable, Searchable;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, OPsDataTable $dataTable) {
        $this->checkPermission('read', 'ops');
        $this->setBreadcrumbs([
            'Home' => route('dashboard'),
            'Master OP' => '',
        ]);

        $this->setParams([
            'title' => 'Master OP',
            'subtitle' => 'Data OP',
        ]);

        return $dataTable->render('ops.index', ['params' => $this->getParams(), 'breadcrumbs' => $this->getBreadcrumbs()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(OPCreatePPsDataTable $dataTable) {
        return $dataTable->render('ops.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOPRequest $request) {
        $validated = $request->validated();
        $pps = $validated['pp_ids'];

        // Handle the date_needed field based on the selection
        switch ($validated['date_needed_select']) {
            case '2_bulan':
                //                $validated['date_needed'] = now()->addMonths(2)->toDateString();
                $validated['date_needed'] = $validated['custom_date'];
                break;
            case 'urgent':
                //                $validated['date_needed'] = now()->toDateString();
                $validated['date_needed'] = 'Urgent';
                break;
            case 'custom_date':
                $validated['date_needed'] = $validated['custom_date'];
                break;
        }

        $op = OP::create($validated);

        foreach ($pps as $ppId) {
            $op->detailOps()->create(['pp_id' => $ppId]);
            PP::where('id', $ppId)->update(['status' => PPStatusEnum::Process]);
        }

        return to_route('ops.index')->with('success', 'OP created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(OP $op) {
        $op = $op->load('detailOps.pp');

        return view('ops.show', compact('op'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OP $op) {
        return view('ops.edit', compact('op'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOPRequest $request, OP $op) {
        $op->update($request->validated());

        return to_route('ops.index')->with('success', 'OP updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OP $op) {
        $op->delete();

        return back();
    }
}
