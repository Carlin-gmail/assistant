<?php

namespace App\Services;

use App\Models\TransferType;

class TransferTypeService
{
    public function create(array $data): TransferType
    {
        return TransferType::create([
            'name'        => $data['name'],
            'supplier'    => $data['supplier'] ?? null,
            'fabric_type' => $data['fabric_type'] ?? null,
            'temperature' => $data['temperature'] ?? null,
            'press_time'  => $data['press_time'] ?? null,
            'pressure'    => $data['pressure'] ?? null,
            'peel_type'   => $data['peel_type'] ?? null,
            'notes'       => $data['notes'] ?? null,
            'last_update' => now(),
        ]);
    }

    public function update(TransferType $type, array $data)
    {
        $data['last_update'] = now();
        $type->update($data);
    }

    public function getPressingSettings(TransferType $type)
    {
        return [
            'name'        => $type->name,
            'supplier'    => $type->supplier,
            'fabric_type' => $type->fabric_type,
            'temperature' => $type->temperature,
            'press_time'  => $type->press_time,
            'pressure'    => $type->pressure,
            'peel_type'   => $type->peel_type,
            'notes'       => $type->notes,
            'last_update' => $type->last_update?->toDateString(),
        ];
    }

    public function delete(TransferType $transferType){
        $transferType->delete($transferType);
    }
}
