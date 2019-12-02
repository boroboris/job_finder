<?php

use App\Users\Person;
use \App\Users\Advertisement;

require_once 'helpers.php';

require_once __DIR__ . '/Users/Person.php';
require_once __DIR__ . '/Users/Advertisement.php';
require_once __DIR__ . '/JobFinder.php';

$config = require __DIR__ . '/config.php';

/*
 * convert input to json - preprocess input
 * */
list($pathToPersonQualifications, $pathToJobBoard) = parseInputArgumets($argc, $argv);
shell_exec('php ' . __DIR__ . '/scripts/processJobSearchInput.php ' . $pathToPersonQualifications . ' ' . $pathToJobBoard);

/*
 *  get json array of Person and Companies
 * */
$usersLocation = $config['person_storage_location'];
$advertisementsStorageLocation = $config['advertisements_storage_location'];
$resultsLocation = $config['results_location'];

$personData = json_decode(file_get_contents($usersLocation), true);
$advertisementInfo = json_decode(file_get_contents($advertisementsStorageLocation), true);

$person = new Person($personData['name'], $personData['qualifications']);
$advertisements = [];

foreach ($advertisementInfo as $companyData) {
    $advertisements[] = new Advertisement($companyData['name'], $companyData['requirements']);
}

/*
 *  find out for which jobs Person qualifies - "search algorithm"
 * */
$personQualifications = $person->getQualifications();
$qualificationNames = array_keys($personQualifications);

// clear results
file_put_contents($resultsLocation, "");

// match candidate with potential companies
foreach ($advertisements as $company) {
    $requirements = $company->getRequiredQualifications();

    if (count($requirements) === 0) {
        $output = JobFinder::noRequirementsOutput($person, $company);

        echo $output;
        file_put_contents($resultsLocation, $output, FILE_APPEND);

        continue;
    }

    $requirementNames = array_keys($requirements);
    $result = array_diff($requirementNames, $qualificationNames);

    if (count($result) === 0) {
        $satisfiedRequirements = [];
        $requirementTypesSatisfied = [];

        foreach ($requirements as $name => $requirement) {
            list($found, $requirementTypeSatisfied) = JobFinder::matchPersonQualifications($personQualifications[$name], $requirement);

            if ($found) {
                $satisfiedRequirements[] = 1;
                $requirementTypesSatisfied[] = $requirementTypeSatisfied;
            } else {
                $satisfiedRequirements[] = 0;
            }
        }

        $requirementsCount = count($satisfiedRequirements);
        if ($requirementsCount > 0) {
            $allRequirementsSatisfied = array_sum($satisfiedRequirements) / $requirementsCount === 1;

            if ($allRequirementsSatisfied) {
                $output = JobFinder::satisfiedRequirementsOutput($person, $company, $requirementTypesSatisfied);

                echo $output;
                file_put_contents($resultsLocation, $output, FILE_APPEND);
            }
        }
    }
}
