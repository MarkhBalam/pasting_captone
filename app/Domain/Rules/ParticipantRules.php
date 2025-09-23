<?php

namespace App\Domain\Rules;

final class ParticipantRules
{
    public static function validate(array $data, array $ctx): array
    {
        $errors = [];

        $fullName    = trim((string)($data['full_name'] ?? ''));
        $email       = trim((string)($data['email'] ?? ''));
        $affiliation = trim((string)($data['affiliation'] ?? ''));

        if ($fullName === '' || $email === '' || $affiliation === '') {
            $errors[] = 'Participant.FullName, Participant.Email, and Participant.Affiliation are required.';
        }

        $existing = array_map('mb_strtolower', (array)($ctx['existingEmails'] ?? []));
        if ($email !== '' && in_array(mb_strtolower($email), $existing, true)) {
            $errors[] = 'Participant.Email already exists.';
        }

        if (!empty($data['cross_skill_trained'])) {
            $spec = trim((string)($data['specialization'] ?? ''));
            if ($spec === '') {
                $errors[] = 'Cross-skill flag requires Specialization.';
            }
        }

        return $errors;
    }
}
