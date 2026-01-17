<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display inventory list (grid / table later).
     */
    public function index()
    {
        return view('inventories.index', [
            'items' => Inventory::orderBy('name')->get(),
        ]);
    }

    /**
     * Show form to create a new inventory item.
     */
    public function create()
    {
        return view('inventories.create');
    }

    /**
     * Store a new inventory item.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'                 => 'required|string|max:255',
            'brand'                => 'nullable|string|max:255',
            'category'             => 'nullable|string|max:255',
            'type'                 => 'nullable|string|max:255',
            'condition'            => 'nullable|string|max:255',
            'color'                => 'nullable|string|max:255',
            'size'                 => 'nullable|string|max:255',
            'material'             => 'nullable|string|max:255',
            'model'                => 'nullable|string|max:255',
            'style'                => 'nullable|string|max:255',
            'vendor'               => 'nullable|string|max:255',
            'sku'                  => 'nullable|string|max:255|unique:inventories,sku',
            'location'             => 'nullable|string|max:255',
            'status'               => 'nullable|string|max:255',
            'minimum_stock_level'  => 'nullable|string|max:255',
            'quantity'             => 'nullable|integer|min:0',
            'price'                => 'nullable|numeric',
            'purchase_date'        => 'nullable|date',
            'notes'                => 'nullable|string',
            'description'          => 'nullable|string',
            'image_url'            => 'nullable|string|max:255',
            'product_url'          => 'nullable|string|max:255',
        ]);

        Inventory::create($validated);

        return redirect()
            ->route('inventories.index')
            ->with('success', 'Inventory item created.');
    }

    /**
     * Show single inventory item.
     */
    public function show(Inventory $inventory)
    {
        return view('inventories.show', [
            'item' => $inventory,
        ]);
    }

    /**
     * Edit inventory item.
     */
    public function edit(Inventory $inventory)
    {
        return view('inventories.edit', [
            'item' => $inventory,
        ]);
    }

    /**
     * Update inventory item.
     */
    public function update(Request $request, Inventory $inventory)
    {
        $validated = $request->validate([
            'name'                 => 'required|string|max:255',
            'brand'                => 'nullable|string|max:255',
            'category'             => 'nullable|string|max:255',
            'type'                 => 'nullable|string|max:255',
            'condition'            => 'nullable|string|max:255',
            'color'                => 'nullable|string|max:255',
            'size'                 => 'nullable|string|max:255',
            'material'             => 'nullable|string|max:255',
            'model'                => 'nullable|string|max:255',
            'style'                => 'nullable|string|max:255',
            'vendor'               => 'nullable|string|max:255',
            'sku'                  => 'nullable|string|max:255|unique:inventories,sku,' . $inventory->id,
            'location'             => 'nullable|string|max:255',
            'status'               => 'nullable|string|max:255',
            'minimum_stock_level'  => 'nullable|string|max:255',
            'quantity'             => 'nullable|integer|min:0',
            'price'                => 'nullable|numeric',
            'purchase_date'        => 'nullable|date',
            'notes'                => 'nullable|string',
            'description'          => 'nullable|string',
            'image_url'            => 'nullable|string|max:255',
        ]);

        $inventory->update($validated);

        return redirect()
            ->route('inventories.index')
            ->with('success', 'Inventory item updated.');
    }

    /**
     * Delete inventory item.
     */
    public function destroy(Inventory $inventory)
    {
        $inventory->delete();

        return redirect()
            ->route('inventories.index')
            ->with('success', 'Inventory item deleted.');
    }
}
