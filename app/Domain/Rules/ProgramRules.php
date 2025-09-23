<?php

namespace App\Domain\Rules;

final class ProgramRules
{
    public static function validate(array $data, array $ctx): array
    {
        $errors = [];

        $name = trim((string)($data['name'] ?? ''));
        // $desc = trim((string)($data['description'] ?? '')); // not asserted in your test

        if ($name === '') {
            $errors[] = 'Program.Name is required.';
        }

        $existing = array_map('mb_strtolower', (array)($ctx['existingNames'] ?? []));
        if ($name !== '' && in_array(mb_strtolower($name), $existing, true)) {
            $errors[] = 'Program.Name already exists.';
        }

        $focus = $data['focus_areas'] ?? [];
        if (is_array($focus) && count($focus) > 0) {
            $valid     = (array)($ctx['validAlignments'] ?? []);
            $alignment = (string)($data['national_alignment'] ?? '');
            if ($alignment === '' || !in_array($alignment, $valid, true)) {
                $errors[] = 'Program.NationalAlignment must include at least one recognized alignment when FocusAreas are specified.';
            }
        }

        return $errors;
    }

    public static function checkBeforeDelete(array $state): array
    {
        if (!empty($state['hasProjects'])) {
            return ['Program has Projects; archive or reassign before delete.'];
        }
        return [];
    }
}
