<?php

namespace App\Http\Controllers;

use App\DataTables\PrintersDataTable;
use App\Http\Requests\StorePrinterRequest;
use App\Http\Requests\UpdatePrinterRequest;
use App\Http\Resources\PrinterResource;
use App\Models\Printer;
use App\Support\Enums\IntentEnum;
use App\Traits\Controllers\Filterable;
use App\Traits\Controllers\Searchable;
use Illuminate\Http\Request;

class PrinterController extends Controller {
    use Filterable, Searchable;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, PrintersDataTable $dataTable) {
        $intent = $request->get('intent');

        switch ($intent) {
            case IntentEnum::PRINTER_SELECT2_SEARCH_PRINTERS->value:
                $printers = $this->search($request, Printer::class, ['name', 'index']);
                $printers = $this->applyColumnFilters($printers, $request, ['name']);

                return PrinterResource::collection($printers->paginate(5));
        }

        $this->checkPermission('read', 'printers');
        $this->setBreadcrumbs([
            'Home' => route('dashboard'),
            'Master Printer' => '',
        ]);

        $this->setParams([
            'title' => 'Master Printer',
            'subtitle' => 'Data Printer',
        ]);

        return $dataTable->render('printers.index', [
            'params' => $this->getParams(),
            'breadcrumbs' => $this->getBreadcrumbs(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('printers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePrinterRequest $request) {
        $printer = Printer::create($request->validated());

        return redirect(route('printers.service-cards.index', $printer))->with('success', 'Printer created successfully.');

        //        return redirect(route('printers.show', $printer))->with('success', 'Printer created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Printer $printer) {
        return view('printers.show', compact('printer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Printer $printer) {
        return view('printers.edit', compact('printer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePrinterRequest $request, Printer $printer) {
        $printer->update($request->validated());

        return redirect(route('printers.service-cards.index', $printer))->with('success', 'Printer created successfully.');

        //        return back()->with('success', 'Printer updated successfully.');
        //        return redirect(route('printers.show', $printer))->with('success', 'Printer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Printer $printer) {
        $printer->delete();

        return back();
    }

    public function serviceCards(Printer $printer) {
        $serviceCards = $printer->serviceCards->load([
            'worker',
            'device',
        ]);

        return view('printers.service-cards', compact('printer', 'serviceCards'));
    }
}
