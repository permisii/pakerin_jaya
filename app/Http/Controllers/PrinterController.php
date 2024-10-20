<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePrinterRequest;
use App\Http\Requests\UpdatePrinterRequest;
use App\Models\Printer;
use App\Support\Enums\IntentEnum;
use Illuminate\Http\Request;

class PrinterController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
        $intent = $request->get('intent');

        switch ($intent) {
            case IntentEnum::PRINTER_SELECT2_SEARCH_PRINTERS->value:
                return Printer::where('brand', 'like', '%' . $request->get('q') . '%')
                    ->get();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePrinterRequest $request) {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Printer $printer) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Printer $printer) {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePrinterRequest $request, Printer $printer) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Printer $printer) {
        //
    }
}
