<?php

namespace App\Domain\Rules;

final class ProjectRules
{
    public static function validate(array $data, array $ctx): array
    {
        $errors = [];

        $programId = $data['program_id'] ?? null;
        $facilityId = $data['facility_id'] ?? null;
        $name = trim((string)($data['name'] ?? ''));

        if (empty($programId) || empty($facilityId)) {
            $errors[] = 'Project.ProgramId and Project.FacilityId are required.';
        }

        $team = $data['team'] ?? [];
        if (!is_array($team) || count($team) === 0) {
            $errors[] = 'Project must have at least one team member assigned.';
        }

        if (($data['status'] ?? null) === 'Completed') {
            $outcomes = $data['outcomes'] ?? [];
            if (!is_array($outcomes) || count($outcomes) === 0) {
                $errors[] = 'Completed projects must have at least one documented outcome.';
            }
        }

        $existing = array_map('mb_strtolower', (array)($ctx['existingNamesInProgram'] ?? []));
        if ($name !== '' && in_array(mb_strtolower($name), $existing, true)) {
            $errors[] = 'A project with this name already exists in this program.';
        }

        $reqs = (array)($data['requirements'] ?? []);
        $caps = (array)($ctx['facilityCapabilities'] ?? []);
        if (!empty($reqs) && !self::allRequirementsCovered($reqs, $caps)) {
            $errors[] = 'Project requirements not compatible with facility capabilities.';
        }

        return $errors;
    }

    private static function allRequirementsCovered(array $requirements, array $capabilities): bool
    {
        $capSet = array_map('mb_strtolower', $capabilities);
        foreach ($requirements as $r) {
            if (!in_array(mb_strtolower((string)$r), $capSet, true)) return false;
        }
        return true;
    }
}
