<?php

namespace App\Domain\Rules;

final class EquipmentRules
{
    public static function validate(array $data, array $ctx): array
    {
        $errors = [];

        $facilityId    = $data['facility_id'] ?? null;
        $name          = trim((string)($data['name'] ?? ''));
        $inventoryCode = trim((string)($data['inventory_code'] ?? ''));

        if (empty($facilityId) || $name === '' || $inventoryCode === '') {
            $errors[] = 'Equipment.FacilityId, Equipment.Name, and Equipment.InventoryCode are required.';
        }

        $existing = array_map('mb_strtolower', (array)($ctx['existingInventoryCodes'] ?? []));
        if ($inventoryCode !== '' && in_array(mb_strtolower($inventoryCode), $existing, true)) {
            $errors[] = 'Equipment.InventoryCode already exists.';
        }

        if (($data['usage_domain'] ?? null) === 'Electronics') {
            $phases = $data['support_phase'] ?? [];
            $ok = is_array($phases) && (in_array('Prototyping', $phases, true) || in_array('Testing', $phases, true));
            if (!$ok) {
                $errors[] = 'Electronics equipment must support Prototyping or Testing.';
            }
        }

        return $errors;
    }

    public static function checkBeforeDelete(array $state): array
    {
        if (!empty($state['referencedByActiveProject'])) {
            return ['Equipment referenced by active Project.'];
        }
        return [];
    }
}
