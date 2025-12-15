<?php

namespace App\Http\Controllers;

use App\Models\TransferType;
use App\Services\TransferTypeService;
use Illuminate\Http\Request;

class TransferTypeController extends Controller
{
    public function __construct(
        private TransferTypeService $service
    ) {}

    /**
     * Index page
     */
    public function index()
    {
        $transferTypes = TransferType::orderBy('name')->get();
        return view('transfer-types.index', compact('transferTypes'));
    }

    /**
     * Store new type
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'supplier'    => 'nullable|string',
            'fabric_type' => 'nullable|string',
            'temperature' => 'nullable|integer',
            'press_time'  => 'nullable|integer',
            'pressure'    => 'nullable|string',
            'peel_type'   => 'nullable|string',
            'notes'       => 'nullable|string',
        ]);

        $this->service->create($validated);

        return redirect()
            ->back()
            ->with('success', 'Transfer type created.');
    }

     public function show(TransferType $transferType)
    {
        return view('transfer-types.show', [
            'transferType' => $transferType,
        ]);
    }

    public function edit(TransferType $transferType)
    {
        return view('transfer-types.edit', [
            'transferType' => $transferType,
        ]);
    }


    /**
     * Update type
     */
    public function update(Request $request, TransferType $type)
    {
        $validated = $request->validate([
            'supplier'    => 'nullable|string',
            'fabric_type' => 'nullable|string',
            'temperature' => 'nullable|integer',
            'press_time'  => 'nullable|integer',
            'pressure'    => 'nullable|string',
            'peel_type'   => 'nullable|string',
            'notes'       => 'nullable|string',
        ]);

        $this->service->update($type, $validated);

        return redirect()
            ->back()
            ->with('success', 'Type updated.');
    }

    /**
     * Modal (Ajax)
     */
    public function pressingSettingsModal(TransferType $type)
    {
        return response()->json(
            $this->service->getPressingSettings($type)
        );
    }

    /**
     * Delete type
     */
    public function destroy(TransferType $transferType){
        // dd($transferType);
        $this->service->delete($transferType);
        return redirect()->back()->with('success', 'Transfer type deleted.');
    }
}
