<?php

require_once __DIR__ . '/../helpers.php';
$config = require __DIR__ . '/../config.php';

$jobCandidateLocation = $config['person_storage_location'];
$companiesLocation = $config['advertisements_storage_location'];

list($pathToPersonQualifications, $pathToJobBoard) = parseInputArgumets($argc, $argv);
var_dump($pathToPersonQualifications, $pathToJobBoard);

$contents = file_get_contents($pathToPersonQualifications);
$jobCandidateInputMatches = [];

preg_match_all("/\"(.+)\"\s(has)(.+)/", $contents, $jobCandidateInputMatches);

$jobCandidate = [
    'name' => $jobCandidateInputMatches[1][0],
    'qualifications' => []
];

$qualifications = processQualifications($jobCandidateInputMatches[3][0]);

foreach ($qualifications as $qualification) {
    $jobCandidate['qualifications'][] = $qualification;
}

file_put_contents($jobCandidateLocation, json_encode($jobCandidate));


$contents = file_get_contents($pathToJobBoard);
$jobOffers = [];

preg_match_all("/\"(.+)\"\s(requires|doesn't require anything)(.+)/", $contents, $jobOffers);

$companies = [];

foreach ($jobOffers[1] as $key => $companyName) {
    $requirements = [];

    if ($jobOffers[2][$key] === "requires") {
        $requirements = processQualifications($jobOffers[3][$key]);
    }

    $companies[$key] = [
        'name' => $companyName,
        'requirements' => $requirements
    ];
}

file_put_contents($companiesLocation, json_encode($companies));