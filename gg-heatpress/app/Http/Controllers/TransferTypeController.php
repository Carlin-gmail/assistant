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
        $transferTypes = TransferType::orderBy('name')
        ->orderBy('name')
        ->get();

        $groups = TransferType::orderBy('supplier')->pluck('supplier')->unique();
        // dd($groups);

        return view('transfer-types.index', compact(['transferTypes', 'groups']));
    }

    public function create()
    {
        return view('transfer-types.create');
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
            'transfer_url' => 'nullable|url',
        ]);

        $this->service->create($validated);

        return redirect()
            ->route('transfer-types.index')
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
    public function update(Request $request, TransferType $transferType)
    {
        // dd($request->all());
        $validated = $request->validate([
            'supplier'    => 'nullable|string',
            'fabric_type' => 'nullable|string',
            'temperature' => 'nullable|integer',
            'press_time'  => 'nullable|integer',
            'pressure'    => 'nullable|string',
            'peel_type'   => 'nullable|string',
            'notes'       => 'nullable|string',
            'transfer_url' => 'nullable|url',
        ]);
        // dd($validated);

        $this->service->update($transferType, $validated);

        return redirect()
            ->route('transfer-types.show', $transferType)
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

    public function search(Request $request){
        $query = $request->input('search');

        $transferTypes = TransferType::where('name',  'like',"%{$query}%")
            ->orderBy('name')
            ->get();

        $groups = TransferType::orderBy('supplier')->pluck('supplier')->unique();
        return view('transfer-types.index', compact(['transferTypes', 'groups']));
    }
}
