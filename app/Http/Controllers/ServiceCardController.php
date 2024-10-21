<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceCardRequest;
use App\Http\Requests\UpdateServiceCardRequest;
use App\Models\ServiceCard;

class ServiceCardController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        return view('service-cards.index', [
            'serviceCards' => ServiceCard::with([
                'device',
                'assignment',
                'worker',
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
        $serviceCard = ServiceCard::create($request->validated());

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
