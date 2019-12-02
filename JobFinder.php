<?php

use App\Users\Person;

class JobFinder
{
    static function noRequirementsOutput(Person $person, $company): string
    {
        $output = $person->getName() . ' can apply for job in company ' . $company->getName() . PHP_EOL;
        $output .= 'This job has no requirements' . PHP_EOL;
        $output .= '--------------------------' . PHP_EOL;
        return $output;
    }

    static function satisfiedRequirementsOutput(Person $person, $company, array $requirementTypesSatisfied): string
    {
        $output = $person->getName() . ' can apply for job in company ' . $company->getName() . PHP_EOL;
        $output .= 'Requirements satisfied: ' . implode($requirementTypesSatisfied, ', ') . PHP_EOL;
        $output .= '--------------------------' . PHP_EOL;

        return $output;
    }

    static function matchPersonQualifications($personQualifications, $requirement)
    {
        $found = false;

        foreach ($personQualifications as $qualification) {

            $result = array_filter($requirement, function ($value) use ($qualification) {
                return $value == $qualification;
            });

            if (count($result) > 0) {
                $found = true;
                return [$found, array_pop($result)->getType()];
            }
        }

        return [$found, null];
    }
}