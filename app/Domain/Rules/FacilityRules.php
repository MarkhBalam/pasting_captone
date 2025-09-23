<?php

namespace App\Domain\Rules;

final class FacilityRules
{
    public static function validate(array $data, array $ctx): array
    {
        $errors = [];

        $name = trim((string)($data['name'] ?? ''));
        $loc  = trim((string)($data['location'] ?? ''));
        $type = trim((string)($data['facility_type'] ?? ''));

        if ($name === '' || $loc === '' || $type === '') {
            $errors[] = 'Facility.Name, Facility.Location, and Facility.FacilityType are required.';
        }

        $pairs = (array)($ctx['existingPairs'] ?? []);
        if ($name !== '' && $loc !== '' && self::pairExists($pairs, $name, $loc)) {
            $errors[] = 'A facility with this name already exists at this location.';
        }

        if (!empty($ctx['hasAnyServicesOrEquipment'])) {
            $caps = $data['capabilities'] ?? [];
            if (empty($caps) || (is_array($caps) && count($caps) === 0)) {
                $errors[] = 'Facility.Capabilities must be populated when Services/Equipment exist.';
            }
        }

        return $errors;
    }

    public static function checkBeforeDelete(array $state): array
    {
        if (!empty($state['hasServices']) || !empty($state['hasEquipment']) || !empty($state['hasProjects'])) {
            return ['Facility has dependent records (Services/Equipment/Projects).'];
        }
        return [];
    }

    private static function pairExists(array $pairs, string $name, string $location): bool
    {
        $needle = mb_strtolower($name).'|'.mb_strtolower($location);
        foreach ($pairs as $p) {
            $pn = mb_strtolower((string)($p['name'] ?? ''));
            $pl = mb_strtolower((string)($p['location'] ?? ''));
            if ($pn.'|'.$pl === $needle) return true;
        }
        return false;
    }
}
