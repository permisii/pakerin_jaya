<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceCardRequest;
use App\Http\Requests\UpdateServiceCardRequest;
use App\Models\Assignment;
use App\Models\ServiceCard;
use App\Models\WorkProcess;

class ServiceCardController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        return view('service-cards.index', [
            'serviceCards' => ServiceCard::with([
                'device',
                'assignment',
                'workProcesses',
            ]),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('service-cards.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceCardRequest $request) {
        $assignment = Assignment::create([
            'assignment_number' => $request->validated()['assignment_number'],
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
        ]);

        $serviceCard = ServiceCard::create(array_merge($request->validated(), [
            'assignment_id' => $assignment->id,
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
        ]));

        $workerIds = $request->validated()['worker_ids'];
        foreach ($workerIds as $workerId) {
            WorkProcess::create([
                'service_card_id' => $serviceCard->id,
                'user_id' => $workerId,
            ]);
        }

        if ($serviceCard->device_type === 'App\Models\PC') {
            return redirect()->route('pcs.service-cards.index', ['pc' => $serviceCard->device_id]);
        } elseif ($serviceCard->device_type === 'App\Models\Printer') {
            return redirect()->route('printers.service-cards.index', ['printer' => $serviceCard->device_id]);
        }

        return redirect()->route('service-cards.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(ServiceCard $serviceCard) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServiceCard $serviceCard) {
        return view('service-cards.edit', compact('serviceCard'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceCardRequest $request, ServiceCard $serviceCard) {
        $serviceCard->update($request->validated());

        if (isset($request->validated()['worker_ids'])) {
            $workerIds = $request->validated()['worker_ids'];
            WorkProcess::where('service_card_id', $serviceCard->id)->delete();
            foreach ($workerIds as $workerId) {
                WorkProcess::create([
                    'service_card_id' => $serviceCard->id,
                    'user_id' => $workerId,
                ]);
            }
        } else {
            $serviceCard->workProcesses()->delete();
        }

        if ($serviceCard->device_type === 'App\Models\PC') {
            return redirect()->route('pcs.service-cards.index', ['pc' => $serviceCard->device_id]);
        } elseif ($serviceCard->device_type === 'App\Models\Printer') {
            return redirect()->route('printers.service-cards.index', ['printer' => $serviceCard->device_id]);
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceCard $serviceCard) {
        $serviceCard->delete();

        return back();
    }
}
