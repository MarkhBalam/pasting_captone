<?php

namespace App\Domain\Rules;

final class ServiceRules
{
    public static function validate(array $data, array $ctx): array
    {
        $errors = [];

        $facilityId = $data['facility_id'] ?? null;
        $name       = trim((string)($data['name'] ?? ''));
        $category   = trim((string)($data['category'] ?? ''));
        $skillType  = trim((string)($data['skill_type'] ?? ''));

        if (empty($facilityId) || $name === '' || $category === '' || $skillType === '') {
            $errors[] = 'Service.FacilityId, Service.Name, Service.Category, and Service.SkillType are required.';
        }

        $existing = array_map('mb_strtolower', (array)($ctx['existingNamesInFacility'] ?? []));
        if ($name !== '' && in_array(mb_strtolower($name), $existing, true)) {
            $errors[] = 'A service with this name already exists in this facility.';
        }

        return $errors;
    }

    public static function checkBeforeDelete(array $state): array
    {
        if (!empty($state['referencedByProjectTestingRequirements'])) {
            return ['Service in use by Project testing requirements.'];
        }
        return [];
    }
}
